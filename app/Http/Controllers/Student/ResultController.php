<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $submissions = DB::table('assessment_submissions')
            ->where('user_id', $userId)
            ->get()
            ->keyBy('assessment_type');

        $minatSubmission = $submissions->get('minat_bakat');
        $kemampuanSubmission = $submissions->get('kemampuan');
        $kepribadianSubmission = $submissions->get('kepribadian');

        $minatResponses = $this->decodeResponses($minatSubmission->responses ?? null);
        $kemampuanResponses = $this->decodeResponses($kemampuanSubmission->responses ?? null);
        $kepribadianResponses = $this->decodeResponses($kepribadianSubmission->responses ?? null);

        /*
|--------------------------------------------------------------------------
| Mapping ID soal ke teks pertanyaan
|--------------------------------------------------------------------------
| Data responses di database tetap menggunakan ID soal.
| Teks pertanyaan hanya digunakan untuk kebutuhan tampilan.
*/

$allQuestionIds = array_unique(array_merge(
    $this->collectQuestionIds($minatResponses),
    $this->collectQuestionIds($kemampuanResponses),
    $this->collectQuestionIds($kepribadianResponses)
));

$questionTexts = [];

if (!empty($allQuestionIds)) {
    $questionTexts = DB::table('questions')
        ->whereIn('id', $allQuestionIds)
        ->pluck('question_text', 'id')
        ->toArray();
}

// Format jawaban Minat Bakat dan Kepribadian.
$minatQuestionResponses = $this->formatQuestionResponses(
    $minatResponses,
    $questionTexts
);

$kepribadianQuestionResponses = $this->formatQuestionResponses(
    $kepribadianResponses,
    $questionTexts
);

