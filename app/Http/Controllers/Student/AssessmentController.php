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
        $questions = $assessment ? $assessment->questions : collect();

        return view('student.assessment.minat-bakat', compact('questions'));
    }

    public function minatBakatStore(Request $request)
    {
        $request->validate([
            'responses' => 'required|array',
        ]);

        session(['minat_bakat_result' => $request->responses]);

        return redirect()->route('student.assessment.kemampuan')
                         ->with('success', 'Tes Minat Bakat berhasil disimpan, silakan lanjutkan ke Tes Kemampuan.');
    }

    public function kemampuan()
    {
        return view('student.assessment.kemampuan');
    }

    public function kemampuanStore(Request $request)
    {
        $request->validate([
            'responses' => 'required|array',
        ]);

        session(['kemampuan_result' => $request->responses]);

        return redirect()->route('student.assessment.kepribadian')
                         ->with('success', 'Tes Kemampuan berhasil disimpan, silakan lanjutkan ke Tes Kepribadian.');
    }

    public function kepribadian()
    {
        // Mengambil asesmen kepribadian dari Supabase (PostgreSQL menggunakan ilike)
        $assessment = Assessment::where('title', 'ilike', '%kepribadian%')->first();

        // Mengambil pertanyaan terkait melalui relasi
        $questions = $assessment ? $assessment->questions : collect();

        return view('student.assessment.kepribadian', compact('questions'));
    }

    public function kepribadianStore(Request $request)
    {
        $request->validate([
            'responses' => 'required|array',
        ]);

        // Simpan jawaban tes kepribadian ke session (atau database Supabase)
        session(['kepribadian_result' => $request->responses]);

        // Redirect ke halaman hasil asesmen sesuai alur (resources/views/student/result/index.blade.php)
        return redirect()->route('student.result.index')
                         ->with('success', 'Seluruh rangkaian asesmen berhasil diselesaikan!');
    }
}
