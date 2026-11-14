<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // ======================================================
        // AMBIL SUBMISSION
        // ======================================================

        $submissions = DB::table('assessment_submissions')
            ->where('user_id', $userId)
            ->get()
            ->keyBy('assessment_type');

        $minatSubmission = $submissions->get('minat_bakat');
        $kemampuanSubmission = $submissions->get('kemampuan');
        $kepribadianSubmission = $submissions->get('kepribadian');

        $minatResponses = $this->decodeResponses(
            $minatSubmission->responses ?? null
        );

        $kemampuanResponses = $this->decodeResponses(
            $kemampuanSubmission->responses ?? null
        );

        $kepribadianResponses = $this->decodeResponses(
            $kepribadianSubmission->responses ?? null
        );

        // ======================================================
        // MAPPING ID SOAL KE TEKS PERTANYAAN
        // ======================================================

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

        $minatQuestionResponses = $this->formatQuestionResponses(
            $minatResponses,
            $questionTexts
        );

        $kepribadianQuestionResponses = $this->formatQuestionResponses(
            $kepribadianResponses,
            $questionTexts
        );

        // ======================================================
        // HASIL TES KEMAMPUAN
        // ======================================================

        $abilityAnswerKeys = $this->getAbilityAnswerKeys();

        $kemampuanQuestionResponses = [];
        $abilitySubtests = [];

        $subtestConfig = [
            'numerik' => [
                'label' => 'Numerik',
                'total' => 16,
            ],
            'verbal' => [
                'label' => 'Literasi',
                'total' => 15,
            ],
            'abstrak' => [
                'label' => 'Abstrak & Logika',
                'total' => 16,
            ],
        ];

        foreach ($subtestConfig as $key => $config) {

            $responsesForSubtest = $this->extractSubtestResponses(
                $kemampuanResponses,
                $key
            );

            // Kompatibilitas data lama dengan key literasi.
            if ($key === 'verbal' && empty($responsesForSubtest)) {
                $responsesForSubtest = $this->extractSubtestResponses(
                    $kemampuanResponses,
                    'literasi'
                );
            }

            $displayKey = $key;

            $kemampuanQuestionResponses[$displayKey] =
                $this->formatIndexedResponses(
                    $responsesForSubtest,
                    $config['label']
                );

            $answerKey = $abilityAnswerKeys[$key] ?? [];

            $scoreData = $this->scoreAbilitySubtest(
                $responsesForSubtest,
                $answerKey,
                $config['total']
            );

            $hasResponses = $scoreData['answered_count'] > 0;

            $canBeScored = !empty($answerKey);

            $abilitySubtests[$displayKey] = [
                'label' => $config['label'],

                'status' => !$hasResponses
                    ? 'Belum dikerjakan'
                    : (
                        $scoreData['answered_count'] >= $config['total']
                            ? 'Selesai'
                            : 'Belum lengkap'
                    ),

                'score' => $canBeScored
                    ? $scoreData['score_percent']
                    : null,

                'score_percent' => $canBeScored
                    ? $scoreData['score_percent']
                    : null,

                'answered_count' => $scoreData['answered_count'],

                'correct_count' => $canBeScored
                    ? $scoreData['correct_count']
                    : null,

                'wrong_count' => $canBeScored
                    ? $scoreData['wrong_count']
                    : null,

                'unanswered_count' => max(
                    0,
                    $config['total'] - $scoreData['answered_count']
                ),

                'total_count' => $config['total'],

                'scored_question_count' => $scoreData['scored_question_count'],
            ];
        }

        // ======================================================
        // HASIL MINAT BAKAT
        // ======================================================

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
                !is_scalar($questionId) ||
                !ctype_digit((string) $questionId) ||
                !is_scalar($selectedScore) ||
                !is_numeric($selectedScore) ||
                (float) $selectedScore < 1 ||
                (float) $selectedScore > 5
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
                'score_percent' => (int) round(
                    (($average - 1) / 4) * 100
                ),
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

        $interestCategoryResults = $categoryScores;

        // ======================================================
        // SKOR KESELURUHAN KEMAMPUAN
        // ======================================================

        $kemampuanAnsweredCount = array_sum(
            array_column($abilitySubtests, 'answered_count')
        );

        $scoredSubtests = collect($abilitySubtests)
            ->filter(fn ($item) => $item['score_percent'] !== null);

        $totalCorrect = $scoredSubtests->sum('correct_count');
        $totalQuestions = $scoredSubtests->sum('total_count');

        $kemampuanScore = $totalQuestions > 0
            ? (int) round(
                ($totalCorrect / $totalQuestions) * 100
            )
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
                : (
                    $kemampuanSubmission !== null
                        ? 'Menunggu penilaian'
                        : 'Belum dikerjakan'
                ),
            'message' => 'Skor dihitung dari subtes yang sudah memiliki kunci jawaban.',
        ];

        // ======================================================
        // HASIL TES KEPRIBADIAN
        // ======================================================

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

        $personalityQuestionIds = collect($personalityGroups)
            ->flatMap(fn ($group) => $group['questions'])
            ->unique()
            ->values()
            ->all();

        $personalityOptions = DB::table('question_options')
            ->whereIn('question_id', $personalityQuestionIds)
            ->get([
                'id',
                'question_id',
                'option_text',
                'score',
            ])
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

                if (
                    !$option ||
                    (int) $option->question_id !== (int) $questionId ||
                    !is_numeric($option->score) ||
                    (float) $option->score < 1 ||
                    (float) $option->score > 5
                ) {
                    continue;
                }

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
                'average' => $average !== null
                    ? round($average, 2)
                    : null,
                'score_percent' => $percent,
                'answered_count' => $answered,
                'total_count' => $total,
                'status' => $answered === 0
                    ? 'Belum dikerjakan'
                    : (
                        $answered === $total
                            ? 'Selesai'
                            : 'Belum lengkap'
                    ),
            ];
        }

        // ======================================================
        // INTERPRETASI BIG FIVE BERDASARKAN SKOR SETIAP DIMENSI
        // Skor opsi diasumsikan sudah searah: 1 = rendah, 5 = tinggi.
        // ======================================================

        $personalityGuides = [
            'openness' => [
                'low' => [
                    'level' => 'Cenderung praktis',
                    'interpretation' => 'Kamu mungkin lebih nyaman dengan hal yang jelas, konkret, dan sudah dikenal. Kamu cenderung menyukai langkah yang terstruktur sebelum mencoba pendekatan baru.',
                    'strengths' => 'Praktis, realistis, dan dapat menjaga fokus pada hal yang sudah terbukti.',
                    'development' => 'Coba eksplorasi ide atau pengalaman baru secara bertahap agar pilihanmu semakin luas.',
                    'environment' => 'Lingkungan belajar yang terarah, memiliki contoh konkret, dan tujuan yang jelas.',
                ],
                'medium' => [
                    'level' => 'Seimbang',
                    'interpretation' => 'Kamu dapat menghargai ide baru sekaligus mempertimbangkan cara yang sudah terbukti. Kamu berpotensi menyesuaikan diri sesuai kebutuhan situasi.',
                    'strengths' => 'Fleksibel dalam menimbang ide, pengalaman, dan pendekatan praktis.',
                    'development' => 'Latih rasa ingin tahu dengan mencoba satu kegiatan atau sudut pandang baru secara berkala.',
                    'environment' => 'Lingkungan belajar yang menggabungkan panduan terstruktur dan ruang bereksperimen.',
                ],
                'high' => [
                    'level' => 'Terbuka terhadap pengalaman',
                    'interpretation' => 'Kamu cenderung tertarik pada gagasan, pengalaman, dan cara pandang baru. Eksplorasi dan kreativitas dapat menjadi bagian penting dari proses belajarmu.',
                    'strengths' => 'Imajinatif, ingin tahu, dan terbuka mempertimbangkan berbagai kemungkinan.',
                    'development' => 'Pilih ide yang paling relevan lalu susun langkah nyata agar eksplorasi menghasilkan karya atau pencapaian.',
                    'environment' => 'Lingkungan belajar yang memberi ruang proyek, kreativitas, riset, dan pemecahan masalah terbuka.',
                ],
            ],
            'conscientiousness' => [
                'low' => [
                    'level' => 'Fleksibel dan spontan',
                    'interpretation' => 'Kamu mungkin lebih nyaman bekerja secara fleksibel daripada mengikuti rencana yang sangat rinci. Konsistensi dan pengelolaan prioritas dapat menjadi area latihan.',
                    'strengths' => 'Spontan, adaptif, dan tidak selalu terpaku pada satu cara kerja.',
                    'development' => 'Gunakan target kecil, daftar tugas sederhana, dan tenggat yang realistis untuk membangun kebiasaan.',
                    'environment' => 'Lingkungan dengan target yang jelas, umpan balik rutin, dan tahapan kerja yang terukur.',
                ],
                'medium' => [
                    'level' => 'Cukup terorganisasi',
                    'interpretation' => 'Kamu dapat mengatur tanggung jawab, tetapi masih membutuhkan fleksibilitas dalam situasi tertentu. Keseimbangan antara rencana dan penyesuaian bisa menjadi kekuatan.',
                    'strengths' => 'Mampu mengikuti tanggung jawab sambil menyesuaikan diri dengan perubahan.',
                    'development' => 'Pertahankan kebiasaan yang sudah berjalan dan prioritaskan tugas berdasarkan urgensi.',
                    'environment' => 'Lingkungan dengan struktur kerja yang jelas tetapi tetap memberi ruang mengatur cara penyelesaian.',
                ],
                'high' => [
                    'level' => 'Terencana dan bertanggung jawab',
                    'interpretation' => 'Kamu cenderung menyukai keteraturan, persiapan, dan penyelesaian tanggung jawab. Perencanaan dapat membantu kamu menjaga kemajuan.',
                    'strengths' => 'Terorganisasi, tekun, dapat diandalkan, dan memperhatikan penyelesaian tugas.',
                    'development' => 'Jaga keseimbangan agar standar tinggi tidak membuatmu terlalu kaku atau sulit menerima perubahan.',
                    'environment' => 'Lingkungan dengan tujuan, jadwal, standar, dan tanggung jawab yang jelas.',
                ],
            ],
            'extraversion' => [
                'low' => [
                    'level' => 'Reflektif dan mandiri',
                    'interpretation' => 'Kamu mungkin lebih nyaman memproses pikiran secara mandiri atau dalam kelompok kecil. Ini bukan berarti tidak mampu bekerja sama.',
                    'strengths' => 'Reflektif, mampu bekerja mandiri, dan memberi ruang untuk berpikir sebelum bertindak.',
                    'development' => 'Latih menyampaikan ide dalam kelompok kecil dan membangun relasi secara bertahap.',
                    'environment' => 'Lingkungan yang menyediakan waktu fokus mandiri serta interaksi kelompok yang terarah.',
                ],
                'medium' => [
                    'level' => 'Seimbang dalam bersosialisasi',
                    'interpretation' => 'Kamu berpotensi menikmati interaksi sosial sekaligus membutuhkan waktu untuk bekerja atau berpikir sendiri.',
                    'strengths' => 'Dapat menyesuaikan diri dalam aktivitas mandiri maupun kolaboratif.',
                    'development' => 'Kenali situasi ketika diskusi kelompok membantu dan kapan fokus mandiri lebih efektif.',
                    'environment' => 'Lingkungan belajar yang menggabungkan tugas individu, diskusi, dan kerja tim.',
                ],
                'high' => [
                    'level' => 'Ekspresif dan sosial',
                    'interpretation' => 'Kamu cenderung mendapatkan energi dari interaksi, diskusi, atau kegiatan bersama orang lain.',
                    'strengths' => 'Komunikatif, antusias berinteraksi, dan berpotensi aktif dalam kegiatan kelompok.',
                    'development' => 'Latih mendengarkan secara aktif dan memberi ruang bagi orang lain untuk menyampaikan pendapat.',
                    'environment' => 'Lingkungan kolaboratif dengan diskusi, presentasi, organisasi, atau kegiatan tim.',
                ],
            ],
            'agreeableness' => [
                'low' => [
                    'level' => 'Mandiri dan kritis',
                    'interpretation' => 'Kamu mungkin cenderung mempertahankan pendapat dan menilai sesuatu secara kritis. Pastikan sikap tegas tetap disampaikan dengan menghargai orang lain.',
                    'strengths' => 'Berani menyampaikan pandangan, kritis, dan tidak mudah mengikuti tekanan kelompok.',
                    'development' => 'Latih empati, kompromi, dan mendengarkan alasan orang lain sebelum mengambil keputusan bersama.',
                    'environment' => 'Lingkungan yang menghargai diskusi terbuka, argumentasi sehat, dan batas tanggung jawab yang jelas.',
                ],
                'medium' => [
                    'level' => 'Kooperatif dan asertif',
                    'interpretation' => 'Kamu dapat bekerja sama sekaligus menyampaikan kebutuhan atau pendapat sendiri sesuai situasi.',
                    'strengths' => 'Mampu berkolaborasi tanpa harus selalu mengesampingkan pendapat pribadi.',
                    'development' => 'Terus latih komunikasi yang jelas, saling menghargai, dan penyelesaian perbedaan pendapat.',
                    'environment' => 'Lingkungan dengan kerja tim, pembagian peran, dan komunikasi dua arah.',
                ],
                'high' => [
                    'level' => 'Kooperatif dan suportif',
                    'interpretation' => 'Kamu cenderung memperhatikan kebutuhan orang lain dan menjaga hubungan yang harmonis dalam kelompok.',
                    'strengths' => 'Empatik, suportif, kooperatif, dan memperhatikan suasana kerja bersama.',
                    'development' => 'Latih ketegasan dan kemampuan menetapkan batas agar kebutuhanmu sendiri tetap diperhatikan.',
                    'environment' => 'Lingkungan kolaboratif yang mengutamakan pelayanan, dukungan, dan hubungan antarmanusia.',
                ],
            ],
            'emotional_stability' => [
                'low' => [
                    'level' => 'Perlu dukungan pengelolaan tekanan',
                    'interpretation' => 'Kamu mungkin lebih mudah merasakan tekanan dalam situasi tertentu. Hasil ini bukan diagnosis; keterampilan mengelola stres dapat dilatih.',
                    'strengths' => 'Kepekaan terhadap situasi dapat membantu kamu menyadari perubahan suasana dan kebutuhan diri.',
                    'development' => 'Latih jeda sebelum merespons, atur waktu istirahat, dan cari dukungan ketika beban terasa berat.',
                    'environment' => 'Lingkungan yang suportif, komunikatif, dan memiliki arahan serta umpan balik yang jelas.',
                ],
                'medium' => [
                    'level' => 'Cukup stabil',
                    'interpretation' => 'Kamu mungkin dapat mengelola tekanan dalam banyak situasi, meskipun kondisi tertentu tetap dapat memengaruhi perasaan.',
                    'strengths' => 'Memiliki dasar pengelolaan emosi dan dapat menyesuaikan respons sesuai keadaan.',
                    'development' => 'Pertahankan kebiasaan sehat dan siapkan strategi menghadapi situasi yang menantang.',
                    'environment' => 'Lingkungan yang suportif dengan tantangan bertahap dan komunikasi terbuka.',
                ],
                'high' => [
                    'level' => 'Relatif tenang dan tangguh',
                    'interpretation' => 'Kamu cenderung tetap tenang dan mampu menjaga kestabilan saat menghadapi tekanan atau perubahan.',
                    'strengths' => 'Tenang, relatif tahan menghadapi tekanan, dan mampu menjaga perspektif saat menghadapi masalah.',
                    'development' => 'Tetap beri ruang untuk mengenali emosi dan meminta bantuan saat diperlukan; stabil bukan berarti harus selalu kuat.',
                    'environment' => 'Lingkungan dengan tantangan yang jelas, tanggung jawab, dan kesempatan menyelesaikan masalah.',
                ],
            ],
        ];

        foreach ($personalityDetails as $key => &$detail) {
            $percent = $detail['score_percent'];

            if ($percent === null || !isset($personalityGuides[$key])) {
                $detail['level'] = 'Belum tersedia';
                $detail['interpretation'] = null;
                $detail['strengths'] = null;
                $detail['development'] = null;
                $detail['career_environment'] = null;
                continue;
            }

            $band = $percent < 40 ? 'low' : ($percent < 70 ? 'medium' : 'high');
            $guide = $personalityGuides[$key][$band];

            $detail['level'] = $guide['level'];
            $detail['interpretation'] = $guide['interpretation'];
            $detail['strengths'] = $guide['strengths'];
            $detail['development'] = $guide['development'];
            $detail['career_environment'] = $guide['environment'];
        }
        unset($detail);

        $totalPersonalityQuestions = 35;

        $kepribadianScore =
            $personalityAnsweredCount === $totalPersonalityQuestions
                ? (int) round(
                    (
                        (
                            array_sum($allPersonalityScores)
                            / $totalPersonalityQuestions
                        ) - 1
                    ) / 4 * 100
                )
                : null;

        $dominantPersonality = null;

        if ($kepribadianScore !== null) {
            $rankedPersonality = collect($personalityDetails)
                ->filter(fn ($item) => $item['score_percent'] !== null)
                ->sortByDesc('score_percent')
                ->values();

            // Ini adalah dimensi paling menonjol, bukan label tipe kepribadian mutlak.
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
            'has_interpretation' => $kepribadianScore !== null
                && $personalityAnsweredCount === $totalPersonalityQuestions,
            'status' => $kepribadianSubmission === null
                ? 'Belum dikerjakan'
                : (
                    $kepribadianScore !== null
                        ? 'Selesai'
                        : 'Belum lengkap'
                ),
            'message' => $kepribadianScore !== null
                ? 'Skor kepribadian berhasil dihitung dari 35 jawaban.'
                : 'Skor akhir tersedia setelah seluruh 35 pertanyaan dijawab.',
        ];

        // ======================================================
        // REKOMENDASI JURUSAN
        // ======================================================

        $interestScoreByCategory = collect($categoryScores)
            ->keyBy('id')
            ->map(fn ($item) => $item['score_percent']);

        $majorAbilityMapping = [
            1 => ['numerik', 'abstrak'],
            2 => ['numerik', 'verbal'],
            3 => ['numerik', 'abstrak'],
            4 => ['numerik', 'verbal'],
            5 => ['verbal'],
            6 => ['verbal'],
            7 => ['abstrak', 'verbal'],
            8 => ['verbal', 'numerik'],
        ];

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

        $averageAvailableScores = function (array $scores): ?float {

            $validScores = array_values(array_filter(
                $scores,
                fn ($score) => $score !== null && is_numeric($score)
            ));

            return count($validScores) > 0
                ? array_sum($validScores) / count($validScores)
                : null;
        };

        $allMajors = DB::table('majors')
            ->whereNotNull('category_id')
            ->get([
                'id',
                'name',
                'description',
                'category_id',
            ]);

        $recommendedMajors = $allMajors->map(function ($major) use (
            $interestScoreByCategory,
            $majorAbilityMapping,
            $majorPersonalityMapping,
            $abilitySubtests,
            $personalityScores,
            $averageAvailableScores
        ) {

            $categoryId = (int) $major->category_id;

            $interestScore = $interestScoreByCategory->get($categoryId);

            $abilityKeys = $majorAbilityMapping[$categoryId] ?? [];

            $abilityValues = [];

            foreach ($abilityKeys as $key) {
                $abilityValues[] =
                    $abilitySubtests[$key]['score_percent'] ?? null;
            }

            $abilityScore = $averageAvailableScores($abilityValues);

            $personalityKeys =
                $majorPersonalityMapping[$categoryId] ?? [];

            $personalityValues = [];

            foreach ($personalityKeys as $key) {
                $personalityValues[] =
                    $personalityScores[$key] ?? null;
            }

            $personalityScore =
                $averageAvailableScores($personalityValues);

            $components = [];

            if ($interestScore !== null) {
                $components[] = [
                    'score' => $interestScore,
                    'weight' => 50,
                ];
            }

            if ($abilityScore !== null) {
                $components[] = [
                    'score' => $abilityScore,
                    'weight' => 25,
                ];
            }

            if ($personalityScore !== null) {
                $components[] = [
                    'score' => $personalityScore,
                    'weight' => 25,
                ];
            }

            $totalWeight = array_sum(
                array_column($components, 'weight')
            );

            $matchScore = $totalWeight > 0
                ? array_sum(array_map(
                    fn ($item) =>
                        $item['score'] * $item['weight'],
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
            ->filter(
                fn ($major) => $major['match_score'] !== null
            )
            ->sortByDesc('match_score')
            ->take(3)
            ->values()
            ->all();

        // ======================================================
        // UNIVERSITAS YANG MEMILIKI JURUSAN TERKAIT
        // ======================================================

        $recommendedMajors = collect($recommendedMajors)
            ->map(function ($major) {

                $major['universities'] = DB::table(
                    'university_majors as um'
                )
                    ->join(
                        'universities as u',
                        'u.id',
                        '=',
                        'um.university_id'
                    )
                    ->where('um.major_id', $major['id'])
                    ->where(
                        'u.name',
                        'not like',
                        '%Uji Import%'
                    )
                    ->where(function ($query) {
                        $query->whereNull('u.branch_notes')
                            ->orWhere(
                                'u.branch_notes',
                                'not like',
                                '%DATA UJI IMPORT%'
                            );
                    })
                    ->orderByRaw(
                        'CASE WHEN u.ranking IS NULL THEN 1 ELSE 0 END'
                    )
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

        // ======================================================
        // STATUS ASESMEN
        // ======================================================

        $assessmentCompleted =
            $minatSubmission !== null &&
            $kemampuanSubmission !== null &&
            $kepribadianSubmission !== null;

        $profileMetrics = [
            'Minat Bakat' => $minatScorePercent,
            'Kemampuan' => $kemampuanScore,
            'Kepribadian' => $kepribadianScore,
        ];

        // ======================================================
        // KIRIM DATA KE BLADE
        // ======================================================

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

    // ==========================================================
    // KUNCI JAWABAN DINAMIS DARI DATABASE
    // ==========================================================

    private function getAbilityAnswerKeys(): array
    {
        $subtestMap = [
            'numeric' => 'numerik',
            'verbal' => 'verbal',
            'abstract' => 'abstrak',
        ];

        $answerKeys = [
            'numerik' => [],
            'verbal' => [],
            'abstrak' => [],
        ];

        $questions = DB::table('questions as q')
            ->join(
                'assessment_subtests as s',
                's.id',
                '=',
                'q.subtest_id'
            )
            ->join(
                'question_options as qo',
                'qo.question_id',
                '=',
                'q.id'
            )
            ->where('q.is_active', true)
            ->whereIn(
                's.code',
                ['numeric', 'verbal', 'abstract']
            )
            ->whereIn(
                'q.type',
                ['multiple_choice', 'image_choice', 'visual']
            )
            ->where('qo.score', '>', 0)
            ->whereRaw(
                'qo.score = (
                    SELECT MAX(qo2.score)
                    FROM question_options qo2
                    WHERE qo2.question_id = q.id
                )'
            )
            ->select(
                's.code',
                'q.id as question_id',
                'qo.id as option_id'
            )
            ->orderBy('q.id')
            ->get();

        foreach ($questions as $question) {

            $key = $subtestMap[$question->code] ?? null;

            if ($key === null) {
                continue;
            }

            // Mendukung lebih dari satu opsi dengan skor tertinggi.
            $answerKeys[$key][$question->question_id][] =
                (string) $question->option_id;
        }

        return $answerKeys;
    }

    // ==========================================================
    // PERHITUNGAN NILAI KEMAMPUAN
    // ==========================================================

    private function scoreAbilitySubtest(
        array $responses,
        array $answerKey,
        int $totalQuestions
    ): array {

        $answeredCount = $this->countAnsweredResponses($responses);

        $correctCount = 0;
        $scoredAnsweredCount = 0;

        foreach ($answerKey as $questionId => $correctOptionIds) {

            $givenOptionId = $responses[$questionId]
                ?? $responses[(string) $questionId]
                ?? null;

            if (
                $givenOptionId === null ||
                !is_scalar($givenOptionId) ||
                trim((string) $givenOptionId) === ''
            ) {
                continue;
            }

            $scoredAnsweredCount++;

            $correctOptionIds = (array) $correctOptionIds;

            if (
                in_array(
                    (string) $givenOptionId,
                    array_map('strval', $correctOptionIds),
                    true
                )
            ) {
                $correctCount++;
            }
        }

        $wrongCount = max(
            0,
            $scoredAnsweredCount - $correctCount
        );

        return [
            'answered_count' => $answeredCount,
            'correct_count' => $correctCount,
            'wrong_count' => $wrongCount,
            'scored_question_count' => count($answerKey),

            'score_percent' => $totalQuestions > 0
                ? (int) round(
                    ($correctCount / $totalQuestions) * 100
                )
                : null,
        ];
    }

    // ==========================================================
    // FORMAT JAWABAN BERDASARKAN SUBTES
    // ==========================================================

    private function formatIndexedResponses(
        array $responses,
        string $subtestLabel
    ): array {

        $formatted = [];

        foreach ($responses as $number => $answer) {

            if (
                !is_numeric($number) ||
                $answer === null ||
                $answer === ''
            ) {
                continue;
            }

            $formatted[] = [
                'question_id' => (int) $number,
                'question_text' =>
                    $subtestLabel . ' - Soal ' . $number,
                'answer' => is_scalar($answer)
                    ? (string) $answer
                    : 'Jawaban tersimpan',
            ];
        }

        return $formatted;
    }

    // ==========================================================
    // NORMALISASI JAWABAN
    // ==========================================================

    private function normalizeAnswer(string $answer): string
    {
        $normalized = preg_replace(
            '/\s+/',
            ' ',
            trim($answer)
        );

        return mb_strtolower($normalized ?? '');
    }

    // ==========================================================
    // HITUNG JAWABAN TERISI
    // ==========================================================

    private function countAnsweredResponses(array $responses): int
    {
        return collect($responses)
            ->filter(function ($answer) {

                if ($answer === null || $answer === '') {
                    return false;
                }

                if (is_array($answer)) {
                    return count($answer) > 0;
                }

                return true;
            })
            ->count();
    }

    // ==========================================================
    // AMBIL JAWABAN SUBTES
    // ==========================================================

    private function extractSubtestResponses(
        array $responses,
        string $subtestKey
    ): array {

        $candidate = $responses[$subtestKey]
            ?? ($responses['subtests'][$subtestKey] ?? null);

        return is_array($candidate)
            ? $candidate
            : [];
    }

    // ==========================================================
    // DECODE JSON RESPONSES
    // ==========================================================

    private function decodeResponses(mixed $responses): array
    {
        if (is_array($responses)) {
            return $responses;
        }

        if (
            !is_string($responses) ||
            trim($responses) === ''
        ) {
            return [];
        }

        $decoded = json_decode($responses, true);

        return is_array($decoded)
            ? $decoded
            : [];
    }

    // ==========================================================
    // KUMPULKAN ID SOAL
    // ==========================================================

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

    // ==========================================================
    // FORMAT JAWABAN UNTUK HALAMAN HASIL
    // ==========================================================

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
