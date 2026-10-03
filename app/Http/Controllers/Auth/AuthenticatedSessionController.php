<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // Paksa arahkan berdasarkan role_id database Supabase tanpa peduli intended URL
        if ($user?->role_id == 3) {
            return redirect()->route('admin.dashboard');
        }

        if ($user?->role_id == 2) {
            return redirect()->route('counselor.dashboard');
        }

        // Default untuk siswa (role_id == 1)
        return redirect()->route('student.dashboard');
    }
}
