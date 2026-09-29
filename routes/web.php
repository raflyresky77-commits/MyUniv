<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.store');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

    /*
|--------------------------------------------------------------------------
| Student
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
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