// Kunci jawaban mengikuti pilihan yang benar-benar ditampilkan
        // pada student/assessment/kemampuan.blade.php.
        $abilityAnswerKeys = [
            'numerik' => [
                1 => 'Rp10.000',
                2 => '4 Hari',
                3 => '36',
                4 => '37',
                5 => '3 Jam',
            ],
            'verbal' => [
                1 => 'B. Kilat',
                2 => 'A. Menetap',
                3 => 'B. Menulis',
                4 => 'A. Berhasil guna / membawa hasil',
                5 => 'B. Persamaan / kiasan',
            ],
            // Belum diberi kunci karena Blade masih menampilkan placeholder ilustrasi.
            'abstrak' => [],
        ];

        // Penyimpanan tetap memakai key "verbal"; halaman hasil memakai "literasi".
        $kemampuanQuestionResponses = [];
        $abilitySubtests = [];

        $subtestConfig = [
            'numerik' => ['label' => 'Numerik', 'total' => 5],
            'verbal' => ['label' => 'Literasi', 'total' => 5],
            'abstrak' => ['label' => 'Abstrak & Logika', 'total' => 6],
        ];

        foreach ($subtestConfig as $key => $config) {
            $responsesForSubtest = $this->extractSubtestResponses($kemampuanResponses, $key);

            // Kompatibilitas dengan data lama yang mungkin tersimpan sebagai "literasi".
            if ($key === 'verbal' && empty($responsesForSubtest)) {
                $responsesForSubtest = $this->extractSubtestResponses($kemampuanResponses, 'literasi');
            }

            $displayKey = $key === 'verbal' ? 'literasi' : $key;
            $kemampuanQuestionResponses[$displayKey] = $this->formatIndexedResponses(
                $responsesForSubtest,
                $config['label']
            );

            $scoreData = $this->scoreAbilitySubtest(
                $responsesForSubtest,
                $abilityAnswerKeys[$key],
                $config['total']
            );

            $hasResponses = $scoreData['answered_count'] > 0;
            $canBeScored = !empty($abilityAnswerKeys[$key]);

            $abilitySubtests[$displayKey] = [
                'label' => $config['label'],
                'status' => !$hasResponses
                    ? 'Belum dikerjakan'
                    : ($scoreData['answered_count'] === $config['total'] ? 'Selesai' : 'Belum lengkap'),
                'score' => $canBeScored ? $scoreData['score_percent'] : null,
                'score_percent' => $canBeScored ? $scoreData['score_percent'] : null,
                'answered_count' => $scoreData['answered_count'],
                'correct_count' => $canBeScored ? $scoreData['correct_count'] : null,
                'wrong_count' => $canBeScored ? $scoreData['wrong_count'] : null,
                'unanswered_count' => $config['total'] - $scoreData['answered_count'],
                'total_count' => $config['total'],
            ];
        }

        /*
         * Kategori minat MyUniv.
         * Pastikan ID kategori ini sama dengan interest_categories di Supabase.
         */
        $interestCategories = [
            1 => 'Teknologi & Komputer',
            2 => 'Bisnis & Ekonomi',
            3 => 'Sains & Matematika',
            4 => 'Kesehatan',
            5 => 'Sosial & Humaniora',
            6 => 'Bahasa & Komunikasi',
            7 => 'Seni & Desain',
            8 => 'Pendidikan',
        ];

        /*
         * Form saat ini mengirim question_id => score (1-5).
         * Filter label diperlukan karena database sebelumnya memiliki pilihan
         * skala suka dan skala setuju dengan nilai yang dapat berulang.
         */
        $preferenceLabels = [
            'sangat tidak suka',
            'tidak suka',
            'netral',
            'suka',
            'sangat suka',
        ];

        $validMinatOptions = collect();

        foreach ($minatResponses as $questionId => $selectedScore) {
            if (
                !is_scalar($questionId)
                || !ctype_digit((string) $questionId)
                || !is_scalar($selectedScore)
                || !is_numeric($selectedScore)
                || (float) $selectedScore < 1
                || (float) $selectedScore > 5
            ) {
                continue;
            }

            $option = DB::table('question_options')
                ->where('question_id', (int) $questionId)
                ->where('score', (int) $selectedScore)
                ->whereIn(
                    DB::raw('LOWER(TRIM(option_text))'),
                    $preferenceLabels
                )
                ->first([
                    'id',
                    'question_id',
                    'option_text',
                    'score',
                    'interest_category_id',
                ]);

            if ($option) {
                $validMinatOptions->push($option);
            }
        }

        $scoredMinatOptions = $validMinatOptions
            ->filter(fn ($option) => is_numeric($option->score))
            ->values();

        $averageMinatScore = $scoredMinatOptions->isNotEmpty()
            ? (float) $scoredMinatOptions->avg('score')
            : null;

        $minatScorePercent = $averageMinatScore !== null
            ? (int) round(($averageMinatScore / 5) * 100)
            : null;

        /*
         * Hitung skor per kategori dari opsi jawaban yang sudah divalidasi.
         * Satu jawaban dihitung satu kali, sesuai kategori opsi tersebut.
         */
        $categoryAnswers = [];

        foreach ($scoredMinatOptions as $option) {
            if ($option->interest_category_id === null) {
                continue;
            }

            $categoryId = (int) $option->interest_category_id;

            if (!isset($interestCategories[$categoryId])) {
                continue;
            }

            $categoryAnswers[$categoryId][] = (float) $option->score;
        }

        $categoryScores = [];

        foreach ($interestCategories as $categoryId => $categoryName) {
            $scores = $categoryAnswers[$categoryId] ?? [];

            if (count($scores) === 0) {
                $categoryScores[] = [
                    'id' => $categoryId,
                    'name' => $categoryName,
                    'average' => null,
                    'score_percent' => null,
                    'answered_count' => 0,
                ];

                continue;
            }

            $average = array_sum($scores) / count($scores);

            $categoryScores[] = [
                'id' => $categoryId,
                'name' => $categoryName,
                'average' => round($average, 2),
                // Mengubah skala 1-5 menjadi rentang visual 0-100.
                'score_percent' => (int) round((($average - 1) / 4) * 100),
                'answered_count' => count($scores),
            ];
        }

        $rankedCategories = collect($categoryScores)
            ->filter(fn ($category) => $category['average'] !== null)
            ->sortByDesc('average')
            ->values();

        $topCategories = $rankedCategories
            ->take(3)
            ->values()
            ->all();

        $minatResult = [
            'responses' => $minatResponses,
            'submitted_at' => $minatSubmission->submitted_at ?? null,
            'answered_count' => $scoredMinatOptions->count(),
            'scored_count' => $scoredMinatOptions->count(),
            'average_score' => $averageMinatScore !== null
                ? round($averageMinatScore, 2)
                : null,
            'score_percent' => $minatScorePercent,
            'category_scores' => $categoryScores,
            'top_categories' => $topCategories,
            'has_submission' => $minatSubmission !== null,
            'has_result' => $scoredMinatOptions->isNotEmpty(),
            'message' => $scoredMinatOptions->isNotEmpty()
                ? 'Skor jawaban berhasil dibaca. Profil kategori merupakan gambaran awal minat.'
                : 'Nilai hasil belum tersedia atau opsi jawaban belum cocok dengan skor.',
        ];

        // Alias untuk Blade lama yang mungkin menggunakan variabel ini.
        $interestCategoryResults = $categoryScores;

        /*
         * Skor keseluruhan belum dihitung karena subtes abstrak belum memiliki
         * ilustrasi visual dan kunci jawaban yang dapat diverifikasi.
         */
        $kemampuanAnsweredCount = array_sum(array_column($abilitySubtests, 'answered_count'));

        $scoredSubtests = collect($abilitySubtests)
    ->filter(fn ($item) => $item['score_percent'] !== null);

