<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js untuk Interaksi UI -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4FAFF; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen font-['Plus_Jakarta_Sans'] text-[#2F3136] flex antialiased" x-data="{ sidebarOpen: false, profileDropdown: false }">

    <!-- MOBILE SIDEBAR BACKDROP -->
    <div x-show="sidebarOpen" x-cloak class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-xs md:hidden" @click="sidebarOpen = false" x-transition.opacity></div>

    <!-- SIDEBAR -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-[#C9D7EE] flex flex-col justify-between transition-transform duration-300 ease-in-out md:translate-x-0 md:static shadow-xs">
        <div>
            <!-- Logo & Brand -->
            <div class="p-6 flex items-center justify-between border-b border-[#C9D7EE]">
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 flex items-center justify-center bg-[#F4FAFF] rounded-[10px] border border-[#C9D7EE] p-2">
                        <span class="text-[#3650A2] font-extrabold text-xl">M</span>
                    </div>
                    <div>
                        <h2 class="text-base font-extrabold tracking-wide text-[#3650A2]">MyUniv</h2>
                        <p class="text-[11px] text-[#6E7178]">Sistem Peminatan Siswa</p>
                    </div>
                </div>
                <!-- Close Button Mobile -->
                <button @click="sidebarOpen = false" class="md:hidden text-[#6E7178] hover:text-[#3650A2] p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Navigasi Menu Sesuai Wireframe -->
            <nav class="p-4 space-y-2 text-sm font-medium">
                <a href="{{ route('student.dashboard') }}" class="w-full flex items-center gap-3.5 px-4 py-3 rounded-[10px] bg-[#F4FAFF] text-[#3650A2] font-bold transition">
                    <svg class="w-5 h-5 text-[#3650A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <a href="#" class="w-full flex items-center gap-3.5 px-4 py-3 rounded-[10px] text-[#6E7178] hover:bg-[#F4FAFF] hover:text-[#3650A2] transition">
                    <svg class="w-5 h-5 text-[#6E7178]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    Assesmen
                </a>
                <a href="#" class="w-full flex items-center gap-3.5 px-4 py-3 rounded-[10px] text-[#6E7178] hover:bg-[#F4FAFF] hover:text-[#3650A2] transition">
                    <svg class="w-5 h-5 text-[#6E7178]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Eksplorasi
                </a>
                <a href="#" class="w-full flex items-center gap-3.5 px-4 py-3 rounded-[10px] text-[#6E7178] hover:bg-[#F4FAFF] hover:text-[#3650A2] transition">
                    <svg class="w-5 h-5 text-[#6E7178]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    Education Planning
                </a>
                <a href="#" class="w-full flex items-center gap-3.5 px-4 py-3 rounded-[10px] text-[#6E7178] hover:bg-[#F4FAFF] hover:text-[#3650A2] transition">
                    <svg class="w-5 h-5 text-[#6E7178]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    Konsultasi BK
                </a>
                <a href="#" class="w-full flex items-center gap-3.5 px-4 py-3 rounded-[10px] text-[#6E7178] hover:bg-[#F4FAFF] hover:text-[#3650A2] transition">
                    <svg class="w-5 h-5 text-[#6E7178]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profil
                </a>
            </nav>
        </div>

        <!-- Slot Kartu Samping / Hiasan Sesuai Wireframe -->
        <div class="p-4 m-4 bg-[#F4FAFF] border border-[#C9D7EE] rounded-[10px] h-36"></div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Top Navbar -->
        <header class="h-20 bg-white border-b border-[#C9D7EE] px-6 sm:px-8 flex items-center justify-between sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-4 w-full max-w-md">
                <button @click="sidebarOpen = true" class="md:hidden text-[#3650A2] p-2 rounded-[6px] hover:bg-[#F4FAFF] transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <!-- Search Bar -->
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-[#6E7178]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" placeholder="Cari Jurusan, universitas, atau artikel..." class="w-full bg-white text-[#2F3136] text-[14px] rounded-[6px] border border-[#C9D7EE] pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20 focus:border-[#3650A2] transition">
                </div>
            </div>

            <!-- Profile Widget -->
            <div class="relative" @click.away="profileDropdown = false">
                <button @click="profileDropdown = !profileDropdown" class="flex items-center gap-3 p-1.5 rounded-[10px] hover:bg-[#F4FAFF] transition">
                    <div class="text-right hidden sm:block">
                        <span class="block text-[14px] font-bold text-[#2F3136]">{{ $user->name ?? 'Anggia Tresa' }}</span>
                        <span class="block text-[12px] text-[#6E7178]">Siswa</span>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#3650A2] text-white font-bold flex items-center justify-center border border-[#C9D7EE]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="profileDropdown" x-cloak class="absolute right-0 mt-2 w-48 bg-white border border-[#C9D7EE] rounded-[10px] shadow-lg py-2 text-sm z-50">
                    <a href="#" class="block px-4 py-2 text-[#2F3136] hover:bg-[#F4FAFF]">Profil Saya</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">Keluar</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Body Content -->
        <main class="p-6 sm:p-8 space-y-6">

            <!-- Greeting Banner -->
            <div>
                <h1 class="text-[29px] font-bold text-[#3650A2]">Halo, {{ explode(' ', $user->name)[0] ?? 'Anggia' }}!</h1>
                <p class="text-[16px] text-[#6E7178] mt-1">Siap melanjutkan perjalanan menuju masa depanmu?</p>
            </div>

            <!-- Top Grid Cards: Asesmen & Motivasi -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Ringkasan Asesmen Card -->
                <div class="bg-white border border-[#C9D7EE] rounded-[10px] p-6 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xs">
                    <div class="relative w-32 h-32 flex items-center justify-center">
                        <!-- Progress Circle Simpel menggunakan SVG -->
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-[#C9D7EE]" stroke-width="3.5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="text-[#FF7A59]" stroke-dasharray="30, 100" stroke-width="3.5" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        </svg>
                        <div class="absolute text-center">
                            <span class="text-xl font-bold text-[#3650A2]">30%</span>
                        </div>
                    </div>
                    <div class="flex-1 text-center sm:text-left space-y-3">
                        <div>
                            <h3 class="text-[18px] font-semibold text-[#2F3136]">Belum Mengerjakan</h3>
                            <p class="text-[14px] text-[#6E7178] mt-1">Temukan minat dan potensi dirimu sekarang.</p>
                        </div>
                        <a href="#" class="inline-block px-4 py-2 bg-[#6E7178] text-[#F4FAFF] text-[14px] font-semibold rounded-[6px] hover:bg-[#3650A2] transition">
                            Mulai Asesmen
                        </a>
                    </div>
                </div>

                <!-- Quote Motivasi / Maskot Card -->
                <div class="bg-white border border-[#C9D7EE] rounded-[10px] p-6 flex items-center justify-between gap-4 shadow-xs">
                    <div class="space-y-2">
                        <p class="text-[14px] text-[#2F3136] italic">"Setiap langkah kecil hari ini, membawa kamu lebih dekat ke masa depan yang kamu impikan."</p>
                        <p class="text-[12px] font-bold text-[#3650A2]">- MyUniv</p>
                    </div>
                    <!-- Ilustrasi Sederhana / Maskot -->
                    <div class="w-20 h-20 bg-[#F4FAFF] border border-[#C9D7EE] rounded-[10px] flex items-center justify-center shrink-0">
                        <div class="w-0 h-0 border-x-[16px] border-x-transparent border-b-[28px] border-b-[#FF7A59]"></div>
                    </div>
                </div>
            </div>

            <!-- Shortcut Menu Section (Lanjutan dari sini) -->
            <div class="space-y-4">
                <h3 class="text-[23px] font-semibold text-[#3650A2]">Lanjutan dari sini</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Card 1 -->
                    <div class="bg-white border border-[#C9D7EE] rounded-[10px] p-5 flex flex-col justify-between space-y-4 shadow-xs hover:border-[#3650A2] transition">
                        <div>
                            <div class="w-8 h-8 rounded-[6px] bg-[#F4FAFF] border border-[#C9D7EE] flex items-center justify-center text-[#3650A2] mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <h4 class="text-[14px] font-bold text-[#2F3136]">Temukan jurusan & universitas</h4>
                            <p class="text-[12px] text-[#6E7178] mt-1">Cari berdasarkan minat, lokasi, dan kebutuhan.</p>
                        </div>
                        <a href="#" class="text-[14px] font-semibold text-[#FF7A59] flex items-center gap-1 hover:underline">Buka &gt;</a>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white border border-[#C9D7EE] rounded-[10px] p-5 flex flex-col justify-between space-y-4 shadow-xs hover:border-[#3650A2] transition">
                        <div>
                            <div class="w-8 h-8 rounded-[6px] bg-[#F4FAFF] border border-[#C9D7EE] flex items-center justify-center text-[#3650A2] mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                            </div>
                            <h4 class="text-[14px] font-bold text-[#2F3136]">Susun rencana pendidikan</h4>
                            <p class="text-[12px] text-[#6E7178] mt-1">Atur target, checklist, dan persiapanmu.</p>
                        </div>
                        <a href="#" class="text-[14px] font-semibold text-[#FF7A59] flex items-center gap-1 hover:underline">Buka &gt;</a>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white border border-[#C9D7EE] rounded-[10px] p-5 flex flex-col justify-between space-y-4 shadow-xs hover:border-[#3650A2] transition">
                        <div>
                            <div class="w-8 h-8 rounded-[6px] bg-[#F4FAFF] border border-[#C9D7EE] flex items-center justify-center text-[#3650A2] mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                            </div>
                            <h4 class="text-[14px] font-bold text-[#2F3136]">Diskusi dengan Guru BK</h4>
                            <p class="text-[12px] text-[#6E7178] mt-1">Ajukan konsultasi online atau offline.</p>
                        </div>
                        <a href="#" class="text-[14px] font-semibold text-[#FF7A59] flex items-center gap-1 hover:underline">Buka &gt;</a>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-white border border-[#C9D7EE] rounded-[10px] p-5 flex flex-col justify-between space-y-4 shadow-xs hover:border-[#3650A2] transition">
                        <div>
                            <div class="w-8 h-8 rounded-[6px] bg-[#F4FAFF] border border-[#C9D7EE] flex items-center justify-center text-[#3650A2] mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <h4 class="text-[14px] font-bold text-[#2F3136]">Lihat Hasil Peminatan</h4>
                            <p class="text-[12px] text-[#6E7178] mt-1">Tinjau hasil dan rekomendasi jurusan.</p>
                        </div>
                        <a href="#" class="text-[14px] font-semibold text-[#FF7A59] flex items-center gap-1 hover:underline">Buka &gt;</a>
                    </div>
                </div>
            </div>

            <!-- Bottom Section: Rekomendasi Untukmu & Artikel Terbaru -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Rekomendasi Untukmu (2 Kolom di LG) -->
                <div class="lg:col-span-2 space-y-4">
                    <h3 class="text-[23px] font-semibold text-[#3650A2]">Rekomendasi untukmu</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @forelse($recommendations as $rec)
                            <div class="bg-white border border-[#C9D7EE] rounded-[10px] p-4 flex flex-col justify-between space-y-3 shadow-xs">
                                <div class="w-full h-28 bg-[#F4FAFF] border border-[#C9D7EE] rounded-[6px]"></div>
                                <div>
                                    <h4 class="text-[14px] font-bold text-[#2F3136]">{{ $rec->major_name ?? 'Nama Jurusan' }}</h4>
                                    <p class="text-[12px] text-[#6E7178] mt-1">Deskripsi singkat jurusan tersebut.</p>
                                </div>
                            </div>
                        @empty
                            <!-- Dummy default sesuai wireframe jika data kosong -->
                            @for($i = 0; $i < 3; $i++)
                                <div class="bg-white border border-[#C9D7EE] rounded-[10px] p-4 flex flex-col justify-between space-y-3 shadow-xs">
                                    <div class="w-full h-28 bg-[#F4FAFF] border border-[#C9D7EE] rounded-[6px]"></div>
                                    <div>
                                        <h4 class="text-[14px] font-bold text-[#2F3136]">Nama Jurusan</h4>
                                        <p class="text-[12px] text-[#6E7178] mt-1">Deskripsi singkat jurusan tersebut.</p>
                                    </div>
                                </div>
                            @endfor
                        @endforelse
                    </div>
                </div>

                <!-- Artikel Terbaru (1 Kolom di LG) -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-[23px] font-semibold text-[#3650A2]">Artikel Terbaru</h3>
                        <a href="#" class="text-[12px] font-bold text-[#FF7A59] hover:underline">Lihat Semua</a>
                    </div>
                    <div class="bg-white border border-[#C9D7EE] rounded-[10px] p-4 space-y-4 shadow-xs">
                        <div class="flex gap-3 items-center border-b border-[#C9D7EE] pb-3">
                            <div class="w-16 h-12 bg-[#F4FAFF] border border-[#C9D7EE] rounded-[6px] shrink-0"></div>
                            <div>
                                <h5 class="text-[12px] font-bold text-[#2F3136] leading-snug">Tips Memilih Jurusan yang Sesuai Dengan Minat</h5>
                                <span class="text-[10px] text-[#6E7178]">12 Sep 2026</span>
                            </div>
                        </div>
                        <div class="flex gap-3 items-center border-b border-[#C9D7EE] pb-3">
                            <div class="w-16 h-12 bg-[#F4FAFF] border border-[#C9D7EE] rounded-[6px] shrink-0"></div>
                            <div>
                                <h5 class="text-[12px] font-bold text-[#2F3136] leading-snug">Mengenai Jalur Masuk Universitas Tahun 2027</h5>
                                <span class="text-[10px] text-[#6E7178]">12 Sep 2026</span>
                            </div>
                        </div>
                        <div class="flex gap-3 items-center">
                            <div class="w-16 h-12 bg-[#F4FAFF] border border-[#C9D7EE] rounded-[6px] shrink-0"></div>
                            <div>
                                <h5 class="text-[12px] font-bold text-[#2F3136] leading-snug">Cara Menyusun Rencana Pendidikan yang Efektif</h5>
                                <span class="text-[10px] text-[#6E7178]">12 Sep 2026</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

</body>
</html>
