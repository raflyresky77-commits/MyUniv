<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Support\Facades\Auth;

class CounselorController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'today_count' => 3,
            'active_count' => 4,
        ];

        return view('counselor.dashboard', compact('stats'));
    }

    public function exploration()
    {
        // Gunakan data universitas dan relasi jurusan yang sama dengan Explore siswa.
        $universities = University::with('majors')->get();
        $user = Auth::user();

        return view('counselor.exploration', compact('universities', 'user'));
    }

    public function consultation()
    {
        return view('counselor.consultation');
    }

    public function profile()
    {
        return view('counselor.profile');
    }
}
