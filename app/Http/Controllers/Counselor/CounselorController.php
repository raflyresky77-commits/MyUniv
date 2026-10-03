<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        // Tampilkan view eksplorasi atau arahkan sesuai kebutuhan
        return view('counselor.exploration');
    }

    public function consultation()
    {
        // Tampilkan view konsultasi BK
        return view('counselor.consultation');
    }

    public function profile()
    {
        // Tampilkan view profil Guru BK
        return view('counselor.profile');
    }
}
