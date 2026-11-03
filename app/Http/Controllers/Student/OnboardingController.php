<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OnboardingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = Student::firstOrNew(['user_id' => $user->id]);

        if ($this->profileIsComplete($student)) {
            return redirect()->route('student.dashboard');
        }

        return view('student.onboarding.index', compact('user', 'student'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'birth_date' => ['required', 'date', 'before_or_equal:today'],
            'address' => ['required', 'string', 'max:150'],
            'phone' => ['required', 'string', 'max:20'],
            'nisn' => [
                'required',
                'digits:10',
                Rule::unique('students', 'nisn')->ignore($student?->id),
            ],
            'class' => ['required', 'string', 'max:50'],
        ], [
            'nisn.digits' => 'NISN harus terdiri dari 10 angka.',
            'address.required' => 'Kota atau daerah domisili wajib diisi.',
            'class.required' => 'Kelas wajib diisi. Contoh: XII RPL-2.',
        ]);

        DB::transaction(function () use ($user, $validated) {
            $user->update([
                'name' => $validated['name'],
            ]);

            Student::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nisn' => $validated['nisn'],
                    'gender' => $validated['gender'],
                    'birth_date' => $validated['birth_date'],
                    'address' => $validated['address'],
                    'phone' => $validated['phone'],
                    'class' => $validated['class'],
                ]
            );
        });

        return redirect()
            ->route('student.dashboard')
            ->with('success', 'Data diri berhasil disimpan. Selamat datang di MyUniv!');
    }

    private function profileIsComplete(?Student $student): bool
    {
        if (!$student) {
            return false;
        }

        return filled($student->nisn)
            && filled($student->gender)
            && filled($student->birth_date)
            && filled($student->address)
            && filled($student->phone)
            && filled($student->class);
    }
}
