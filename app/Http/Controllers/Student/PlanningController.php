<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\EducationPlan;
use App\Models\Major;
use App\Models\PlanChecklist;
use App\Models\Student;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanningController extends Controller
{
    /**
     * Mengambil data siswa yang sedang login.
     */
    private function getStudent()
    {
        return Student::where('user_id', Auth::id())->firstOrFail();
    }

    /**
     * Menampilkan halaman Education Planning.
     */
    public function index()
    {
        $user = Auth::user();
        $student = $this->getStudent();

        // Checklist default untuk setiap rencana pendidikan.
        $defaultTasks = [
            'Riset universitas dan jurusan',
            'Memeriksa persyaratan masuk',
            'Menyiapkan dokumen pendaftaran',
            'Mempelajari materi seleksi',
            'Melakukan evaluasi persiapan',
        ];

        // Mengisi checklist default untuk rencana lama yang belum memilikinya.
        $existingPlans = EducationPlan::where('student_id', $student->id)
            ->where(function ($query) {
                $query->whereNull('title')
                    ->orWhere('title', '!=', 'Target Pendidikan');
            })
            ->whereDoesntHave('checklists')
            ->get();

        foreach ($existingPlans as $plan) {
            $plan->checklists()->createMany(
                array_map(function ($title) {
                    return [
                        'title' => $title,
                        'is_completed' => false,
                    ];
                }, $defaultTasks)
            );
        }

        // Mengambil semua rencana beserta checklist.
        $plans = EducationPlan::with('checklists')
            ->where('student_id', $student->id)
            ->where(function ($query) {
                $query->whereNull('title')
                    ->orWhere('title', '!=', 'Target Pendidikan');
            })
            ->latest()
            ->get()
            ->map(function ($plan) {
                return [
                    'id' => $plan->id,
                    'title' => $plan->title,
                    'description' => $plan->description,

                    'tasks' => $plan->checklists->map(function ($task) {
                        return [
                            'id' => $task->id,
                            'name' => $task->title,

                            // Format untuk ditampilkan di halaman.
                            'date' => $task->deadline
                                ? $task->deadline->format('d M Y')
                                : '-',

                            // Format khusus untuk input type="date".
                            'deadline' => $task->deadline
                                ? $task->deadline->format('Y-m-d')
                                : '',

                            'status' => $task->is_completed
                                ? 'Selesai'
                                : 'Belum mulai',
                        ];
                    })->toArray(),
                ];
            });

        // Mengambil target pendidikan siswa.
        $targetPlan = EducationPlan::with([
            'targetUniversity',
            'targetMajor',
        ])
            ->where('student_id', $student->id)
            ->where(function ($query) {
                $query->whereNotNull('target_university_id')
                    ->orWhereNotNull('target_major_id');
            })
            ->latest()
            ->first();

        $target = (object) [
            'university' => $targetPlan?->targetUniversity?->name,
            'major' => $targetPlan?->targetMajor?->name,
            'admission_path' => $targetPlan?->admission_path,
            'career' => $targetPlan?->career,
        ];

        // Dataset universitas dan jurusan.
        $universities = University::orderBy('name')->get();

        // Ambil hanya jurusan yang benar-benar terhubung ke universitas
        // melalui tabel pivot university_majors di Supabase.
        $majors = Major::whereHas('universities')
            ->with('universities:id,name')
            ->orderBy('name')
            ->get();

        return view('student.planning.index', compact(
            'user',
            'student',
            'plans',
            'target',
            'targetPlan',
            'universities',
            'majors'
        ));
    }

    /**
     * Membuat rencana pendidikan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $student = $this->getStudent();

        $plan = EducationPlan::create([
            'student_id' => $student->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status' => 'pending',
        ]);

        // Checklist default untuk rencana baru.
        $plan->checklists()->createMany([
            ['title' => 'Riset universitas dan jurusan'],
            ['title' => 'Memeriksa persyaratan masuk'],
            ['title' => 'Menyiapkan dokumen pendaftaran'],
            ['title' => 'Mempelajari materi seleksi'],
            ['title' => 'Melakukan evaluasi persiapan'],
        ]);

        return redirect()
            ->route('student.planning.index')
            ->with('success', 'Rencana pendidikan berhasil ditambahkan!');
    }

    /**
     * Mengedit rencana pendidikan.
     */
    public function update(Request $request, EducationPlan $plan)
    {
        $student = $this->getStudent();

        abort_unless($plan->student_id === $student->id, 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $plan->update($validated);

        return redirect()
            ->route('student.planning.index')
            ->with('success', 'Rencana pendidikan berhasil diperbarui!');
    }

    /**
     * Menghapus rencana pendidikan.
     */
    public function destroy(EducationPlan $plan)
    {
        $student = $this->getStudent();

        abort_unless($plan->student_id === $student->id, 403);

        $plan->delete();

        return redirect()
            ->route('student.planning.index')
            ->with('success', 'Rencana pendidikan berhasil dihapus!');
    }

    /**
     * Menyimpan target universitas, jurusan, dan karier.
     */
    public function updateTarget(Request $request)
    {
        $student = $this->getStudent();

        $validated = $request->validate([
            'target_university_id' => [
                'required',
                'exists:universities,id',
            ],
            'target_major_id' => [
                'required',
                'exists:majors,id',
            ],
            'admission_path' => [
                'required',
                'string',
                'max:100',
            ],
            'career' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        // Memastikan jurusan tersedia di universitas pilihan.
        $majorBelongsToUniversity = Major::whereKey(
            $validated['target_major_id']
        )
            ->whereHas('universities', function ($query) use ($validated) {
                $query->where(
                    'universities.id',
                    $validated['target_university_id']
                );
            })
            ->exists();

        if (!$majorBelongsToUniversity) {
            return back()
                ->withErrors([
                    'target_major_id' =>
                        'Jurusan tidak tersedia di universitas yang dipilih.',
                ])
                ->withInput();
        }

        // Cari target pendidikan sebelumnya.
        $targetPlan = EducationPlan::where('student_id', $student->id)
            ->where(function ($query) {
                $query->whereNotNull('target_university_id')
                    ->orWhereNotNull('target_major_id');
            })
            ->latest()
            ->first();

        // Buat data target jika belum tersedia.
        if (!$targetPlan) {
            $targetPlan = new EducationPlan();

            $targetPlan->student_id = $student->id;
            $targetPlan->title = 'Target Pendidikan';
            $targetPlan->status = 'pending';
        }

        $targetPlan->fill($validated);
        $targetPlan->save();

        return redirect()
            ->route('student.planning.index')
            ->with('success', 'Target kuliah dan karier berhasil disimpan!');
    }

    /**
     * Memperbarui status checklist melalui AJAX.
     */
    public function updateChecklist(
        Request $request,
        PlanChecklist $checklist
    ) {
        $student = $this->getStudent();

        abort_unless(
            $checklist->plan->student_id === $student->id,
            403
        );

        $validated = $request->validate([
            'is_completed' => ['required', 'boolean'],
        ]);

        $checklist->update([
            'is_completed' => $validated['is_completed'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Checklist berhasil diperbarui.',
            'is_completed' => $checklist->is_completed,
        ]);
    }

    /**
     * Menambahkan task baru ke rencana pendidikan.
     */
    public function storeChecklist(Request $request, EducationPlan $plan)
    {
        $student = $this->getStudent();

        abort_unless($plan->student_id === $student->id, 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'deadline' => ['nullable', 'date'],
        ]);

        $plan->checklists()->create([
            'title' => $validated['title'],
            'deadline' => $validated['deadline'] ?? null,
            'is_completed' => false,
        ]);

        return redirect()
            ->route('student.planning.index')
            ->with('success', 'Task berhasil ditambahkan!');
    }

    /**
     * Mengedit nama dan deadline task.
     */
    public function updateChecklistDetails(
        Request $request,
        PlanChecklist $checklist
    ) {
        $student = $this->getStudent();

        abort_unless(
            $checklist->plan->student_id === $student->id,
            403
        );

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'deadline' => ['nullable', 'date'],
        ]);

        $checklist->update([
            'title' => $validated['title'],
            'deadline' => $validated['deadline'] ?? null,
        ]);

        return redirect()
            ->route('student.planning.index')
            ->with('success', 'Task berhasil diperbarui!');
    }

    /**
     * Menghapus task dari rencana pendidikan.
     */
    public function destroyChecklist(PlanChecklist $checklist)
    {
        $student = $this->getStudent();

        abort_unless(
            $checklist->plan->student_id === $student->id,
            403
        );

        $checklist->delete();

        return redirect()
            ->route('student.planning.index')
            ->with('success', 'Task berhasil dihapus!');
    }
}
