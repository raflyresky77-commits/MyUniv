<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asesmen Peminatan - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #1E2D62 100%); }
        .bg-gradient-strong { background: linear-gradient(135deg, #2B4185 0%, #141F43 100%); }

        /* Kartu dengan Depth Kuat & Kontras Warna Lebih Solid */
        .card-interactive-strong {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(54, 80, 162, 0.12);
            box-shadow: 0 20px 45px -12px rgba(30, 45, 98, 0.12), 0 0 0 1px rgba(54, 80, 162, 0.04);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .card-interactive-strong:hover {
            transform: translateY(-6px) scale(1.01);
            border-color: rgba(54, 80, 162, 0.4);
            box-shadow: 0 35px 65px -15px rgba(54, 80, 162, 0.22), 0 0 0 2px rgba(255, 122, 89, 0.2);
        }

        /* Animasi Melayang Halus untuk Maskot */
        @keyframes floatMascot {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(1.5deg); }
        }
        .mascot-float {
            animation: floatMascot 4s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-[#F4F7FE] text-gray-800 antialiased">

    <!-- Backdrop Gelap Sidebar Mobile -->
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

                <!-- Assesmen (Aktif) -->
                <a href="{{ route('student.assessment.index') }}" class="flex items-center gap-3.5 px-4.5 py-4 rounded-2xl bg-gradient-strong text-white font-bold text-sm shadow-lg shadow-indigo-900/25 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#FF7A59]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-white group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    <span>Assesmen</span>
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

                <!-- Konsultasi BK -->
                <a href="{{ route('student.consultation.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    Konsultasi BK
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
            <span class="text-sm font-bold text-gray-700 hidden sm:inline">Dashboard Asesmen Siswa</span>
        </div>

        <!-- Profil Header di Pojok Kanan Atas -->
        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-extrabold text-gray-900 leading-tight">{{ auth()->user()->name }}</div>
                <div class="text-xs font-semibold text-indigo-500">Siswa</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-gradient-strong text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-900/20 transition-transform hover:scale-105 cursor-pointer">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="md:ml-72 pt-28 min-h-screen flex flex-col">
        <main class="p-6 md:p-10 space-y-8 max-w-7xl w-full mx-auto flex-1">

            <!-- Bagian Judul Header dengan Maskot Nimbul (Pop-out 3D) di Kanan -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gradient-to-r from-white via-[#EEF3FF] to-[#E2ECFF] px-8 sm:px-12 py-8 sm:py-10 rounded-[40px] border border-indigo-100 shadow-sm relative overflow-visible transition-all">

                <!-- Efek Cahaya Background -->
                <div class="absolute -left-10 -bottom-10 w-48 h-48 bg-indigo-200/40 rounded-full blur-3xl pointer-events-none"></div>

                <!-- Teks Bagian Kiri (Lebih optimal mengisi ruang tengah dengan max-w-2xl) -->
                <div class="space-y-4 relative z-10 max-w-2xl">
                    <span class="px-4 py-1.5 bg-[#3650A2] text-white rounded-full text-xs font-extrabold tracking-wider uppercase shadow-xs">Pusat Asesmen</span>
                    <h1 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight">Kenali Potensi Dirimu</h1>
                    <p class="text-gray-600 text-sm sm:text-base font-medium leading-relaxed">
                        Pilih dan selesaikan rangkaian tes minat, bakat, kemampuan, serta kepribadian kariermu untuk rekomendasi masa depan terbaik.
                    </p>
                </div>

                <!-- Maskot Mauny Nimbul di Sebelah Kanan (Digeser sedikit ke dalam/tengah) -->
                <div class="relative z-20 flex justify-center md:justify-end shrink-0 -mt-8 md:-mt-12 -mb-12 md:-mb-16 md:mr-4 pointer-events-none">
                    <div class="relative w-48 sm:w-56 md:w-72 aspect-square flex items-center justify-center">
                        <!-- Efek Backdrop Glow di Bawah Maskot -->
                        <div class="absolute inset-x-4 bottom-2 h-6 bg-indigo-900/20 rounded-full blur-md"></div>

                        <!-- Gambar Maskot dengan Efek Floating & Drop Shadow Pekat agar Terasa Nimbul -->
                        <img src="{{ asset('images/3d.0.png') }}" alt="Maskot Mauny" class="w-full h-full object-contain mascot-float filter drop-shadow-[0_20px_25px_rgba(30,45,98,0.25)] hover:scale-105 transition-transform duration-300">
                    </div>
                </div>

            </div>

            <!-- Progress Keseluruhan Card dengan Warna Strong -->
            <div class="card-interactive-strong rounded-[36px] p-7 sm:p-8 space-y-4 relative overflow-hidden group">
                <div class="absolute right-0 top-0 bottom-0 w-3.5 bg-gradient-to-b from-[#3650A2] to-[#FF7A59]"></div>
                <div class="flex justify-between items-center">
                    <span class="text-sm font-extrabold text-gray-900 flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center text-[#3650A2] transition-transform group-hover:rotate-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        Progress Keseluruhan Asesmen
                    </span>
                    <span class="text-xs font-extrabold px-4 py-1.5 bg-indigo-50 text-[#3650A2] rounded-full border border-indigo-200">66% Selesai</span>
                </div>
                <div class="w-full bg-gray-100 h-3.5 rounded-full overflow-hidden p-0.5 border border-indigo-50">
                    <div class="bg-gradient-to-r from-[#3650A2] via-indigo-600 to-[#FF7A59] h-full rounded-full transition-all duration-700 shadow-sm" style="width: 66%;"></div>
                </div>
                <div class="text-xs font-bold text-gray-500">2 dari 3 tes telah diselesaikan dengan baik</div>
            </div>

            <!-- Grid 3 Kartu Asesmen Kuat & Interaktif -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- 1. Tes Minat & Bakat -->
                <div class="card-interactive-strong rounded-[40px] p-7 flex flex-col justify-between group relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-100/60 rounded-full blur-3xl group-hover:bg-indigo-200/90 transition-all duration-500"></div>
                    <div class="space-y-5 relative z-10">
                        <div class="flex justify-between items-center border-b border-indigo-100/60 pb-4">
                            <span class="text-xs font-extrabold text-[#3650A2] uppercase tracking-wider">Modul 01</span>
                            <span class="px-3 py-1 bg-emerald-100/80 text-emerald-800 rounded-xl text-[10px] font-extrabold uppercase tracking-wide border border-emerald-200 flex items-center gap-1.5 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Selesai
                            </span>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-xl font-black text-gray-900 group-hover:text-[#3650A2] transition-colors">Tes Minat &amp; Bakat</h3>
                            <p class="text-xs text-gray-600 leading-relaxed">Mengetahui bidang minat spesifik dan kecenderungan bakat utamamu untuk masa depan.</p>
                        </div>
                        <div class="bg-indigo-50/60 border border-indigo-100 p-4 rounded-2xl space-y-1 shadow-2xs">
                            <div class="text-xs font-extrabold text-[#3650A2]">Hasil Tersimpan</div>
                            <div class="text-[11px] text-gray-500 font-medium">Diperbarui minggu ini</div>
                        </div>
                    </div>
                    <div class="pt-8 relative z-10 flex justify-end">
                        <a href="{{ route('student.assessment.minat-bakat') }}" class="w-full text-center px-5 py-3 bg-gray-100 hover:bg-[#3650A2] hover:text-white text-gray-700 text-xs font-extrabold rounded-2xl transition-all duration-300 border border-gray-200 shadow-2xs">
                            Mulai Lagi
                        </a>
                    </div>
                </div>

                <!-- 2. Tes Kemampuan (Highlight Utama dengan Coral Kuat) -->
                <div class="card-interactive-strong rounded-[40px] p-7 flex flex-col justify-between group relative overflow-hidden border-2 border-[#3650A2]/30 shadow-xl">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-orange-100/80 rounded-full blur-3xl group-hover:bg-orange-200 transition-all duration-500"></div>
                    <div class="space-y-5 relative z-10">
                        <div class="flex justify-between items-center border-b border-indigo-100/60 pb-4">
                            <span class="text-xs font-extrabold text-[#FF7A59] uppercase tracking-wider">Modul 02</span>
                            <span class="px-3 py-1 bg-amber-100 text-amber-900 rounded-xl text-[10px] font-extrabold uppercase tracking-wide border border-amber-200 flex items-center gap-1.5 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600 animate-ping"></span> Belum
                            </span>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-xl font-black text-gray-900 group-hover:text-[#FF7A59] transition-colors">Tes Kemampuan</h3>
                            <p class="text-xs text-gray-600 leading-relaxed">Mengukur tingkat kognitif, kemampuan numerik, abstrak, serta problem solving-mu.</p>
                        </div>
                        <div class="bg-white border border-indigo-100 p-4 rounded-2xl space-y-2.5 shadow-xs">
                            <div class="flex justify-between items-center">
                                <ul class="text-xs font-bold text-gray-700 space-y-1">
                                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#3650A2]"></span> Abstrak &amp; Logika</li>
                                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#3650A2]"></span> Numerik</li>
                                </ul>
                                <span class="px-2.5 py-1 bg-indigo-100/80 border border-indigo-200 rounded-xl text-[11px] font-extrabold text-[#3650A2]">40 Menit</span>
                            </div>
                        </div>
                    </div>
                    <div class="pt-8 relative z-10 flex justify-end">
                        <a href="{{ route('student.assessment.kemampuan') }}" class="w-full text-center px-6 py-3.5 bg-[#FF7A59] hover:bg-[#3650A2] text-white text-xs font-extrabold rounded-2xl transition-all duration-300 shadow-md shadow-orange-500/25 hover:shadow-indigo-900/30 hover:scale-[1.02]">
                            Mulai Tes Sekarang
                        </a>
                    </div>
                </div>

                <!-- 3. Tes Kepribadian Karier -->
                <div class="card-interactive-strong rounded-[40px] p-7 flex flex-col justify-between group relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-100/60 rounded-full blur-3xl group-hover:bg-indigo-200/90 transition-all duration-500"></div>
                    <div class="space-y-5 relative z-10">
                        <div class="flex justify-between items-center border-b border-indigo-100/60 pb-4">
                            <span class="text-xs font-extrabold text-[#3650A2] uppercase tracking-wider">Modul 03</span>
                            <span class="px-3 py-1 bg-emerald-100/80 text-emerald-800 rounded-xl text-[10px] font-extrabold uppercase tracking-wide border border-emerald-200 flex items-center gap-1.5 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> Selesai
                            </span>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-xl font-black text-gray-900 group-hover:text-[#3650A2] transition-colors">Tes Kepribadian Karier</h3>
                            <p class="text-xs text-gray-600 leading-relaxed">Mengetahui tipe kepribadian dan lingkungan kerja yang paling selaras dengan karaktermu.</p>
                        </div>
                        <div class="bg-indigo-50/60 border border-indigo-100 p-4 rounded-2xl space-y-1 shadow-2xs">
                            <div class="text-xs font-extrabold text-[#3650A2]">Hasil Tersimpan</div>
                            <div class="text-[11px] text-gray-500 font-medium">Tipe: Realistis - Investigatif</div>
                        </div>
                    </div>
                    <div class="pt-8 relative z-10 flex justify-end">
                        <a href="{{ route('student.assessment.kepribadian') }}" class="w-full text-center px-5 py-3 bg-gray-100 hover:bg-[#3650A2] hover:text-white text-gray-700 text-xs font-extrabold rounded-2xl transition-all duration-300 border border-gray-200 shadow-2xs">
                            Mulai Lagi
                        </a>
                    </div>
                </div>

            </div>

            <!-- Footer Bantuan / Konsultasi BK dengan Nuansa Kuat -->
            <div class="w-full card-interactive-strong rounded-[40px] p-7 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-sm group">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#3650A2] to-[#1E2D62] text-white flex items-center justify-center font-extrabold shrink-0 shadow-md shadow-indigo-900/20 transition-transform group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    </div>
                    <div class="space-y-1">
                        <div class="text-base font-extrabold text-gray-900 group-hover:text-[#3650A2] transition-colors">Butuh panduan atau interpretasi hasil asesmen?</div>
                        <div class="text-xs text-gray-600 font-medium leading-relaxed">Jadwalkan sesi diskusi langsung bersama Guru Bimbingan Konseling (BK) sekolahmu untuk mendapatkan insight mendalam.</div>
                    </div>
                </div>
                <a href="{{ route('student.consultation.index') }}" class="px-7 py-3.5 bg-[#3650A2] hover:bg-[#1E2D62] text-white text-xs font-extrabold rounded-2xl transition-all duration-300 shadow-md shadow-indigo-900/25 hover:scale-105 shrink-0">
                    Hubungi Guru BK
                </a>
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
