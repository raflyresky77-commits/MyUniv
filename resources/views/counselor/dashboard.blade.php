<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru BK - MyUniv</title>
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
                <a href="{{ route('counselor.dashboard') }}" class="flex items-center gap-3.5 px-4.5 py-4 rounded-2xl bg-gradient-myuniv text-white font-bold text-sm shadow-lg shadow-indigo-200/60 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#FF7A59]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span>Beranda</span>
                </a>

                <!-- Eksplorasi -->
                <a href="{{ route('counselor.exploration') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Eksplorasi
                </a>

                <!-- Konsultasi BK -->
                <a href="{{ route('counselor.consultation') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    Konsultasi BK
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
                <h1 class="text-sm font-extrabold text-gray-800 tracking-tight">Beranda</h1>
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

            <!-- Hero Banner / Selamat Datang -->
            <div class="bg-gradient-myuniv text-white p-8 sm:p-10 rounded-[28px] shadow-xl shadow-indigo-900/10 relative overflow-hidden flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="absolute right-0 top-0 w-96 h-96 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative z-10 max-w-xl">
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1 bg-[#FF7A59] text-white text-xs font-extrabold rounded-full mb-4 shadow-md shadow-orange-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Konsultasi Siswa Aktif
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight mb-3">Selamat Datang, Bu Eli</h2>
                    <p class="text-indigo-100 text-sm leading-relaxed font-medium">Dashboard Guru BK MyUniv — Pantau jadwal konsultasi, bimbingan siswa, serta arahkan masa depan siswa dengan mudah dan terstruktur.</p>
                </div>
            </div>

            <!-- Grid Statistik (Jadwal Hari Ini & Jadwal Aktif) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Jadwal Hari Ini -->
                <div class="glass-card p-6 rounded-[24px] border border-[#E2E8F0] shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Jadwal Hari Ini</p>
                        <h3 class="text-3xl font-black text-gray-900 tracking-tight mb-1">{{ $stats['today_count'] ?? 3 }}</h3>
                        <p class="text-xs text-indigo-600 font-semibold">Jadwal Tercatat</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-[#3650A2] flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </div>

                <!-- Jadwal Aktif -->
                <div class="glass-card p-6 rounded-[24px] border border-[#E2E8F0] shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Jadwal Aktif</p>
                        <h3 class="text-3xl font-black text-gray-900 tracking-tight mb-1">{{ $stats['active_count'] ?? 4 }}</h3>
                        <p class="text-xs text-[#FF7A59] font-semibold">Jadwal Tersedia</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-orange-50 text-[#FF7A59] flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>

            </div>

            <!-- Konten Utama: Jadwal Terdekat & Akses Cepat -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Bagian Kiri: Jadwal Terdekat -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-extrabold text-[#3650A2] tracking-tight">Jadwal Terdekat</h3>
                        <span class="text-xs font-bold text-gray-400">Daftar sesi konsultasi terdekat</span>
                    </div>

                    <!-- Item Jadwal 1 -->
                    <div class="glass-card p-5 rounded-[20px] border border-[#E2E8F0] shadow-sm flex items-center justify-between transition hover:border-[#3650A2]/50">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#3650A2] flex items-center justify-center font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-extrabold text-gray-900">Senin: 09.00 - 10.00</h4>
                                <p class="text-xs text-gray-500 font-medium">Offline: Ruang BK</p>
                            </div>
                        </div>
                        <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-[#3650A2] hover:text-white text-gray-700 text-xs font-extrabold rounded-xl transition shadow-xs">Edit</a>
                    </div>

                    <!-- Item Jadwal 2 -->
                    <div class="glass-card p-5 rounded-[20px] border border-[#E2E8F0] shadow-sm flex items-center justify-between transition hover:border-[#3650A2]/50">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-extrabold text-gray-900">Selasa: 13.00 - 14.00</h4>
                                <p class="text-xs text-gray-500 font-medium">Online: WhatsApp</p>
                            </div>
                        </div>
                        <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-[#3650A2] hover:text-white text-gray-700 text-xs font-extrabold rounded-xl transition shadow-xs">Edit</a>
                    </div>
                </div>

                <!-- Bagian Kanan: Akses Cepat -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-extrabold text-[#3650A2] tracking-tight">Akses Cepat</h3>
                    </div>

                    <div class="space-y-3">
                        <a href="#" class="w-full p-4 glass-card border border-[#E2E8F0] hover:border-[#FF7A59] hover:shadow-md text-gray-900 hover:text-[#FF7A59] font-extrabold text-sm rounded-2xl transition flex items-center justify-between group">
                            <span>+ Tambah Jadwal</span>
                            <span class="text-gray-400 group-hover:text-[#FF7A59]">&rarr;</span>
                        </a>

                        <a href="#" class="w-full p-4 glass-card border border-[#E2E8F0] hover:border-[#3650A2] hover:shadow-md text-gray-900 hover:text-[#3650A2] font-extrabold text-sm rounded-2xl transition flex items-center justify-between group">
                            <span>Lihat Semua Jadwal</span>
                            <span class="text-gray-400 group-hover:text-[#3650A2]">&rarr;</span>
                        </a>

                        <a href="{{ route('counselor.exploration') }}" class="w-full p-4 glass-card border border-[#E2E8F0] hover:border-[#3650A2] hover:shadow-md text-gray-900 hover:text-[#3650A2] font-extrabold text-sm rounded-2xl transition flex items-center justify-between group">
                            <span>Buka Explore</span>
                            <span class="text-gray-400 group-hover:text-[#3650A2]">&rarr;</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Catatan Footer Banner -->
            <div class="glass-card p-6 rounded-[24px] border border-[#E2E8F0] shadow-sm flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-extrabold text-gray-900 mb-1">Catatan:</h4>
                    <p class="text-xs text-gray-500 leading-relaxed font-medium">Konsultasi online dilanjutkan melalui WhatsApp. Sistem hanya menyimpan informasi jadwal.</p>
                </div>
            </div>

        </main>

    </div>
</body>
</html>
