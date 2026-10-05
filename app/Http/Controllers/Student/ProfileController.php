<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Sesuaikan menjadi 'student.profile' karena filenya langsung di resources/views/student/profile.blade.php
        return view('student.profile', compact('user'));
    }
}
