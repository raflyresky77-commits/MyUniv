<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AssessmentResult;
use App\Models\Recommendation;
use App\Models\EducationPlan;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard siswa.
     */
    public function index()
    {
        $user = Auth::user();

        // Mengambil data asesmen terakhir siswa
        $assessmentResult = AssessmentResult::where('user_id', $user->id)
            ->latest()
            ->first();

        // Mengambil rekomendasi jurusan berdasarkan hasil asesmen
        $recommendations = Recommendation::where('user_id', $user->id)
            ->take(3)
            ->get();

        // Mengambil ringkasan education planning siswa
        $educationPlans = EducationPlan::where('user_id', $user->id)
            ->take(3)
            ->get();

        return view('student.dashboard', compact(
            'user',
            'assessmentResult',
            'recommendations',
            'educationPlans'
        ));
    }
}
