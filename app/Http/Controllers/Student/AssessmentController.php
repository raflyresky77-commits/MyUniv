<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Question;

class AssessmentController extends Controller
{
    public function index()
    {
        return view('student.assessment.index');
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

        session([
            'minat_bakat_result' => $validated['responses'],
        ]);

        return redirect()
            ->route('student.assessment.kemampuan')
            ->with(
                'success',
                'Tes Minat Bakat berhasil disimpan, silakan lanjutkan ke Tes Kemampuan.'
            );
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

        session([
            'kemampuan_result' => $validated['responses'],
        ]);

        return redirect()
            ->route('student.assessment.kepribadian')
            ->with(
                'success',
                'Tes Kemampuan berhasil disimpan, silakan lanjutkan ke Tes Kepribadian.'
            );
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

        // Menyimpan jawaban ke session.
        session([
            'kepribadian_result' => $validated['responses'],
        ]);

        return redirect()
            ->route('student.result.index')
            ->with(
                'success',
                'Seluruh rangkaian asesmen berhasil diselesaikan!'
            );
    }

    public function result()
    {
        return view('student.assessment.result');
    }

}
