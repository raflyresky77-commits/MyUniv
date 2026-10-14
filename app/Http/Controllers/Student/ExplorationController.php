<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 1. Tambahkan import Auth facade

class ExplorationController extends Controller
{
    public function index()
    {
        // Mengambil data universitas beserta relasi majors dari Supabase
        $universities = University::with('majors')->get();

        // 2. Gunakan Auth::user() untuk menghindari error linter IDE
        $user = Auth::user();

        return view('student.explore.index', compact('universities', 'user'));
    }
}
