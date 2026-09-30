<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama / Landing Page
Route::get('/', function () {
    return view('landing'); // Pastikan file view-nyaresources/views/landing.blade.php
});

// Route Register
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Route Login (sesuaikan dengan controller login kamu nanti)
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Student
|--------------------------------------------------------------------------
*/

// Route khusus Siswa (Authenticated & Role Siswa)
Route::middleware(['auth', 'role:siswa'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [dashboard::class, 'index'])->name('dashboard');
});

// Atau jika menggunakan alias /dashboard langsung sesuai permintaan output:
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/dashboard', [dashboard::class, 'index'])->name('student.dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Counselor / Guru BK
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('counselor')->name('counselor.')->group(function () {
    Route::get('/dashboard', function () {
        return view('counselor.dashboard');
    })->name('dashboard');
});

