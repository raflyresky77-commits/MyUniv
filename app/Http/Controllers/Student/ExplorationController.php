<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Support\Facades\Auth;

class ExplorationController extends Controller
{
    public function index()
    {
        $universities = University::with('majors')->get();

        $user = Auth::user();

        return view('student.explore.index', compact('universities', 'user'));
    }
}
