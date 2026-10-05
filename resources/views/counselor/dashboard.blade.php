<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru BK - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-strong { background: linear-gradient(135deg, #2B4185 0%, #141F43 100%); }

        .glass-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(235, 242, 255, 0.85) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid rgba(54, 80, 162, 0.15);
            box-shadow: 0 20px 45px -12px rgba(30, 45, 98, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.9);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .glass-card:hover {
            transform: translateY(-4px);
            border-color: #FF7A59;
            box-shadow: 0 25px 50px -12px rgba(255, 122, 89, 0.2);
        }

        .card-shortcut-gradient {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 245, 255, 0.9) 100%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(54, 80, 162, 0.12);
            box-shadow: 0 10px 30px -10px rgba(54, 80, 162, 0.08);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }
        .card-shortcut-gradient::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #3650A2, #FF7A59);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .card-shortcut-gradient:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 122, 89, 0.4);
            background: linear-gradient(135deg, rgba(255, 255, 255, 1) 0%, rgba(255, 242, 238, 0.6) 100%);
            box-shadow: 0 20px 40px -12px rgba(255, 122, 89, 0.18);
        }
        .card-shortcut-gradient:hover::after {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-[#F4F7FE] text-gray-800 antialiased">

    <!-- Backdrop Gelap saat Sidebar Mobile Terbuka -->
    <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 md:hidden hidden backdrop-blur-xs transition-opacity"></div>

    <!-- Sidebar Navigation -->
    <aside id="mobileSidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-[#E2E8F0] flex flex-col justify-between transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl md:shadow-[4px_0_24px_rgba(54,80,162,0.05)] overflow-y-auto">
        <div>
            <!-- Brand Logo -->
            <div class="px-6 py-6 border-b border-gray-100 flex items-center gap-3.5">
                <div class="w-11 h-11 flex items-center justify-center bg-indigo-50 rounded-[14px] border border-indigo-200/80 p-1.5 shrink-0 overflow-hidden shadow-sm transition-transform duration-300 hover:scale-105">
                    <img src="{{ asset('images/icon.png') }}" alt="Logo MyUniv" class="w-full h-full object-contain">
                </div>
                <div>
                    <span class="text-lg font-black text-[#3650A2] tracking-tight leading-none block">MyUniv</span>
                    <span class="text-[10px] font-extrabold text-indigo-400 uppercase tracking-wider mt-1 block">Panel Guru BK</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-5 space-y-2">
                <div class="px-4 py-2 text-[10px] font-extrabold text-indigo-400 uppercase tracking-widest">Menu Utama</div>

                <!-- Beranda (Aktif) -->
                <a href="{{ route('counselor.dashboard') }}" class="flex items-center gap-3.5 px-4.5 py-4 rounded-2xl bg-gradient-strong text-white font-bold text-sm shadow-lg shadow-indigo-900/25 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#FF7A59]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-white group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Beranda</span>
                </a>

                <!-- Eksplorasi -->
                <a href="{{ route('counselor.exploration') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>Eksplorasi</span>
                </a>

                <!-- Konsultasi BK -->
                <a href="{{ route('counselor.consultation') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <span>Konsultasi BK</span>
                </a>

                <!-- Profil -->
                <a href="{{ route('counselor.profile') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Profil</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer & Tombol Logout -->
        <div class="p-5 border-t border-gray-100 bg-white space-y-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-red-600 hover:bg-red-50 font-bold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Top Navbar -->
    <header class="bg-white/90 backdrop-blur-md border-b border-[#E2E8F0] px-6 lg:px-10 py-5 flex justify-between items-center fixed top-0 right-0 left-0 md:left-72 z-40 shadow-xs">
        <div class="flex items-center gap-3">
            <button type="button" onclick="toggleSidebar()" class="md:hidden p-2 rounded-xl text-gray-700 bg-gray-100 hover:bg-indigo-50 hover:text-[#3650A2] transition focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <span class="text-xs font-bold px-3 py-1 bg-indigo-50 text-[#3650A2] rounded-full tracking-wide">Panel Guru BK</span>
            <span class="text-gray-300 font-light hidden sm:inline">/</span>
            <h1 class="text-sm font-extrabold text-gray-800 tracking-tight hidden sm:inline">Beranda</h1>
        </div>

        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-extrabold text-gray-900 leading-tight">Eli Asrifah S. Pd.</div>
                <div class="text-xs font-semibold text-indigo-500">Guru BK</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-gradient-strong text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-900/20 transition-transform hover:scale-105 cursor-pointer">
                EA
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="md:ml-72 pt-28 min-h-screen flex flex-col">
        <main class="p-6 md:p-10 space-y-8 max-w-7xl w-full mx-auto flex-1">

            <!-- Hero Banner dengan Foto Kampus & Gradasi Transparan -->
            <div class="relative rounded-[40px] overflow-hidden px-8 sm:px-12 py-12 sm:py-16 shadow-lg border border-indigo-100 flex flex-col justify-center">
                <!-- Background Image Kampus -->
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset('images/banner-dashboardc.png') }}" alt="Background Kampus" class="w-full h-full object-cover object-center filter scale-105">
                </div>
                <!-- Overlay Gradasi Konsisten -->
                <div class="absolute inset-0 z-5 bg-gradient-to-r from-[#141F43]/75 via-[#1E2D62]/80 to-[#3650A2]/75 backdrop-blur-[1px]"></div>

                <!-- Content Banner -->
                <div class="space-y-4 relative z-20 max-w-2xl text-white">
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-[#FF7A59] text-white text-xs font-extrabold rounded-full shadow-md uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Konsultasi Siswa Aktif
                    </span>
                    <h2 class="text-3xl sm:text-5xl font-black tracking-tight text-white drop-shadow-sm">Selamat Datang, Bu Eli 👋</h2>
                    <p class="text-gray-200 text-sm sm:text-base leading-relaxed font-medium drop-shadow">
                        Dashboard Guru BK MyUniv — Pantau jadwal konsultasi, bimbingan siswa, serta arahkan masa depan siswa dengan mudah dan terstruktur.
                    </p>
                </div>
            </div>

            <!-- Grid Statistik (Jadwal Hari Ini & Jadwal Aktif) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Jadwal Hari Ini -->
                <div class="glass-card p-6 sm:p-7 rounded-[32px] flex items-center justify-between">
                    <div>
                        <p class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Jadwal Hari Ini</p>
                        <h3 class="text-3xl font-black text-gray-900 tracking-tight mb-1">{{ $stats['today_count'] ?? 3 }}</h3>
                        <p class="text-xs text-indigo-600 font-semibold">Jadwal Tercatat</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-[#3650A2] flex items-center justify-center shadow-sm border border-indigo-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </div>

                <!-- Jadwal Aktif -->
                <div class="glass-card p-6 sm:p-7 rounded-[32px] flex items-center justify-between">
                    <div>
                        <p class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Jadwal Aktif</p>
                        <h3 class="text-3xl font-black text-gray-900 tracking-tight mb-1">{{ $stats['active_count'] ?? 4 }}</h3>
                        <p class="text-xs text-[#FF7A59] font-semibold">Jadwal Tersedia</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-orange-50 text-[#FF7A59] flex items-center justify-center shadow-sm border border-orange-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
            </div>

            <!-- Konten Utama: Jadwal Terdekat & Akses Cepat -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Bagian Kiri: Jadwal Terdekat -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center justify-between px-1 mb-2">
                        <h3 class="text-lg font-black text-[#3650A2] tracking-tight">Jadwal Terdekat</h3>
                        <span class="text-xs font-bold text-gray-400">Daftar sesi konsultasi terdekat</span>
                    </div>

                    <div class="space-y-4">
                        <!-- Item Jadwal 1 -->
                        <div class="glass-card p-5 rounded-[24px] flex items-center justify-between transition group">
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-indigo-50 text-[#3650A2] flex items-center justify-center font-bold border border-indigo-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-extrabold text-gray-900 group-hover:text-[#3650A2] transition">Senin: 09.00 - 10.00</h4>
                                    <p class="text-xs text-gray-500 font-medium mt-0.5">Offline: Ruang BK</p>
                                </div>
                            </div>
                            <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-[#3650A2] hover:text-white text-gray-700 text-xs font-extrabold rounded-xl transition shadow-2xs">Edit</a>
                        </div>

                        <!-- Item Jadwal 2 -->
                        <div class="glass-card p-5 rounded-[24px] flex items-center justify-between transition group">
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold border border-emerald-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-extrabold text-gray-900 group-hover:text-[#3650A2] transition">Selasa: 13.00 - 14.00</h4>
                                    <p class="text-xs text-gray-500 font-medium mt-0.5">Online: WhatsApp</p>
                                </div>
                            </div>
                            <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-[#3650A2] hover:text-white text-gray-700 text-xs font-extrabold rounded-xl transition shadow-2xs">Edit</a>
                        </div>
                    </div>
                </div>

                <!-- Bagian Kanan: Akses Cepat -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between px-1 mb-2">
                        <h3 class="text-lg font-black text-[#3650A2] tracking-tight">Akses Cepat</h3>
                    </div>

                    <div class="space-y-3">
                        <a href="#" class="card-shortcut-gradient w-full p-4.5 rounded-[22px] flex items-center justify-between group">
                            <span class="text-xs font-extrabold text-gray-900 group-hover:text-[#FF7A59] transition">+ Tambah Jadwal</span>
                            <span class="text-gray-400 group-hover:text-[#FF7A59] group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>

                        <a href="#" class="card-shortcut-gradient w-full p-4.5 rounded-[22px] flex items-center justify-between group">
                            <span class="text-xs font-extrabold text-gray-900 group-hover:text-[#3650A2] transition">Lihat Semua Jadwal</span>
                            <span class="text-gray-400 group-hover:text-[#3650A2] group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>

                        <a href="{{ route('counselor.exploration') }}" class="card-shortcut-gradient w-full p-4.5 rounded-[22px] flex items-center justify-between group">
                            <span class="text-xs font-extrabold text-gray-900 group-hover:text-[#3650A2] transition">Buka Explore</span>
                            <span class="text-gray-400 group-hover:text-[#3650A2] group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Catatan Footer Banner -->
            <div class="glass-card p-6 rounded-[28px] flex items-start gap-4 mb-12">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 font-bold border border-amber-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-extrabold text-gray-900 mb-1">Catatan:</h4>
                    <p class="text-xs text-gray-500 leading-relaxed font-medium">Konsultasi online dilanjutkan melalui WhatsApp. Sistem hanya menyimpan informasi jadwal.</p>
                </div>
            </div>

        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }
    </script>
</body>
</html>
