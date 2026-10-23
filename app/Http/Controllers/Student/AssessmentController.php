<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class AssessmentController extends Controller
{
    public function index()
    {
        $submissions = DB::table('assessment_submissions')
            ->where('user_id', auth()->id())
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

        return view('student.assessment.minat-bakat', compact('questions'));
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
        $drawingQuestions = Question::where('type', 'drawing')
                ->where('category_id', 2)
                ->where('is_active', true)
                ->orderBy('id')
                ->get();

        return view(
            'student.assessment.kemampuan',
            compact('drawingQuestions')
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

        return view(
            'student.assessment.kepribadian',
            compact('questions')
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
     * Simpan atau perbarui jawaban asesmen siswa.
     */
    private function saveAssessmentSubmission(string $assessmentType, array $responses): void
    {
        $now = now();

        $query = DB::table('assessment_submissions')
            ->where('user_id', auth()->id())
            ->where('assessment_type', $assessmentType);

        $values = [
            'responses' => json_encode($responses, JSON_UNESCAPED_UNICODE),
            'submitted_at' => $now,
            'updated_at' => $now,
        ];

        if ($query->exists()) {
            $query->update($values);
        } else {
            DB::table('assessment_submissions')->insert(array_merge($values, [
                'user_id' => auth()->id(),
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
