<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi BK - Dashboard Guru BK - MyUniv</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #22346E 100%); }
        .glass-card { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); }
    </style>
</head>
<body class="bg-[#F8FBFF] min-h-screen text-gray-800 flex">

    <!-- Sidebar Navigation -->
    <aside class="w-72 bg-white border-r border-[#E2E8F0] flex flex-col justify-between hidden md:flex shadow-[4px_0_24px_rgba(54,80,162,0.03)] z-20">
        <div>
            <!-- Brand Logo -->
            <div class="px-8 py-7 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-myuniv flex items-center justify-center text-white font-extrabold text-xl shadow-lg shadow-indigo-200/50">M</div>
                    <div>
                        <span class="text-lg font-extrabold text-[#3650A2] block leading-tight tracking-tight">MyUniv</span>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Enterprise OS</span>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-5 space-y-2">
                <div class="px-4 py-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Menu Utama</div>

                <!-- Menu Beranda -->
                <a href="{{ route('counselor.dashboard') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span>Beranda</span>
                </a>

                <!-- Eksplorasi -->
                <a href="{{ route('counselor.exploration') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Eksplorasi
                </a>

                <!-- Konsultasi BK (Aktif) -->
                <a href="{{ route('counselor.consultation') }}" class="flex items-center gap-3.5 px-4.5 py-4 rounded-2xl bg-gradient-myuniv text-white font-bold text-sm shadow-lg shadow-indigo-200/60 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#FF7A59]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <span>Konsultasi BK</span>
                </a>

                <!-- Profil -->
                <a href="{{ route('counselor.profile') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profil
                </a>
            </nav>
        </div>

        <!-- Logout Section -->
        <div class="p-5 border-t border-gray-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50/80 rounded-xl transition font-bold group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 group-hover:text-red-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-h-screen">

        <!-- Top Navbar -->
        <header class="bg-white/80 backdrop-blur-md border-b border-[#E2E8F0] px-8 py-4.5 flex justify-between items-center sticky top-0 z-10 shadow-xs">
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold px-3 py-1 bg-indigo-50 text-[#3650A2] rounded-full tracking-wide">Panel Guru BK</span>
                <span class="text-gray-300 font-light">/</span>
                <h1 class="text-sm font-extrabold text-gray-800 tracking-tight">Konsultasi BK</h1>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <div class="text-sm font-extrabold text-gray-900 leading-tight">Eli Asrifah S. Pd.</div>
                    <div class="text-xs font-medium text-gray-400">Guru BK</div>
                </div>
                <div class="w-11 h-11 rounded-2xl bg-gradient-myuniv text-white flex items-center justify-center font-extrabold text-sm shadow-md shadow-indigo-200/50">EA</div>
            </div>
        </header>

        <!-- Page Body Content -->
        <main class="p-8 space-y-8 max-w-7xl w-full mx-auto">
            <div class="bg-gradient-myuniv text-white p-8 sm:p-10 rounded-[28px] shadow-xl shadow-indigo-900/10 relative overflow-hidden">
                <h2 class="text-3xl font-black tracking-tight mb-3">Manajemen Konsultasi Siswa</h2>
                <p class="text-indigo-100 text-sm leading-relaxed font-medium">Kelola daftar sesi bimbingan, pertanyaan siswa, serta rekapitulasi jadwal konsultasi online maupun offline.</p>
            </div>

            <div class="glass-card p-6 rounded-[24px] border border-[#E2E8F0] shadow-sm space-y-4">
                <h3 class="text-lg font-extrabold text-[#3650A2]">Daftar Permintaan Konsultasi</h3>
                <p class="text-sm text-gray-500">Belum ada permintaan sesi konsultasi baru yang masuk dari siswa.</p>
            </div>
        </main>
    </div>
</body>
</html>
