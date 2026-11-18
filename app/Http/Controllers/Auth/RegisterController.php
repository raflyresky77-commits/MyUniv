<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Menampilkan halaman pendaftaran akun.
    public function create()
    {
        return view('auth.register');
    }

    // Memproses pendaftaran akun siswa baru.
    public function store(Request $request)
    {
        // Validasi seluruh input sebelum data disimpan.
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            // Email harus valid dan belum pernah digunakan.
            'login' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            // Password minimal 8 karakter dan harus sesuai konfirmasi.
            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],
        ], [
            // Pesan khusus untuk setiap kesalahan validasi email.
            'login.required' => 'Email wajib diisi.',
            'login.email' => 'Format email tidak valid.',
            'login.max' => 'Email maksimal 255 karakter.',
            'login.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',

            // Pesan validasi nama dan password.
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
        ]);

        // Membuat akun baru dengan role_id 1 sebagai siswa.
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['login'],
            'role_id' => 1,
            'password' => Hash::make($validated['password']),
        ]);

        // Membuat data awal siswa yang terhubung dengan akun.
        Student::create([
            'user_id' => $user->id,
        ]);

        // Otomatis login setelah pendaftaran berhasil.
        Auth::login($user);

        // Mengarahkan siswa ke halaman onboarding.
        return redirect()->route('student.onboarding.index')
            ->with(
                'success',
                'Akun berhasil dibuat! Silakan lengkapi data dirimu.'
            );
    }
}
