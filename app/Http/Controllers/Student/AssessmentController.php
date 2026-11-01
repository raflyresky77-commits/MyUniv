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

    public function kemampuan()
    {
        // Ambil jawaban tersimpan siswa. Halaman Kemampuan kini hanya
        // menggunakan subtes Numerik, Literasi, dan Abstrak & Logika.
        $savedResponses = $this->getSavedResponses('kemampuan');

        return view(
            'student.assessment.kemampuan',
            compact('savedResponses')
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
        $questions = Question::where('subtest_id', 1)
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
        ]);

        $this->saveAssessmentSubmission('kepribadian', $validated['responses']);

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

        // Perbarui submission terbaru milik siswa untuk jenis asesmen ini.
        // Jika belum ada, buat record baru.
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
    }

    public function result()
    {
        return view('student.assessment.result');
}

}
