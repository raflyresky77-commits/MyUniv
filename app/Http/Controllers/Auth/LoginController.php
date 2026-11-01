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
        // Validasi input login
        $credentials = $request->validate([
            'login' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Proses autentikasi pengguna
        if (!Auth::attempt([
            'email' => $credentials['login'],
            'password' => $credentials['password'],
        ])) {
            return back()->withErrors([
                'login' => 'Email atau password yang Anda masukkan salah.',
            ])->onlyInput('login');
        }

        // Regenerasi session setelah login berhasil
        $request->session()->regenerate();

        // Ambil role ID pengguna
        $roleId = (int) Auth::user()->role_id;

        // Tentukan halaman dashboard berdasarkan role
        switch ($roleId) {
            case 1:
                return redirect()->route('student.dashboard');

            case 2:
                return redirect()->route('counselor.dashboard');

            case 3:
                return redirect()->route('admin.dashboard');

            default:
                // Logout jika role tidak dikenali
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login')->withErrors([
                    'login' => 'Role akun tidak valid. Silakan hubungi administrator.',
                ]);
        }
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
