<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    public function index()
    {
        $submissions = DB::table('assessment_submissions')
            ->where('user_id', Auth::id())
            ->get()
            ->keyBy('assessment_type');

        $completedCount = collect(['minat_bakat', 'kemampuan', 'kepribadian'])
            ->filter(fn ($type) => isset($submissions[$type]))
            ->count();

        $progress = (int) round(($completedCount / 3) * 100);

        return view('student.assessment.index', compact(
            'submissions',
            'completedCount',
            'progress'
        ));
    }

    public function minatBakat()   
    {
        $assessment = Assessment::where('title', 'ilike', '%minat%')->first();

        $questions = $assessment
            ? $assessment->questions
            : collect();

        $savedResponses = $this->getSavedResponses('minat_bakat');

        return view('student.assessment.minat-bakat', compact('questions', 'savedResponses'));
    }

    public function minatBakatStore(Request $request)
    {
        $validated = $request->validate([
            'responses' => 'required|array',
        ]);

        $this->saveAssessmentSubmission('minat_bakat', $validated['responses']);

        return redirect()
            ->route('student.assessment.index')
            ->with('success', 'Jawaban Tes Minat Bakat berhasil disimpan.');
    }
        // Ambil jawaban tersimpan siswa. Halaman Kemampuan kini hanya
        // menggunakan subtes Numerik, Literasi, dan Abstrak & Logika.
    
public function kemampuan()
{
    $savedResponses = $this->getSavedResponses('kemampuan');

    // SOAL NUMERIK: Assessment 7, Subtest 2
    // Termasuk soal lama yang subtest_id-nya NULL.
    $numerikQuestions = Question::with('options')
        ->where('assessment_id', 7)
        ->where('is_active', true)
        ->where('type', 'multiple_choice')
        ->where(function ($query) {
            $query->where('subtest_id', 2)
                ->orWhereNull('subtest_id');
        })
        ->orderBy('id')
        ->get();

    // SOAL VERBAL: Assessment 6, Subtest 3
    // Termasuk soal lama yang subtest_id-nya NULL.
    $verbalQuestions = Question::with('options')
        ->where('assessment_id', 6)
        ->where('is_active', true)
        ->where('type', 'multiple_choice')
        ->where(function ($query) {
            $query->where('subtest_id', 3)
            ->orWhereNull('subtest_id');
        })
        ->orderBy('id')
        ->get();

    // SOAL ABSTRAK: Assessment 9, Subtest 4
    $abstrakQuestions = Question::with('options')
        ->where('assessment_id', 9)
        ->where('subtest_id', 4)
        ->where('is_active', true)
        ->whereIn('type', ['image_choice', 'visual'])
        ->orderBy('id')
        ->get();

    // Struktur data untuk Blade tetap menggunakan key yang sama.
    $subtests = [
        'numerik' => [
            'questions' => $numerikQuestions,
        ],
        'verbal' => [
            'questions' => $verbalQuestions,
        ],
        'abstrak' => [
            'questions' => $abstrakQuestions,
        ],
    ];

    $answerDetails = $this->getKemampuanAnswerDetails($savedResponses);
    return view(
    'student.assessment.kemampuan',
    compact('savedResponses', 'subtests', 'answerDetails')
);
}


    public function kemampuanStore(Request $request)
    {
        $validated = $request->validate([
            'responses' => 'required|array',
        ]);

        $this->saveAssessmentSubmission('kemampuan', $validated['responses']);

        return redirect()
            ->route('student.assessment.index')
            ->with('success', 'Jawaban Tes Kemampuan berhasil disimpan.');
    }


    public function kepribadian()
{
    $questions = Question::with('options')
        ->whereIn('id', array_merge(
            range(1, 10),
            range(90, 114)
        ))
        ->where('type', 'likert')
        ->where('is_active', true)
        ->orderBy('id')
        ->get();

    $savedResponses = $this->getSavedResponses('kepribadian');

    return view(
        'student.assessment.kepribadian',
        compact('questions', 'savedResponses')
    );
}


    public function kepribadianStore(Request $request)
{
    $validated = $request->validate([
        'responses' => 'required|array',
        'responses.*' => 'required|integer',
    ]);

    $responses = $validated['responses'];

    // Pastikan semua ID pertanyaan yang diwajibkan sudah dijawab.
    $questionIds = array_merge(
        range(1, 10),
        range(90, 114)
    );

    if (count($responses) !== count($questionIds) ||
        array_diff($questionIds, array_map('intval', array_keys($responses)))) {
        return back()
            ->withErrors(['responses' => 'Semua pertanyaan wajib dijawab.'])
            ->withInput();
    }

    // Pastikan option_id benar-benar milik pertanyaan yang dipilih.
    foreach ($responses as $questionId => $optionId) {
        $validOption = DB::table('question_options')
            ->where('id', $optionId)
            ->where('question_id', $questionId)
            ->exists();

        if (!$validOption) {
            return back()
                ->withErrors(['responses' => 'Pilihan jawaban tidak valid.'])
                ->withInput();
        }
    }

    $this->saveAssessmentSubmission('kepribadian', $responses);

    return redirect()
        ->route('student.assessment.index')
        ->with('success', 'Jawaban Tes Kepribadian Karier berhasil disimpan.');
}

    /**
     * Ambil jawaban terakhir siswa agar tetap tampil saat asesmen dibuka ulang.
     */
    private function getSavedResponses(string $assessmentType): array
    {
        // Ambil submission paling baru agar jawaban lama/duplikat tidak
        // membuat halaman memulihkan record yang bukan versi terakhir.
        $submission = DB::table('assessment_submissions')
            ->where('user_id', Auth::id())
            ->where('assessment_type', $assessmentType)
            ->orderByDesc('updated_at')
            ->orderByDesc('id')
            ->first();

        $rawResponses = $submission->responses ?? null;

        if (is_array($rawResponses)) {
            return $rawResponses;
        }

        if (! is_string($rawResponses) || $rawResponses === '') {
            return [];
        }

        $decoded = json_decode($rawResponses, true);

        return is_array($decoded) ? $decoded : [];
    }

        
