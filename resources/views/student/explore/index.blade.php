<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eksplorasi Perguruan Tinggi - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-strong { background: linear-gradient(135deg, #3650A2 0%, #1E2D61 100%); }
        .card-glass {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(54, 80, 162, 0.12);
            box-shadow: 0 20px 40px -15px rgba(30, 45, 98, 0.08);
        }
        .card-glass:hover {
            box-shadow: 0 25px 50px -12px rgba(54, 80, 162, 0.18);
            border-color: rgba(255, 122, 89, 0.3);
        }
    </style>
</head>
<body class="bg-[#F4F7FE] text-gray-800 antialiased selection:bg-[#FF7A59] selection:text-white">

    <!-- Backdrop Gelap Mobile Sidebar -->
    <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 md:hidden hidden backdrop-blur-xs transition-opacity"></div>

    <!-- Sidebar Navigation -->
    <aside id="mobileSidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-[#E2E8F0] flex flex-col justify-between transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl md:shadow-[4px_0_24px_rgba(54,80,162,0.05)] overflow-y-auto">
        <div>
            <!-- Brand Logo -->
            <div class="px-6 py-6 border-b border-gray-100 flex items-center gap-3.5">
                <div class="w-11 h-11 flex items-center justify-center bg-indigo-50 rounded-[16px] border border-indigo-200/80 p-1.5 shrink-0 overflow-hidden shadow-sm transition-transform duration-300 hover:scale-105">
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

                <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Beranda</span>
                </a>

                <a href="{{ route('student.assessment.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    <span>Assesmen</span>
                </a>

                <a href="{{ route('student.exploration.index') }}" class="flex items-center gap-3.5 px-4.5 py-4 rounded-2xl bg-gradient-strong text-white font-bold text-sm shadow-lg shadow-indigo-900/25 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#FF7A59]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-white group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>Eksplorasi</span>
                </a>

                <a href="{{ route('student.planning.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    <span>Education Planning</span>
                </a>

                <a href="{{ route('student.consultation.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <span>Konsultasi BK</span>
                </a>

                <a href="{{ route('student.profile.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Profil</span>
                </a>
            </nav>
        </div>

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
            <span class="text-sm font-extrabold text-[#3650A2] hidden sm:inline flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-[#FF7A59] animate-pulse"></span>
                Eksplorasi Perguruan Tinggi &amp; Jurusan
            </span>
        </div>

        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-extrabold text-gray-900 leading-tight">{{ $user->name ?? 'Anisa Lidia' }}</div>
                <div class="text-xs font-semibold text-indigo-500">Siswa</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-gradient-strong text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-900/20">
                {{ strtoupper(substr($user->name ?? 'Anisa Lidia', 0, 2)) }}
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="md:ml-72 pt-28 min-h-screen flex flex-col">
        <main class="p-6 md:p-10 space-y-8 max-w-6xl w-full mx-auto flex-1">

            <!-- Hero Banner Section -->
            <div class="bg-gradient-strong rounded-[32px] p-8 sm:p-10 text-white relative overflow-hidden shadow-xl shadow-indigo-950/15">
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute right-20 top-0 w-32 h-32 bg-[#FF7A59]/20 rounded-full blur-xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl space-y-3">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-bold text-indigo-100">
                        <svg class="w-3.5 h-3.5 text-[#FF7A59]" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.788 0l7-3a1 1 0 000-1.84l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.17 1 1 0.01-1.98c.35.035.7.093 1.05.17V16.5a1 1 0 001 1h8a1 1 0 001-1v-4.148c.35-.077.7-.135 1.05-.17a1 1 0 01.01 1.98 8.969 8.969 0 01-1.05.17v-4.102l1.69-.723a1 1 0 000-1.84l-7-3a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84z"/></svg>
                        Direktori Kampus PTN &amp; PTS Unggulan
                    </span>
                    <h1 class="text-2xl sm:text-4xl font-black tracking-tight leading-tight">Temukan Masa Depanmu di Kampus Impian</h1>
                    <p class="text-xs sm:text-sm text-indigo-100 font-medium leading-relaxed">
                        Jelajahi profil lengkap Perguruan Tinggi Negeri (PTN) dan Swasta (PTS) terbaik termasuk BINUS University, informasi akreditasi, hingga program studi pilihanmu.
                    </p>

                    <!-- Search Input Bar -->
                    <div class="pt-2">
                        <div class="relative max-w-lg">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5 text-[#3650A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </span>
                            <input type="text" id="searchInput" onkeyup="filterUniversities()" placeholder="Cari nama kampus (cth: Binus, UI, ITB), kota, atau jurusan..." class="w-full pl-12 pr-4 py-3.5 bg-white text-gray-900 rounded-2xl font-semibold text-xs shadow-lg focus:outline-none focus:ring-4 focus:ring-[#FF7A59]/30 transition-all placeholder:text-gray-400">
                        </div>
                    </div>
                </div>
            </div>

            <!-- List Perguruan Tinggi (PTN & PTS Termasuk BINUS) -->
            <div class="space-y-6" id="universityList">

                @php
                    $universities = [
                        [
                            'code' => 'binus',
                            'name' => 'BINUS University',
                            'location' => 'Jakarta, Bandung, Malang, Semarang',
                            'type' => 'PTS',
                            'accreditation' => 'Unggul (A)',
                            'program_studi' => 'Computer Science, Information Systems, Desain Komunikasi Visual, Manajemen',
                            'jenjang' => 'S1, S2, S3',
                            'pendaftaran' => 'PMB Binus (Tes Potensi Keberhasilan / Rapor)',
                            'website' => 'https://binus.ac.id',
                            'desc' => 'Perguruan tinggi swasta berkelas dunia dengan keunggulan di bidang teknologi informasi, kreativitas, dan kewirausahaan.',
                            'image' => 'universities/BANNER-BINUS.png',
                        ],
                        [
                            'code' => 'telkom',
                            'name' => 'Telkom University',
                            'location' => 'Bandung, Jawa Barat',
                            'type' => 'PTS',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Teknik Informatika, Teknik Telekomunikasi, Bisnis Digital, Desain Interior',
                            'jenjang' => 'D3, S1, S2',
                            'pendaftaran' => 'Jalur Seleksi Siswa Unggulan (JSS), UTMB',
                            'website' => 'https://telkomuniversity.ac.id',
                            'desc' => 'PTS swasta papan atas peraih predikat kampus swasta terbaik nomor 1 di Indonesia dengan fokus ICT & digital business.',
                            'image' => 'universities/BANNER-TELKOM.jpg',
                        ],
                        [
                            'code' => 'ui',
                            'name' => 'Universitas Indonesia (UI)',
                            'location' => 'Depok, Jawa Barat',
                            'type' => 'PTN',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Ilmu Komputer, Kedokteran, Hukum, Manajemen',
                            'jenjang' => 'D3, S1, S2, S3',
                            'pendaftaran' => 'SNBP, SNBT, SIMAK UI',
                            'website' => 'https://www.ui.ac.id',
                            'desc' => 'Perguruan tinggi negeri berstandar kelas dunia dengan rumpun ilmu sains, kesehatan, dan humaniora.',
                            'image' => 'universities/BANNER-UI.jpg',
                        ],
                        [
                            'code' => 'itb',
                            'name' => 'Institut Teknologi Bandung (ITB)',
                            'location' => 'Bandung, Jawa Barat',
                            'type' => 'PTN',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Teknik Informatika, Teknik Elektro, Arsitektur, Bisnis',
                            'jenjang' => 'S1, S2, S3',
                            'pendaftaran' => 'SNBP, SNBT, Seleksi Mandiri ITB',
                            'website' => 'https://www.itb.ac.id',
                            'desc' => 'Kampus teknik, sains, dan seni terkemuka pencetak innovator dan perintis teknologi bangsa.',
                            'image' => 'universities/BANNER-ITB.jpg',
                        ],
                        [
                            'code' => 'ugm',
                            'name' => 'Universitas Gadjah Mada (UGM)',
                            'location' => 'Yogyakarta',
                            'type' => 'PTN',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Kedokteran, Psikologi, Teknik Industri, Hubungan Internasional',
                            'jenjang' => 'D4, S1, S2, S3',
                            'pendaftaran' => 'SNBP, SNBT, UM UGM',
                            'website' => 'https://www.ugm.ac.id',
                            'desc' => 'Universitas nasional berkelas dunia yang mengakar kuat pada budaya bangsa dan kerakyatan.',
                            'image' => 'universities/BANNER-UGM.jpg',
                        ],
                        [
                            'code' => 'its',
                            'name' => 'Institut Teknologi Sepuluh Nopember (ITS)',
                            'location' => 'Surabaya, Jawa Timur',
                            'type' => 'PTN',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Teknik Sistem Perkapalan, Teknik Komputer, Desain Produk',
                            'jenjang' => 'D4, S1, S2, S3',
                            'pendaftaran' => 'SNBP, SNBT, Seleksi Mandiri ITS',
                            'website' => 'https://www.its.ac.id',
                            'desc' => 'Pusat unggulan riset dan teknologi maritim, industri kreatif, serta rekayasa modern.',
                            'image' => 'universities/BANNER-ITS.jpg',
                        ],
                        [
                            'code' => 'unair',
                            'name' => 'Universitas Airlangga (UNAIR)',
                            'location' => 'Surabaya, Jawa Timur',
                            'type' => 'PTN',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Kedokteran Gigi, Farmasi, Ilmu Komunikasi, Akuntansi',
                            'jenjang' => 'D3, S1, S2, S3',
                            'pendaftaran' => 'SNBP, SNBT, Mandiri UNAIR',
                            'website' => 'https://www.unair.ac.id',
                            'desc' => 'Perguruan tinggi terdepan di bidang kedokteran, kesehatan, farmasi, dan ilmu sosial.',
                            'image' => 'universities/BANNER-UNAIR.jpg',
                        ],
                        [
                            'code' => 'ipb',
                            'name' => 'Institut Pertanian Bogor (IPB)',
                            'location' => 'Bogor, Jawa Barat',
                            'type' => 'PTN',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Agronomi & Hortikultura, Kedokteran Hewan, Statistika',
                            'jenjang' => 'D4, S1, S2, S3',
                            'pendaftaran' => 'SNBP, SNBT, Mandiri IPB (SM-IPB)',
                            'website' => 'https://www.ipb.ac.id',
                            'desc' => 'Kampus pelopor inovasi pertanian, biosains, kelautan, dan sosio-ekonomi agribisnis.',
                            'image' => 'universities/BANNER-IPB.jpg',
                        ],
                        [
                            'code' => 'trisakti',
                            'name' => 'Universitas Trisakti',
                            'location' => 'Jakarta Barat',
                            'type' => 'PTS',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Kedokteran, Teknik Perminyakan, Arsitektur, Hukum',
                            'jenjang' => 'D3, S1, S2, S3',
                            'pendaftaran' => 'Saringan Masuk Usakti (SMUS)',
                            'website' => 'https://www.trisakti.ac.id',
                            'desc' => 'Universitas swasta bersejarah dengan kualitas jejang fakultas teknik dan kedokteran yang sangat kuat.',
                            'image' => 'universities/BANNER-TRISAKTI.jpg',
                        ],
                        [
                            'code' => 'undip',
                            'name' => 'Universitas Diponegoro (UNDIP)',
                            'location' => 'Semarang, Jawa Tengah',
                            'type' => 'PTN',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Ilmu Hukum, Kedokteran, Teknik Sipil, Administrasi Publik',
                            'jenjang' => 'D4, S1, S2, S3',
                            'pendaftaran' => 'SNBP, SNBT, UM Undip',
                            'website' => 'https://www.undip.ac.id',
                            'desc' => 'Universitas riset mandiri yang menghasilkan lulusan berkualitas tinggi dan berdaya saing global.',
                            'image' => 'universities/BANNER-UNDIP.jpg',
                        ],
                        [
                            'code' => 'unpad',
                            'name' => 'Universitas Padjadjaran (UNPAD)',
                            'location' => 'Sumedang, Jawa Barat',
                            'type' => 'PTN',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Ilmu Komunikasi, Kedokteran, Sastra Inggris, Hubungan Masyarakat',
                            'jenjang' => 'D4, S1, S2, S3',
                            'pendaftaran' => 'SNBP, SNBT, SMUP Unpad',
                            'website' => 'https://www.unpad.ac.id',
                            'desc' => 'Kampus unggulan di bidang sosio-humaniora, kesehatan, serta sains terapan.',
                            'image' => 'universities/BANNER-UNPAD.jpg',
                        ],
                        [
                            'code' => 'upi',
                            'name' => 'Universitas Pendidikan Indonesia (UPI)',
                            'location' => 'Bandung, Jawa Barat',
                            'type' => 'PTN',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Pendidikan Arsitektur, Pendidikan Teknik Informatika, Psikologi',
                            'jenjang' => 'D4, S1, S2, S3',
                            'pendaftaran' => 'SNBP, SNBT, Seleksi Mandiri UPI',
                            'website' => 'https://www.upi.edu',
                            'desc' => 'Pelopor pendidikan tinggi kependidikan terdepan di Indonesia yang menghasilkan pendidik profesional.',
                            'image' => 'universities/BANNER-UPI.jpg',
                        ],
                        [
                            'code' => 'ub',
                            'name' => 'Universitas Brawijaya (UB)',
                            'location' => 'Malang, Jawa Timur',
                            'type' => 'PTN',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Teknik Informatika, Ilmu Administrasi Bisnis, Kedokteran',
                            'jenjang' => 'D3, S1, S2, S3',
                            'pendaftaran' => 'SNBP, SNBT, Seleksi Mandiri UB',
                            'website' => 'https://ub.ac.id',
                            'desc' => 'Universitas unggul berwawasan enterpreneurship dengan riset ilmu pengetahuan dan teknologi.',
                            'image' => 'universities/BANNER-UB.jpg',
                        ],
                        [
                            'code' => 'unnes',
                            'name' => 'Universitas Negeri Semarang (UNNES)',
                            'location' => 'Semarang, Jawa Tengah',
                            'type' => 'PTN',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Pendidikan Guru, Hukum, Ilmu Olahraga, Sastra',
                            'jenjang' => 'D3, S1, S2, S3',
                            'pendaftaran' => 'SNBP, SNBT, Seleksi Mandiri UNNES',
                            'website' => 'https://unnes.ac.id',
                            'desc' => 'Universitas berwawasan konservasi dan bereputasi internasional yang menghasilkan lulusan berkarakter.',
                            'image' => 'universities/BANNER-UNNES.png',
                        ],
                        [
                            'code' => 'uny',
                            'name' => 'Universitas Negeri Yogyakarta (UNY)',
                            'location' => 'Yogyakarta',
                            'type' => 'PTN',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Pendidikan Teknik Mesin, Pendidikan Luar Biasa, Manajemen',
                            'jenjang' => 'D4, S1, S2, S3',
                            'pendaftaran' => 'SNBP, SNBT, Seleksi Mandiri UNY',
                            'website' => 'https://www.uny.ac.id',
                            'desc' => 'Kampus kependidikan dan keahlian vokasi unggulan yang melahirkan SDM cerdas dan mandiri.',
                            'image' => 'universities/BANNER-UNY.jpg',
                        ],
                        [
                            'code' => 'unhas',
                            'name' => 'Universitas Hasanuddin (UNHAS)',
                            'location' => 'Makassar, Sulawesi Selatan',
                            'type' => 'PTN',
                            'accreditation' => 'Unggul',
                            'program_studi' => 'Kedokteran, Teknik Kelautan, Hubungan Internasional',
                            'jenjang' => 'D4, S1, S2, S3',
                            'pendaftaran' => 'JALUR MANDIRI UNHAS',
                            'website' => 'https://www.unhas.ac.id',
                            'desc' => 'Pusat pengembangan maritim, benua maritim Indonesia, serta sains dan teknologi kawasan timur.',
                            'image' => 'universities/BANNER-UNHAS.png',
                        ],
                    ];
                @endphp

                @foreach($universities as $univ)
                <div class="university-card card-glass rounded-[32px] p-6 sm:p-8 flex flex-col md:flex-row gap-6 items-center justify-between transition-all duration-300 hover:-translate-y-1" data-search="{{ strtolower($univ['name'] . ' ' . $univ['location'] . ' ' . $univ['program_studi'] . ' ' . $univ['pendaftaran'] . ' ' . $univ['type']) }}">

                    <!-- Kiri: Foto Kampus dengan Tag img & Tombol Web -->
                    <div class="w-full md:w-5/12 flex flex-col gap-4">
                        <div class="w-full h-48 rounded-2xl relative overflow-hidden shadow-md shrink-0 group bg-gray-200">
                            @if($univ['code'] == 'itb')
                                <img src="{{ asset('images/universities/BANNER-ITB.jpg') }}" alt="{{ $univ['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @elseif($univ['code'] == 'undip')
                                <img src="{{ asset('images/universities/BANNER-UNDIP.jpg') }}" alt="{{ $univ['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="{{ asset('images/' . $univ['image']) }}" alt="{{ $univ['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif

                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#141F43]/90 via-[#141F43]/30 to-transparent"></div>

                            <!-- Badge Atas -->
                            <div class="absolute top-3 left-3 right-3 flex justify-between items-center z-10">
                                <span class="px-2.5 py-1 {{ $univ['type'] == 'PTS' ? 'bg-[#FF7A59]/90 text-white' : 'bg-white/20 text-white' }} backdrop-blur-md rounded-lg text-[10px] font-extrabold uppercase tracking-wider border border-white/20 shadow-xs">
                                    {{ $univ['type'] }} • Akreditasi {{ $univ['accreditation'] }}
                                </span>
                            </div>

                            <!-- Keterangan Bawah di atas Foto -->
                            <div class="absolute bottom-3 left-3 right-3 z-10 text-white">
                                <h4 class="text-sm font-extrabold tracking-tight drop-shadow-sm">{{ $univ['name'] }}</h4>
                                <p class="text-[11px] text-indigo-100 flex items-center gap-1 mt-0.5 font-medium">
                                    <svg class="w-3 h-3 text-[#FF7A59]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $univ['location'] }}
                                </p>
                            </div>
                        </div>

                        <!-- TOMBOL KUNJUNGI WEBSITE -->
                        <a href="{{ $univ['website'] }}" target="_blank" class="w-full py-3.5 px-5 bg-gradient-to-r from-[#FF7A59] to-[#FF5233] text-white rounded-2xl text-xs font-black shadow-lg shadow-orange-500/30 hover:opacity-95 hover:scale-[1.02] transition-all flex items-center justify-center gap-2.5 uppercase tracking-wider group">
                            <span>Kunjungi Website Resmi</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>

                    <!-- Kanan: Informasi Detail -->
                    <div class="w-full md:w-7/12 space-y-4 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-lg sm:text-xl font-black text-gray-900 tracking-tight">{{ $univ['name'] }}</h3>
                                <span class="px-2 py-0.5 text-[10px] font-extrabold rounded-md {{ $univ['type'] == 'PTS' ? 'bg-orange-100 text-[#FF7A59]' : 'bg-indigo-100 text-[#3650A2]' }}">{{ $univ['type'] }}</span>
                            </div>
                            <p class="text-xs text-gray-500 font-medium mt-0.5">{{ $univ['location'] }}</p>
                        </div>

                        <!-- Tabel Detail Informasi -->
                        <div class="bg-white/90 rounded-2xl border border-indigo-100 overflow-hidden shadow-xs">
                            <table class="w-full text-left text-xs">
                                <tbody class="divide-y divide-gray-100">
                                    <tr class="hover:bg-indigo-50/40 transition">
                                        <td class="py-2.5 px-4 font-bold text-gray-600 w-1/3">Jenis Institusi</td>
                                        <td class="py-2.5 px-4 font-semibold text-gray-900">{{ $univ['type'] == 'PTS' ? 'Perguruan Tinggi Swasta (PTS)' : 'Perguruan Tinggi Negeri (PTN)' }}</td>
                                    </tr>
                                    <tr class="hover:bg-indigo-50/40 transition">
                                        <td class="py-2.5 px-4 font-bold text-gray-600">Akreditasi</td>
                                        <td class="py-2.5 px-4 font-semibold text-emerald-600 flex items-center gap-1.5">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                            {{ $univ['accreditation'] }}
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-indigo-50/40 transition">
                                        <td class="py-2.5 px-4 font-bold text-gray-600">Lokasi Kampus</td>
                                        <td class="py-2.5 px-4 font-medium text-gray-900">{{ $univ['location'] }}</td>
                                    </tr>
                                    <tr class="hover:bg-indigo-50/40 transition">
                                        <td class="py-2.5 px-4 font-bold text-gray-600">Program Studi</td>
                                        <td class="py-2.5 px-4 font-medium text-gray-900">{{ $univ['program_studi'] }}</td>
                                    </tr>
                                    <tr class="hover:bg-indigo-50/40 transition">
                                        <td class="py-2.5 px-4 font-bold text-gray-600">Jenjang</td>
                                        <td class="py-2.5 px-4 font-medium text-gray-900">{{ $univ['jenjang'] }}</td>
                                    </tr>
                                    <tr class="hover:bg-indigo-50/40 transition">
                                        <td class="py-2.5 px-4 font-bold text-gray-600">Pendaftaran</td>
                                        <td class="py-2.5 px-4 font-extrabold text-[#3650A2]">{{ $univ['pendaftaran'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tentang Universitas -->
                        <div>
                            <span class="text-[11px] font-extrabold text-indigo-400 uppercase tracking-wider block">Tentang Kampus</span>
                            <p class="text-xs text-gray-600 font-medium mt-1 leading-relaxed">
                                {{ $univ['desc'] }}
                            </p>
                        </div>
                    </div>

                </div>
                @endforeach

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

        // Live search filter implementation
        function filterUniversities() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.university-card');

            cards.forEach(card => {
                const searchData = card.getAttribute('data-search');
                if (searchData.includes(input)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