$totalCorrect = $scoredSubtests->sum('correct_count');
$totalQuestions = $scoredSubtests->sum('total_count');

$kemampuanScore = $totalQuestions > 0
    ? (int) round(($totalCorrect / $totalQuestions) * 100)
    : null;

$kemampuanResult = [
    'responses' => $kemampuanResponses,
    'submitted_at' => $kemampuanSubmission->submitted_at ?? null,
    'has_submission' => $kemampuanSubmission !== null,
    'answered_count' => $kemampuanAnsweredCount,
    'score' => $kemampuanScore,
    'score_percent' => $kemampuanScore,
    'status' => $kemampuanScore !== null
        ? 'Berhasil dihitung'
        : ($kemampuanSubmission !== null ? 'Menunggu penilaian' : 'Belum dikerjakan'),
    'message' => 'Skor dihitung dari subtes yang sudah memiliki kunci jawaban.',
];

        /*
         * Kepribadian & Karier: tidak menebak kategori sebelum aturan pemetaan
         * tiap pertanyaan dan jawabannya tersedia.
         */

/*
|--------------------------------------------------------------------------
| Perhitungan Tes Kepribadian - 35 Pertanyaan
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Perhitungan Tes Kepribadian - 35 Pertanyaan
|--------------------------------------------------------------------------
*/

$personalityGroups = [
    'openness' => [
        'label' => 'Keterbukaan',
        'questions' => [3, 9, 90, 91, 92, 93, 94],
    ],
    'conscientiousness' => [
        'label' => 'Kedisiplinan',
        'questions' => [1, 6, 95, 96, 97, 98, 99],
    ],
    'extraversion' => [
        'label' => 'Ekstraversi',
        'questions' => [2, 8, 100, 101, 102, 103, 104],
    ],
    'agreeableness' => [
        'label' => 'Keramahan',
        'questions' => [4, 7, 105, 106, 107, 108, 109],
    ],
    'emotional_stability' => [
        'label' => 'Stabilitas Emosi',
        'questions' => [5, 10, 110, 111, 112, 113, 114],
    ],
];

// Ambil seluruh opsi jawaban untuk 35 pertanyaan.
// Responses sekarang berisi question_id => question_option_id.
$personalityQuestionIds = collect($personalityGroups)
    ->flatMap(fn ($group) => $group['questions'])
    ->unique()
    ->values()
    ->all();

$personalityOptions = DB::table('question_options')
    ->whereIn('question_id', $personalityQuestionIds)
    ->get(['id', 'question_id', 'option_text', 'score'])
    ->keyBy('id');

$personalityScores = [];
$personalityDetails = [];
$personalityAnsweredCount = 0;
$allPersonalityScores = [];

foreach ($personalityGroups as $key => $group) {
    $scores = [];

    foreach ($group['questions'] as $questionId) {
        $optionId = $kepribadianResponses[$questionId]
            ?? $kepribadianResponses[(string) $questionId]
            ?? null;

        if (!is_numeric($optionId)) {
            continue;
        }

        $option = $personalityOptions->get((int) $optionId);

        // Pastikan opsi memang milik pertanyaan yang sedang dihitung.
        if (
            !$option ||
            (int) $option->question_id !== (int) $questionId ||
            !is_numeric($option->score) ||
            (float) $option->score < 1 ||
            (float) $option->score > 5
        ) {
            continue;
        }

        // Skor sudah mengikuti nilai di database,
        // termasuk pembalikan untuk pertanyaan negatif.
        $score = (float) $option->score;

        $scores[] = $score;
        $allPersonalityScores[] = $score;
        $personalityAnsweredCount++;
    }

    $answered = count($scores);
    $total = count($group['questions']);

    $average = $answered > 0
        ? array_sum($scores) / $answered
        : null;

    $percent = $average !== null
        ? (int) round((($average - 1) / 4) * 100)
        : null;

    $personalityScores[$key] = $percent;

    $personalityDetails[$key] = [
        'label' => $group['label'],
        'average' => $average !== null ? round($average, 2) : null,
        'score_percent' => $percent,
        'answered_count' => $answered,
        'total_count' => $total,
        'status' => $answered === 0
            ? 'Belum dikerjakan'
            : ($answered === $total ? 'Selesai' : 'Belum lengkap'),
    ];
}

