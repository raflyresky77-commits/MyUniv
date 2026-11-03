<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt([
            'email' => $credentials['login'],
            'password' => $credentials['password'],
        ])) {
            return back()->withErrors([
                'login' => 'Email atau password yang Anda masukkan salah.',
            ])->onlyInput('login');
        }

        $request->session()->regenerate();

        $user = Auth::user();
        $roleId = (int) $user->role_id;

        switch ($roleId) {
            case 1:
                $student = Student::where('user_id', $user->id)->first();

                if (!$this->profileIsComplete($student)) {
                    return redirect()->route('student.onboarding.index');
                }

                return redirect()->route('student.dashboard');

            case 2:
                return redirect()->route('counselor.dashboard');

            case 3:
                return redirect()->route('admin.dashboard');

            default:
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login')->withErrors([
                    'login' => 'Role akun tidak valid. Silakan hubungi administrator.',
                ]);
        }
    }

    private function profileIsComplete(?Student $student): bool
    {
        if (!$student) {
            return false;
        }

        return filled($student->nisn)
            && filled($student->gender)
            && filled($student->birth_date)
            && filled($student->address)
            && filled($student->phone)
            && filled($student->class);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
