<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use App\Models\ConsultationResponse;
use App\Models\Consultation;
use App\Models\TeacherBk;
use App\Models\University;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CounselorController extends Controller
{
    // Mengambil profil Guru BK yang sedang login.
    private function getTeacher()
    {
        return TeacherBk::where('user_id', Auth::id())->first();
    }

    public function dashboard()
    {
        $teacher = $this->getTeacher();

        $consultations = Consultation::query()
            ->when(
                $teacher,
                fn ($query) => $query->where('teacher_id', $teacher->id),
                fn ($query) => $query->whereRaw('1 = 0')
            );

        // Menghitung statistik konsultasi berdasarkan data database.
        $stats = [
            'today_count' => (clone $consultations)
                ->whereDate('scheduled_at', today())
                ->count(),

            'active_count' => (clone $consultations)
                ->whereIn('status', ['pending', 'approved'])
                ->count(),
        ];

        $nearestConsultations = (clone $consultations)
            ->with(['student.user'])
            ->whereIn('status', ['pending', 'approved'])
            ->whereNotNull('scheduled_at')
            ->orderBy('scheduled_at')
            ->take(5)
            ->get();

        return view('counselor.dashboard', compact(
            'stats',
            'nearestConsultations'
        ));
    }

    public function exploration()
    {
        // Data eksplorasi menggunakan sumber dan relasi yang sama dengan halaman Student.
        $universities = University::with('majors')
            ->where(function ($query) {
                $query->whereNull('branch_notes')
                    ->orWhere('branch_notes', 'not like', '%DATA UJI IMPORT%');
            })
            ->where('name', 'not like', '%Uji Import%')
            ->orderByRaw('CASE WHEN ranking IS NULL THEN 1 ELSE 0 END')
            ->orderBy('ranking')
            ->orderBy('name')
            ->get();

        return view('counselor.exploration', compact('universities'));
    }


    public function consultation()
    {
        $teacher = $this->getTeacher();

        // Mengambil konsultasi yang ditangani Guru BK.
        $query = Consultation::with([
            'student.user',
            'teacher.user',
            'responses'
        ])
            ->when(
                $teacher,
                fn ($query) => $query->where('teacher_id', $teacher->id),
                fn ($query) => $query->whereRaw('1 = 0')
            );

        $consultations = (clone $query)
            ->latest()
            ->get();

        $stats = [
            'pending' => (clone $query)->where('status', 'pending')->count(),
            'active' => (clone $query)->where('status', 'approved')->count(),
            'completed' => (clone $query)
                ->where('status', 'completed')
                ->whereMonth('updated_at', now()->month)
                ->whereYear('updated_at', now()->year)
                ->count(),
        ];

        return view('counselor.consultation', compact(
            'consultations',
            'stats'
        ));
    }


    public function updateConsultation(
        Request $request,
        Consultation $consultation
    ) {
        $teacher = $this->getTeacher();

        if (!$teacher) {
            abort(403, 'Profil Guru BK tidak ditemukan.');
        }

        // Memastikan konsultasi memang ditangani Guru BK yang login.
        $consultation = Consultation::where('teacher_id', $teacher->id)
            ->findOrFail($consultation->id);

        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,approved,rejected,completed'
            ],
            'response' => [
                'nullable',
                'string',
                'max:3000'
            ],
        ], [
            'status.required' => 'Status konsultasi wajib dipilih.',
            'status.in' => 'Status konsultasi tidak valid.',
            'response.max' => 'Catatan maksimal 3000 karakter.',
        ]);

        // Simpan status dan tanggapan Guru BK.
        \Illuminate\Support\Facades\DB::transaction(function () use (
            $consultation,
            $teacher,
            $validated
        ) {
            $consultation->update([
                'status' => $validated['status'],
            ]);

            if (!empty(trim($validated['response'] ?? ''))) {
                ConsultationResponse::create([
                    'consultation_id' => $consultation->id,
                    'teacher_id' => $teacher->id,
                    'responses' => $validated['response'],
                ]);
            }
        });

        return redirect()
            ->route('counselor.consultation')
            ->with('success', 'Konsultasi berhasil diperbarui.');
    }



    /**
     * Menampilkan seluruh siswa yang memiliki profil pada tabel students.
     * Akses halaman dibatasi oleh middleware role:counselor pada routes/web.php.
     */
    public function assessmentResults(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $selectedClass = trim((string) $request->query('class', ''));

        $studentQuery = Student::query()
            ->with('user')
            ->whereHas('user')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($studentQuery) use ($search) {
                    $studentQuery->where('nisn', 'ilike', "%{$search}%")
                        ->orWhere('class', 'ilike', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'ilike', "%{$search}%")
                                ->orWhere('email', 'ilike', "%{$search}%");
                        });
                });
            })
            ->when($selectedClass !== '', fn ($query) => $query->where('class', $selectedClass));

        $totalStudents = (clone $studentQuery)->count();

        $students = (clone $studentQuery)
            ->orderBy('class')
            ->orderBy('id')
            ->paginate(15)
            ->withQueryString();

        $userIds = $students->getCollection()
            ->pluck('user_id')
            ->filter()
            ->unique()
            ->values();

        $submissionsByUser = $userIds->isEmpty()
            ? collect()
            : DB::table('assessment_submissions')
                ->whereIn('user_id', $userIds)
                ->get()
                ->groupBy('user_id');

        $assessmentTypes = [
            'minat_bakat' => 'Minat Bakat',
            'kemampuan' => 'Kemampuan',
            'kepribadian' => 'Kepribadian',
        ];

        $students->getCollection()->transform(function ($student) use ($submissionsByUser, $assessmentTypes) {
            $submissions = $submissionsByUser->get($student->user_id, collect())
                ->keyBy('assessment_type');

            // Bangun array pada variabel lokal agar kompatibel dengan magic
            // attribute Eloquent; hindari indirect modification pada properti model.
            $assessmentStatus = [];

            foreach ($assessmentTypes as $type => $label) {
                $submission = $submissions->get($type);

                $assessmentStatus[$type] = [
                    'label' => $label,
                    'completed' => $submission !== null,
                    'submitted_at' => $submission->submitted_at ?? null,
                ];
            }

            $student->assessment_status = $assessmentStatus;

            $student->all_assessments_completed = collect($assessmentTypes)
                ->keys()
                ->every(fn ($type) => $submissions->has($type));

            return $student;
        });

        $classes = Student::query()
            ->whereNotNull('class')
            ->where('class', '!=', '')
            ->distinct()
            ->orderBy('class')
            ->pluck('class');

        return view('counselor.assessment-results.index', compact(
            'students',
            'classes',
            'search',
            'selectedClass',
            'totalStudents'
        ));
    }

    /**
     * Menampilkan data jawaban yang tersimpan untuk siswa terpilih.
     * Tidak mengubah atau menghitung ulang skor asesmen siswa.
     */
    public function assessmentResultDetail(int $studentId)
    {
        $student = Student::with('user')->findOrFail($studentId);

        abort_unless($student->user, 404);

        $typeLabels = [
            'minat_bakat' => 'Minat Bakat',
            'kemampuan' => 'Kemampuan',
            'kepribadian' => 'Kepribadian',
        ];

        $submissions = DB::table('assessment_submissions')
            ->where('user_id', $student->user_id)
            ->orderBy('submitted_at')
            ->get()
            ->map(function ($submission) use ($typeLabels) {
                $decoded = is_array($submission->responses)
                    ? $submission->responses
                    : json_decode((string) $submission->responses, true);

                $responses = is_array($decoded) ? $decoded : [];
                $submission->label = $typeLabels[$submission->assessment_type]
                    ?? ucfirst(str_replace('_', ' ', $submission->assessment_type));
                $submission->display_responses = $this->formatCounselorResponses(
                    $submission->assessment_type,
                    $responses
                );

                return $submission;
            });

        return view('counselor.assessment-results.show', compact(
            'student',
            'submissions'
        ));
    }


    /**
     * Menyiapkan jawaban asesmen menjadi informasi yang mudah dibaca Guru BK.
     * Data asli di assessment_submissions tidak diubah.
     */
    private function formatCounselorResponses(string $type, array $responses): array
    {
        // Beberapa versi penyimpanan membungkus jawaban di dalam key "responses",
        // "answers", atau "data". Buka wrapper tersebut tanpa mengubah data DB.
        foreach (['responses', 'answers', 'data'] as $wrapper) {
            if (isset($responses[$wrapper]) && is_array($responses[$wrapper])) {
                $responses = $responses[$wrapper];
                break;
            }
        }

        $rows = [];

        if (in_array($type, ['minat_bakat', 'kepribadian'], true)) {
            $pairs = $this->flattenCounselorAnswers($responses);
            if (empty($pairs)) {
                return [];
            }

            $questionIds = collect($pairs)
                ->pluck('question_id')
                ->filter(fn ($id) => is_numeric($id))
                ->map(fn ($id) => (int) $id)
                ->unique()
                ->values();

            $questions = $questionIds->isEmpty()
                ? collect()
                : DB::table('questions')
                    ->whereIn('id', $questionIds)
                    ->pluck('question_text', 'id');

            $optionIds = $type === 'kepribadian'
                ? collect($pairs)
                    ->pluck('answer')
                    ->filter(fn ($value) => is_numeric($value))
                    ->map(fn ($value) => (int) $value)
                    ->unique()
                    ->values()
                : collect();

            $optionsById = $optionIds->isEmpty()
                ? collect()
                : DB::table('question_options')
                    ->whereIn('id', $optionIds)
                    ->get(['id', 'question_id', 'option_text'])
                    ->keyBy('id');

            foreach ($pairs as $pair) {
                $questionId = (int) $pair['question_id'];
                $answer = $pair['answer'];
                $questionText = $questions->get(
                    $questionId,
                    'Pertanyaan nomor ' . $questionId
                );

                if ($answer === null || $answer === '') {
                    $answerText = 'Tidak dijawab';
                } elseif ($type === 'minat_bakat') {
                    $scaleLabels = [
                        1 => 'Sangat tidak suka',
                        2 => 'Tidak suka',
                        3 => 'Netral',
                        4 => 'Suka',
                        5 => 'Sangat suka',
                    ];

                    $answerText = is_numeric($answer) && isset($scaleLabels[(int) $answer])
                        ? $scaleLabels[(int) $answer]
                        : (is_scalar($answer) ? (string) $answer : 'Jawaban tersimpan');
                } else {
                    $option = is_numeric($answer)
                        ? $optionsById->get((int) $answer)
                        : null;

                    $answerText = ($option && (int) $option->question_id === $questionId)
                        ? $option->option_text
                        : (is_scalar($answer) ? (string) $answer : 'Jawaban tersimpan');
                }

                $rows[] = [
                    'question' => $questionText,
                    'answer' => $answerText,
                ];
            }

            return $rows;
        }

        if ($type === 'kemampuan') {
            // Kunci berikut disamakan dengan ResultController yang dipakai MyUniv.
            // Jangan menilai subtes yang belum memiliki kunci tervalidasi.
            $answerKeys = [
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
                // ResultController belum memberi kunci untuk abstrak.
                'abstrak' => [],
            ];

            $subtestAliases = [
                'numerik' => 'Numerik',
                'verbal' => 'Literasi',
                'literasi' => 'Literasi',
                'abstrak' => 'Abstrak & Logika',
            ];

            $foundSubtest = false;
            foreach ($subtestAliases as $key => $label) {
                $answers = $responses[$key]
                    ?? ($responses['subtests'][$key] ?? null);

                if (!is_array($answers)) {
                    continue;
                }

                $foundSubtest = true;
                // Data lama menggunakan key "literasi", tetapi kuncinya sama
                // dengan subtes "verbal" pada ResultController.
                $keyName = $key === 'literasi' ? 'verbal' : $key;
                $answerKey = $answerKeys[$keyName] ?? [];

                foreach ($answers as $number => $answer) {
                    if (!is_numeric($number)) {
                        continue;
                    }

                    $number = (int) $number;
                    $hasAnswer = !($answer === null || $answer === '');
                    $canBeGraded = array_key_exists($number, $answerKey);
                    $correctAnswer = $canBeGraded ? $answerKey[$number] : null;
                    $isCorrect = $hasAnswer && $canBeGraded
                        && is_scalar($answer)
                        && $this->normalizeCounselorAnswer((string) $answer)
                            === $this->normalizeCounselorAnswer($correctAnswer);

                    $rows[] = [
                        'question' => $label . ' — Soal ' . $number,
                        'answer' => $this->humanizeAbilityAnswer($answer),
                        'grading_status' => !$hasAnswer
                            ? 'Tidak dijawab'
                            : ($canBeGraded ? ($isCorrect ? 'Benar' : 'Salah') : 'Belum dinilai'),
                        'correct_answer' => ($hasAnswer && $canBeGraded && !$isCorrect)
                            ? $correctAnswer
                            : null,
                        'grading_note' => $canBeGraded
                            ? null
                            : 'Kunci jawaban belum tersedia atau belum tervalidasi. Jawaban tidak dinilai.',
                    ];
                }
            }

            // Format lama: nomor soal tersimpan langsung pada root.
            // Tidak ada identitas subtes, sehingga tidak boleh ditebak kunci jawabannya.
            if (!$foundSubtest) {
                foreach ($responses as $number => $answer) {
                    if (is_numeric($number) && !is_array($answer)) {
                        $rows[] = [
                            'question' => 'Soal ' . $number,
                            'answer' => $this->humanizeAbilityAnswer($answer),
                            'grading_status' => 'Belum dinilai',
                            'correct_answer' => null,
                            'grading_note' => 'Jenis subtes tidak teridentifikasi. Jawaban tidak dinilai agar tidak memberikan hasil yang keliru.',
                        ];
                    }
                }
            }

            return $rows;
        }

        // Jangan tampilkan JSON mentah jika tipe asesmen belum dikenali.
        return [];
    }

    /**
     * Meratakan jawaban dengan format question_id => answer,
     * termasuk jika pasangan tersebut berada di dalam beberapa level array.
     */
    private function flattenCounselorAnswers(array $responses): array
    {
        $pairs = [];

        foreach ($responses as $key => $value) {
            if (is_numeric($key) && !is_array($value)) {
                $pairs[] = [
                    'question_id' => (int) $key,
                    'answer' => $value,
                ];
                continue;
            }

            if (is_array($value)) {
                $pairs = array_merge(
                    $pairs,
                    $this->flattenCounselorAnswers($value)
                );
            }
        }

        return $pairs;
    }

    /** Normalisasi teks yang sama dengan pendekatan ResultController. */
    private function normalizeCounselorAnswer(string $answer): string
    {
        $normalized = preg_replace('/\s+/', ' ', trim($answer));

        return mb_strtolower($normalized ?? '');
    }

    /**
     * Mengubah jawaban kemampuan menjadi teks yang aman dan mudah dibaca.
     * Pilihan seperti A/B/C tetap ditampilkan apa adanya karena label opsi
     * dapat berbeda untuk tiap soal.
     */
    private function humanizeAbilityAnswer($answer): string
    {
        if ($answer === null || $answer === '') {
            return 'Tidak dijawab';
        }

        if (is_bool($answer)) {
            return $answer ? 'Ya' : 'Tidak';
        }

        if (is_scalar($answer)) {
            return (string) $answer;
        }

        return 'Jawaban tersimpan';
    }

    public function profile()
    {
        $user = Auth::user();
        $teacher = $this->getTeacher();

        return view('counselor.profile', compact(
            'user',
            'teacher'
        ));
    }
}