/**
 * Memproses jawaban kemampuan agar ID opsi yang sudah tidak tersedia
 * tidak ditampilkan sebagai angka mentah.
 */
private function getKemampuanAnswerDetails(array $responses): array
{
    $details = [];

    foreach (['numerik', 'verbal', 'abstrak'] as $subtest) {
        $answers = $responses[$subtest] ?? [];

        if (!is_array($answers)) {
            continue;
        }

        foreach ($answers as $questionId => $optionId) {
            $option = DB::table('question_options')
                ->where('id', $optionId)
                ->where('question_id', $questionId)
                ->first();

            $details[$subtest][$questionId] = [
                'answer' => $option?->option_text,
                'available' => $option !== null,
                'status' => $option
                    ? 'Jawaban tersedia'
                    : 'Pilihan jawaban tidak tersedia',
            ];
        }
    }

    return $details;
}


    /**
     * Simpan atau perbarui jawaban asesmen siswa.
     */
    
private function saveAssessmentSubmission(string $assessmentType, array $responses): void
{
    $now = now();

    $values = [
        'responses' => json_encode($responses, JSON_UNESCAPED_UNICODE),
        'submitted_at' => $now,
        'updated_at' => $now,
    ];

    // Cari submission terbaru milik siswa.
    $submission = DB::table('assessment_submissions')
        ->where('user_id', Auth::id())
        ->where('assessment_type', $assessmentType)
        ->orderByDesc('updated_at')
        ->orderByDesc('id')
        ->first();

    if ($submission) {
        DB::table('assessment_submissions')
            ->where('id', $submission->id)
            ->update($values);
    } else {
        DB::table('assessment_submissions')->insert(array_merge($values, [
            'user_id' => Auth::id(),
            'assessment_type' => $assessmentType,
            'created_at' => $now,
        ]));
    }

    // Simpan jawaban Numerik ke student_answers.
    if ($assessmentType === 'kemampuan') {
        $this->syncNumerikStudentAnswers($responses);
    }
}


/**
 * Sinkronisasi jawaban Numerik ke student_answers.
 */
private function syncNumerikStudentAnswers(array $responses): void
{
    // Ambil jawaban pada subtes Numerik.
    $numerikAnswers = $responses['numerik'] ?? [];

    if (!is_array($numerikAnswers) || empty($numerikAnswers)) {
        return;
    }

    // Cari data siswa berdasarkan akun yang sedang login.
    $studentId = DB::table('students')
        ->where('user_id', Auth::id())
        ->value('id');

    if (!$studentId) {
        return;
    }

    $questionIds = collect(array_keys($numerikAnswers))
        ->filter(fn ($id) => is_numeric($id))
        ->map(fn ($id) => (int) $id)
        ->unique()
        ->values();

    $optionIds = collect($numerikAnswers)
        ->filter(fn ($id) => is_numeric($id))
        ->map(fn ($id) => (int) $id)
        ->unique()
        ->values();

    if ($questionIds->isEmpty() || $optionIds->isEmpty()) {
        return;
    }

    // Hanya gunakan pertanyaan dari assessment Numerik ID 7.
    $questions = DB::table('questions')
        ->where('assessment_id', 7)
        ->whereIn('id', $questionIds)
        ->get(['id', 'assessment_id'])
        ->keyBy('id');

    // Ambil pilihan jawaban beserta skor.
    $options = DB::table('question_options')
        ->whereIn('id', $optionIds)
        ->get(['id', 'question_id', 'score'])
        ->keyBy('id');

    foreach ($numerikAnswers as $questionId => $optionId) {
        if (!is_numeric($questionId) || !is_numeric($optionId)) {
            continue;
        }

        $questionId = (int) $questionId;
        $optionId = (int) $optionId;

        $question = $questions->get($questionId);
        $option = $options->get($optionId);

        // Pastikan soal dan pilihan jawaban benar-benar cocok.
        if (!$question || !$option) {
            continue;
        }

        if ((int) $option->question_id !== $questionId) {
            continue;
        }

        DB::table('student_answers')->updateOrInsert(
            [
                'student_id' => $studentId,
                'assessment_id' => $question->assessment_id,
                'question_id' => $questionId,
            ],
            [
                'question_option_id' => $optionId,
                'score' => (int) $option->score,
                'answered_at' => now(),
            ]
        );
    }
}



    public function result()
    {
        return view('student.assessment.result');
}

}