// Skor keseluruhan hanya tersedia jika 35 jawaban valid ditemukan.
$totalPersonalityQuestions = 35;

$kepribadianScore = $personalityAnsweredCount === $totalPersonalityQuestions
    ? (int) round(
        ((array_sum($allPersonalityScores) / $totalPersonalityQuestions) - 1) / 4 * 100
    )
    : null;

// Aspek dominan hanya ditentukan jika semua pertanyaan sudah dijawab.
$dominantPersonality = null;

if ($kepribadianScore !== null) {
    $rankedPersonality = collect($personalityDetails)
        ->filter(fn ($item) => $item['score_percent'] !== null)
        ->sortByDesc('score_percent')
        ->values();

    $dominantPersonality = $rankedPersonality->first();
}

$kepribadianResult = [
    'responses' => $kepribadianResponses,
    'submitted_at' => $kepribadianSubmission->submitted_at ?? null,
    'has_submission' => $kepribadianSubmission !== null,
    'answered_count' => $personalityAnsweredCount,
    'total_count' => $totalPersonalityQuestions,
    'score' => $kepribadianScore,
    'score_percent' => $kepribadianScore,
    'personality_scores' => $personalityScores,
    'personality_details' => $personalityDetails,
    'dominant_personality' => $dominantPersonality,
    'status' => $kepribadianSubmission === null
        ? 'Belum dikerjakan'
        : ($kepribadianScore !== null ? 'Selesai' : 'Belum lengkap'),
    'message' => $kepribadianScore !== null
        ? 'Skor kepribadian berhasil dihitung dari 35 jawaban.'
        : 'Skor akhir tersedia setelah seluruh 35 pertanyaan dijawab.',
];

        // ======================================================
// REKOMENDASI 3 JURUSAN DARI 3 HASIL ASESMEN
// ======================================================

// 1. Skor minat berdasarkan kategori jurusan.
$interestScoreByCategory = collect($categoryScores)
    ->keyBy('id')
    ->map(fn ($item) => $item['score_percent']);

// 2. Aturan awal kategori jurusan -> subtes kemampuan.
$majorAbilityMapping = [
    1 => ['numerik', 'abstrak'],       // Teknologi & Komputer
    2 => ['numerik', 'literasi'],      // Bisnis & Ekonomi
    3 => ['numerik', 'abstrak'],       // Sains & Matematika
    4 => ['numerik', 'literasi'],      // Kesehatan
    5 => ['literasi'],                 // Sosial & Humaniora
    6 => ['literasi'],                 // Bahasa & Komunikasi
    7 => ['abstrak', 'literasi'],      // Seni & Desain
    8 => ['literasi', 'numerik'],      // Pendidikan
];

// 3. Aturan awal kategori jurusan -> aspek kepribadian.
$majorPersonalityMapping = [
    1 => ['openness', 'conscientiousness'],
    2 => ['extraversion', 'conscientiousness'],
    3 => ['openness', 'conscientiousness'],
    4 => ['agreeableness', 'conscientiousness'],
    5 => ['agreeableness', 'extraversion'],
    6 => ['extraversion', 'openness'],
    7 => ['openness'],
    8 => ['agreeableness', 'conscientiousness'],
];

// Helper untuk mengambil rata-rata skor yang tersedia.
$averageAvailableScores = function (array $scores): ?float {
    $validScores = array_values(array_filter(
        $scores,
        fn ($score) => $score !== null && is_numeric($score)
    ));

    return count($validScores) > 0
        ? array_sum($validScores) / count($validScores)
        : null;
};

// 4. Ambil semua jurusan dari database.
$allMajors = DB::table('majors')
    ->whereNotNull('category_id')
    ->get(['id', 'name', 'description', 'category_id']);

