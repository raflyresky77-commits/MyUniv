<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\University;
use App\Models\Major;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $assessmentsCount = Assessment::count();
        $universitiesCount = University::count();
        $majorsCount = Major::count();
        $usersCount = User::count();

        return view('admin.dashboard', compact(
            'assessmentsCount',
            'universitiesCount',
            'majorsCount',
            'usersCount'
        ));
    }
}
