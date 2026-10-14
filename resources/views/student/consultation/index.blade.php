<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi BK - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #1E2D62 100%); }
        .bg-gradient-strong { background: linear-gradient(135deg, #2B4185 0%, #141F43 100%); }

        /* Card Konsultasi dengan Efek Glassmorphism & Hover Interaktif */
        .card-consultation {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(235, 242, 255, 0.85) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid rgba(54, 80, 162, 0.15);
            box-shadow: 0 20px 45px -12px rgba(30, 45, 98, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.9);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }
        .card-consultation:hover {
            transform: translateY(-4px) scale(1.005);
            border-color: #FF7A59;
            box-shadow: 0 25px 50px -15px rgba(255, 122, 89, 0.2), 0 0 0 3px rgba(255, 122, 89, 0.12);
        }

        /* Card Shortcut & Jadwal */
        .card-schedule {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 245, 255, 0.9) 100%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(54, 80, 162, 0.12);
            box-shadow: 0 10px 30px -10px rgba(54, 80, 162, 0.08);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .card-schedule:hover {
            transform: translateY(-3px);
            border-color: rgba(255, 122, 89, 0.4);
            box-shadow: 0 15px 35px -10px rgba(255, 122, 89, 0.15);
        }

        .section-bg {
            background: linear-gradient(135deg, rgba(54, 80, 162, 0.04) 0%, rgba(255, 122, 89, 0.04) 100%);
            border: 1px solid rgba(54, 80, 162, 0.08);
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
                    <span class="text-[10px] font-extrabold text-indigo-400 uppercase tracking-wider mt-1 block">Sistem Peminatan</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-5 space-y-2">
                <div class="px-4 py-2 text-[10px] font-extrabold text-indigo-400 uppercase tracking-widest">Menu Utama</div>

                <!-- Beranda -->
                <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Beranda</span>
                </a>

                <!-- Asesmen -->
                <a href="{{ route('student.assessment.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    <span>Asesmen</span>
                </a>

                <!-- Eksplorasi -->
                <a href="{{ route('student.exploration.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Eksplorasi
                </a>

                <!-- Education Planning -->
                <a href="{{ route('student.planning.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Education Planning
                </a>

                <!-- Konsultasi BK (Aktif) -->
                <a href="{{ route('student.consultation.index') }}" class="flex items-center gap-3.5 px-4.5 py-4 rounded-2xl bg-gradient-strong text-white font-bold text-sm shadow-lg shadow-indigo-900/25 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#FF7A59]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-white group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <span>Konsultasi BK</span>
                </a>

                <!-- Profil -->
                <a href="{{ route('student.profile.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profil
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
                    <span>Keluar (Logout)</span>
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
            <span class="text-sm font-bold text-gray-700 hidden sm:inline">Konsultasi Bimbingan Konseling</span>
        </div>

        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-extrabold text-gray-900 leading-tight">{{ $user->name ?? ' Anisa Lidia Putri' }}</div>
                <div class="text-xs font-semibold text-indigo-500">Siswa</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-gradient-strong text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-900/20 transition-transform hover:scale-105 cursor-pointer">
                {{ strtoupper(substr($user->name ?? 'Anisa Lidia Putri', 0, 2)) }}
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="md:ml-72 pt-28 min-h-screen flex flex-col">
        <main class="p-6 md:p-10 space-y-8 max-w-7xl w-full mx-auto flex-1">

            <!-- Banner Header Halaman Konsultasi -->
            <div class="relative rounded-[40px] overflow-hidden px-8 sm:px-12 py-10 sm:py-14 shadow-lg border border-indigo-100 flex flex-col justify-center">
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset('images/full.png') }}" alt="Background Konsultasi" class="w-full h-full object-cover object-center filter scale-105">
                </div>
                <div class="absolute inset-0 z-5 bg-linear-to-r from-[#141F43]/75 via-[#1E2D62]/85 to-[#3650A2]/80 backdrop-blur-[1px]"></div>
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 relative z-20 text-white">
                    <div class="space-y-3 max-w-2xl">
                        <span class="px-4 py-1.5 bg-[#FF7A59] text-white rounded-full text-xs font-extrabold tracking-wider uppercase shadow-md inline-block">Layanan Bimbingan</span>
                        <h1 class="text-2xl sm:text-4xl font-black tracking-tight text-white drop-shadow-sm">Konsultasi Guru BK 💬</h1>
                        <p class="text-gray-200 text-xs sm:text-sm font-medium leading-relaxed drop-shadow">
                            Punya kebingungan seputar pilihan jurusan, perguruan tinggi, atau kendala belajar? Diskusikan langsung secara online maupun offline dengan guru BK sekolahmu.
                        </p>
                    </div>
                    <!-- Tombol Ajukan Jadwal Baru -->
                    <button onclick="openModal()" class="px-6 py-3.5 bg-[#FF7A59] hover:bg-[#e0684a] text-white font-extrabold text-xs sm:text-sm rounded-2xl shadow-lg shadow-orange-500/30 transition-all hover:scale-105 shrink-0 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        <span>Buat Jadwal Baru</span>
                    </button>
                </div>
            </div>

            <!-- GRID UTAMA: Daftar Jadwal & Info Guru BK -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Kolom Kiri & Tengah: Riwayat / Jadwal Konsultasi Aktif (2 Kolom) -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between px-2">
                        <div>
                            <span class="text-[10px] font-black text-[#FF7A59] uppercase tracking-widest block">Status Sesi</span>
                            <h3 class="text-xl font-black text-[#3650A2]">Jadwal Konsultasi Anda</h3>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">Total: 2 Sesi</span>
                    </div>

                    <div class="space-y-4">
                        <!-- Sesi 1: Status Disetujui / Mendatang (Online) -->
                        <div class="card-consultation rounded-[32px] p-6 sm:p-7 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 group">
                            <div class="absolute right-0 top-0 bottom-0 w-3 bg-[#FF7A59]"></div>
                            <div class="flex items-start gap-4">
                                <div class="w-14 h-14 rounded-2xl bg-indigo-50 border border-indigo-200/80 flex items-center justify-center text-[#3650A2] shrink-0 font-bold shadow-sm">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <div class="space-y-1.5">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h4 class="text-base font-black text-gray-900 group-hover:text-[#3650A2] transition">Diskusi Jalur SNBP &amp; Nilai Rapor</h4>
                                        <span class="px-3 py-0.5 bg-emerald-50 text-emerald-600 border border-emerald-200 text-[10px] font-extrabold rounded-full">Disetujui</span>
                                        <!-- Badge Metode -->
                                        <span class="px-2.5 py-0.5 bg-indigo-50 text-indigo-700 border border-indigo-200 text-[10px] font-bold rounded-md">💻 Online</span>
                                    </div>
                                    <p class="text-xs text-gray-600">Guru Pembimbing: <strong class="text-gray-800">Drs. H. Ahmad Supriatna, M.Pd.</strong></p>
                                    <div class="flex items-center gap-4 text-xs font-semibold text-gray-500 pt-1">
                                        <span class="flex items-center gap-1"><svg class="w-4 h-4 text-[#3650A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> Rabu, 14 Okt 2026</span>
                                        <span class="flex items-center gap-1"><svg class="w-4 h-4 text-[#FF7A59]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> 10.00 WIB</span>
                                    </div>
                                </div>
                            </div>
                            <div class="shrink-0 w-full sm:w-auto flex sm:flex-col justify-end">
                                <a href="#" class="w-full sm:w-auto text-center px-5 py-2.5 bg-[#3650A2] hover:bg-[#1E2D62] text-white text-xs font-extrabold rounded-xl transition shadow-md shadow-indigo-900/20">
                                    Masuk Ruangan &rarr;
                                </a>
                            </div>
                        </div>

                        <!-- Sesi 2: Status Menunggu / Pending (Offline) -->
                        <div class="card-consultation rounded-[32px] p-6 sm:p-7 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 group">
                            <div class="absolute right-0 top-0 bottom-0 w-3 bg-amber-400"></div>
                            <div class="flex items-start gap-4">
                                <div class="w-14 h-14 rounded-2xl bg-indigo-50 border border-indigo-200/80 flex items-center justify-center text-[#3650A2] shrink-0 font-bold shadow-sm">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <div class="space-y-1.5">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h4 class="text-base font-black text-gray-900 group-hover:text-[#3650A2] transition">Konsultasi Pemilihan Jurusan Kuliah</h4>
                                        <span class="px-3 py-0.5 bg-amber-50 text-amber-600 border border-amber-200 text-[10px] font-extrabold rounded-full">Menunggu Konfirmasi</span>
                                        <!-- Badge Metode -->
                                        <span class="px-2.5 py-0.5 bg-amber-50 text-amber-700 border border-amber-200 text-[10px] font-bold rounded-md">🏫 Offline (Tatap Muka di Ruang BK)</span>
                                    </div>
                                    <p class="text-xs text-gray-600">Guru Pembimbing: <strong class="text-gray-800">Siti Maryam, S.Pd.</strong></p>
                                    <div class="flex items-center gap-4 text-xs font-semibold text-gray-500 pt-1">
                                        <span class="flex items-center gap-1"><svg class="w-4 h-4 text-[#3650A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> Jum'at, 16 Okt 2026</span>
                                        <span class="flex items-center gap-1"><svg class="w-4 h-4 text-[#FF7A59]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> 13.30 WIB</span>
                                    </div>
                                </div>
                            </div>
                            <div class="shrink-0 w-full sm:w-auto flex sm:flex-col justify-end">
                                <button class="w-full sm:w-auto text-center px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs font-extrabold rounded-xl transition">
                                    Batalkan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Profil Guru BK & Catatan Penting -->
                <div class="space-y-6">
                    <div class="section-bg rounded-[32px] p-6 space-y-5 shadow-xs">
                        <div class="flex items-center justify-between">
                            <h3 class="text-base font-black text-[#3650A2]">Guru BK Sekolah</h3>
                            <span class="text-[10px] font-extrabold text-[#FF7A59] uppercase tracking-wider">SMK Budi Bakti</span>
                        </div>

                        <!-- Daftar Guru (Menampilkan jam operasional/ketersediaan yang disinkronkan dari dashboard guru) -->
                        <div class="space-y-3">
                            <div class="card-schedule rounded-[22px] p-4 flex items-start gap-3.5">
                                <div class="w-12 h-12 rounded-xl bg-gradient-strong text-white flex items-center justify-center font-black text-sm shrink-0 shadow-sm mt-0.5">
                                    AH
                                </div>
                                <div class="overflow-hidden flex-1">
                                    <h4 class="text-xs font-black text-gray-900 truncate">Drs. H. Ahmad Supriatna, M.Pd.</h4>
                                    <p class="text-[11px] text-indigo-500 font-bold">Koordinator BK</p>
                                    <div class="mt-1 flex items-center justify-between">
                                        <span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 text-[9px] font-extrabold rounded-md">Online / Siap Konsul</span>
                                        <span class="text-[10px] font-bold text-gray-500">08:00 - 15:00 WIB</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-schedule rounded-[22px] p-4 flex items-start gap-3.5">
                                <div class="w-12 h-12 rounded-xl bg-[#3650A2] text-white flex items-center justify-center font-black text-sm shrink-0 shadow-sm mt-0.5">
                                    SM
                                </div>
                                <div class="overflow-hidden flex-1">
                                    <h4 class="text-xs font-black text-gray-900 truncate">Siti Maryam, S.Pd.</h4>
                                    <p class="text-[11px] text-indigo-500 font-bold">Guru BK Kelas XII</p>
                                    <div class="mt-1 flex items-center justify-between">
                                        <span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 text-[9px] font-extrabold rounded-md">Online / Siap Konsul</span>
                                        <span class="text-[10px] font-bold text-gray-500">09:00 - 14:00 WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info / Panduan Singkat -->
                        <div class="p-4 rounded-2xl bg-indigo-50/70 border border-indigo-100 text-xs text-gray-600 space-y-2">
                            <p class="font-bold text-[#3650A2] flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-[#FF7A59]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Catatan Konsultasi
                            </p>
                            <p class="leading-relaxed">Pastikan hadir tepat waktu sesuai jadwal yang disetujui guru pembimbing dan siapkan pertanyaan atau topik yang ingin dibahas sebelumnya.</p>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Modal Buat Jadwal Konsultasi (Dengan Opsi Pilih Metode Online / Offline) -->
    <div id="consultationModal" class="fixed inset-0 bg-black/60 z-50 hidden flex items-center justify-center backdrop-blur-xs px-4">
        <div class="bg-white rounded-[36px] max-w-lg w-full p-8 shadow-2xl border border-indigo-100 space-y-6 relative transform transition-all max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center border-b border-gray-100 pb-4">
                <div>
                    <span class="text-[10px] font-black text-[#FF7A59] uppercase tracking-widest block">Formulir Sesi</span>
                    <h3 class="text-xl font-black text-[#3650A2]">Buat Jadwal Konsultasi</h3>
                </div>
                <button onclick="closeModal()" class="p-2 rounded-xl bg-gray-100 text-gray-500 hover:bg-red-50 hover:text-red-500 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Form disesuaikan mengarah ke route store POST -->
            <form action="{{ route('student.consultation.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">Pilih Guru Pembimbing</label>
                    <select name="teacher_id" class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-indigo-100 text-sm font-semibold text-gray-800 focus:outline-none focus:border-[#3650A2]" required>
                        <option value="">-- Pilih Guru BK --</option>
                        <option value="1">Drs. H. Ahmad Supriatna, M.Pd. (08:00 - 15:00 WIB)</option>
                        <option value="2">Siti Maryam, S.Pd. (09:00 - 14:00 WIB)</option>
                    </select>
                </div>

                <!-- Opsi Metode Konsultasi: Online atau Offline -->
                <div>
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">Metode Konsultasi</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-center gap-3 p-3 rounded-2xl bg-gray-50 border border-indigo-100 cursor-pointer hover:border-[#3650A2] transition">
                            <input type="radio" name="consultation_method" value="online" checked class="text-[#3650A2] focus:ring-[#3650A2]">
                            <div>
                                <span class="text-xs font-black text-gray-800 block">💻 Online</span>
                                <span class="text-[10px] text-gray-500">Via Video Call MyUniv</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-3 rounded-2xl bg-gray-50 border border-indigo-100 cursor-pointer hover:border-[#3650A2] transition">
                            <input type="radio" name="consultation_method" value="offline" class="text-[#3650A2] focus:ring-[#3650A2]">
                            <div>
                                <span class="text-xs font-black text-gray-800 block">🏫 Offline</span>
                                <span class="text-[10px] text-gray-500">Tatap Muka di Ruang BK</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 mb-1.5">Tanggal Konsultasi</label>
                        <input type="date" name="consultation_date" class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-indigo-100 text-sm font-semibold text-gray-800 focus:outline-none focus:border-[#3650A2]" required>
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 mb-1.5">Jam Pilihan (Sesuai Jam Kerja Guru)</label>
                        <input type="time" name="consultation_time" class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-indigo-100 text-sm font-semibold text-gray-800 focus:outline-none focus:border-[#3650A2]" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">Topik / Permasalahan yang Didiskusikan</label>
                    <textarea name="topic" rows="3" placeholder="Tuliskan topik atau pertanyaan singkat..." class="w-full px-4 py-3 rounded-2xl bg-gray-50 border border-indigo-100 text-sm font-semibold text-gray-800 focus:outline-none focus:border-[#3650A2]" required></textarea>
                </div>

                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="px-5 py-3 rounded-xl bg-gray-100 text-gray-600 text-xs font-extrabold hover:bg-gray-200 transition">Batal</button>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-[#3650A2] hover:bg-[#1E2D62] text-white text-xs font-extrabold shadow-md shadow-indigo-900/20 transition">Kirim Pengajuan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        function openModal() {
            document.getElementById('consultationModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('consultationModal').classList.add('hidden');
        }
    </script>
</body>
</html>
