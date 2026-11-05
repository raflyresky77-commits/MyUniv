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
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'login'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // 1. Buat User baru (role_id = 1 untuk Student)
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['login'],
            'role_id'  => 1,
            'password' => Hash::make($validated['password']),
        ]);

        // 2. Inisialisasi record Student awal agar tidak null
        Student::create([
            'user_id' => $user->id,
        ]);

        // 3. Otomatis login akun yang baru terdaftar
        Auth::login($user);

        // 4. Langsung arahkan ke alur Onboarding untuk melengkapi profil
        return redirect()->route('student.onboarding.index')
            ->with('success', 'Akun berhasil dibuat! Silakan lengkapi data dirimu.');
    }
}
