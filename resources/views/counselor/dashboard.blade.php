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

        /* Animasi card dibuat konsisten: fade-up saat muncul, lift + glow saat hover */
        .glass-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(235, 242, 255, 0.88) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(54, 80, 162, 0.16);
            box-shadow: 0 14px 34px -14px rgba(30, 45, 98, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.95);
            position: relative;
            overflow: hidden;
            isolation: isolate;
            transition: transform 520ms cubic-bezier(0.22, 1, 0.36, 1),
                        box-shadow 520ms cubic-bezier(0.22, 1, 0.36, 1),
                        border-color 420ms ease;
            animation: counselor-card-enter 560ms ease-out both;
            will-change: transform;
        }
        .glass-card::before {
            content: '';
            position: absolute;
            inset: 0 auto 0 0;
            width: 4px;
            background: linear-gradient(180deg, #3650A2 0%, #FF7A59 100%);
            opacity: 0.75;
            pointer-events: none;
            z-index: -1;
        }
        /* Animasi masuk hanya mengatur opacity agar tidak bentrok dengan hover transform. */
        @keyframes counselor-card-enter {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .glass-card:hover {
            transform: translateY(-3px);
            border-color: rgba(255, 122, 89, 0.65);
            box-shadow: 0 24px 48px -18px rgba(54, 80, 162, 0.25), 0 8px 22px -12px rgba(255, 122, 89, 0.35);
        }
        /* Urutan masuk bertahap supaya animasi tidak muncul serentak */
        .card-delay-1 { animation-delay: 60ms; }
        .card-delay-2 { animation-delay: 130ms; }
        .card-delay-3 { animation-delay: 200ms; }
        .card-delay-4 { animation-delay: 270ms; }

        .card-shortcut-gradient {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(237, 243, 255, 0.92) 100%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(54, 80, 162, 0.14);
            box-shadow: 0 10px 28px -12px rgba(54, 80, 162, 0.16);
            transition: transform 520ms cubic-bezier(0.22, 1, 0.36, 1),
                        box-shadow 520ms cubic-bezier(0.22, 1, 0.36, 1),
                        border-color 420ms ease, background 420ms ease;
            will-change: transform;
            position: relative;
            overflow: hidden;
            animation: counselor-card-enter 560ms cubic-bezier(0.2, 0.7, 0.2, 1) both;
        }
        .card-shortcut-gradient::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #3650A2, #FF7A59);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 480ms cubic-bezier(0.22, 1, 0.36, 1);
        }
        .card-shortcut-gradient:hover {
            transform: translateY(-3px);
            border-color: rgba(255, 122, 89, 0.55);
            background: linear-gradient(135deg, #FFFFFF 0%, rgba(255, 242, 238, 0.88) 100%);
            box-shadow: 0 20px 38px -16px rgba(54, 80, 162, 0.2), 0 8px 18px -12px rgba(255, 122, 89, 0.3);
        }
        .card-shortcut-gradient:hover::after { transform: scaleX(1); }
        @media (prefers-reduced-motion: reduce) {
            .glass-card, .card-shortcut-gradient { animation: none !important; transition: none !important; }
            .glass-card:hover, .card-shortcut-gradient:hover { transform: none; }
            .card-shortcut-gradient::after { transition: none !important; }
        }
    </style>
</head>
<body class="bg-[#F4F7FE] text-gray-800 antialiased">

    {{-- Komponen navigasi Guru BK --}}
    <x-counselor.sidebar active="dashboard" />
    <x-counselor.topbar title="Beranda" subtitle="Panel Guru BK" />

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
                <x-card variant="interactive" class="glass-card card-delay-1 p-6 sm:p-7 !rounded-[32px] flex items-center justify-between">
                    <div>
                        <p class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Jadwal Hari Ini</p>
                        <h3 class="text-3xl font-black text-gray-900 tracking-tight mb-1">{{ $stats['today_count'] ?? 3 }}</h3>
                        <p class="text-xs text-indigo-600 font-semibold">Jadwal Tercatat</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-[#3650A2] flex items-center justify-center shadow-sm border border-indigo-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </x-card>

                <!-- Jadwal Aktif -->
                <x-card variant="interactive" class="glass-card card-delay-2 p-6 sm:p-7 !rounded-[32px] flex items-center justify-between">
                    <div>
                        <p class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Jadwal Aktif</p>
                        <h3 class="text-3xl font-black text-gray-900 tracking-tight mb-1">{{ $stats['active_count'] ?? 4 }}</h3>
                        <p class="text-xs text-[#FF7A59] font-semibold">Jadwal Tersedia</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-orange-50 text-[#FF7A59] flex items-center justify-center shadow-sm border border-orange-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </x-card>
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
                        <x-card variant="interactive" class="glass-card card-delay-1 p-5 !rounded-[24px] flex items-center justify-between group">
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
                        </x-card>

                        <!-- Item Jadwal 2 -->
                        <x-card variant="interactive" class="glass-card card-delay-2 p-5 !rounded-[24px] flex items-center justify-between group">
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
                        </x-card>
                    </div>
                </div>

                <!-- Bagian Kanan: Akses Cepat -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between px-1 mb-2">
                        <h3 class="text-lg font-black text-[#3650A2] tracking-tight">Akses Cepat</h3>
                    </div>

                    <div class="space-y-3">
                        <a href="#" class="card-shortcut-gradient card-delay-1 w-full p-4.5 rounded-[22px] flex items-center justify-between group">
                            <span class="text-xs font-extrabold text-gray-900 group-hover:text-[#FF7A59] transition">+ Tambah Jadwal</span>
                            <span class="text-gray-400 group-hover:text-[#FF7A59] group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>

                        <a href="#" class="card-shortcut-gradient card-delay-2 w-full p-4.5 rounded-[22px] flex items-center justify-between group">
                            <span class="text-xs font-extrabold text-gray-900 group-hover:text-[#3650A2] transition">Lihat Semua Jadwal</span>
                            <span class="text-gray-400 group-hover:text-[#3650A2] group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>

                        <a href="{{ route('counselor.exploration') }}" class="card-shortcut-gradient card-delay-3 w-full p-4.5 rounded-[22px] flex items-center justify-between group">
                            <span class="text-xs font-extrabold text-gray-900 group-hover:text-[#3650A2] transition">Buka Explore</span>
                            <span class="text-gray-400 group-hover:text-[#3650A2] group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Catatan Footer Banner -->
            <x-card variant="interactive" class="glass-card card-delay-3 p-6 !rounded-[28px] flex items-start gap-4 mb-12">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 font-bold border border-amber-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-extrabold text-gray-900 mb-1">Catatan:</h4>
                    <p class="text-xs text-gray-500 leading-relaxed font-medium">Konsultasi online dilanjutkan melalui WhatsApp. Sistem hanya menyimpan informasi jadwal.</p>
                </div>
            </x-card>

        </main>
    </div>

</body>
</html>
