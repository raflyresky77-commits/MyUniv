<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Memproses login pengguna.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => [
                'required',
                'string',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
            ],
        ], [
            'login.required' => 'Email atau username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $authCredentials = [
            $field => $credentials['login'],
            'password' => $credentials['password'],
        ];

        if (!Auth::attempt($authCredentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('login'))
                ->withErrors([
                    'login' => 'Email/username atau password tidak sesuai.',
                ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'counselor' => redirect()->route('counselor.dashboard'),
            'student' => redirect()->route('dashboard'),
            default => redirect()->route('dashboard'),
        };
    }

    /**
     * Logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
