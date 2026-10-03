<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{

public function index(Request $request)
{
    $search = $request->input('search');

    $assessments = Assessment::when($search, function ($query, $search) {
            // Mencari ke berbagai kemungkinan nama kolom di Supabase agar tidak meleset
            return $query->where(function($q) use ($search) {
                $q->where('title', 'ilike', '%' . $search . '%')
                  ->orWhere('description', 'ilike', '%' . $search . '%') // Antisipasi deskripsi
                  ->orWhere('category', 'ilike', '%' . $search . '%');   // Antisipasi kategori
            });
        })
        ->withCount('questions')
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('admin.assessments.index', compact('assessments'));
}

    // Tambahkan method create ini untuk mengatasi error
    public function create()
    {
        return view('admin.assessments.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        // Hapus 'category' jika tidak ada di tabel, ganti dengan relasi yang benar misal:
        // 'assessment_type_id' => 'required|exists:assessment_types,id',
    ]);


    \App\Models\Assessment::create([
        'title' => $validated['title'],
        'description' => $validated['description'] ?? null,
        // 'assessment_type_id' => $validated['assessment_type_id'] ?? null,
    ]);

    return redirect()->route('admin.assessments.index')->with('success', 'Asesmen berhasil ditambahkan.');
}

    public function show(int $id)
{
    // Pastikan hanya memuat relasi 'questions'
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

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
        ]);

        $assessment->update($request->all());

        return redirect()->route('admin.assessments.index')->with('success', 'Paket asesmen berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $assessment = Assessment::findOrFail($id);
        $assessment->delete();

        return redirect()->route('admin.assessments.index')->with('success', 'Paket asesmen berhasil dihapus.');
    }

    public function storeQuestion(Request $request, int $assessmentId)
    {
        $request->validate([
            'question_text' => 'required|string',
        ]);

        \App\Models\Question::create([
            'assessment_id' => $assessmentId,
            'category_id' => 1,
            'subtest_id' => 1,
            'question_text' => $request->question_text,
            'type' => $request->type ?? 'likert',
            'is_active' => true,
        ]);

        return redirect()->route('admin.assessments.show', $assessmentId)
            ->with('success', 'Pertanyaan berhasil ditambahkan.');
    }


}