$recommendedMajors = $allMajors->map(function ($major) use (
    $interestScoreByCategory,
    $majorAbilityMapping,
    $majorPersonalityMapping,
    $abilitySubtests,
    $personalityScores,
    $averageAvailableScores
) {
    $categoryId = (int) $major->category_id;

    // Skor minat.
    $interestScore = $interestScoreByCategory->get($categoryId);

    // Skor kemampuan dari subtes yang relevan.
    $abilityKeys = $majorAbilityMapping[$categoryId] ?? [];

    $abilityValues = [];

    foreach ($abilityKeys as $key) {
        $abilityValues[] = $abilitySubtests[$key]['score_percent'] ?? null;
    }

    $abilityScore = $averageAvailableScores($abilityValues);

    // Skor kepribadian dari aspek yang relevan.
    $personalityKeys = $majorPersonalityMapping[$categoryId] ?? [];

    $personalityValues = [];

    foreach ($personalityKeys as $key) {
        $personalityValues[] = $personalityScores[$key] ?? null;
    }

    $personalityScore = $averageAvailableScores($personalityValues);

    // Bobot: Minat 50%, Kemampuan 25%, Kepribadian 25%.
    // Jika salah satu hasil belum tersedia, bobot dihitung ulang
    // hanya dari komponen yang tersedia.
    $components = [];

    if ($interestScore !== null) {
        $components[] = ['score' => $interestScore, 'weight' => 50];
    }

    if ($abilityScore !== null) {
        $components[] = ['score' => $abilityScore, 'weight' => 25];
    }

    if ($personalityScore !== null) {
        $components[] = ['score' => $personalityScore, 'weight' => 25];
    }

    $totalWeight = array_sum(array_column($components, 'weight'));

    $matchScore = $totalWeight > 0
        ? array_sum(array_map(
            fn ($item) => $item['score'] * $item['weight'],
            $components
        )) / $totalWeight
        : null;

    return [
        'id' => $major->id,
        'name' => $major->name,
        'description' => $major->description,
        'category_id' => $categoryId,
        'interest_score' => $interestScore,
        'ability_score' => $abilityScore,
        'personality_score' => $personalityScore,
        'match_score' => $matchScore !== null
            ? (int) round($matchScore)
            : null,
    ];
})
    ->filter(fn ($major) => $major['match_score'] !== null)
    ->sortByDesc('match_score')
    ->take(3)
    ->values()
    ->all();

        // Ambil perguruan tinggi yang benar-benar memiliki relasi ke jurusan
        // melalui pivot university_majors. Data uji import tidak ditampilkan.
        $recommendedMajors = collect($recommendedMajors)
            ->map(function ($major) {
                $major['universities'] = DB::table('university_majors as um')
                    ->join('universities as u', 'u.id', '=', 'um.university_id')
                    ->where('um.major_id', $major['id'])
                    ->where('u.name', 'not like', '%Uji Import%')
                    ->where(function ($query) {
                        $query->whereNull('u.branch_notes')
                            ->orWhere('u.branch_notes', 'not like', '%DATA UJI IMPORT%');
                    })
                    ->orderByRaw('CASE WHEN u.ranking IS NULL THEN 1 ELSE 0 END')
                    ->orderBy('u.ranking')
                    ->orderBy('u.name')
                    ->get([
                        'u.id',
                        'u.name',
                        'u.type',
                        'u.location',
                        'u.website',
                        'u.ranking',
                        'u.ranking_source',
                        'u.ranking_year',
                        'u.accreditation as university_accreditation',
                        'u.branch_notes',
                        'um.accreditation as major_accreditation',
                        'um.additional_info',
                    ])
                    ->map(fn ($university) => (array) $university)
                    ->all();

                return $major;
            })
            ->all();

        $assessmentCompleted = $minatSubmission !== null
            && $kemampuanSubmission !== null
            && $kepribadianSubmission !== null;

        // Hanya berisi metrik aspek asesmen, bukan rincian kategori minat.
        $profileMetrics = [
    'Minat Bakat' => $minatScorePercent,
    'Kemampuan' => $kemampuanScore,
    'Kepribadian' => $kepribadianScore,
];

        return view('student.assessment.result', compact(
    'minatResult',
    'kemampuanResult',
    'kepribadianResult',
    'kemampuanResponses',
    'kepribadianResponses',
    'assessmentCompleted',
    'profileMetrics',
    'abilitySubtests',
    'categoryScores',
    'topCategories',
    'interestCategoryResults',
    'minatQuestionResponses',
    'kemampuanQuestionResponses',
    'kepribadianQuestionResponses',
    'recommendedMajors'
));
    }

    /**
     * Format jawaban subtes yang menggunakan nomor urut dari Blade,
     * bukan question_id dari tabel questions.
     */
    private function formatIndexedResponses(array $responses, string $subtestLabel): array
    {
        $formatted = [];

        foreach ($responses as $number => $answer) {
            if (!is_numeric($number) || $answer === null || $answer === '') {
                continue;
            }

            $formatted[] = [
                'question_id' => (int) $number,
                'question_text' => $subtestLabel . ' - Soal ' . $number,
                'answer' => is_scalar($answer) ? (string) $answer : 'Jawaban tersimpan',
            ];
        }

        return $formatted;
    }

    /**
     * Menghitung skor subtes dari kunci jawaban yang tersedia.
     * Persentase menggunakan total soal, sehingga soal kosong tidak menaikkan nilai.
     */
    private function scoreAbilitySubtest(array $responses, array $answerKey, int $totalQuestions): array
    {
        $answeredCount = $this->countAnsweredResponses($responses);
        $correctCount = 0;

        foreach ($answerKey as $questionNumber => $correctAnswer) {
            $givenAnswer = $responses[$questionNumber] ?? $responses[(string) $questionNumber] ?? null;

            if (
                is_scalar($givenAnswer)
                && $this->normalizeAnswer((string) $givenAnswer) === $this->normalizeAnswer($correctAnswer)
            ) {
                $correctCount++;
            }
        }

        return [
            'answered_count' => $answeredCount,
            'correct_count' => $correctCount,
            'wrong_count' => max(0, $answeredCount - $correctCount),
            'score_percent' => $totalQuestions > 0
                ? (int) round(($correctCount / $totalQuestions) * 100)
                : null,
        ];
    }

    private function normalizeAnswer(string $answer): string
    {
        $normalized = preg_replace('/\\s+/', ' ', trim($answer));

        return mb_strtolower($normalized ?? '');
    }

    /**
     * Menghitung jawaban yang benar-benar memiliki isi.
     */
    private function countAnsweredResponses(array $responses): int
    {
        return collect($responses)->filter(function ($answer) {
            if ($answer === null || $answer === '') {
                return false;
            }

            if (is_array($answer)) {
                return count($answer) > 0;
            }

            return true;
        })->count();
    }

    private function extractSubtestResponses(
        array $responses,
        string $subtestKey
    ): array {
        $candidate = $responses[$subtestKey]
            ?? ($responses['subtests'][$subtestKey] ?? null);

        return is_array($candidate) ? $candidate : [];
    }

    private function decodeResponses(mixed $responses): array
    {
        if (is_array($responses)) {
            return $responses;
        }

        if (!is_string($responses) || trim($responses) === '') {
            return [];
        }

        $decoded = json_decode($responses, true);

        return is_array($decoded) ? $decoded : [];
    }

    /**
 * Mengumpulkan seluruh ID soal dari struktur responses,
 * termasuk responses yang memiliki struktur bertingkat.
 */
