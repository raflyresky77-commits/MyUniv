<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExplorationController extends Controller
{
    public function index()
    {
        return view('student.explore.index');
    }
}
