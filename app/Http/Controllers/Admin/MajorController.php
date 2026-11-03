<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MajorTemplateExport;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::latest()->get();
        return view('admin.majors.index', compact('majors'));
    }

    public function create()
    {
        $universities = University::all();
        return view('admin.majors.create', compact('universities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
        ]);

        Major::create($request->all());

        return redirect()->route('admin.majors.index')->with('success', 'Program studi baru berhasil ditambahkan!');
    }

    public function edit(Major $major)
    {
        $universities = University::all();
        return view('admin.majors.edit', compact('major', 'universities'));
    }

    public function update(Request $request, Major $major)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
        ]);

        $major->update($request->all());

        return redirect()->route('admin.majors.index')->with('success', 'Program studi berhasil diperbarui!');
    }

    public function destroy(Major $major)
    {
        $major->delete();

        return back()->with('success', 'Program studi berhasil dihapus.');
    }

    /**
     * Download template import program studi.
     */
    public function downloadImportTemplate()
    {
        return Excel::download(new MajorTemplateExport(), 'template-prodi-myuniv.xlsx');
    }

    /**
     * Preview import prodi. Prodi yang sudah ada akan digunakan kembali,
     * lalu dibuatkan relasi ke universitas yang dipilih.
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
        $required = ['name', 'university_name'];
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

            if (!array_filter($row, fn ($v) => trim((string) $v) !== '')) continue;

            $name = trim((string) ($row['name'] ?? ''));
            $universityName = trim((string) ($row['university_name'] ?? ''));
            if ($name === '') $errors[] = "Baris {$rowNumber}: nama prodi wajib diisi.";
            if ($universityName === '') $errors[] = "Baris {$rowNumber}: university_name wajib diisi.";

            $university = $universityName !== ''
                ? University::whereRaw('LOWER(name) = ?', [mb_strtolower($universityName)])->first()
                : null;
            if ($universityName !== '' && !$university) {
                $errors[] = "Baris {$rowNumber}: universitas '{$universityName}' tidak ditemukan. Tambahkan/import universitas lebih dahulu.";
            }

            $categoryId = trim((string) ($row['category_id'] ?? ''));
            if ($categoryId !== '' && !DB::table('interest_categories')->where('id', $categoryId)->exists()) {
                $errors[] = "Baris {$rowNumber}: category_id {$categoryId} tidak ditemukan pada interest_categories.";
            }

            $key = mb_strtolower($name . '|' . $universityName);
            if ($name !== '' && $universityName !== '' && isset($seen[$key])) {
                $errors[] = "Baris {$rowNumber}: kombinasi prodi dan universitas duplikat di dalam file.";
            }
            $seen[$key] = true;

            $rows[] = [
                'row_number' => $rowNumber,
                'university_id' => $university?->id,
                'data' => [
                    'name' => $name,
                    'description' => trim((string) ($row['description'] ?? '')) ?: null,
                    'category_id' => $categoryId === '' ? null : (int) $categoryId,
                    'university_name' => $universityName,
                    'accreditation' => trim((string) ($row['accreditation'] ?? '')) ?: null,
                    'additional_info' => trim((string) ($row['additional_info'] ?? '')) ?: null,
                ],
            ];
        }

        if (!$rows) $errors[] = 'Tidak ada baris data yang dapat diproses.';

        session(['major_import_preview' => $rows, 'major_import_errors' => $errors]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => empty($errors),
                'total_rows' => count($rows),
                'valid_rows' => count($rows) - count(array_filter($errors)),
                'errors' => $errors,
                'rows' => $rows,
            ], empty($errors) ? 200 : 422);
        }

        return view('admin.imports.majors-preview', compact('rows', 'errors'));
    }

    /**
     * Simpan prodi dan relasi pivot secara atomik.
     */
    public function confirmImport()
    {
        $rows = session('major_import_preview');
        if (!$rows) {
            if (request()->expectsJson()) return response()->json(['message' => 'Preview import sudah kedaluwarsa. Silakan upload ulang.'], 422);
            return redirect()->route('admin.majors.index')->withErrors(['file' => 'Preview import sudah kedaluwarsa. Silakan upload ulang.']);
        }

        $errors = session('major_import_errors', []);
        if (!empty($errors)) {
            if (request()->expectsJson()) return response()->json(['message' => 'Preview memiliki kesalahan. Perbaiki file lalu upload kembali.', 'errors' => $errors], 422);
            return redirect()->route('admin.majors.index')->withErrors(['file' => 'Preview memiliki kesalahan. Perbaiki file lalu upload kembali.']);
        }

        $created = 0;
        $linked = 0;
        $alreadyLinked = 0;

        DB::transaction(function () use ($rows, &$created, &$linked, &$alreadyLinked) {
            foreach ($rows as $item) {
                $data = $item['data'];
                $major = Major::whereRaw('LOWER(name) = ?', [mb_strtolower($data['name'])])->first();

                if (!$major) {
                    $major = Major::create([
                        'name' => $data['name'],
                        'description' => $data['description'],
                        'category_id' => $data['category_id'],
                    ]);
                    $created++;
                } else {
                    $update = [];
                    if ($data['description'] !== null) $update['description'] = $data['description'];
                    if ($data['category_id'] !== null) $update['category_id'] = $data['category_id'];
                    if ($update) $major->update($update);
                }

                $university = University::findOrFail($item['university_id']);
                $pivotExists = $university->majors()->where('majors.id', $major->id)->exists();

                if ($pivotExists) {
                    $pivotUpdate = [];
                    if ($data['accreditation'] !== null) $pivotUpdate['accreditation'] = $data['accreditation'];
                    if ($data['additional_info'] !== null) $pivotUpdate['additional_info'] = $data['additional_info'];
                    if ($pivotUpdate) $university->majors()->updateExistingPivot($major->id, $pivotUpdate);
                    $alreadyLinked++;
                } else {
                    $university->majors()->attach($major->id, [
                        'accreditation' => $data['accreditation'],
                        'additional_info' => $data['additional_info'],
                    ]);
                    $linked++;
                }
            }
        });

        session()->forget(['major_import_preview', 'major_import_errors']);
        $message = "Import prodi selesai: {$created} prodi baru, {$linked} relasi baru, {$alreadyLinked} relasi sudah ada/diperbarui.";
        if (request()->expectsJson()) return response()->json(['success' => true, 'message' => $message, 'created' => $created, 'linked' => $linked, 'already_linked' => $alreadyLinked]);
        return redirect()->route('admin.majors.index')->with('success', $message);
    }

}
