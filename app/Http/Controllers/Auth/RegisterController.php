<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $role = 1;

        User::create([
            'name' => $request->name,
            'email' => $request->login,
            'role_id' => $role,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
