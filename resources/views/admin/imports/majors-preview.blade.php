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

        <div class="max-w-6xl mx-auto space-y-5">
            <a href="{{ route('admin.majors.index') }}" class="text-sm font-bold text-indigo-700">&larr; Kembali ke Prodi</a>
            <div class="bg-white rounded-2xl border p-5 sm:p-7">
                <h1 class="text-xl font-black">Preview Import Program Studi</h1>
                <p class="text-sm text-slate-500 mt-1">Prodi yang sudah ada akan digunakan kembali, bukan dibuat duplikat. Relasi kampus akan ditambahkan ke tabel university_majors.</p>
                <div class="mt-4 text-sm">Total baris terbaca: <b>{{ count($rows) }}</b></div>
                @if($errors)
                    <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <b>Ditemukan {{ count($errors) }} kesalahan:</b>
                        <ul class="list-disc pl-5 mt-2 space-y-1">
                            @foreach($errors as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @else
                    <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                        Validasi berhasil. Data siap disimpan.
                    </div>
                @endif
                <div class="overflow-x-auto mt-5">
                    <table class="w-full text-sm border-collapse">
                        <thead><tr class="bg-slate-100 text-left">
                            <th class="p-3">Baris</th><th class="p-3">Nama Prodi</th><th class="p-3">Universitas</th>
                            <th class="p-3">Kategori ID</th><th class="p-3">Akreditasi</th>
                        </tr></thead>
                        <tbody>
                        @foreach($rows as $item)
                            <tr class="border-b">
                                <td class="p-3">{{ $item['row_number'] }}</td>
                                <td class="p-3 font-semibold">{{ $item['data']['name'] }}</td>
                                <td class="p-3">{{ $item['data']['university_name'] }}</td>
                                <td class="p-3">{{ $item['data']['category_id'] ?? '-' }}</td>
                                <td class="p-3">{{ $item['data']['accreditation'] ?? '-' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-wrap gap-3 mt-6">
                    @if(!$errors && count($rows))
                        <form method="POST" action="{{ route('admin.majors.import.confirm') }}">
                            @csrf
                            <button class="rounded-xl bg-indigo-700 text-white px-5 py-3 text-sm font-bold">Konfirmasi & Simpan</button>
                        </form>
                    @endif
                    <a href="{{ route('admin.majors.index') }}" class="rounded-xl bg-slate-100 px-5 py-3 text-sm font-bold">Batal</a>
                </div>
            </div>
        </div>
    </body>
</html>
