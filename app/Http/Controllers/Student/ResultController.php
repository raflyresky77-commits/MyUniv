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
         * Subtes kemampuan.
         * Nilai akhir belum dihitung karena rubrik penilaian belum ditetapkan.
         */
        $subtestLabels = [
            'numerik' => 'Numerik',
            'kreativitas' => 'Kreativitas',
            'literasi' => 'Literasi',
            'abstrak' => 'Abstrak',
        ];

        $abilitySubtests = [];
        $drawingImages = [];

        foreach ($subtestLabels as $key => $label) {
            $responsesForSubtest = $this->extractSubtestResponses(
                $kemampuanResponses,
                $key
            );

            $hasResponses = count($responsesForSubtest) > 0;

            $abilitySubtests[$key] = [
                'label' => $label,
                'status' => $hasResponses
                    ? ($key === 'kreativitas' ? 'Menunggu penilaian' : 'Jawaban tersimpan')
                    : 'Belum dikerjakan',
                'score' => null,
                'answered_count' => count($responsesForSubtest),
            ];

            // Ambil gambar dari jawaban subtes Kreativitas/Drawing.
            if ($key !== 'kreativitas') {
                continue;
            }

            foreach ($responsesForSubtest as $questionId => $answer) {
                $imageData = null;

                if (is_string($answer) && str_starts_with($answer, 'data:image/')) {
                    $imageData = $answer;
                } elseif (is_array($answer)) {
                    $candidate = $answer['image_data']
                        ?? $answer['data_url']
                        ?? $answer['image_url']
                        ?? $answer['url']
                        ?? null;

                    if (
                        is_string($candidate)
                        && str_starts_with($candidate, 'data:image/')
                    ) {
                        $imageData = $candidate;
                    } elseif (
                        is_string($candidate)
                        && filter_var($candidate, FILTER_VALIDATE_URL)
                        && in_array(
                            parse_url($candidate, PHP_URL_SCHEME),
                            ['http', 'https'],
                            true
                        )
                    ) {
                        $imageData = $candidate;
                    }
                }

                if ($imageData !== null) {
                    $drawingImages[] = [
                        'url' => $imageData,
                        'question_label' => 'Soal Kreativitas '
                            . (is_scalar($questionId) ? $questionId : ''),
                        'submitted_at' => $kemampuanSubmission->submitted_at ?? null,
                    ];
                }
            }
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
         * Tes Kemampuan: jawaban tersimpan, tetapi belum diberi nilai akhir.
         */
        $kemampuanResult = [
            'responses' => $kemampuanResponses,
            'submitted_at' => $kemampuanSubmission->submitted_at ?? null,
            'has_submission' => $kemampuanSubmission !== null,
            'answered_count' => count($kemampuanResponses),
            'score' => null,
            'status' => $kemampuanSubmission !== null
                ? 'Jawaban tersimpan'
                : 'Belum dikerjakan',
            'message' => 'Skor tidak dihitung sampai rubrik penilaian ditetapkan.',
        ];

        /*
         * Kepribadian & Karier: tidak menebak kategori sebelum aturan pemetaan
         * tiap pertanyaan dan jawabannya tersedia.
         */
        $kepribadianResult = [
            'responses' => $kepribadianResponses,
            'submitted_at' => $kepribadianSubmission->submitted_at ?? null,
            'has_submission' => $kepribadianSubmission !== null,
            'answered_count' => count($kepribadianResponses),
            'category' => null,
            'status' => $kepribadianSubmission !== null
                ? 'Menunggu aturan pemetaan kategori'
                : 'Belum dikerjakan',
            'message' => 'Kategori belum dihitung karena aturan pemetaan belum tersedia.',
        ];

        $assessmentCompleted = $minatSubmission !== null
            && $kemampuanSubmission !== null
            && $kepribadianSubmission !== null;

        // Hanya berisi metrik aspek asesmen, bukan rincian kategori minat.
        $profileMetrics = [
            'Minat Bakat' => $minatScorePercent,
            'Kemampuan' => null,
            'Kepribadian' => null,
            'Kreativitas' => null,
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
            'drawingImages',
            'categoryScores',
            'topCategories',
            'interestCategoryResults'
        ));
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
}
