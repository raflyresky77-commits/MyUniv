<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $assessments = Assessment::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'ilike', '%' . $search . '%')
                    ->orWhere('description', 'ilike', '%' . $search . '%');
            });
        })
            ->withCount('questions')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.assessments.index', compact('assessments'));
    }

    public function create()
    {
        return view('admin.assessments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        Assessment::create($validated);

        return redirect()
            ->route('admin.assessments.index')
            ->with('success', 'Asesmen berhasil ditambahkan.');
    }

    public function show(int $id)
    {
        $assessment = Assessment::with('questions')->findOrFail($id);

        return view('admin.assessments.show', compact('assessment'));
    }

    public function edit(int $id)
    {
        $assessment = Assessment::findOrFail($id);

        return view('admin.assessments.edit', compact('assessment'));
    }

    public function update(Request $request, int $id)
    {
        $assessment = Assessment::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $assessment->update($validated);

        return redirect()
            ->route('admin.assessments.index')
            ->with('success', 'Paket asesmen berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $assessment = Assessment::findOrFail($id);
        $assessment->delete();

        return redirect()
            ->route('admin.assessments.index')
            ->with('success', 'Paket asesmen berhasil dihapus.');
    }

    /** Mengambil daftar soal untuk modal Kelola Soal. */
    public function questionsIndex(int $assessment)
    {
        $assessmentData = Assessment::findOrFail($assessment);

        $questions = Question::with('options')
            ->where('assessment_id', $assessmentData->id)
            ->latest()
            ->get()
            ->map(function ($question) {
                return [
                    'id' => $question->id,
                    'question_text' => $question->question_text,
                    'type' => $question->type,
                    'image_url' => $question->image_url,
                    'is_active' => $question->is_active,
                    'options' => $question->options->map(function ($option) {
                        return [
                            'id' => $option->id,
                            'option_text' => $option->option_text,
                            'score' => $option->score,
                            'interest_category_id' => $option->interest_category_id,
                        ];
                    })->values(),
                ];
            });

        return response()->json(['success' => true, 'questions' => $questions]);
    }

    /** Menampilkan detail satu soal untuk modal edit. */
    public function questionShow(int $question)
    {
        $questionData = Question::with('options')->findOrFail($question);

        return response()->json([
            'success' => true,
            'question' => [
                'id' => $questionData->id,
                'question_text' => $questionData->question_text,
                'type' => $questionData->type,
                'image_url' => $questionData->image_url,
                'options' => $questionData->options->map(function ($option) {
                    return [
                        'id' => $option->id,
                        'option_text' => $option->option_text,
                        'score' => $option->score,
                        'interest_category_id' => $option->interest_category_id,
                    ];
                })->values(),
            ],
        ]);
    }

    /** Menambahkan soal ke paket asesmen. */
    public function storeQuestion(Request $request, int $assessment)
    {
        $assessmentData = Assessment::findOrFail($assessment);

        $validated = $request->validate([
            'question_text' => ['required', 'string'],
            'type' => ['required', 'string', 'in:multiple_choice,likert,preference,drawing,image_choice,visual'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'options' => ['nullable', 'array', 'max:10'],
            'options.*.option_text' => ['required', 'string', 'max:1000'],
            'options.*.score' => ['nullable', 'numeric'],
            'options.*.interest_category_id' => ['nullable', 'integer'],
        ]);

        $type = $validated['type'];
        $options = $validated['options'] ?? [];

        if (in_array($type, ['multiple_choice', 'likert', 'preference', 'image_choice', 'visual'], true) && count($options) < 2) {
            return response()->json([
                'success' => false,
                'message' => 'Tipe soal ini memerlukan minimal 2 opsi jawaban.',
            ], 422);
        }

        $question = DB::transaction(function () use ($validated, $assessmentData, $type, $options) {
            $question = Question::create([
                'assessment_id' => $assessmentData->id,
                'category_id' => 1,
                'subtest_id' => null,
                'question_text' => trim($validated['question_text']),
                'type' => $type,
                'is_active' => true,
                'image_url' => $validated['image_url'] ?? null,
            ]);

            foreach ($options as $option) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => trim($option['option_text']),
                    'score' => $option['score'] ?? 0,
                    'interest_category_id' => $option['interest_category_id'] ?? null,
                ]);
            }

            return $question;
        });

        return response()->json([
            'success' => true,
            'message' => 'Soal berhasil disimpan.',
            'question' => $question->load('options'),
            'questions_count' => Question::where('assessment_id', $assessmentData->id)->count(),
        ], 201);
    }

    /** Memperbarui soal dan mengganti opsi sesuai data terbaru dari form. */
    public function updateQuestion(Request $request, int $question)
    {
        $questionData = Question::findOrFail($question);

        $validated = $request->validate([
            'question_text' => ['required', 'string'],
            'type' => ['required', 'string', 'in:multiple_choice,likert,preference,drawing,image_choice,visual'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'options' => ['nullable', 'array', 'max:10'],
            'options.*.option_text' => ['required', 'string', 'max:1000'],
            'options.*.score' => ['nullable', 'numeric'],
            'options.*.interest_category_id' => ['nullable', 'integer'],
        ]);

        $type = $validated['type'];
        $options = $validated['options'] ?? [];

        if (in_array($type, ['multiple_choice', 'likert', 'preference', 'image_choice', 'visual'], true) && count($options) < 2) {
            return response()->json([
                'success' => false,
                'message' => 'Tipe soal ini memerlukan minimal 2 opsi jawaban.',
            ], 422);
        }

        DB::transaction(function () use ($questionData, $validated, $type, $options) {
            $questionData->update([
                'question_text' => trim($validated['question_text']),
                'type' => $type,
                'image_url' => $validated['image_url'] ?? null,
            ]);

            $questionData->options()->delete();

            foreach ($options as $option) {
                QuestionOption::create([
                    'question_id' => $questionData->id,
                    'option_text' => trim($option['option_text']),
                    'score' => $option['score'] ?? 0,
                    'interest_category_id' => $option['interest_category_id'] ?? null,
                ]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Soal berhasil diperbarui.',
            'question' => $questionData->fresh()->load('options'),
        ]);
    }

    /** Menghapus soal. */
    public function questionsDestroy(Request $request, int $question)
    {
        $questionData = Question::findOrFail($question);
        $assessmentId = $questionData->assessment_id;
        $questionData->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pertanyaan berhasil dihapus.',
                'questions_count' => Question::where('assessment_id', $assessmentId)->count(),
            ]);
        }

        return redirect()->route('admin.assessments.index')->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
