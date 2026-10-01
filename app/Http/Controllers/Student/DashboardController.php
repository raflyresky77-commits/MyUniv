<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\AssessmentResult;
use App\Models\EducationPlan;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard siswa.
     */
    public function index()
    {
        $user = Auth::user();

        // Mengambil data student berdasarkan user yang sedang login
        $student = Student::where('user_id', $user->id)->first();

        // Mengambil data asesmen terakhir siswa
        $assessmentResult = $student
            ? AssessmentResult::where('student_id', $student->id)
                ->latest()
                ->first()
            : null;

        // Mengambil rekomendasi jurusan berdasarkan user
        $recommendations = collect();

        // Mengambil ringkasan education planning siswa
        $educationPlans = $student
    ? EducationPlan::where('student_id', $student->id)
        ->take(3)
        ->get()
    : collect();


        return view('student.dashboard', compact(
    'user',
    'assessmentResult',
    'recommendations',
    'educationPlans'
));
    }
}
