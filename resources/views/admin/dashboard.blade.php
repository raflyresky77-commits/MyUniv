<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MyUniv</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #22346E 100%); }
        .glass-card { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); }
    </style>
</head>
<body class="bg-[#F8FBFF] text-gray-800 antialiased">

    <!-- Backdrop Gelap saat Sidebar Mobile Terbuka -->
    <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 z-40 hidden md:hidden backdrop-blur-xs transition-opacity"></div>

    <!-- Sidebar Navigation (Tetap fixed di kiri layar) -->
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

                <!-- Menu Aktif (Dashboard) -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3.5 px-4.5 py-4 rounded-2xl bg-gradient-myuniv text-white font-bold text-sm shadow-lg shadow-indigo-200/60 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#FF7A59]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span>Dashboard Utama</span>
                </a>

                <!-- Bank Soal Asesmen -->
                <a href="{{ route('admin.assessments.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    Bank Soal Asesmen
                </a>

                <!-- Data Universitas -->
                <a href="{{ route('admin.universities.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Data Perguruan Tinggi
                </a>

                <!-- Program Studi & Jurusan -->
                <a href="{{ route('admin.majors.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                    Program Studi & Jurusan
                </a>

                <!-- Manajemen Pengguna -->
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

    <!-- Top Navbar (Fixed di atas, tidak ikut scroll) -->
    <header class="bg-white/90 backdrop-blur-md border-b border-[#E2E8F0] px-6 lg:px-10 py-6 flex justify-between items-center fixed top-0 right-0 left-0 md:left-72 z-40 shadow-xs">
        <div class="flex items-center gap-3">
            <button type="button" onclick="toggleSidebar()" class="md:hidden relative z-50 p-2.5 rounded-xl text-gray-700 bg-gray-100 hover:bg-indigo-50 hover:text-[#3650A2] transition focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <span class="text-xs font-extrabold px-3.5 py-1.5 bg-indigo-50 text-[#3650A2] rounded-xl tracking-wide border border-indigo-100/50">Panel Kontrol</span>
            <span class="text-gray-300 font-light hidden sm:inline">/</span>
            <h1 class="text-sm font-black text-gray-800 tracking-tight hidden sm:inline">Ringkasan Admin</h1>
        </div>

        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-extrabold text-gray-900 leading-tight">Administrator Utama</div>
                <div class="text-xs font-semibold text-gray-400">admin@myuniv.test</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-gradient-myuniv text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-200/50">AD</div>
        </div>
    </header>

    <!-- Main Content Wrapper -->
    <div class="md:ml-72 pt-24 min-h-screen flex flex-col">
        <main class="p-6 md:p-8 space-y-8 max-w-7xl w-full mx-auto flex-1">

            <!-- Hero Banner Lebih Menonjol dengan Efek Glow & Aksen Koral -->
            <div class="bg-gradient-myuniv text-white p-8 sm:p-12 rounded-[32px] shadow-2xl shadow-indigo-950/20 relative overflow-hidden flex flex-col md:flex-row justify-between items-start md:items-center gap-8 border border-white/10">
                <div class="absolute -right-16 -top-16 w-80 h-80 bg-[#FF7A59]/40 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute right-40 -bottom-20 w-72 h-72 bg-blue-400/30 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute left-1/2 top-0 w-40 h-40 bg-indigo-500/30 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 max-w-xl">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/15 backdrop-blur-md text-white text-xs font-extrabold rounded-full mb-5 shadow-lg border border-white/20">
                        <span class="w-2 h-2 rounded-full bg-[#FF7A59] animate-ping"></span>
                        <span>MyUniv Enterprise Control Center</span>
                    </div>
                    <h2 class="text-3xl sm:text-5xl font-black tracking-tight mb-4 leading-tight text-white drop-shadow-md">Selamat Datang, Admin!</h2>
                    <p class="text-indigo-100 text-sm sm:text-base leading-relaxed font-medium opacity-95">Kelola penuh seluruh data perguruan tinggi, program studi, asesmen psikometrik siswa, dan basis data platform dengan performa tinggi.</p>
                </div>

                <div class="relative z-10 flex flex-col sm:flex-row md:flex-col gap-3.5 w-full md:w-auto">
                    <div class="bg-white/15 backdrop-blur-xl p-5 rounded-2xl border border-white/25 shadow-xl flex items-center gap-4 min-w-[220px]">
                        <div class="w-12 h-12 rounded-xl bg-[#FF7A59] text-white flex items-center justify-center font-bold shadow-lg shadow-orange-500/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <span class="text-[11px] text-indigo-200 font-bold uppercase tracking-wider block">Database Status</span>
                            <span class="text-sm font-black text-emerald-300 flex items-center gap-1.5 mt-0.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span> Supabase Optimal
                            </span>
                        </div>
                    </div>

                    <div class="bg-white/10 backdrop-blur-xl p-4 rounded-2xl border border-white/15 flex items-center justify-between text-xs font-bold text-indigo-100 px-5">
                        <span>Sistem Keamanan</span>
                        <span class="bg-white/20 px-2.5 py-1 rounded-lg text-white font-extrabold tracking-wide">Role-Based</span>
                    </div>
                </div>
            </div>

            <!-- Quick Action Cards dengan Sentuhan Dekoratif Bentuk Lingkaran Glow -->
            <div>
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-lg font-extrabold text-[#3650A2] tracking-tight">Modul Manajemen</h3>
                    <span class="text-xs font-bold text-gray-400">Pilih menu untuk mulai mengelola</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- Bank Soal Asesmen -->
                    <a href="{{ route('admin.assessments.index') }}" class="glass-card p-6 rounded-[28px] border border-[#E2E8F0] shadow-sm hover:shadow-xl hover:shadow-orange-500/10 hover:border-[#FF7A59]/60 transition-all duration-300 group flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute -right-8 -top-8 w-32 h-32 bg-orange-100/60 rounded-full blur-xl pointer-events-none group-hover:scale-125 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <div class="w-12 h-12 rounded-2xl bg-orange-50 text-[#FF7A59] flex items-center justify-center mb-5 group-hover:bg-[#FF7A59] group-hover:text-white transition-all duration-300 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                            </div>
                            <h4 class="text-base font-extrabold text-gray-900 mb-1.5 group-hover:text-[#FF7A59] transition">Bank Soal Asesmen</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-medium">Atur kuesioner psikometrik & peminatan siswa.</p>
                        </div>
                        <div class="mt-6 relative z-10 flex items-center text-xs font-bold text-[#FF7A59] gap-1 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-1 group-hover:translate-y-0">
                            Kelola modul &rarr;
                        </div>
                    </a>

                    <!-- Data Universitas -->
                    <a href="{{ route('admin.universities.index') }}" class="glass-card p-6 rounded-[28px] border border-[#E2E8F0] shadow-sm hover:shadow-xl hover:shadow-indigo-500/10 hover:border-[#3650A2]/60 transition-all duration-300 group flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute -right-8 -top-8 w-32 h-32 bg-blue-100/60 rounded-full blur-xl pointer-events-none group-hover:scale-125 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#3650A2] flex items-center justify-center mb-5 group-hover:bg-[#3650A2] group-hover:text-white transition-all duration-300 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <h4 class="text-base font-extrabold text-gray-900 mb-1.5 group-hover:text-[#3650A2] transition">Data Perguruan Tinggi</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-medium">Tambah, edit, dan kelola daftar PTN serta PTS.</p>
                        </div>
                        <div class="mt-6 relative z-10 flex items-center text-xs font-bold text-[#3650A2] gap-1 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-1 group-hover:translate-y-0">
                            Kelola modul &rarr;
                        </div>
                    </a>

                    <!-- Program Studi & Jurusan -->
                    <a href="{{ route('admin.majors.index') }}" class="glass-card p-6 rounded-[28px] border border-[#E2E8F0] shadow-sm hover:shadow-xl hover:shadow-indigo-500/10 hover:border-[#3650A2]/60 transition-all duration-300 group flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute -right-8 -top-8 w-32 h-32 bg-indigo-100/60 rounded-full blur-xl pointer-events-none group-hover:scale-125 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-[#3650A2] flex items-center justify-center mb-5 group-hover:bg-[#3650A2] group-hover:text-white transition-all duration-300 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                            </div>
                            <h4 class="text-base font-extrabold text-gray-900 mb-1.5 group-hover:text-[#3650A2] transition">Program Studi & Jurusan</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-medium">Atur data pilihan program studi dan fakultas.</p>
                        </div>
                        <div class="mt-6 relative z-10 flex items-center text-xs font-bold text-[#3650A2] gap-1 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-1 group-hover:translate-y-0">
                            Kelola modul &rarr;
                        </div>
                    </a>

                    <!-- Manajemen Pengguna -->
                    <a href="{{ route('admin.users.index') }}" class="glass-card p-6 rounded-[28px] border border-[#E2E8F0] shadow-sm hover:shadow-xl hover:shadow-purple-500/10 hover:border-purple-500/60 transition-all duration-300 group flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute -right-8 -top-8 w-32 h-32 bg-purple-100/60 rounded-full blur-xl pointer-events-none group-hover:scale-125 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center mb-5 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            </div>
                            <h4 class="text-base font-extrabold text-gray-900 mb-1.5 group-hover:text-purple-600 transition">Manajemen Pengguna</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-medium">Kelola akun siswa, guru BK, dan administrator.</p>
                        </div>
                        <div class="mt-6 relative z-10 flex items-center text-xs font-bold text-purple-600 gap-1 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-1 group-hover:translate-y-0">
                            Kelola modul &rarr;
                        </div>
                    </a>

                    <!-- Widget Aktivitas Sistem (Live Status) -->
                    <div class="glass-card p-6 rounded-[28px] border border-[#E2E8F0] shadow-sm flex flex-col justify-between relative overflow-hidden bg-gradient-to-br from-white via-white to-emerald-50/40 md:col-span-2 lg:col-span-2">
                        <div class="absolute -right-8 -bottom-8 w-36 h-36 bg-emerald-200/50 rounded-full blur-2xl pointer-events-none"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                                <span class="px-2.5 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-extrabold rounded-full uppercase tracking-wider flex items-center gap-1 shadow-xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Live
                                </span>
                            </div>
                            <h4 class="text-base font-extrabold text-gray-900 mb-1">Status Sistem</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-medium mb-4">Database Supabase PostgreSQL & Middleware optimal.</p>
                        </div>
                        <div class="pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs font-bold relative z-10">
                            <span class="text-gray-400 font-medium">Response Latency</span>
                            <span class="text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-100 shadow-xs">18 ms</span>
                        </div>
                    </div>
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
