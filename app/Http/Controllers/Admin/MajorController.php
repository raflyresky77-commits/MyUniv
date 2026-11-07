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

        // Ambil referensi sekali saja. Hindari query database berulang
        // untuk setiap baris Excel, terutama saat database berada di Supabase.
        $universitiesByName = University::query()
            ->get(['id', 'name'])
            ->keyBy(fn ($university) => mb_strtolower(trim($university->name)));

        $validCategoryIds = DB::table('interest_categories')
            ->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->flip();

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
                ? $universitiesByName->get(mb_strtolower($universityName))
                : null;
            if ($universityName !== '' && !$university) {
                $errors[] = "Baris {$rowNumber}: universitas '{$universityName}' tidak ditemukan. Tambahkan/import universitas lebih dahulu.";
            }

            $categoryId = trim((string) ($row['category_id'] ?? ''));
            if ($categoryId !== '' && !$validCategoryIds->has($categoryId)) {
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
            if (request()->expectsJson()) {
                return response()->json(['message' => 'Preview import sudah kedaluwarsa. Silakan upload ulang.'], 422);
            }

            return redirect()->route('admin.majors.index')
                ->withErrors(['file' => 'Preview import sudah kedaluwarsa. Silakan upload ulang.']);
        }

        $errors = session('major_import_errors', []);

        if (!empty($errors)) {
            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Preview memiliki kesalahan. Perbaiki file lalu upload kembali.',
                    'errors' => $errors,
                ], 422);
            }

            return redirect()->route('admin.majors.index')
                ->withErrors(['file' => 'Preview memiliki kesalahan. Perbaiki file lalu upload kembali.']);
        }

        $created = 0;
        $linked = 0;
        $alreadyLinked = 0;

        try {
            DB::transaction(function () use ($rows, &$created, &$linked, &$alreadyLinked) {
                /*
                 * 1. Kelompokkan prodi berdasarkan nama (case-insensitive).
                 * Satu prodi dapat terhubung ke beberapa universitas.
                 */
                $majorPayloads = [];
                $universityIds = [];

                foreach ($rows as $item) {
                    $data = $item['data'];
                    $key = mb_strtolower(trim($data['name']));

                    if (!isset($majorPayloads[$key])) {
                        $majorPayloads[$key] = [
                            'name' => $data['name'],
                            'description' => $data['description'],
                            'category_id' => $data['category_id'],
                        ];
                    } else {
                        // Pertahankan perilaku lama: nilai kosong tidak menimpa data yang sudah ada.
                        if ($majorPayloads[$key]['description'] === null && $data['description'] !== null) {
                            $majorPayloads[$key]['description'] = $data['description'];
                        }
                        if ($majorPayloads[$key]['category_id'] === null && $data['category_id'] !== null) {
                            $majorPayloads[$key]['category_id'] = $data['category_id'];
                        }
                    }

                    $universityIds[] = (int) $item['university_id'];
                }

                $majorKeys = array_keys($majorPayloads);
                $universityIds = array_values(array_unique($universityIds));

                /*
                 * 2. Ambil semua prodi yang sudah ada dalam satu query.
                 */
                $existingMajors = Major::query()
                    ->whereIn(DB::raw('LOWER(name)'), $majorKeys)
                    ->get(['id', 'name', 'description', 'category_id']);

                $majorsByName = $existingMajors->keyBy(
                    fn ($major) => mb_strtolower(trim($major->name))
                );

                /*
                 * 3. Insert prodi baru secara batch.
                 */
                $newMajorRows = [];
                $now = now();

                foreach ($majorPayloads as $key => $data) {
                    if (!$majorsByName->has($key)) {
                        $newMajorRows[] = [
                            'name' => $data['name'],
                            'description' => $data['description'],
                            'category_id' => $data['category_id'],
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                }

                foreach (array_chunk($newMajorRows, 200) as $chunk) {
                    DB::table('majors')->insert($chunk);
                }

                $created = count($newMajorRows);

                /*
                 * 4. Ambil ulang ID prodi baru sekaligus.
                 */
                if ($newMajorRows) {
                    $newMajors = Major::query()
                        ->whereIn(DB::raw('LOWER(name)'), array_keys(array_intersect_key(
                            $majorPayloads,
                            array_fill_keys(array_keys($majorPayloads), true)
                        )))
                        ->get(['id', 'name', 'description', 'category_id']);

                    foreach ($newMajors as $major) {
                        $key = mb_strtolower(trim($major->name));
                        if (!$majorsByName->has($key)) {
                            $majorsByName->put($key, $major);
                        }
                    }
                }

                /*
                 * 5. Perbarui data prodi lama hanya jika file memberi nilai.
                 * Update ini hanya dilakukan untuk prodi yang memang sudah ada.
                 */
                foreach ($majorPayloads as $key => $data) {
                    $major = $majorsByName->get($key);
                    if (!$major) {
                        throw new \RuntimeException("Prodi '{$data['name']}' gagal ditemukan setelah proses insert.");
                    }

                    $updates = [];
                    if ($data['description'] !== null && $data['description'] !== $major->description) {
                        $updates['description'] = $data['description'];
                    }
                    if ($data['category_id'] !== null && (int) $data['category_id'] !== (int) $major->category_id) {
                        $updates['category_id'] = $data['category_id'];
                    }

                    if ($updates) {
                        $updates['updated_at'] = now();
                        DB::table('majors')->where('id', $major->id)->update($updates);
                        foreach ($updates as $column => $value) {
                            if ($column !== 'updated_at') {
                                $major->{$column} = $value;
                            }
                        }
                    }
                }

                /*
                 * 6. Ambil semua relasi pivot yang relevan dalam satu query.
                 */
                $majorIds = $majorsByName->pluck('id')->map(fn ($id) => (int) $id)->unique()->values()->all();

                $existingPivots = DB::table('university_majors')
                    ->whereIn('university_id', $universityIds)
                    ->whereIn('major_id', $majorIds)
                    ->get(['university_id', 'major_id', 'accreditation', 'additional_info']);

                $pivotMap = [];
                foreach ($existingPivots as $pivot) {
                    $pivotMap[$pivot->university_id . ':' . $pivot->major_id] = $pivot;
                }

                /*
                 * 7. Siapkan seluruh relasi dan simpan dengan upsert batch.
                 * Nilai null dari file tidak menghapus nilai pivot lama.
                 */
                $pivotRows = [];

                foreach ($rows as $item) {
                    $data = $item['data'];
                    $majorKey = mb_strtolower(trim($data['name']));
                    $major = $majorsByName->get($majorKey);
                    $universityId = (int) $item['university_id'];
                    $majorId = (int) $major->id;
                    $pivotKey = $universityId . ':' . $majorId;
                    $existingPivot = $pivotMap[$pivotKey] ?? null;

                    if ($existingPivot) {
                        $alreadyLinked++;
                        $accreditation = $data['accreditation'] !== null
                            ? $data['accreditation']
                            : $existingPivot->accreditation;
                        $additionalInfo = $data['additional_info'] !== null
                            ? $data['additional_info']
                            : $existingPivot->additional_info;
                    } else {
                        $linked++;
                        $accreditation = $data['accreditation'];
                        $additionalInfo = $data['additional_info'];
                    }

                    $pivotRows[$pivotKey] = [
                        'university_id' => $universityId,
                        'major_id' => $majorId,
                        'accreditation' => $accreditation,
                        'additional_info' => $additionalInfo,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }

                foreach (array_chunk(array_values($pivotRows), 200) as $chunk) {
                    DB::table('university_majors')->upsert(
                        $chunk,
                        ['university_id', 'major_id'],
                        ['accreditation', 'additional_info', 'updated_at']
                    );
                }
            }, 3);
        } catch (\Throwable $exception) {
            report($exception);

            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Import gagal disimpan. Tidak ada perubahan yang disimpan. Periksa laravel.log untuk detail error.',
                ], 500);
            }

            return redirect()->route('admin.majors.index')
                ->withErrors(['file' => 'Import gagal disimpan. Tidak ada perubahan yang disimpan. Periksa laravel.log untuk detail error.']);
        }

        session()->forget(['major_import_preview', 'major_import_errors']);

        $message = "Import prodi selesai: {$created} prodi baru, {$linked} relasi baru, {$alreadyLinked} relasi sudah ada/diperbarui.";

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'created' => $created,
                'linked' => $linked,
                'already_linked' => $alreadyLinked,
            ]);
        }

        return redirect()->route('admin.majors.index')->with('success', $message);
    }

}
