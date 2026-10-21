<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UniversityController extends Controller
{
    /**
     * Menampilkan daftar perguruan tinggi dan program studi.
     */
    public function index()
    {
        $universities = University::with('majors')
            ->latest()
            ->get();

        $majors = Major::orderBy('name')->get();

        return view(
            'admin.universities.index',
            compact('universities', 'majors')
        );
    }

    /**
     * Menyimpan perguruan tinggi baru.
     */
    public function store(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'nullable|string|max:255',
        'type' => 'required|in:PTN,PTS',
        'website' => 'nullable|url|max:255',
        'description' => 'nullable|string',
        'ranking' => 'nullable|integer|min:1',
        'accreditation' => 'nullable|string|max:255',
        'branch_notes' => 'nullable|string',
    ]);

        University::create($validated);

        return redirect()
            ->route('admin.universities.index')
            ->with('success', 'Perguruan tinggi berhasil ditambahkan.');
    }

    /**
     * Memperbarui data perguruan tinggi.
     */
    public function update(Request $request, University $university)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:PTN,PTS',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'ranking' => 'nullable|integer|min:1',
            'accreditation' => 'nullable|string|max:255',
            'branch_notes' => 'nullable|string',
        ]);

        $university->update($validated);

        return redirect()
            ->route('admin.universities.index')
            ->with('success', 'Data perguruan tinggi berhasil diperbarui.');
    }

    /**
     * Menghapus perguruan tinggi tanpa menghapus data jurusannya.
     */
    public function destroy(University $university)
    {
        DB::transaction(function () use ($university) {
            // Hapus hubungan pada tabel pivot saja.
            $university->majors()->detach();

            // Hapus data perguruan tinggi.
            $university->delete();
        });

        return redirect()
            ->route('admin.universities.index')
            ->with('success', 'Perguruan tinggi berhasil dihapus.');
    }

    /**
     * Menghubungkan program studi yang sudah ada
     * ke perguruan tinggi.
     */
    public function storeMajor(Request $request, University $university)
    {
        $validated = $request->validate([
            'major_id' => 'required|integer|exists:majors,id',
            'accreditation' => 'nullable|string|max:50',
            'additional_info' => 'nullable|string',
        ]);

        $majorId = (int) $validated['major_id'];

        $alreadyExists = $university->majors()
            ->where('majors.id', $majorId)
            ->exists();

        if ($alreadyExists) {
            return back()
                ->withErrors([
                    'major_id' => 'Program studi ini sudah terhubung dengan universitas tersebut.',
                ])
                ->withInput();
        }

        $university->majors()->attach($majorId, [
            'accreditation' => $validated['accreditation'] ?? null,
            'additional_info' => $validated['additional_info'] ?? null,
        ]);

        return back()->with(
            'success',
            'Program studi berhasil ditambahkan ke perguruan tinggi.'
        );
    }

    /**
     * Melepas hubungan program studi dari perguruan tinggi.
     * Data program studi tetap tersimpan.
     */
    public function destroyMajor($universityId, $majorId)
    {
        $university = University::findOrFail($universityId);

        $detached = $university->majors()->detach($majorId);

        if ($detached === 0) {
            return back()->withErrors([
                'major' => 'Relasi program studi tidak ditemukan.',
            ]);
        }

        return back()->with(
            'success',
            'Program studi berhasil dilepas dari perguruan tinggi ini.'
        );
    }
}
