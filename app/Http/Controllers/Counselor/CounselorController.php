<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use App\Models\ConsultationResponse;
use App\Models\Consultation;
use App\Models\TeacherBk;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CounselorController extends Controller
{
    // Mengambil profil Guru BK yang sedang login.
    private function getTeacher()
    {
        return TeacherBk::where('user_id', Auth::id())->first();
    }

    public function dashboard()
    {
        $teacher = $this->getTeacher();

        $consultations = Consultation::query()
            ->when(
                $teacher,
                fn ($query) => $query->where('teacher_id', $teacher->id),
                fn ($query) => $query->whereRaw('1 = 0')
            );

        // Menghitung statistik konsultasi berdasarkan data database.
        $stats = [
            'today_count' => (clone $consultations)
                ->whereDate('scheduled_at', today())
                ->count(),

            'active_count' => (clone $consultations)
                ->whereIn('status', ['pending', 'approved'])
                ->count(),
        ];

        $nearestConsultations = (clone $consultations)
            ->with(['student.user'])
            ->whereIn('status', ['pending', 'approved'])
            ->whereNotNull('scheduled_at')
            ->orderBy('scheduled_at')
            ->take(5)
            ->get();

        return view('counselor.dashboard', compact(
            'stats',
            'nearestConsultations'
        ));
    }

    public function exploration()
    {
        // Data eksplorasi menggunakan sumber dan relasi yang sama dengan halaman Student.
        $universities = University::with('majors')->get();

        return view('counselor.exploration', compact('universities'));
    }


    public function consultation()
    {
        $teacher = $this->getTeacher();

        // Mengambil konsultasi yang ditangani Guru BK.
        $query = Consultation::with([
            'student.user',
            'teacher.user',
            'responses'
        ])
            ->when(
                $teacher,
                fn ($query) => $query->where('teacher_id', $teacher->id),
                fn ($query) => $query->whereRaw('1 = 0')
            );

        $consultations = (clone $query)
            ->latest()
            ->get();

        $stats = [
            'pending' => (clone $query)->where('status', 'pending')->count(),
            'active' => (clone $query)->where('status', 'approved')->count(),
            'completed' => (clone $query)
                ->where('status', 'completed')
                ->whereMonth('updated_at', now()->month)
                ->whereYear('updated_at', now()->year)
                ->count(),
        ];

        return view('counselor.consultation', compact(
            'consultations',
            'stats'
        ));
    }


    public function updateConsultation(
        Request $request,
        Consultation $consultation
    ) {
        $teacher = $this->getTeacher();

        if (!$teacher) {
            abort(403, 'Profil Guru BK tidak ditemukan.');
        }

        // Memastikan konsultasi memang ditangani Guru BK yang login.
        $consultation = Consultation::where('teacher_id', $teacher->id)
            ->findOrFail($consultation->id);

        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,approved,rejected,completed'
            ],
            'response' => [
                'nullable',
                'string',
                'max:3000'
            ],
        ], [
            'status.required' => 'Status konsultasi wajib dipilih.',
            'status.in' => 'Status konsultasi tidak valid.',
            'response.max' => 'Catatan maksimal 3000 karakter.',
        ]);

        // Simpan status dan tanggapan Guru BK.
        \Illuminate\Support\Facades\DB::transaction(function () use (
            $consultation,
            $teacher,
            $validated
        ) {
            $consultation->update([
                'status' => $validated['status'],
            ]);

            if (!empty(trim($validated['response'] ?? ''))) {
                ConsultationResponse::create([
                    'consultation_id' => $consultation->id,
                    'teacher_id' => $teacher->id,
                    'responses' => $validated['response'],
                ]);
            }
        });

        return redirect()
            ->route('counselor.consultation')
            ->with('success', 'Konsultasi berhasil diperbarui.');
    }


    public function profile()
    {
        $user = Auth::user();
        $teacher = $this->getTeacher();

        return view('counselor.profile', compact(
            'user',
            'teacher'
        ));
    }
}
