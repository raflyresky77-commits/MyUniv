<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Student;
use App\Models\TeacherBk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function index()
    {
        $student = Student::firstOrCreate(
            ['user_id' => Auth::id()],
            ['nisn' => null]
        );

        $consultations = Consultation::with([
            'teacher.user',
            'responses'
        ])
            ->where('student_id', $student->id)
            ->latest()
            ->get();

        // Siapkan tautan WhatsApp dari nomor Guru BK untuk setiap pengajuan.
        // Nomor dibersihkan agar sesuai format internasional yang dipakai wa.me.
        $studentName = Auth::user()->name ?? 'Siswa';

        foreach ($consultations as $consultation) {
            $teacherPhone = preg_replace('/\\D+/', '', (string) ($consultation->teacher?->phone ?? ''));

            if (str_starts_with($teacherPhone, '0')) {
                $teacherPhone = '62' . substr($teacherPhone, 1);
            } elseif (str_starts_with($teacherPhone, '8')) {
                $teacherPhone = '62' . $teacherPhone;
            }

            $message = "Assalamu'alaikum, Bapak/Ibu Guru BK. Saya {$studentName}. Saya sudah mengajukan konsultasi melalui MyUniv. Mohon konfirmasi lebih lanjut mengenai pengajuan saya. Terima kasih.";

            $consultation->setAttribute(
                'whatsapp_url',
                strlen($teacherPhone) >= 9
                    ? 'https://wa.me/' . $teacherPhone . '?text=' . rawurlencode($message)
                    : null
            );
        }

        $teachers = TeacherBk::with('user')
            ->whereHas('user')
            ->get();

        return view('student.consultation.index', compact(
            'consultations',
            'teachers'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => [
                'required',
                'exists:teacher_bk,id'
            ],
            'consultation_method' => [
                'required',
                'in:online,offline'
            ],
            'consultation_date' => [
                'required',
                'date',
                'after_or_equal:today'
            ],
            'consultation_time' => [
                'required',
                'date_format:H:i'
            ],
            'topic' => [
                'required',
                'string',
                'max:255'
            ],
            'message' => [
                'nullable',
                'string',
                'max:3000'
            ],
        ], [
            'teacher_id.required' => 'Silakan pilih Guru BK.',
            'teacher_id.exists' => 'Guru BK yang dipilih tidak ditemukan.',
            'consultation_method.required' => 'Metode konsultasi wajib dipilih.',
            'consultation_method.in' => 'Metode konsultasi tidak valid.',
            'consultation_date.required' => 'Tanggal konsultasi wajib diisi.',
            'consultation_date.after_or_equal' => 'Tanggal konsultasi tidak boleh sebelum hari ini.',
            'consultation_time.required' => 'Waktu konsultasi wajib diisi.',
            'consultation_time.date_format' => 'Format waktu konsultasi tidak valid.',
            'topic.required' => 'Topik konsultasi wajib diisi.',
            'topic.max' => 'Topik konsultasi maksimal 255 karakter.',
            'message.max' => 'Pesan konsultasi maksimal 3000 karakter.',
        ]);

        $student = Student::firstOrCreate(
            ['user_id' => Auth::id()],
            ['nisn' => null]
        );

        $scheduledAt = Carbon::createFromFormat(
            'Y-m-d H:i',
            $validated['consultation_date'] . ' ' . $validated['consultation_time']
        );

        Consultation::create([
            'student_id' => $student->id,
            'teacher_id' => $validated['teacher_id'],
            'method' => $validated['consultation_method'],
            'topic' => $validated['topic'],
            'message' => $validated['message'] ?? null,
            'scheduled_at' => $scheduledAt,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('student.consultation.index')
            ->with('success', 'Pengajuan konsultasi berhasil dikirim.');
    }
}
