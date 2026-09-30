<?php

use Illuminate\Support\Facades\Auth;

public function store(LoginRequest $request)
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = Auth::user();

    // Redirect berdasarkan role user
    if ($user->role === 'admin') {
        return redirect()->intended('/admin/dashboard'); // Sesuaikan dengan route admin Anda
    } elseif ($user->role === 'bk') {
        return redirect()->intended('/bk/dashboard');     // Sesuaikan dengan route BK Anda
    }

    // Default untuk siswa
    return redirect()->intended('/dashboard');
}
