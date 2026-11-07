<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\AssessmentController as StudentAssessmentController;
use App\Http\Controllers\Student\ResultController;
use App\Http\Controllers\Student\ExplorationController;
use App\Http\Controllers\Student\PlanningController;
use App\Http\Controllers\Student\ConsultationController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\OnboardingController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Admin\AssessmentController as AdminAssessmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\ConsultationController as AdminConsultationController;

use App\Http\Controllers\Counselor\CounselorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama / Landing Page
Route::get('/', function () {
    return view('landing');
});

// Halaman Syarat & Ketentuan (Terms)
Route::get('/terms', function () {
    return view('terms');
})->name('terms');

// Register
Route::get('/register', [RegisterController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');

// Login
Route::get('/login', [LoginController::class, 'create'])
    ->name('login');

Route::post('/login', [LoginController::class, 'store'])
    ->name('login.store');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

/*
|--------------------------------------------------------------------------
| Student / Siswa
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        // Onboarding pengguna baru
        Route::get('/onboarding', [OnboardingController::class, 'index'])
            ->name('onboarding.index');

        Route::post('/onboarding', [OnboardingController::class, 'store'])
            ->name('onboarding.store');

        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');

        // Asesmen Siswa
        Route::get('/assessment', [StudentAssessmentController::class, 'index'])
            ->name('assessment.index');

        Route::get('/assessment/result', [ResultController::class, 'index'])
            ->name('assessment.result');

        // Tes Minat Bakat
        Route::get('/assessment/minat-bakat', [StudentAssessmentController::class, 'minatBakat'])
            ->name('assessment.minat-bakat');

        Route::post('/assessment/minat-bakat', [StudentAssessmentController::class, 'minatBakatStore'])
            ->name('assessment.minat-bakat.store');

        // Tes Kemampuan
        Route::get('/assessment/kemampuan', [StudentAssessmentController::class, 'kemampuan'])
            ->name('assessment.kemampuan');

        Route::post('/assessment/kemampuan', [StudentAssessmentController::class, 'kemampuanStore'])
            ->name('assessment.kemampuan.store');

        // Tes Kepribadian Karir
        Route::get('/assessment/kepribadian', [StudentAssessmentController::class, 'kepribadian'])
            ->name('assessment.kepribadian');

        Route::post('/assessment/kepribadian', [StudentAssessmentController::class, 'kepribadianStore'])
            ->name('assessment.kepribadian.store');

        // Hasil Asesmen
        Route::get('/result', [ResultController::class, 'index'])
            ->name('result.index');

        // Eksplorasi & Jurusan
        Route::get('/exploration', [ExplorationController::class, 'index'])
            ->name('exploration.index');

        Route::get('/majors/{id}', [ExplorationController::class, 'show'])
            ->name('majors.show');

        // Education Planning
        Route::get('/planning', [PlanningController::class, 'index'])
            ->name('planning.index');

        Route::post('/planning', [PlanningController::class, 'store'])
            ->name('planning.store');

        Route::put('/planning/{plan}', [PlanningController::class, 'update'])
            ->name('planning.update');

        Route::delete('/planning/{plan}', [PlanningController::class, 'destroy'])
            ->name('planning.destroy');

        Route::put('/planning/target', [PlanningController::class, 'updateTarget'])
            ->name('planning.target.update');

        Route::post('/planning/{plan}/checklist', [PlanningController::class, 'storeChecklist'])
            ->name('planning.checklist.store');

        Route::put('/planning/checklist/{checklist}', [PlanningController::class, 'updateChecklistDetails'])
            ->name('planning.checklist.update-details');

        Route::delete('/planning/checklist/{checklist}', [PlanningController::class, 'destroyChecklist'])
            ->name('planning.checklist.destroy');

        Route::patch('/planning/checklist/{checklist}', [PlanningController::class, 'updateChecklist'])
            ->name('planning.checklist.update');

        // Profil Siswa
        Route::get('/profile', [ProfileController::class, 'index'])
            ->name('profile.index');

        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        // Konsultasi BK Siswa
        Route::get('/consultation', [ConsultationController::class, 'index'])
            ->name('consultation.index');

        Route::post('/consultation', [ConsultationController::class, 'store'])
            ->name('consultation.store');
    });

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Manajemen Asesmen
        Route::resource('assessments', AdminAssessmentController::class);

        Route::post(
            'assessments/{assessment}/questions',
            [AdminAssessmentController::class, 'storeQuestion']
        )->name('questions.store');

        Route::get(
            'assessments/{assessment}/questions',
            [AdminAssessmentController::class, 'questionsIndex']
        )->name('assessments.questions.index');

        Route::delete(
            'assessments/questions/{question}',
            [AdminAssessmentController::class, 'questionsDestroy']
        )->name('assessments.questions.destroy');

        Route::get(
            'assessments/questions/{question}',
            [AdminAssessmentController::class, 'questionShow']
        );

        Route::put(
            'assessments/questions/{question}',
            [AdminAssessmentController::class, 'updateQuestion']
        );

        // Import Bank Soal Excel
        Route::get(
            'assessments/{assessment}/questions/template',
            [AdminAssessmentController::class, 'downloadQuestionTemplate']
        )->name('assessments.questions.template');

        Route::post(
            'assessments/{assessment}/questions/import/preview',
            [AdminAssessmentController::class, 'previewQuestionImport']
        )->name('assessments.questions.import.preview');

        Route::post(
            'assessments/{assessment}/questions/import/confirm',
            [AdminAssessmentController::class, 'confirmQuestionImport']
        )->name('assessments.questions.import.confirm');


        // Import Excel Universitas
        Route::get('universities/import/template', [UniversityController::class, 'downloadImportTemplate'])
            ->name('universities.import.template');
        Route::post('universities/import/preview', [UniversityController::class, 'previewImport'])
            ->name('universities.import.preview');
        Route::post('universities/import/confirm', [UniversityController::class, 'confirmImport'])
            ->name('universities.import.confirm');

        // Data Perguruan Tinggi
        Route::resource('universities', UniversityController::class);

        // Tambah relasi program studi ke perguruan tinggi
        Route::post(
            'universities/{university}/majors',
            [UniversityController::class, 'storeMajor']
        )->name('universities.majors.store');

        // Hapus relasi prodi dari perguruan tinggi tertentu
        Route::delete(
            'universities/{university}/majors/{major}',
            [UniversityController::class, 'destroyMajor']
        )->name('majors.destroy.custom');


        // Import Excel Program Studi
        Route::get('majors/import/template', [MajorController::class, 'downloadImportTemplate'])
            ->name('majors.import.template');
        Route::post('majors/import/preview', [MajorController::class, 'previewImport'])
            ->name('majors.import.preview');
        Route::post('majors/import/confirm', [MajorController::class, 'confirmImport'])
            ->name('majors.import.confirm');

        // Manajemen Program Studi
        Route::resource('majors', MajorController::class);

        // Manajemen Pengguna
        Route::resource('users', UserController::class);

        // Monitoring konsultasi BK
        Route::get('/consultations', [AdminConsultationController::class, 'index'])->name('consultations.index');
        Route::put('/consultations/{consultation}', [AdminConsultationController::class, 'update'])->name('consultations.update');
    });

/*
|--------------------------------------------------------------------------
| Counselor / Guru BK
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:counselor'])
    ->prefix('counselor')
    ->name('counselor.')
    ->group(function () {

        Route::get('/dashboard', [CounselorController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/exploration', [CounselorController::class, 'exploration'])
            ->name('exploration');

        Route::get('/consultation', [CounselorController::class, 'consultation'])
            ->name('consultation');

        // Hasil asesmen seluruh siswa terdaftar.
        Route::get('/assessment-results', [CounselorController::class, 'assessmentResults'])
            ->name('assessment-results.index');

        Route::get('/assessment-results/{student}', [CounselorController::class, 'assessmentResultDetail'])
            ->whereNumber('student')
            ->name('assessment-results.show');

        Route::put('/consultation/{consultation}', [CounselorController::class, 'updateConsultation'])
            ->name('consultation.update');

        Route::get('/profile', [CounselorController::class, 'profile'])
            ->name('profile');
    });
