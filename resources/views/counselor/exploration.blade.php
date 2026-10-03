<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eksplorasi - Dashboard Guru BK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #22346E 100%); }
        .glass-card { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); }
    </style>
</head>
<body class="bg-[#F8FBFF] min-h-screen text-gray-800 flex">

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-h-screen">
        <header class="bg-white/80 backdrop-blur-md border-b border-[#E2E8F0] px-8 py-4.5 flex justify-between items-center sticky top-0 z-10">
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold px-3 py-1 bg-indigo-50 text-[#3650A2] rounded-full">Panel Guru BK</span>
                <span class="text-gray-300">/</span>
                <h1 class="text-sm font-extrabold text-gray-800">Eksplorasi</h1>
            </div>
            <a href="{{ route('counselor.dashboard') }}" class="text-xs font-bold text-[#3650A2] hover:underline">&larr; Kembali ke Beranda</a>
        </header>

        <main class="p-8 max-w-7xl w-full mx-auto space-y-6">
            <div class="glass-card p-8 rounded-[24px] border border-[#E2E8F0] shadow-sm">
                <h2 class="text-2xl font-black text-[#3650A2] mb-2">Eksplorasi Universitas & Jurusan</h2>
                <p class="text-sm text-gray-500">Halaman ini digunakan untuk melihat data referensi universitas dan program studi bagi siswa.</p>
            </div>
        </main>
    </div>
</body>
</html>
