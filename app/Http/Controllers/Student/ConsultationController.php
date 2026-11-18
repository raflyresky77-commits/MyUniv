<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Student;
use App\Models\TeacherBk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        // Kunci data Guru BK selama proses pengecekan dan penyimpanan.
        // Ini membantu mencegah dua pengajuan masuk pada slot yang sama secara bersamaan.
        $isAvailable = DB::transaction(function () use ($validated, $student, $scheduledAt) {
            TeacherBk::query()
                ->whereKey($validated['teacher_id'])
                ->lockForUpdate()
                ->firstOrFail();

            // Slot dianggap terpakai jika masih menunggu atau sudah disetujui.
            $hasConflict = Consultation::query()
                ->where('teacher_id', $validated['teacher_id'])
                ->where('scheduled_at', $scheduledAt)
                ->whereIn('status', ['pending', 'approved'])
                ->exists();

            if ($hasConflict) {
                return false;
            }

            Consultation::create([
                'student_id' => $student->id,
                'teacher_id' => $validated['teacher_id'],
                'method' => $validated['consultation_method'],
                'topic' => $validated['topic'],
                'message' => $validated['message'] ?? null,
                'scheduled_at' => $scheduledAt,
                'status' => 'pending',
            ]);

            return true;
        });

        // Kembali ke form dengan notifikasi khusus jika slot sudah digunakan.
        if (! $isAvailable) {
            return redirect()
                ->route('student.consultation.index')
                ->withInput()
                ->with('schedule_conflict', 'Jadwal Guru BK tersebut sudah digunakan. Silakan pilih waktu lain.');
        }

        return redirect()
            ->route('student.consultation.index')
            ->with('success', 'Pengajuan konsultasi berhasil dikirim.');
    }

    /**
     * Membatalkan pengajuan yang masih menunggu persetujuan Guru BK.
     * Siswa hanya dapat membatalkan pengajuan miliknya sendiri.
     */
    public function destroy($id)
    {
        $student = Student::where('user_id', Auth::id())->first();

        if (! $student) {
            return redirect()
                ->route('student.consultation.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }

        $consultation = Consultation::query()
            ->where('id', $id)
            ->where('student_id', $student->id)
            ->where('status', 'pending')
            ->first();

        if (! $consultation) {
            return redirect()
                ->route('student.consultation.index')
                ->with('error', 'Pengajuan tidak ditemukan atau sudah diproses Guru BK sehingga tidak dapat dibatalkan.');
        }

        // Pengajuan yang masih menunggu dihapus agar slot jadwal dapat dipilih kembali.
        $consultation->delete();

        return redirect()
            ->route('student.consultation.index')
            ->with('success', 'Pengajuan konsultasi berhasil dibatalkan.')
            ->with('consultation_cancelled', true);
    }
}
