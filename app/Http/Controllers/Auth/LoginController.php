<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function create()
    {
        return view('auth.login');
    }

    // Memproses data login
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'email' => $credentials['login'],
            'password' => $credentials['password'],
        ])) {
            $request->session()->regenerate();

            if (Auth::user()->role_id == 3) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('student.dashboard');
        }

        return back()->withErrors([
            'login' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('login');
    }

    // Logout session
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
