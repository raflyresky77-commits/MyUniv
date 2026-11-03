<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preview Import Universitas - MyUniv</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])

</head>
    <body class="bg-slate-50 text-slate-800 min-h-screen p-4 sm:p-8">

        @include('components.global-loading')

        <div class="max-w-6xl mx-auto space-y-5">
            <a href="{{ route('admin.universities.index') }}" class="text-sm font-bold text-indigo-700">&larr; Kembali ke Universitas</a>
            <div class="bg-white rounded-2xl border p-5 sm:p-7">
                <h1 class="text-xl font-black">Preview Import Universitas</h1>
                <p class="text-sm text-slate-500 mt-1">Periksa data sebelum disimpan. Baris yang memiliki kesalahan tidak dapat dikonfirmasi.</p>
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
                        Validasi berhasil. Data universitas dengan nama yang sudah ada akan diperbarui; kolom kosong tidak menimpa data lama.
                    </div>
                @endif
                <div class="overflow-x-auto mt-5">
                    <table class="w-full text-sm border-collapse">
                        <thead><tr class="bg-slate-100 text-left">
                            <th class="p-3">Baris</th><th class="p-3">Nama</th><th class="p-3">Jenis</th>
                            <th class="p-3">Lokasi</th><th class="p-3">Ranking</th><th class="p-3">Sumber/Tahun</th>
                        </tr></thead>
                        <tbody>
                        @foreach($rows as $item)
                            <tr class="border-b">
                                <td class="p-3">{{ $item['row_number'] }}</td>
                                <td class="p-3 font-semibold">{{ $item['data']['name'] }}</td>
                                <td class="p-3">{{ $item['data']['type'] }}</td>
                                <td class="p-3">{{ $item['data']['location'] ?: '-' }}</td>
                                <td class="p-3">{{ $item['data']['ranking'] ?? '-' }}</td>
                                <td class="p-3">{{ $item['data']['ranking_source'] ?? '-' }} / {{ $item['data']['ranking_year'] ?? '-' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-wrap gap-3 mt-6">
                    @if(!$errors && count($rows))
                        <form method="POST" action="{{ route('admin.universities.import.confirm') }}">
                            @csrf
                            <button class="rounded-xl bg-indigo-700 text-white px-5 py-3 text-sm font-bold">Konfirmasi & Simpan</button>
                        </form>
                    @endif
                    <a href="{{ route('admin.universities.index') }}" class="rounded-xl bg-slate-100 px-5 py-3 text-sm font-bold">Batal</a>
                </div>
            </div>
        </div>
    </body>
</html>
