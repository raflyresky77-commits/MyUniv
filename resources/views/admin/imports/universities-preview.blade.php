<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preview Import Profil Universitas - MyUniv</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen p-4 sm:p-8">
    @include('components.global-loading')

    <main class="max-w-7xl mx-auto space-y-5">
        <a href="{{ route('admin.universities.index') }}" class="text-sm font-bold text-indigo-700">&larr; Kembali ke Data Universitas</a>

        <section class="bg-white rounded-2xl border border-slate-200 p-5 sm:p-7 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                <div>
                    <h1 class="text-xl font-black text-slate-900">Preview Import Profil Universitas</h1>
                    <p class="text-sm text-slate-500 mt-1">Periksa akreditasi, deskripsi, dan ranking QS sebelum data diperbarui.</p>
                </div>
                <span class="inline-flex w-fit rounded-full bg-indigo-50 text-indigo-700 px-3 py-1 text-xs font-bold">
                    {{ count($rows) }} baris terbaca
                </span>
            </div>

            @if($errors)
                <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <b>Ditemukan {{ count($errors) }} kesalahan:</b>
                    <ul class="list-disc pl-5 mt-2 space-y-1">
                        @foreach($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="mt-5 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                    Validasi berhasil. Nama universitas yang sudah terdaftar akan diperbarui. Kolom Excel yang kosong tidak akan menimpa data lama.
                </div>
            @endif

            <div class="mt-5 overflow-x-auto rounded-xl border border-slate-200">
                <table class="w-full min-w-[1050px] text-sm border-collapse">
                    <thead>
                        <tr class="bg-slate-100 text-left text-slate-600">
                            <th class="p-3 whitespace-nowrap">Baris</th>
                            <th class="p-3 min-w-[220px]">Nama Universitas</th>
                            <th class="p-3 whitespace-nowrap">Akreditasi PT</th>
                            <th class="p-3 min-w-[340px]">Deskripsi Singkat</th>
                            <th class="p-3 whitespace-nowrap">Ranking QS</th>
                            <th class="p-3 whitespace-nowrap">Tahun</th>
                            <th class="p-3 whitespace-nowrap">Jenis</th>
                            <th class="p-3 whitespace-nowrap">Lokasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($rows as $item)
                            @php($data = $item['data'])
                            <tr class="align-top hover:bg-slate-50">
                                <td class="p-3 text-slate-500">{{ $item['row_number'] }}</td>
                                <td class="p-3 font-semibold text-slate-900">{{ $data['name'] ?? '-' }}</td>
                                <td class="p-3">
                                    @if(!empty($data['accreditation']))
                                        <span class="inline-flex rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-bold">{{ $data['accreditation'] }}</span>
                                    @else
                                        <span class="text-slate-400">Tidak diisi</span>
                                    @endif
                                </td>
                                <td class="p-3 min-w-[340px] leading-relaxed text-slate-600">{{ $data['description'] ?: 'Tidak diisi' }}</td>
                                <td class="p-3 whitespace-nowrap">
                                    @if(!empty($data['ranking']))
                                        <span class="font-bold text-indigo-700">{{ $data['ranking'] }}</span>
                                        <span class="text-xs text-slate-500">{{ $data['ranking_source'] ?? '' }}</span>
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="p-3 whitespace-nowrap">{{ $data['ranking_year'] ?? '-' }}</td>
                                <td class="p-3 whitespace-nowrap">{{ $data['type'] ?? '-' }}</td>
                                <td class="p-3 whitespace-nowrap">{{ $data['location'] ?: '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p class="mt-3 text-xs text-slate-500">Catatan: ranking hanya ditampilkan jika diisi pada file. Kolom akreditasi atau deskripsi yang kosong akan mempertahankan data lama di database.</p>

            <div class="flex flex-wrap gap-3 mt-6">
                @if(!$errors && count($rows))
                    <form method="POST" action="{{ route('admin.universities.import.confirm') }}">
                        @csrf
                        <button type="submit" class="rounded-xl bg-indigo-700 hover:bg-indigo-800 text-white px-5 py-3 text-sm font-bold">
                            Konfirmasi & Simpan
                        </button>
                    </form>
                @endif
                <a href="{{ route('admin.universities.index') }}" class="rounded-xl bg-slate-100 hover:bg-slate-200 px-5 py-3 text-sm font-bold text-slate-700">Batal</a>
            </div>
        </section>
    </main>
</body>
</html>
