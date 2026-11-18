<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preview Import Prodi - MyUniv</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen p-4 sm:p-8">
    @include('components.global-loading')

    @php
        $summary = $summary ?? [
            'baru' => count(array_filter($rows, fn($r) => ($r['status'] ?? '') === 'BARU')),
            'update' => count(array_filter($rows, fn($r) => ($r['status'] ?? '') === 'UPDATE')),
            'unchanged' => count(array_filter($rows, fn($r) => ($r['status'] ?? '') === 'TIDAK BERUBAH')),
            'error' => count($errors),
        ];
    @endphp

    <div class="max-w-7xl mx-auto space-y-5">
        <a href="{{ route('admin.majors.index') }}" class="text-sm font-bold text-indigo-700">&larr; Kembali ke Prodi</a>

        <div class="bg-white rounded-2xl border p-5 sm:p-7">
            <h1 class="text-xl font-black">Preview Smart Import Program Studi</h1>
            <p class="text-sm text-slate-500 mt-1">Sistem mencocokkan nama prodi dengan data yang ada. Data kosong di Excel tidak menghapus nilai lama.</p>
            <div class="mt-4 text-sm">Total baris terbaca: <b>{{ count($rows) }}</b></div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-5">
                <div class="rounded-xl bg-emerald-50 border border-emerald-100 p-4"><div class="text-2xl font-black text-emerald-700">{{ $summary['baru'] }}</div><div class="text-sm text-emerald-800">Data baru</div></div>
                <div class="rounded-xl bg-blue-50 border border-blue-100 p-4"><div class="text-2xl font-black text-blue-700">{{ $summary['update'] }}</div><div class="text-sm text-blue-800">Akan diperbarui</div></div>
                <div class="rounded-xl bg-slate-100 border border-slate-200 p-4"><div class="text-2xl font-black text-slate-700">{{ $summary['unchanged'] }}</div><div class="text-sm text-slate-700">Tidak berubah</div></div>
                <div class="rounded-xl bg-red-50 border border-red-100 p-4"><div class="text-2xl font-black text-red-700">{{ $summary['error'] }}</div><div class="text-sm text-red-800">Kesalahan</div></div>
            </div>

            @if($errors)
                <div class="mt-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <b>Ditemukan {{ count($errors) }} kesalahan:</b>
                    <ul class="list-disc pl-5 mt-2 space-y-1">
                        @foreach($errors as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @else
                <div class="mt-5 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
                    Preview berhasil. Periksa status dan perubahan sebelum konfirmasi.
                </div>
            @endif

            <div class="overflow-x-auto mt-5">
                <table class="w-full text-sm border-collapse min-w-[900px]">
                    <thead><tr class="bg-slate-100 text-left">
                        <th class="p-3">Baris</th><th class="p-3">Nama Prodi</th><th class="p-3">Universitas</th>
                        <th class="p-3">Kategori</th><th class="p-3">Akreditasi</th><th class="p-3">Status</th><th class="p-3">Perubahan</th>
                    </tr></thead>
                    <tbody>
                    @foreach($rows as $item)
                        @php
                            $status = $item['status'] ?? 'BARU';
                            $badge = match($status) {
                                'BARU' => 'bg-emerald-100 text-emerald-800',
                                'UPDATE' => 'bg-blue-100 text-blue-800',
                                'TIDAK BERUBAH' => 'bg-slate-200 text-slate-700',
                                default => 'bg-red-100 text-red-800',
                            };
                        @endphp
                        <tr class="border-b align-top">
                            <td class="p-3">{{ $item['row_number'] }}</td>
                            <td class="p-3 font-semibold">{{ $item['data']['name'] }}</td>
                            <td class="p-3">{{ $item['data']['university_name'] }}</td>
                            <td class="p-3">{{ $item['data']['category_id'] ?? '-' }}</td>
                            <td class="p-3">{{ $item['data']['accreditation'] ?? '-' }}</td>
                            <td class="p-3"><span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $badge }}">{{ $status }}</span></td>
                            <td class="p-3">
                                @if(!empty($item['changes']))
                                    <ul class="list-disc pl-4 space-y-1">@foreach($item['changes'] as $change)<li>{{ $change }}</li>@endforeach</ul>
                                @else
                                    <span class="text-slate-400">Tidak ada perubahan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex flex-wrap gap-3 mt-6">
                @if(!$errors && count($rows))
                    <form method="POST" action="{{ route('admin.majors.import.confirm') }}">
                        @csrf
                        <button class="rounded-xl bg-indigo-700 hover:bg-indigo-800 text-white px-5 py-3 text-sm font-bold">Konfirmasi & Simpan</button>
                    </form>
                @endif
                <a href="{{ route('admin.majors.index') }}" class="rounded-xl bg-slate-100 px-5 py-3 text-sm font-bold">Batal</a>
            </div>
        </div>
    </div>
</body>
</html>
