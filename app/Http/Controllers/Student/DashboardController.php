<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\EducationPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $student = Student::where('user_id', $user->id)->first();

        // Siswa wajib menyelesaikan onboarding sebelum membuka dashboard.
        $isProfileIncomplete = !$student
            || blank($student->nisn)
            || blank($student->gender)
            || blank($student->birth_date)
            || blank($student->address)
            || blank($student->phone)
            || blank($student->class);

        if ($isProfileIncomplete) {
            return redirect()->route('student.onboarding.index');
        }

        $isProfileIncomplete = false;

        $assessmentTypes = [
            'minat_bakat',
            'kemampuan',
            'kepribadian',
        ];

        $submissions = DB::table('assessment_submissions')
            ->where('user_id', $user->id)
            ->whereIn('assessment_type', $assessmentTypes)
            ->get()
            ->keyBy('assessment_type');

        $completedAssessmentCount = collect($assessmentTypes)
            ->filter(fn ($type) => $submissions->has($type))
            ->count();

        $totalAssessmentCount = count($assessmentTypes);
        $assessmentProgress = (int) round(
            ($completedAssessmentCount / $totalAssessmentCount) * 100
        );
        $hasCompletedAssessment = $completedAssessmentCount === $totalAssessmentCount;

        $assessmentResult = $submissions->sortByDesc('submitted_at')->first();

        $educationPlans = $student
            ? EducationPlan::where('student_id', $student->id)
                ->latest('updated_at')
                ->take(3)
                ->get()
            : collect();

        // Tidak menampilkan rekomendasi contoh tanpa sumber personal dari database.
        $recommendations = collect();

        return view('student.dashboard', compact(
            'user',
            'student',
            'isProfileIncomplete',
            'submissions',
            'assessmentResult',
            'completedAssessmentCount',
            'totalAssessmentCount',
            'assessmentProgress',
            'hasCompletedAssessment',
            'recommendations',
            'educationPlans'
        ));
    }
}
