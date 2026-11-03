<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UniversityTemplateExport;

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

    /**
     * Download template import universitas.
     */
    public function downloadImportTemplate()
    {
        return Excel::download(new UniversityTemplateExport(), 'template-universitas-myuniv.xlsx');
    }

    /**
     * Membaca Excel, memvalidasi, lalu menampilkan preview tanpa menyimpan data.
     */
    public function previewImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        $sheets = Excel::toArray([], $request->file('file'));
        $sheet = $sheets[0] ?? [];

        if (count($sheet) < 2) {
            return back()->withErrors(['file' => 'File tidak memiliki baris data.']);
        }

        $headers = array_map(fn ($value) => strtolower(trim((string) $value)), $sheet[0]);
        $required = ['name', 'type'];
        $missing = array_diff($required, $headers);

        if ($missing) {
            return back()->withErrors(['file' => 'Kolom wajib tidak ditemukan: ' . implode(', ', $missing)]);
        }

        $rows = [];
        $errors = [];
        $seen = [];

        foreach (array_slice($sheet, 1) as $index => $values) {
            $values = array_pad($values, count($headers), null);
            $row = array_combine($headers, array_slice($values, 0, count($headers)));
            $rowNumber = $index + 2;

            if (!array_filter($row, fn ($v) => trim((string) $v) !== '')) {
                continue;
            }

            $name = trim((string) ($row['name'] ?? ''));
            $type = strtoupper(trim((string) ($row['type'] ?? '')));
            $row['name'] = $name;
            $row['type'] = $type;

            if ($name === '') $errors[] = "Baris {$rowNumber}: nama universitas wajib diisi.";
            if (!in_array($type, ['PTN', 'PTS'], true)) $errors[] = "Baris {$rowNumber}: type harus PTN atau PTS.";

            $key = mb_strtolower($name);
            if ($key !== '' && isset($seen[$key])) $errors[] = "Baris {$rowNumber}: nama universitas duplikat di dalam file.";
            $seen[$key] = true;

            $website = trim((string) ($row['website'] ?? ''));
            if ($website !== '' && !filter_var($website, FILTER_VALIDATE_URL)) {
                $errors[] = "Baris {$rowNumber}: website bukan URL yang valid.";
            }

            $ranking = trim((string) ($row['ranking'] ?? ''));
            $rankUrl = trim((string) ($row['ranking_url'] ?? ''));
            if ($ranking !== '' && (!ctype_digit($ranking) || (int) $ranking < 1)) {
                $errors[] = "Baris {$rowNumber}: ranking harus berupa bilangan bulat positif.";
            }

            if ($ranking !== '') {
                foreach (['ranking_source', 'ranking_year', 'ranking_category', 'ranking_url'] as $field) {
                    if (trim((string) ($row[$field] ?? '')) === '') {
                        $errors[] = "Baris {$rowNumber}: {$field} wajib diisi jika ranking diisi.";
                    }
                }
                if (!in_array(strtoupper(trim((string) ($row['ranking_source'] ?? ''))), ['QS', 'THE', 'WEBOMETRICS'], true)) {
                    $errors[] = "Baris {$rowNumber}: ranking_source harus QS, THE, atau WEBOMETRICS.";
                }
                $year = trim((string) ($row['ranking_year'] ?? ''));
                if ($year !== '' && (!ctype_digit($year) || (int) $year < 2000 || (int) $year > ((int) date('Y') + 1))) {
                    $errors[] = "Baris {$rowNumber}: ranking_year tidak valid.";
                }
                if ($rankUrl !== '' && !filter_var($rankUrl, FILTER_VALIDATE_URL)) {
                    $errors[] = "Baris {$rowNumber}: ranking_url harus berupa URL valid.";
                }
            }

            $rows[] = [
                'row_number' => $rowNumber,
                'data' => [
                    'name' => $name,
                    'type' => $type,
                    'location' => trim((string) ($row['location'] ?? '')),
                    'website' => $website,
                    'description' => trim((string) ($row['description'] ?? '')),
                    'ranking' => $ranking === '' ? null : (int) $ranking,
                    'ranking_source' => strtoupper(trim((string) ($row['ranking_source'] ?? ''))) ?: null,
                    'ranking_year' => trim((string) ($row['ranking_year'] ?? '')) === '' ? null : (int) $row['ranking_year'],
                    'ranking_category' => trim((string) ($row['ranking_category'] ?? '')) ?: null,
                    'ranking_url' => $rankUrl ?: null,
                    'accreditation' => trim((string) ($row['accreditation'] ?? '')) ?: null,
                    'branch_notes' => trim((string) ($row['branch_notes'] ?? '')) ?: null,
                ],
            ];
        }

        if (!$rows) $errors[] = 'Tidak ada baris data yang dapat diproses.';

        session(['university_import_preview' => $rows, 'university_import_errors' => $errors]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => empty($errors),
                'total_rows' => count($rows),
                'valid_rows' => count($rows) - count(array_filter($errors)),
                'errors' => $errors,
                'rows' => $rows,
            ], empty($errors) ? 200 : 422);
        }

        return view('admin.imports.universities-preview', compact('rows', 'errors'));
    }

    /**
     * Simpan data dari preview. Nama universitas yang sudah ada akan diperbarui
     * hanya pada kolom yang diisi di Excel.
     */
    public function confirmImport()
    {
        $rows = session('university_import_preview');
        if (!$rows) {
            if (request()->expectsJson()) return response()->json(['message' => 'Preview import sudah kedaluwarsa. Silakan upload ulang.'], 422);
            return redirect()->route('admin.universities.index')->withErrors(['file' => 'Preview import sudah kedaluwarsa. Silakan upload ulang.']);
        }

        $errors = session('university_import_errors', []);
        if (!empty($errors)) {
            if (request()->expectsJson()) return response()->json(['message' => 'Preview memiliki kesalahan. Perbaiki file lalu upload kembali.', 'errors' => $errors], 422);
            return back()->withErrors(['file' => 'Preview memiliki kesalahan. Perbaiki file lalu upload kembali.']);
        }

        $created = 0;
        $updated = 0;

        DB::transaction(function () use ($rows, &$created, &$updated) {
            foreach ($rows as $item) {
                $data = array_filter($item['data'], fn ($value) => $value !== null && $value !== '');
                $university = University::whereRaw('LOWER(name) = ?', [mb_strtolower($item['data']['name'])])->first();

                if ($university) {
                    $university->fill($data)->save();
                    $updated++;
                } else {
                    University::create($data);
                    $created++;
                }
            }
        });

        session()->forget(['university_import_preview', 'university_import_errors']);
        $message = "Import universitas selesai: {$created} ditambahkan, {$updated} diperbarui.";
        if (request()->expectsJson()) return response()->json(['success' => true, 'message' => $message, 'created' => $created, 'updated' => $updated]);
        return redirect()->route('admin.universities.index')->with('success', $message);
    }

}
