<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation; // Pastikan Model Consultation di-import

class ConsultationController extends Controller
{
    public function index()
    {
        // Menampilkan halaman konsultasi beserta daftar jadwal
        $consultations = Consultation::where('user_id', auth()->id())->get();
        return view('student.consultation.index', compact('consultations'));
    }

    // TAMBAHKAN FUNGSI INI UNTUK MENYIMPAN JADWAL BARU
    public function store(Request $request)
    {
        // 1. Validasi input dari form modal/halaman Anda
        $request->validate([
            'topic' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'message' => 'required|string',
        ]);

        // 2. Simpan data ke database
        Consultation::create([
            'user_id' => auth()->id(), // ID siswa yang sedang login
            'topic' => $request->topic,
            'date' => $request->date,
            'time' => $request->time,
            'message' => $request->message,
            'status' => 'pending', // Status awal pengajuan
        ]);

        // 3. Kembalikan ke halaman index dengan pesan sukses
        return redirect()->route('student.consultation.index')->with('success', 'Jadwal konsultasi berhasil diajukan!');
    }
}
