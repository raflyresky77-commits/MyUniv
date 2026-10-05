<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\AssessmentController as StudentAssessmentController;
use App\Http\Controllers\Student\ResultController;
use App\Http\Controllers\Student\ExplorationController;
use App\Http\Controllers\Student\PlanningController;
use App\Http\Controllers\Student\ConsultationController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\ArticleController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Admin\AssessmentController as AdminAssessmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MajorController;
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

// Route Register
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Route Login
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Student / Siswa
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:siswa'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

    // Asesmen Siswa
    Route::get('/assessment', [StudentAssessmentController::class, 'index'])->name('assessment.index');
    Route::get('/assessment/result', [StudentAssessmentController::class, 'result'])->name('assessment.result');

    // Tes Minat Bakat
    Route::get('/assessment/minat-bakat', [StudentAssessmentController::class, 'minatBakat'])->name('assessment.minat-bakat');
    Route::post('/assessment/minat-bakat', [StudentAssessmentController::class, 'minatBakatStore'])->name('assessment.minat-bakat.store');

    // Tes Kemampuan
    Route::get('/assessment/kemampuan', [StudentAssessmentController::class, 'kemampuan'])->name('assessment.kemampuan');
    Route::post('/assessment/kemampuan', [StudentAssessmentController::class, 'kemampuanStore'])->name('assessment.kemampuan.store');

    // Tes Kepribadian Karir
    Route::get('/assessment/kepribadian', [StudentAssessmentController::class, 'kepribadian'])->name('assessment.kepribadian');
    Route::post('/assessment/kepribadian', [StudentAssessmentController::class, 'kepribadianStore'])->name('assessment.kepribadian.store');

    // Halaman Hasil Asesmen
    Route::get('/result', [ResultController::class, 'index'])->name('result.index');

    // Eksplorasi & Jurusan
    Route::get('/exploration', [ExplorationController::class, 'index'])->name('exploration.index');
    Route::get('/majors/{id}', [ExplorationController::class, 'show'])->name('majors.show');

    // Education Planning
    Route::get('/planning', [PlanningController::class, 'index'])->name('planning.index');
    Route::post('/planning', [PlanningController::class, 'store'])->name('planning.store');

    // Konsultasi BK (SUDAH DIPERBAIKI)
    Route::get('/consultation', [ConsultationController::class, 'index'])->name('consultation.index');
    Route::post('/consultation', [ConsultationController::class, 'store'])->name('consultation.store');

    // Profil Siswa
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    // Artikel
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('assessments', AdminAssessmentController::class);
    Route::post('assessments/{assessment}/questions', [AdminAssessmentController::class, 'storeQuestion'])->name('questions.store');
    Route::get('assessments/{assessment}/questions', [AdminAssessmentController::class, 'questionsIndex'])->name('assessments.questions.index');
    Route::delete('assessments/questions/{question}', [AdminAssessmentController::class, 'questionsDestroy'])->name('assessments.questions.destroy');

    Route::resource('universities', UniversityController::class);
    Route::post('universities/{university}/majors', [UniversityController::class, 'storeMajor'])->name('universities.majors.store');
    Route::delete('universities/majors/{major}', [UniversityController::class, 'destroyMajor'])->name('majors.destroy.custom');

    Route::resource('majors', MajorController::class);
    Route::resource('users', UserController::class);
});

/*
|--------------------------------------------------------------------------
| Counselor / Guru BK
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:counselor'])->prefix('counselor')->name('counselor.')->group(function () {
    Route::get('/dashboard', [CounselorController::class, 'dashboard'])->name('dashboard');
    Route::get('/exploration', [CounselorController::class, 'exploration'])->name('exploration');
    Route::get('/consultation', [CounselorController::class, 'consultation'])->name('consultation');
    Route::get('/profile', [CounselorController::class, 'profile'])->name('profile');
});
