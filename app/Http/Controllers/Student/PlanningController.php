<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanningController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Dummy data rencana pendidikan ala Notion
        $plans = [
            [
                'id' => 1,
                'title' => 'Persiapan SNBP 2027',
                'description' => 'Fokus persiapan jalur prestasi rapor dan portofolio untuk universitas impian.',
                'progress' => 75,
                'tasks' => [
                    ['name' => 'Riset jurusan & Universitas', 'date' => '10 Sep 2026', 'status' => 'Selesai'],
                    ['name' => 'Tingkatkan nilai raport', 'date' => '30 Nov 2026', 'status' => 'Dalam Proses'],
                    ['name' => 'Latihan soal TKA', 'date' => '31 Jan 2027', 'status' => 'Dalam Proses'],
                    ['name' => 'Persiapkan portofolio', 'date' => '28 Feb 2027', 'status' => 'Belum mulai'],
                ]
            ],
            [
                'id' => 2,
                'title' => 'Persiapan UTBK-SNBT 2027',
                'description' => 'Strategi alternatif melalui tes tulis berbasis komputer.',
                'progress' => 25,
                'tasks' => [
                    ['name' => 'Petakan materi TPS & Literasi', 'date' => '15 Des 2026', 'status' => 'Selesai'],
                    ['name' => 'Tryout rutin bulanan', 'date' => '30 Apr 2027', 'status' => 'Belum mulai'],
                ]
            ]
        ];

        return view('student.planning.index', compact('user', 'plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        // Redirect kembali dengan pesan sukses setelah form dikirim via POST
        return redirect()->route('student.planning.index')->with('success', 'Rencana pendidikan baru berhasil ditambahkan!');
    }
}
