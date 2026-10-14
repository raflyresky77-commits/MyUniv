<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #1E2D62 100%); }
        .bg-gradient-strong { background: linear-gradient(135deg, #2B4185 0%, #141F43 100%); }

        /* VARIASI 1: Card Khusus dengan Gradient & Efek Cahaya Ekspresif (Asesmen) */
        .card-expressive {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(235, 242, 255, 0.85) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid rgba(54, 80, 162, 0.15);
            box-shadow: 0 15px 35px -10px rgba(30, 45, 98, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.9);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }
        .card-expressive::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, rgba(255, 122, 89, 0.25) 0%, rgba(54, 80, 162, 0.1) 50%, transparent 70%);
            border-radius: 50%;
            transition: all 0.5s ease;
            transform: scale(0.8);
            pointer-events: none;
        }
        .card-expressive:hover {
            transform: translateY(-5px) scale(1.005);
            border-color: #FF7A59;
            background: linear-gradient(135deg, rgba(255, 255, 255, 1) 0%, rgba(255, 238, 232, 0.5) 50%, rgba(230, 238, 255, 0.9) 100%);
            box-shadow: 0 20px 45px -12px rgba(255, 122, 89, 0.2), 0 0 0 3px rgba(255, 122, 89, 0.12);
        }
        .card-expressive:hover::before {
            transform: scale(1.2);
            background: radial-gradient(circle, rgba(255, 122, 89, 0.4) 0%, rgba(54, 80, 162, 0.15) 60%, transparent 80%);
        }

        /* Card Quote (Gradient Lucu, Statis) */
        .card-quote-static {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(235, 242, 255, 0.85) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid rgba(54, 80, 162, 0.15);
            box-shadow: 0 15px 35px -10px rgba(30, 45, 98, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.9);
            position: relative;
            overflow: hidden;
        }

        /* Card Shortcut dengan Gradient Halus & Efek Interaktif */
        .card-shortcut-gradient {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 245, 255, 0.9) 100%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(54, 80, 162, 0.12);
            box-shadow: 0 8px 25px -8px rgba(54, 80, 162, 0.08);
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
            transform: translateY(-4px);
            border-color: rgba(255, 122, 89, 0.4);
            background: linear-gradient(135deg, rgba(255, 255, 255, 1) 0%, rgba(255, 242, 238, 0.6) 100%);
            box-shadow: 0 15px 30px -10px rgba(255, 122, 89, 0.18);
        }
        .card-shortcut-gradient:hover::after {
            opacity: 1;
        }

        /* Background Wrapper untuk Section Shortcut */
        .section-shortcut-bg {
            background: linear-gradient(135deg, rgba(54, 80, 162, 0.04) 0%, rgba(255, 122, 89, 0.04) 100%);
            border: 1px solid rgba(54, 80, 162, 0.08);
            position: relative;
            overflow: hidden;
        }
        .section-shortcut-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 80% 20%, rgba(54, 80, 162, 0.05) 0%, transparent 40%),
                        radial-gradient(circle at 20% 80%, rgba(255, 122, 89, 0.05) 0%, transparent 40%);
            pointer-events: none;
        }

        /* Animasi Melayang Halus untuk Maskot Quote */
        @keyframes floatMascot {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-6px) rotate(1.5deg); }
        }
        .mascot-float {
            animation: floatMascot 4s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-[#F4F7FE] text-gray-800 antialiased">

    <!-- Backdrop Gelap saat Sidebar Mobile Terbuka -->
    <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 md:hidden hidden backdrop-blur-xs transition-opacity"></div>

    <!-- Sidebar Navigation -->
    <aside id="mobileSidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-[#E2E8F0] flex flex-col justify-between transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out shadow-xl md:shadow-[4px_0_20px_rgba(54,80,162,0.04)] overflow-y-auto">
        <div>
            <!-- Brand Logo -->
            <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3">
                <div class="w-10 h-10 flex items-center justify-center bg-indigo-50 rounded-[12px] border border-indigo-200/80 p-1.5 shrink-0 shadow-xs">
                    <img src="{{ asset('images/icon.png') }}" alt="Logo MyUniv" class="w-full h-full object-contain">
                </div>
                <div>
                    <span class="text-base font-black text-[#3650A2] tracking-tight leading-none block">MyUniv</span>
                    <span class="text-[9px] font-extrabold text-indigo-400 uppercase tracking-wider mt-1 block">Sistem Peminatan</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5">
                <div class="px-3 py-1.5 text-[10px] font-extrabold text-indigo-400 uppercase tracking-widest">Menu Utama</div>

                <!-- Beranda (Aktif) -->
                <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-gradient-strong text-white font-bold text-xs shadow-md shadow-indigo-900/20 transition-all relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#FF7A59]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-0.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Beranda</span>
                </a>

                <!-- Asesmen -->
                <a href="{{ route('student.assessment.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-xs transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:text-[#3650A2]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    <span>Asesmen</span>
                </a>

                <!-- Eksplorasi -->
                <a href="{{ route('student.exploration.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-xs transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:text-[#3650A2]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>Eksplorasi</span>
                </a>

                <!-- Education Planning -->
                <a href="{{ route('student.planning.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-xs transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:text-[#3650A2]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    <span>Education Planning</span>
                </a>

                <!-- Konsultasi BK -->
                <a href="{{ route('student.consultation.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-xs transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:text-[#3650A2]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <span>Konsultasi BK</span>
                </a>

                <!-- Profil -->
                <a href="{{ route('student.profile.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-xs transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:text-[#3650A2]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Profil</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer & Tombol Logout -->
        <div class="p-4 border-t border-gray-100 bg-white">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-red-600 hover:bg-red-50 font-bold text-xs transition-all group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Keluar (Logout)</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Top Navbar -->
    <header class="bg-white/90 backdrop-blur-md border-b border-[#E2E8F0] px-6 lg:px-8 py-4 flex justify-between items-center fixed top-0 right-0 left-0 md:left-72 z-40 shadow-xs">
        <div class="flex items-center gap-3">
            <button type="button" onclick="toggleSidebar()" class="md:hidden p-2 rounded-xl text-gray-700 bg-gray-100 hover:bg-indigo-50 hover:text-[#3650A2] transition focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <span class="text-xs font-extrabold text-[#3650A2] uppercase tracking-wider">Dashboard Utama</span>
        </div>

        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <div class="text-xs font-extrabold text-gray-900 leading-tight">{{ $user->name ?? 'Siswa' }}</div>
                <div class="text-[10px] font-semibold text-indigo-500">Siswa Aktif</div>
            </div>
            <div class="w-9 h-9 rounded-xl bg-gradient-strong text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-900/20">
                {{ strtoupper(substr($user->name ?? 'S', 0, 2)) }}
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="md:ml-72 pt-24 min-h-screen flex flex-col">
        <main class="p-6 md:p-8 space-y-6 max-w-6xl w-full mx-auto flex-1">

            <!-- FITUR ONBOARDING / PERINGATAN PROFIL BELUM LENGKAP -->
            @php
                $isProfileIncomplete = empty($user->phone) || empty($user->class);
            @endphp

            @if($isProfileIncomplete)
                <div class="rounded-2xl bg-amber-50 border border-amber-200 p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-xs">
                    <div class="flex items-center gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 border border-amber-200 flex items-center justify-center text-amber-600 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-extrabold text-amber-900">Lengkapi Data Profil &amp; Onboarding Kamu!</h4>
                            <p class="text-[11px] text-amber-700 mt-0.5">Nomor telepon atau kelas kamu belum diisi. Lengkapi data diri untuk hasil peminatan dan rekomendasi yang akurat.</p>
                        </div>
                    </div>
                    <a href="{{ route('student.profile.index') }}" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-[11px] font-bold rounded-xl transition shadow-xs whitespace-nowrap">
                        Lengkapi Sekarang &rarr;
                    </a>
                </div>
            @endif

            <!-- Greeting Banner -->
            <div class="relative rounded-[28px] overflow-hidden px-6 sm:px-10 py-8 sm:py-10 shadow-md border border-indigo-100 flex flex-col justify-center">
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset('images/header.png') }}" alt="Background Kampus" class="w-full h-full object-cover object-center filter scale-105">
                </div>
                <div class="absolute inset-0 z-5 bg-linear-to-r from-[#141F43]/75 via-[#1E2D62]/85 to-[#3650A2]/80 backdrop-blur-[1px]"></div>
                <div class="space-y-2.5 relative z-20 max-w-xl text-white">
                    <span class="px-3 py-1 bg-[#FF7A59] text-white rounded-full text-[10px] font-extrabold tracking-wider uppercase shadow-xs inline-block">Selamat Datang</span>
                    <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white drop-shadow-xs">Halo, {{ $user->name ?? 'Siswa' }}! 👋</h1>
                    <p class="text-gray-200 text-xs sm:text-sm font-medium leading-relaxed">
                        Temukan potensi dan arah pilihan perguruan tinggi terbaikmu bersama MyUniv.
                    </p>
                </div>
            </div>

            <!-- TOP CARDS: Asesmen (Card Expressive) & Quote Motivasi -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <!-- Ringkasan Asesmen Card dengan Efek Gradasi Ekspresif -->
                <a href="{{ route('student.assessment.index') }}" class="card-expressive rounded-[28px] p-6 flex flex-col sm:flex-row items-center justify-between gap-5 group">
                    <div class="absolute right-0 top-0 bottom-0 w-2.5 bg-[#FF7A59]"></div>
                    <div class="relative w-24 h-24 flex items-center justify-center shrink-0">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-gray-200" stroke-width="3.5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="text-[#FF7A59]" stroke-dasharray="0, 100" stroke-width="3.5" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        </svg>
                        <div class="absolute text-center">
                            <span class="text-base font-black text-[#3650A2]">0%</span>
                        </div>
                    </div>
                    <div class="flex-1 text-center sm:text-left space-y-2 relative z-10">
                        <div>
                            <h3 class="text-sm font-black text-gray-900 group-hover:text-[#3650A2] transition">Asesmen Peminatan</h3>
                            <p class="text-[11px] text-gray-600 mt-0.5 leading-relaxed">Selesaikan asesmen psikometrik untuk membuka rekomendasi kampus dan jurusan.</p>
                        </div>
                        <span class="inline-block px-4 py-2 bg-[#3650A2] text-white text-[11px] font-extrabold rounded-xl group-hover:bg-[#1E2D62] transition shadow-xs">
                            Mulai Asesmen &rarr;
                        </span>
                    </div>
                </a>

                <!-- Quote Motivasi Card -->
                <div class="card-quote-static rounded-[28px] p-6 flex items-center justify-between gap-5">
                    <div class="absolute left-0 top-0 bottom-0 w-2.5 bg-[#3650A2]"></div>
                    <div class="space-y-2 relative z-10">
                        <p class="text-xs sm:text-sm text-gray-800 font-extrabold italic leading-snug">
                            "Masa depanmu ditentukan oleh apa yang kamu mulai dan persiapkan hari ini. Tetap semangat!"
                        </p>
                        <p class="text-[10px] font-black text-[#3650A2] uppercase tracking-wider">&mdash; Mauny, Maskot MyUniv</p>
                    </div>
                    <div class="w-20 h-20 bg-indigo-50/80 border border-indigo-100 rounded-2xl flex items-center justify-center shrink-0 shadow-xs overflow-hidden p-2 relative z-10">
                        <img src="{{ asset('images/3d.0.png') }}" alt="Mauny" class="w-full h-full object-contain mascot-float">
                    </div>
                </div>
            </div>

            <!-- SHORTCUT MENU DENGAN GRADASI HALUS -->
            <div class="section-shortcut-bg rounded-[32px] p-6 space-y-4 shadow-xs">
                <div class="flex items-center justify-between px-1">
                    <div>
                        <span class="text-[9px] font-black text-[#FF7A59] uppercase tracking-widest block">Akses Cepat</span>
                        <h3 class="text-base font-black text-[#3650A2]">Eksplorasi Fitur</h3>
                    </div>
                    <span class="text-[11px] font-semibold text-gray-500 hidden sm:inline">Pilih menu navigasi di bawah</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Card 1: Eksplorasi -->
                    <a href="{{ route('student.exploration.index') }}" class="card-shortcut-gradient rounded-2xl p-5 flex flex-col justify-between space-y-4 group">
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-[#3650A2] mb-3 group-hover:bg-[#3650A2] group-hover:text-white transition-all shadow-2xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <h4 class="text-xs font-extrabold text-gray-900 group-hover:text-[#3650A2] transition">Eksplorasi Kampus</h4>
                            <p class="text-[11px] text-gray-600 mt-0.5 leading-relaxed">Cari jurusan &amp; universitas idaman.</p>
                        </div>
                        <span class="text-[11px] font-extrabold text-[#FF7A59] flex items-center gap-1 group-hover:translate-x-1 transition-transform">Buka &rarr;</span>
                    </a>

                    <!-- Card 2: Planning -->
                    <a href="{{ route('student.planning.index') }}" class="card-shortcut-gradient rounded-2xl p-5 flex flex-col justify-between space-y-4 group">
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-[#3650A2] mb-3 group-hover:bg-[#3650A2] group-hover:text-white transition-all shadow-2xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                            </div>
                            <h4 class="text-xs font-extrabold text-gray-900 group-hover:text-[#3650A2] transition">Education Planning</h4>
                            <p class="text-[11px] text-gray-600 mt-0.5 leading-relaxed">Atur target persiapan belajarmu.</p>
                        </div>
                        <span class="text-[11px] font-extrabold text-[#FF7A59] flex items-center gap-1 group-hover:translate-x-1 transition-transform">Buka &rarr;</span>
                    </a>

                    <!-- Card 3: Konsultasi -->
                    <a href="{{ route('student.consultation.index') }}" class="card-shortcut-gradient rounded-2xl p-5 flex flex-col justify-between space-y-4 group">
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-[#3650A2] mb-3 group-hover:bg-[#3650A2] group-hover:text-white transition-all shadow-2xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                            </div>
                            <h4 class="text-xs font-extrabold text-gray-900 group-hover:text-[#3650A2] transition">Konsultasi BK</h4>
                            <p class="text-[11px] text-gray-600 mt-0.5 leading-relaxed">Diskusi online dengan Guru BK.</p>
                        </div>
                        <span class="text-[11px] font-extrabold text-[#FF7A59] flex items-center gap-1 group-hover:translate-x-1 transition-transform">Buka &rarr;</span>
                    </a>

                    <!-- Card 4: Hasil Peminatan -->
                    <a href="{{ route('student.assessment.result') }}" class="card-shortcut-gradient rounded-2xl p-5 flex flex-col justify-between space-y-4 group">
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-[#3650A2] mb-3 group-hover:bg-[#3650A2] group-hover:text-white transition-all shadow-2xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <h4 class="text-xs font-extrabold text-gray-900 group-hover:text-[#3650A2] transition">Hasil Peminatan</h4>
                            <p class="text-[11px] text-gray-600 mt-0.5 leading-relaxed">Tinjau hasil analisis psikometrik.</p>
                        </div>
                        <span class="text-[11px] font-extrabold text-[#FF7A59] flex items-center gap-1 group-hover:translate-x-1 transition-transform">Buka &rarr;</span>
                    </a>
                </div>
            </div>

            <!-- REKOMENDASI & ARTIKEL -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pb-8">
                <!-- Kolom Kiri & Tengah: Rekomendasi Kampus (Terkunci jika belum asesmen) -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex justify-between items-center">
                        <h3 class="text-base font-black text-[#3650A2]">Rekomendasi untuk Kamu</h3>
                        <a href="{{ route('student.exploration.index') }}" class="text-xs font-extrabold text-[#FF7A59] hover:underline">Lihat Semua</a>
                    </div>

                    @php $hasCompletedAssessment = false; @endphp

                    @if(!$hasCompletedAssessment)
                        <div class="card-shortcut-gradient rounded-[28px] p-8 text-center space-y-4 border border-indigo-100 bg-white/80">
                            <div class="w-14 h-14 bg-indigo-50 border border-indigo-100 rounded-2xl mx-auto flex items-center justify-center text-[#3650A2]">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <div class="space-y-1 max-w-md mx-auto">
                                <h4 class="text-sm font-black text-[#3650A2]">Rekomendasi Kampus Terkunci</h4>
                                <p class="text-xs text-gray-500 leading-relaxed">Selesaikan asesmen peminatan terlebih dahulu agar sistem dapat mencocokkan dan menampilkan rekomendasi universitas yang paling sesuai dengan potensi dirimu.</p>
                            </div>
                            <div>
                                <a href="{{ route('student.assessment.index') }}" class="inline-flex items-center px-5 py-2.5 bg-[#FF7A59] hover:bg-[#e86949] text-white text-xs font-extrabold rounded-xl shadow-md shadow-coral-500/20 transition">
                                    Mulai Asesmen Sekarang &rarr;
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="rounded-[24px] overflow-hidden flex flex-col justify-between group bg-white border border-indigo-100 shadow-xs hover:shadow-md transition">
                                <div class="relative h-36 w-full overflow-hidden bg-gray-100">
                                    <img src="{{ asset('images/BANNER-ITB.jpg') }}" alt="Banner Kampus" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/10 to-white"></div>
                                    <div class="absolute -bottom-2 left-4 w-10 h-10 rounded-xl bg-white p-1 shadow-md border border-indigo-100 flex items-center justify-center z-10">
                                        <img src="{{ asset('images/LOGO-ITB.png') }}" alt="Logo Univ" class="w-full h-full object-contain">
                                    </div>
                                    <span class="absolute top-2.5 right-2.5 px-2.5 py-0.5 bg-[#3650A2]/90 backdrop-blur-md text-white text-[9px] font-extrabold rounded-full">Teknologi</span>
                                </div>
                                <div class="p-5 pt-4 space-y-3 flex-1 flex flex-col justify-between">
                                    <div class="space-y-0.5">
                                        <h4 class="text-xs font-black text-gray-900 group-hover:text-[#3650A2] transition">Teknik Informatika</h4>
                                        <p class="text-[11px] text-gray-600 line-clamp-2 leading-relaxed">Prospek karier luas di era digital &amp; pengembangan software.</p>
                                    </div>
                                    <div class="pt-3 border-t border-gray-100 flex justify-between items-center">
                                        <span class="text-[11px] font-semibold text-gray-500">Kesesuaian</span>
                                        <span class="font-black text-white text-[10px] px-2.5 py-1 bg-gradient-strong rounded-lg">88% Match</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Kolom Kanan: Artikel & Tips -->
                <div class="space-y-3">
                    <div class="flex justify-between items-center px-1">
                        <h3 class="text-base font-black text-[#3650A2]">Artikel &amp; Tips</h3>
                        <span class="text-[11px] font-semibold text-gray-500">Update</span>
                    </div>

                    <div class="space-y-3">
                        <div onclick="openArticleModal('jalur')" class="card-shortcut-gradient rounded-2xl p-4 space-y-2.5 group cursor-pointer transition hover:border-[#FF7A59]/40">
                            <div class="flex items-center justify-between">
                                <span class="px-2 py-0.5 bg-indigo-50 text-[#3650A2] border border-indigo-100 text-[9px] font-extrabold rounded-full group-hover:bg-[#3650A2] group-hover:text-white transition">Jalur Masuk</span>
                                <span class="text-[10px] text-gray-500 font-bold">4 min</span>
                            </div>
                            <div class="space-y-1">
                                <h4 class="text-xs font-black text-gray-900 group-hover:text-[#3650A2] transition leading-snug">
                                    Pemberitahuan Berbagai Cara Masuk ke Perguruan Tinggi
                                </h4>
                                <p class="text-[11px] text-gray-600 line-clamp-2 leading-relaxed">
                                    Kenali jalur SNBP, SNBT, hingga Mandiri untuk memilih strategi pendaftaran terbaik.
                                </p>
                            </div>
                        </div>

                        <div onclick="openArticleModal('strategi')" class="card-shortcut-gradient rounded-2xl p-4 space-y-2.5 group cursor-pointer transition hover:border-[#FF7A59]/40">
                            <div class="flex items-center justify-between">
                                <span class="px-2 py-0.5 bg-orange-50 text-[#FF7A59] border border-orange-100 text-[9px] font-extrabold rounded-full group-hover:bg-[#FF7A59] group-hover:text-white transition">Strategi</span>
                                <span class="text-[10px] text-gray-500 font-bold">3 min</span>
                            </div>
                            <div class="space-y-1">
                                <h4 class="text-xs font-black text-gray-900 group-hover:text-[#3650A2] transition leading-snug">
                                    Strategi Lolos Seleksi Masuk Perguruan Tinggi Impian
                                </h4>
                                <p class="text-[11px] text-gray-600 line-clamp-2 leading-relaxed">
                                    Pelajari tips manajemen waktu belajar dan pemetaan nilai rapor semester awal.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL ARTIKEL INTERAKTIF -->
    <div id="articleModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden transition-opacity">
        <div class="bg-white rounded-[28px] max-w-xl w-full max-h-[85vh] overflow-y-auto p-6 sm:p-7 space-y-5 shadow-2xl relative border border-indigo-100">
            <button onclick="closeArticleModal()" class="absolute top-5 right-5 w-8 h-8 rounded-full bg-gray-100 hover:bg-rose-50 hover:text-rose-600 flex items-center justify-center transition text-gray-500 font-bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div id="modalContentBody" class="space-y-3 pt-1"></div>
            <div class="pt-3 border-t border-gray-100 flex justify-end">
                <button onclick="closeArticleModal()" class="px-5 py-2 bg-[#3650A2] hover:bg-[#1E2D62] text-white text-xs font-bold rounded-xl transition shadow-xs">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        const articlesData = {
            jalur: {
                category: "Jalur Masuk",
                categoryClass: "bg-indigo-50 text-[#3650A2] border-indigo-100",
                readTime: "4 min read",
                title: "Pemberitahuan Berbagai Cara Masuk ke Perguruan Tinggi",
                content: `
                    <p class="text-xs text-gray-600 leading-relaxed font-medium">
                        Memilih jalur masuk perguruan tinggi adalah langkah awal krusial. Secara umum terdapat tiga jalur utama penerimaan mahasiswa baru di Indonesia:
                    </p>
                    <div class="space-y-2.5 pt-1">
                        <div class="p-3.5 rounded-xl bg-indigo-50/50 border border-indigo-100 space-y-1">
                            <h5 class="text-xs font-black text-[#3650A2]">1. SNBP (Seleksi Berdasarkan Prestasi)</h5>
                            <p class="text-[11px] text-gray-600 leading-relaxed">Berfokus pada rekam jejak akademik nilai rapor semester 1 sampai 5 serta prestasi pendukung.</p>
                        </div>
                        <div class="p-3.5 rounded-xl bg-indigo-50/50 border border-indigo-100 space-y-1">
                            <h5 class="text-xs font-black text-[#3650A2]">2. SNBT (Seleksi Berdasarkan Tes)</h5>
                            <p class="text-[11px] text-gray-600 leading-relaxed">Melalui UTBK dengan materi TPS, penalaran matematika, literasi bahasa Indonesia dan Inggris.</p>
                        </div>
                    </div>
                `
            },
            strategi: {
                category: "Tips & Strategi",
                categoryClass: "bg-orange-50 text-[#FF7A59] border-orange-100",
                readTime: "3 min read",
                title: "Strategi Lolos Seleksi Masuk Perguruan Tinggi Impian",
                content: `
                    <p class="text-xs text-gray-600 leading-relaxed font-medium">
                        Impian kuliah di kampus idaman membutuhkan perencanaan dan strategi belajar yang matang:
                    </p>
                    <div class="space-y-2.5 pt-1">
                        <div class="p-3.5 rounded-xl bg-orange-50/40 border border-orange-100 space-y-1">
                            <h5 class="text-xs font-black text-[#FF7A59]">1. Pemetaan Nilai Rapor</h5>
                            <p class="text-[11px] text-gray-600 leading-relaxed">Riset daya tampung dan rata-rata nilai (passing grade) pada jurusan impianmu di MyUniv.</p>
                        </div>
                    </div>
                `
            }
        };

        function openArticleModal(type) {
            const article = articlesData[type];
            if (!article) return;

            const modalBody = document.getElementById('modalContentBody');
            modalBody.innerHTML = `
                <div class="flex items-center justify-between">
                    <span class="px-2.5 py-0.5 border text-[9px] font-extrabold rounded-full ${article.categoryClass}">${article.category}</span>
                    <span class="text-[11px] text-gray-500 font-bold">${article.readTime}</span>
                </div>
                <h2 class="text-lg sm:text-xl font-black text-[#3650A2] tracking-tight leading-snug">
                    ${article.title}
                </h2>
                <div class="space-y-2 pt-1">
                    ${article.content}
                </div>
            `;

            document.getElementById('articleModal').classList.remove('hidden');
        }

        function closeArticleModal() {
            document.getElementById('articleModal').classList.add('hidden');
        }
    </script>
</body>
</html>
