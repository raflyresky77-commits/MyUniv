<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Bank Soal - MyUniv</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahan CDN SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #22346E 100%); }
        /* Custom Polygon Card Shape yang unik & lucu */
        .custom-card-shape {
            clip-path: polygon(0 0, calc(100% - 16px) 0, 100% 16px, 100% 100%, 0 100%);
        }
        .custom-badge-shape {
            clip-path: polygon(8px 0%, 100% 0%, calc(100% - 8px) 100%, 0% 100%);
        }
        /* Tambahan Animasi Transisi Hapus ala Univ */
        .deleting-animation {
            transition: all 0.4s ease-in-out !important;
            opacity: 0 !important;
            transform: scale(0.95) !important;
            background-color: #fee2e2 !important;
        }
    </style>
</head>
<body class="bg-[#F8FBFF] text-gray-800 antialiased">

    <!-- Floating Toast Notification (Pop-up Sukses/Error) -->
    @if(session('success'))
    <div id="toastNotification" class="fixed top-6 right-6 z-50 flex items-center gap-3 bg-emerald-600 text-white px-5 py-3.5 rounded-2xl shadow-xl shadow-emerald-900/20 transform transition-all duration-300 translate-y-0 opacity-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
        <span class="text-xs font-bold">{{ session('success') }}</span>
        <button onclick="closeToast()" class="ml-2 text-emerald-200 hover:text-white font-bold">&times;</button>
    </div>
    @endif

    <!-- Backdrop Gelap Mobile Sidebar -->
    <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 z-40 hidden md:hidden backdrop-blur-xs transition-opacity"></div>

    <!-- Sidebar Navigation (Fixed) -->
    <aside id="mobileSidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-[#E2E8F0] flex flex-col justify-between transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl md:shadow-[4px_0_24px_rgba(54,80,162,0.03)] overflow-y-auto">
        <div>
            <!-- Brand Logo -->
            <div class="px-6 py-6 border-b border-gray-100 flex items-center gap-3.5">
                <div class="h-10 flex items-center justify-center">
                    <img src="{{ asset('images/icon.png') }}" alt="MyUniv Logo" class="h-10 w-auto object-contain">
                </div>
                <div>
                    <span class="text-lg font-black text-[#3650A2] tracking-tight leading-none block">MyUniv</span>
                    <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider mt-1 block">Enterprise OS</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-5 space-y-2">
                <div class="px-4 py-2 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Menu Utama</div>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span>Dashboard Utama</span>
                </a>

                <a href="{{ route('admin.assessments.index') }}" class="flex items-center gap-3.5 px-4.5 py-4 rounded-2xl bg-gradient-myuniv text-white font-bold text-sm shadow-lg shadow-indigo-200/60 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#FF7A59]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Bank Soal Asesmen
                </a>

                <a href="{{ route('admin.universities.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Data Universitas
                </a>

                <a href="{{ route('admin.majors.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                    Program Studi & Jurusan
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Manajemen Pengguna
                </a>
            </nav>
        </div>

        <!-- Logout Section -->
        <div class="p-5 border-t border-gray-100 bg-white">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50/80 rounded-xl transition font-bold group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 group-hover:text-red-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- Top Navbar -->
    <header class="bg-white/90 backdrop-blur-md border-b border-[#E2E8F0] px-6 lg:px-10 py-6 flex justify-between items-center fixed top-0 right-0 left-0 md:left-72 z-40 shadow-xs">
        <div class="flex items-center gap-3">
            <button type="button" onclick="toggleSidebar()" class="md:hidden relative z-50 p-2.5 rounded-xl text-gray-700 bg-gray-100 hover:bg-indigo-50 hover:text-[#3650A2] transition focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <span class="text-xs font-extrabold px-3.5 py-1.5 bg-indigo-50 text-[#3650A2] rounded-xl tracking-wide border border-indigo-100/50">Modul Asesmen</span>
            <span class="text-gray-300 font-light hidden sm:inline">/</span>
            <h1 class="text-sm font-black text-gray-800 tracking-tight hidden sm:inline">Bank Soal & Kuesioner</h1>
        </div>

        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-extrabold text-gray-900 leading-tight">Administrator Utama</div>
                <div class="text-xs font-semibold text-gray-400">admin@myuniv.test</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-gradient-myuniv text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-200/50">AD</div>
        </div>
    </header>

    <!-- Konten Utama -->
    <div class="md:ml-72 pt-28 min-h-screen flex flex-col">
        <main class="px-6 lg:px-10 pb-12 space-y-8 max-w-7xl mx-auto w-full flex-1">

            <!-- Validasi Error -->
            @if($errors->any())
                <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-xs font-bold rounded-2xl shadow-sm">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Header Banner -->
            <div class="bg-gradient-myuniv text-white p-8 sm:p-10 rounded-[28px] shadow-xl shadow-indigo-900/10 relative overflow-hidden flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <!-- Aksen Gradien Oval Dekoratif di Banner -->
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#FF7A59]/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-indigo-400/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-xl">
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1 bg-[#FF7A59] text-white text-xs font-extrabold rounded-full mb-4 shadow-md shadow-orange-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Psikometrik & Minat Bakat
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight mb-2">Daftar Paket Asesmen</h2>
                    <p class="text-indigo-100 text-sm leading-relaxed font-medium">Kelola kategori tes, peminatan siswa, dan atur butir pertanyaan dalam satu halaman interaktif.</p>
                </div>
                <div class="relative z-10">
                    <button onclick="toggleCreateForm()" class="px-6 py-3.5 bg-[#FF7A59] hover:bg-[#e06848] text-white text-xs font-extrabold rounded-2xl shadow-lg shadow-orange-500/30 transition-all flex items-center gap-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        <span>Tambah Paket Asesmen</span>
                    </button>
                </div>
            </div>

            <!-- CARD FORM TAMBAH (Inline Collapse) -->
            <div id="createFormCard" class="bg-white rounded-[24px] border border-[#E2E8F0] shadow-sm p-8 hidden transition-all duration-300">
                <div class="mb-6 flex items-center justify-between border-b border-gray-100 pb-4">
                    <div>
                        <h3 class="text-lg font-black text-[#3650A2] tracking-tight">Konfigurasi Paket & Soal Asesmen Baru</h3>
                        <p class="text-xs text-gray-500 font-medium mt-0.5">Buat paket tes psikometrik baru dan tentukan kategori sub-testnya.</p>
                    </div>
                    <button onclick="toggleCreateForm()" class="text-gray-400 hover:text-gray-600 text-xs font-bold">Tutup &times;</button>
                </div>

                <form action="{{ route('admin.assessments.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Nama Paket Asesmen</label>
                        <input type="text" name="title" required class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-[#3650A2] transition" placeholder="Contoh: Paket Asesmen Komprehensif Kelas XII 2026">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Kategori Utama Tes</label>
                            <select name="category" id="categorySelect" required onchange="toggleSubTests('categorySelect', 'subtestContainer')" class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-[#3650A2] transition">
                                <option value="personality_career">Tes Kepribadian & Karir</option>
                                <option value="learning_style">Tes Gaya Belajar (VARK)</option>
                                <option value="cognitive_ability">Tes Kemampuan / Kognitif</option>
                            </select>
                        </div>
                        <div id="subtestContainer" class="hidden">
                            <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Pilih Sub-Test Kemampuan</label>
                            <select name="subtest_type" class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-[#3650A2] transition">
                                <option value="verbal">1. Verbal Reasoning (Penalaran Verbal)</option>
                                <option value="numerical">2. Numerical Reasoning (Penalaran Numerik)</option>
                                <option value="logical">3. Logical Reasoning (Penalaran Logika)</option>
                                <option value="spatial">4. Spatial Reasoning (Spasial/Abstrak)</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Deskripsi & Instruksi Pengerjaan</label>
                        <textarea name="description" rows="3" class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-[#3650A2] transition" placeholder="Tuliskan petunjuk pengisian soal..."></textarea>
                    </div>
                    <div class="pt-2 flex items-center justify-end gap-3">
                        <button type="button" onclick="toggleCreateForm()" class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl text-xs font-bold hover:bg-gray-200 transition">Batal</button>
                        <button type="submit" class="px-6 py-3 bg-gradient-myuniv text-white rounded-xl text-xs font-bold shadow-lg shadow-indigo-200/60 transition">Simpan Paket &rarr;</button>
                    </div>
                </form>
            </div>

            <!-- Tabel Data Asesmen dengan Kartu Shape & Gradien Oval Estetik -->
            <div class="bg-white rounded-[28px] border border-[#E2E8F0] shadow-sm overflow-hidden relative p-4 sm:p-6 space-y-4">
                <div class="flex flex-col sm:flex-row justify-between gap-4 items-center pb-4 border-b border-gray-100">
                    <form action="{{ route('admin.assessments.index') }}" method="GET" class="flex items-center gap-2 w-full sm:w-auto">
                        <div class="relative w-full sm:w-80">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul asesmen..." class="w-full pl-11 pr-4 py-2.5 bg-[#F8FBFF] border border-[#E2E8F0] rounded-xl text-xs font-semibold focus:outline-none focus:border-[#3650A2] transition">
                        </div>
                        <button type="submit" class="px-4 py-2.5 bg-[#3650A2] hover:bg-[#2c428a] text-white text-xs font-bold rounded-xl shadow-md transition">Cari</button>
                        @if(request('search'))
                            <a href="{{ route('admin.assessments.index') }}" class="px-3 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs font-bold rounded-xl transition">Reset</a>
                        @endif
                    </form>
                    <div class="text-xs font-bold text-gray-400">Total: {{ isset($assessments) ? $assessments->total() : 0 }} Paket Asesmen</div>
                </div>

                <!-- Grid Kartu Asesmen dengan Gradien Oval di Dalamnya -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($assessments as $assessment)
                    <!-- Ditambahkan id unik untuk target animasi delete -->
                    <div id="assessment-card-{{ $assessment->id }}" class="bg-[#F8FBFF] border border-indigo-100/90 p-5 rounded-2xl custom-card-shape shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between relative overflow-hidden group">

                        <!-- Aksen Gradien Oval di Dalam Kartu -->
                        <div class="absolute -right-10 -bottom-10 w-36 h-36 bg-indigo-500/10 rounded-full blur-2xl pointer-events-none group-hover:bg-indigo-500/20 transition duration-500"></div>
                        <div class="absolute -left-10 -top-10 w-36 h-36 bg-[#FF7A59]/10 rounded-full blur-2xl pointer-events-none group-hover:bg-[#FF7A59]/20 transition duration-500"></div>

                        <!-- Aksen Pojok Lucu -->
                        <div class="absolute top-0 right-0 w-8 h-8 bg-[#FF7A59]/15 rounded-bl-2xl flex items-center justify-center text-[#FF7A59] z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>

                        <div class="space-y-3 relative z-10">
                            <div class="flex items-center gap-2 flex-wrap pr-6">
                                <span class="px-3 py-1 bg-indigo-100/80 text-[#3650A2] font-extrabold rounded-lg text-[10px] custom-badge-shape shadow-xs">
                                    {{ $assessment->category ?? 'Umum' }}
                                </span>
                                @if(!empty($assessment->subtest_type))
                                <span class="px-2.5 py-0.5 bg-orange-100 text-[#FF7A59] font-bold rounded-md text-[10px]">
                                    Sub: {{ ucfirst($assessment->subtest_type) }}
                                </span>
                                @endif
                                <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full font-bold text-[9px]">Aktif</span>
                            </div>

                            <div>
                                <h3 class="font-black text-gray-900 text-base tracking-tight leading-snug">{{ $assessment->title }}</h3>
                                <p class="text-gray-500 text-xs mt-1 line-clamp-2 leading-relaxed">{{ $assessment->description ?? 'Tidak ada deskripsi tambahan untuk paket asesmen ini.' }}</p>
                            </div>
                        </div>

                        <div class="pt-4 mt-4 border-t border-indigo-100/60 flex items-center justify-between relative z-10">
                            <div class="text-xs font-extrabold text-[#3650A2] flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-[#FF7A59]"></span>
                                {{ $assessment->questions_count ?? 0 }} Butir Soal
                            </div>

                            <div class="flex items-center gap-1.5">
                                <!-- Tombol Kelola Soal (Modal Pop-up) -->
                                <button onclick="openManageQuestionsModal('{{ $assessment->id }}', '{{ addslashes($assessment->title) }}')" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-[11px] shadow-sm transition">
                                    Kelola Soal
                                </button>
                                <!-- Tombol Edit (Modal Pop-up) -->
                                <button onclick="openEditModal('{{ $assessment->id }}', '{{ addslashes($assessment->title) }}', '{{ $assessment->category }}', '{{ addslashes($assessment->description ?? '') }}', '{{ $assessment->subtest_type ?? '' }}')" class="px-3 py-1.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold rounded-xl text-[11px] transition shadow-xs">
                                    Edit
                                </button>
                                <!-- Tombol Hapus (Di-upgrade dengan Form & SweetAlert2 Identik Univ) -->
                                <form action="{{ route('admin.assessments.destroy', $assessment->id) }}" method="POST" onsubmit="handleDeleteAssessment(event, 'assessment-card-{{ $assessment->id }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 font-bold rounded-xl text-[11px] transition cursor-pointer">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 py-12 text-center text-gray-400 font-semibold bg-gray-50 rounded-2xl">
                        Belum ada data paket asesmen yang tersedia.
                    </div>
                    @endforelse
                </div>

                <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                    <div>Menampilkan data asesmen interaktif</div>
                    <div>{{ $assessments->links() }}</div>
                </div>
            </div>

        </main>
    </div>

    <!-- ================= MODAL 1: KELOLA SOAL (POP-UP) ================= -->
    <div id="manageQuestionsModal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-xs flex items-center justify-center hidden p-4">
        <div class="bg-white w-full max-w-3xl rounded-[28px] shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
            <div class="p-6 bg-gradient-myuniv text-white flex justify-between items-center relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-[#FF7A59]/20 rounded-full blur-2xl pointer-events-none"></div>
                <div class="relative z-10">
                    <h3 id="modalAssessmentTitle" class="text-lg font-black tracking-tight">Kelola Butir Soal</h3>
                    <p class="text-xs text-indigo-100 font-medium">Tambahkan atau hapus pertanyaan untuk paket asesmen ini.</p>
                </div>
                <button onclick="closeManageQuestionsModal()" class="text-white/80 hover:text-white text-lg font-bold p-2 relative z-10">&times;</button>
            </div>

            <div class="p-6 overflow-y-auto space-y-6 flex-1 bg-[#F8FBFF]">
                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-xs space-y-4">
                    <h4 class="text-xs font-extrabold text-[#3650A2] uppercase tracking-wider">+ Tambah Pertanyaan Baru</h4>
                    <form id="addQuestionForm" method="POST" class="space-y-3">
                        @csrf
                        <textarea name="question_text" rows="2" required placeholder="Tuliskan pertanyaan / pernyataan asesmen..." class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs font-medium focus:outline-none focus:border-[#3650A2]"></textarea>
                        <div class="flex justify-end">
                            <button type="submit" class="px-5 py-2 bg-[#3650A2] text-white text-xs font-bold rounded-xl shadow-md hover:bg-indigo-900 transition">Simpan Soal</button>
                        </div>
                    </form>
                </div>

                <div class="space-y-3">
                    <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">Daftar Pertanyaan Tersimpan</h4>
                    <div id="questionsListContainer" class="space-y-2">
                        <div class="p-3 bg-white border border-gray-200 rounded-xl text-xs text-gray-600 flex justify-between items-center">
                            <span>1. Contoh pertanyaan tes psikometrik karir...</span>
                            <button class="text-red-500 font-bold hover:underline">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= MODAL 2: EDIT PAKET ASESMEN (POP-UP DENGAN SUB-TEST) ================= -->
    <div id="editModal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-xs flex items-center justify-center hidden p-4">
        <div class="bg-white w-full max-w-xl rounded-[28px] shadow-2xl overflow-hidden">
            <div class="p-6 bg-[#3650A2] text-white flex justify-between items-center relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-[#FF7A59]/20 rounded-full blur-2xl pointer-events-none"></div>
                <h3 class="text-lg font-black tracking-tight relative z-10">Edit Paket Asesmen</h3>
                <button onclick="closeEditModal()" class="text-white/80 hover:text-white text-lg font-bold p-2 relative z-10">&times;</button>
            </div>
            <form id="editForm" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-1.5">Nama Paket Asesmen</label>
                    <input type="text" id="editTitle" name="title" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-[#3650A2]">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-1.5">Kategori Utama</label>
                        <select name="category" id="editCategory" required onchange="toggleSubTests('editCategory', 'editSubtestContainer')" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-[#3650A2]">
                            <option value="personality_career">Tes Kepribadian & Karir</option>
                            <option value="learning_style">Tes Gaya Belajar (VARK)</option>
                            <option value="cognitive_ability">Tes Kemampuan / Kognitif</option>
                        </select>
                    </div>
                    <div id="editSubtestContainer" class="hidden">
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-1.5">Sub-Test Kemampuan</label>
                        <select name="subtest_type" id="editSubtestType" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-[#3650A2]">
                            <option value="verbal">1. Verbal Reasoning</option>
                            <option value="numerical">2. Numerical Reasoning</option>
                            <option value="logical">3. Logical Reasoning</option>
                            <option value="spatial">4. Spatial Reasoning</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-1.5">Deskripsi</label>
                    <textarea name="description" id="editDescription" rows="3" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-[#3650A2]"></textarea>
                </div>
                <div class="pt-3 flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-xl text-xs font-bold">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-[#3650A2] text-white rounded-xl text-xs font-bold shadow-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script JavaScript Kontrol Pop-up & Animasi Hapus -->
    <script>
        function toggleSidebar() {
            document.getElementById('mobileSidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebarBackdrop').classList.toggle('hidden');
        }

        function toggleCreateForm() {
            const formCard = document.getElementById('createFormCard');
            formCard.classList.toggle('hidden');
            if(!formCard.classList.contains('hidden')) formCard.scrollIntoView({ behavior: 'smooth' });
        }

        function toggleSubTests(selectId, containerId) {
            const categorySelect = document.getElementById(selectId);
            const container = document.getElementById(containerId);
            if (categorySelect && container) {
                if (categorySelect.value === 'cognitive_ability') {
                    container.classList.remove('hidden');
                } else {
                    container.classList.add('hidden');
                }
            }
        }

        // Auto hide toast after 4 seconds
        setTimeout(() => {
            const toast = document.getElementById('toastNotification');
            if(toast) {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }
        }, 4000);

        function closeToast() {
            const toast = document.getElementById('toastNotification');
            if(toast) toast.remove();
        }

        // Modal Kelola Soal
        function openManageQuestionsModal(id, title) {
            document.getElementById('modalAssessmentTitle').innerText = "Kelola Soal: " + title;
            document.getElementById('addQuestionForm').action = "/admin/assessments/" + id + "/questions";
            document.getElementById('manageQuestionsModal').classList.remove('hidden');
        }
        function closeManageQuestionsModal() {
            document.getElementById('manageQuestionsModal').classList.add('hidden');
        }

        // Modal Edit
        function openEditModal(id, title, category, description, subtestType) {
            document.getElementById('editTitle').value = title;
            document.getElementById('editCategory').value = category;
            document.getElementById('editDescription').value = description;

            const subtestSelect = document.getElementById('editSubtestType');
            if (subtestSelect && subtestType) {
                subtestSelect.value = subtestType;
            }

            toggleSubTests('editCategory', 'editSubtestContainer');

            document.getElementById('editForm').action = "/admin/assessments/" + id;
            document.getElementById('editModal').classList.remove('hidden');
        }
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Handler SweetAlert2 & Animasi Hapus Identik Halaman Univ
        function handleDeleteAssessment(event, cardId) {
            event.preventDefault();
            const form = event.target.closest('form');
            const card = document.getElementById(cardId);

            Swal.fire({
                title: 'Hapus Paket Asesmen Ini?',
                text: "Semua data butir soal di dalam paket asesmen ini akan ikut terhapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus Asesmen!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[24px]' }
            }).then((result) => {
                if (result.isConfirmed) {
                    if (card) card.classList.add('deleting-animation');
                    setTimeout(() => {
                        form.submit();
                    }, 400);
                }
            });
        }
    </script>
</body>
</html>
