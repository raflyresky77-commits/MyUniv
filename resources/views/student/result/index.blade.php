<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Asesmen Karier - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#F4F7FE] text-gray-800 antialiased">
    <div class="max-w-4xl mx-auto px-6 py-12 space-y-6">

        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl font-bold text-sm">
                {{ session('success') }} 🎉
            </div>
        @endif

        <div class="bg-white p-8 rounded-[32px] shadow-sm border border-indigo-100 text-center space-y-4">
            <span class="px-4 py-1.5 bg-[#FF7A59] text-white rounded-full text-xs font-extrabold uppercase tracking-wider">Hasil Analisis</span>
            <h1 class="text-3xl font-black text-[#3650A2]">Profil Kepribadian Kariermu</h1>
            <p class="text-gray-600 text-sm max-w-xl mx-auto">
                Berdasarkan jawaban yang kamu berikan, karaktermu condong ke arah kepemimpinan dan pemecahan masalah analitis.
            </p>
            <div class="pt-4">
                <a href="{{ route('student.dashboard') }}" class="px-8 py-3.5 bg-[#3650A2] text-white rounded-2xl font-bold text-xs shadow-lg shadow-indigo-950/20 hover:bg-[#2B4185] transition">
                    Kembali ke Beranda &rarr;
                </a>
            </div>
        </div>

    </div>
</body>
</html>