private function collectQuestionIds(array $responses): array
{
    $ids = [];

    foreach ($responses as $key => $value) {
        if (is_numeric($key)) {
            $ids[] = (int) $key;
        }

        if (is_array($value)) {
            $ids = array_merge(
                $ids,
                $this->collectQuestionIds($value)
            );
        }
    }

    return array_values(array_unique($ids));
}

/**
 * Mengubah pasangan ID soal dan jawaban menjadi data
 * yang siap ditampilkan di halaman hasil.
 *
 * Jawaban disiapkan sebagai teks untuk ditampilkan di halaman hasil.
 */
private function formatQuestionResponses(
    array $responses,
    array $questionTexts
): array {
    $formatted = [];

    foreach ($responses as $questionId => $answer) {
        if (!is_numeric($questionId)) {
            continue;
        }

        $questionId = (int) $questionId;

        $questionText = $questionTexts[$questionId]
            ?? "Pertanyaan tidak ditemukan (ID: {$questionId})";

        $displayAnswer = $answer;

        if (is_array($answer)) {
            $displayAnswer = 'Jawaban tersimpan';
        } elseif (is_bool($answer)) {
            $displayAnswer = $answer ? 'Ya' : 'Tidak';
        } elseif ($answer === null || $answer === '') {
            $displayAnswer = 'Tidak dijawab';
        }

        $formatted[] = [
            'question_id' => $questionId,
            'question_text' => $questionText,
            'answer' => $displayAnswer,
        ];
    }

    return $formatted;
    }
}
