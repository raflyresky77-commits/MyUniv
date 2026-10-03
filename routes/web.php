<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Admin\AssessmentController;
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
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Utama Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Bank Soal Asesmen
    Route::resource('assessments', AssessmentController::class);

    // Sub-route untuk mengelola pertanyaan dalam suatu asesmen
    Route::post('assessments/{assessment}/questions', [AssessmentController::class, 'storeQuestion'])->name('questions.store');
    Route::get('assessments/{assessment}/questions', [AssessmentController::class, 'questionsIndex'])->name('assessments.questions.index');
    Route::delete('assessments/questions/{question}', [AssessmentController::class, 'questionsDestroy'])->name('assessments.questions.destroy');

    // CRUD Universitas & Sub-Route Jurusan
    Route::resource('universities', UniversityController::class);
    Route::post('universities/{university}/majors', [UniversityController::class, 'storeMajor'])->name('universities.majors.store');
    Route::delete('universities/majors/{major}', [UniversityController::class, 'destroyMajor'])->name('majors.destroy.custom');

    // CRUD Program Studi / Jurusan
    Route::resource('majors', MajorController::class);

    // CRUD Manajemen Pengguna (Users)
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
