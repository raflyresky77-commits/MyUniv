<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js untuk Interaksi UI -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4FAFF; }
    </style>
</head>
<body class="min-h-screen font-['Plus_Jakarta_Sans'] text-[#2F3136] flex" x-data="{ sidebarOpen: false, modalOpen: false, profileDropdown: false, activeTab: 'dashboard' }">

    <!-- MOBILE SIDEBAR BACKDROP -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-40 bg-black/50 md:hidden" @click="sidebarOpen = false" x-transition.opacity></div>

    <!-- SIDEBAR -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#3650A2] text-white flex flex-col justify-between transition-transform duration-300 ease-in-out md:translate-x-0 md:static border-r border-[#C9D7EE]/20 shadow-xl">
        <div>
            <!-- Logo & Brand -->
            <div class="p-6 flex items-center justify-between border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 flex items-center justify-center bg-white rounded-xl shadow-sm p-1.5">
                        <span class="text-[#3650A2] font-extrabold text-lg">M</span>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold leading-tight">MyUniv</h2>
                        <p class="text-[10px] text-[#C9D7EE]">Admin Panel</p>
                    </div>
                </div>
                <!-- Close Button Mobile -->
                <button @click="sidebarOpen = false" class="md:hidden text-white/80 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Navigasi Menu Interaktif -->
            <nav class="p-4 space-y-1.5 text-sm font-medium">
                <button @click="activeTab = 'dashboard'; sidebarOpen = false" :class="activeTab === 'dashboard' ? 'bg-white/15 text-white shadow-sm' : 'text-[#C9D7EE] hover:bg-white/10 hover:text-white'" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition text-left">
                    <svg class="w-5 h-5 text-[#FF7A59]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Dashboard
                </button>
                <button @click="activeTab = 'bank-soal'; sidebarOpen = false" :class="activeTab === 'bank-soal' ? 'bg-white/15 text-white shadow-sm' : 'text-[#C9D7EE] hover:bg-white/10 hover:text-white'" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition text-left">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    Bank Soal Asesmen
                </button>
                <button @click="activeTab = 'universitas'; sidebarOpen = false" :class="activeTab === 'universitas' ? 'bg-white/15 text-white shadow-sm' : 'text-[#C9D7EE] hover:bg-white/10 hover:text-white'" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition text-left">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Data Universitas & Prodi
                </button>
                <button @click="activeTab = 'pengguna'; sidebarOpen = false" :class="activeTab === 'pengguna' ? 'bg-white/15 text-white shadow-sm' : 'text-[#C9D7EE] hover:bg-white/10 hover:text-white'" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition text-left">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Manajemen Pengguna
                </button>
            </nav>
        </div>

        <!-- Logout Section -->
        <div class="p-4 border-t border-white/10">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-[#FF8575] hover:bg-white/10 transition font-medium text-sm text-left">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar (Logout)
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Top Navbar -->
        <header class="h-20 bg-white border-b border-[#C9D7EE]/60 px-6 sm:px-8 flex items-center justify-between sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="md:hidden text-[#3650A2] p-1.5 rounded-lg hover:bg-[#F4FAFF] transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div>
                    <h1 class="text-lg sm:text-xl font-bold text-[#3650A2]" x-text="activeTab === 'dashboard' ? 'Dashboard Admin' : (activeTab === 'bank-soal' ? 'Bank Soal Asesmen' : (activeTab === 'universitas' ? 'Data Universitas & Prodi' : 'Manajemen Pengguna'))"></h1>
                    <p class="text-xs text-[#6E7178] hidden sm:block">Kelola data platform MyUniv dengan mudah dan cepat.</p>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative" @click.away="profileDropdown = false">
                <button @click="profileDropdown = !profileDropdown" class="flex items-center gap-3 p-1.5 rounded-xl hover:bg-[#F4FAFF] transition">
                    <div class="w-10 h-10 rounded-full bg-[#3650A2] text-white font-bold flex items-center justify-center shadow-sm">
                        AD
                    </div>
                    <div class="text-left hidden sm:block">
                        <span class="block text-xs font-bold text-[#3650A2]">Administrator</span>
                        <span class="block text-[10px] text-[#6E7178]">admin@myuniv.id</span>
                    </div>
                    <svg class="w-4 h-4 text-[#6E7178]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <!-- Dropdown Content -->
                <div x-show="profileDropdown" x-transition class="absolute right-0 mt-2 w-48 bg-white border border-[#C9D7EE]/60 rounded-xl shadow-lg py-1.5 text-xs">
                    <button @click="alert('Membuka halaman Profil Admin...'); profileDropdown = false" class="w-full text-left px-4 py-2 text-[#2F3136] hover:bg-[#F4FAFF] transition">Profil Saya</button>
                    <button @click="alert('Membuka pengaturan akun...'); profileDropdown = false" class="w-full text-left px-4 py-2 text-[#2F3136] hover:bg-[#F4FAFF] transition">Pengaturan Akun</button>
                    <div class="border-t border-[#C9D7EE]/40 my-1"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition font-semibold">Keluar</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Dynamic Body Content -->
        <main class="p-6 sm:p-8 space-y-6">

            <!-- DASHBOARD TAB -->
            <div x-show="activeTab === 'dashboard'" class="space-y-6">
                <!-- Statistik -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    <div class="bg-white p-6 rounded-[16px] border border-[#C9D7EE]/60 shadow-xs flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-[#6E7178] uppercase tracking-wider">Total Siswa</p>
                            <h3 class="text-2xl font-extrabold text-[#3650A2] mt-1">1,248</h3>
                            <span class="text-[10px] text-emerald-600 font-semibold mt-1 inline-block">+12% bulan ini</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-[#3650A2]/10 text-[#3650A2] flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-[16px] border border-[#C9D7EE]/60 shadow-xs flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-[#6E7178] uppercase tracking-wider">Bank Soal</p>
                            <h3 class="text-2xl font-extrabold text-[#3650A2] mt-1">120 Soal</h3>
                            <span class="text-[10px] text-emerald-600 font-semibold mt-1 inline-block">Aktif & Terverifikasi</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-[#FF7A59]/10 text-[#FF7A59] flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-[16px] border border-[#C9D7EE]/60 shadow-xs flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-[#6E7178] uppercase tracking-wider">Total Universitas</p>
                            <h3 class="text-2xl font-extrabold text-[#3650A2] mt-1">45 Kampus</h3>
                            <span class="text-[10px] text-[#6E7178] font-semibold mt-1 inline-block">PTN & PTS Pilihan</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-[#3650A2]/10 text-[#3650A2] flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-[16px] border border-[#C9D7EE]/60 shadow-xs flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-[#6E7178] uppercase tracking-wider">Konsultasi BK</p>
                            <h3 class="text-2xl font-extrabold text-[#3650A2] mt-1">18 Sesi</h3>
                            <span class="text-[10px] text-amber-600 font-semibold mt-1 inline-block">Menunggu Jadwal</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-[#FF7A59]/10 text-[#FF7A59] flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Tabel -->
                <div class="bg-white rounded-[16px] border border-[#C9D7EE]/60 shadow-xs overflow-hidden">
                    <div class="p-6 border-b border-[#C9D7EE]/60 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="text-base font-bold text-[#3650A2]">Aktivitas Pendaftaran Siswa Terbaru</h2>
                            <p class="text-xs text-[#6E7178] mt-0.5">Daftar siswa yang baru saja melakukan registrasi akun di platform.</p>
                        </div>
                        <button @click="modalOpen = true" class="px-4 py-2.5 bg-[#FF7A59] text-white text-xs font-bold rounded-xl hover:bg-[#e0684a] shadow-sm transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Tambah Data Siswa
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-[#2F3136]">
                            <thead class="bg-[#F4FAFF] text-[11px] uppercase tracking-wider text-[#6E7178] border-b border-[#C9D7EE]/60">
                                <tr>
                                    <th class="px-6 py-4">Nama Siswa</th>
                                    <th class="px-6 py-4">Kelas</th>
                                    <th class="px-6 py-4">Status Tes</th>
                                    <th class="px-6 py-4">Tanggal Daftar</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#C9D7EE]/40">
                                <tr class="hover:bg-[#F4FAFF]/50 transition">
                                    <td class="px-6 py-4 font-semibold text-[#3650A2]">Anggia Tresa Putri</td>
                                    <td class="px-6 py-4 text-[#6E7178]">XII RPL</td>
                                    <td class="px-6 py-4"><span class="px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700">Selesai</span></td>
                                    <td class="px-6 py-4 text-[#6E7178]">09 September 2026</td>
                                    <td class="px-6 py-4 text-right">
                                        <button @click="alert('Melihat detail siswa')" class="text-xs font-semibold text-[#3650A2] bg-[#3650A2]/10 px-3 py-1.5 rounded-lg hover:bg-[#3650A2]/20 transition">Detail</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- BANK SOAL TAB -->
            <div x-show="activeTab === 'bank-soal'" class="bg-white rounded-[16px] border border-[#C9D7EE]/60 p-6 shadow-xs space-y-4" style="display: none;">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-base font-bold text-[#3650A2]">Manajemen Bank Soal Asesmen</h2>
                        <p class="text-xs text-[#6E7178]">Kelola soal-soal psikotes dan penjurusan siswa.</p>
                    </div>
                    <button @click="alert('Fitur tambah soal')" class="px-4 py-2 bg-[#FF7A59] text-white text-xs font-bold rounded-xl hover:bg-[#e0684a] transition">+ Buat Soal Baru</button>
                </div>
                <div class="p-8 text-center border-2 border-dashed border-[#C9D7EE] rounded-xl text-[#6E7178] text-xs">
                    Belum ada bank soal tambahan. Klik tombol di atas untuk mulai menambahkan soal.
                </div>
            </div>

            <!-- UNIVERSITAS TAB -->
            <div x-show="activeTab === 'universitas'" class="bg-white rounded-[16px] border border-[#C9D7EE]/60 p-6 shadow-xs space-y-4" style="display: none;">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-base font-bold text-[#3650A2]">Data Universitas & Program Studi</h2>
                        <p class="text-xs text-[#6E7178]">Daftar perguruan tinggi mitra MyUniv.</p>
                    </div>
                    <button @click="alert('Fitur tambah universitas')" class="px-4 py-2 bg-[#FF7A59] text-white text-xs font-bold rounded-xl hover:bg-[#e0684a] transition">+ Tambah Kampus</button>
                </div>
                <div class="p-8 text-center border-2 border-dashed border-[#C9D7EE] rounded-xl text-[#6E7178] text-xs">
                    Daftar universitas dan program studi akan muncul di sini.
                </div>
            </div>

            <!-- PENGGUNA TAB -->
            <div x-show="activeTab === 'pengguna'" class="bg-white rounded-[16px] border border-[#C9D7EE]/60 p-6 shadow-xs space-y-4" style="display: none;">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-base font-bold text-[#3650A2]">Manajemen Pengguna Sistem</h2>
                        <p class="text-xs text-[#6E7178]">Kelola akun Siswa, Guru BK, dan Administrator.</p>
                    </div>
                    <button @click="alert('Fitur tambah pengguna')" class="px-4 py-2 bg-[#FF7A59] text-white text-xs font-bold rounded-xl hover:bg-[#e0684a] transition">+ Tambah Pengguna</button>
                </div>
                <div class="p-8 text-center border-2 border-dashed border-[#C9D7EE] rounded-xl text-[#6E7178] text-xs">
                    Daftar akun pengguna sistem terdaftar.
                </div>
            </div>

        </main>
    </div>

    <!-- MODAL TAMBAH DATA -->
    <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" style="display: none;">
        <div @click.away="modalOpen = false" class="bg-white w-full max-w-md rounded-[20px] p-6 shadow-2xl border border-[#C9D7EE]/60 space-y-5">
            <div class="flex justify-between items-center border-b border-[#C9D7EE]/40 pb-4">
                <h3 class="text-base font-bold text-[#3650A2]">Form Tambah Data Siswa</h3>
                <button @click="modalOpen = false" class="text-[#6E7178] hover:text-[#2F3136]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="space-y-4 text-xs font-medium">
                <div>
                    <label class="block text-[#6E7178] mb-1">Nama Lengkap Siswa</label>
                    <input type="text" placeholder="Masukkan nama siswa..." class="w-full px-4 py-2.5 rounded-xl border border-[#C9D7EE] focus:outline-none focus:ring-2 focus:ring-[#3650A2]">
                </div>
                <div>
                    <label class="block text-[#6E7178] mb-1">Kelas / Jurusan</label>
                    <input type="text" placeholder="Contoh: XII RPL" class="w-full px-4 py-2.5 rounded-xl border border-[#C9D7EE] focus:outline-none focus:ring-2 focus:ring-[#3650A2]">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button @click="modalOpen = false" class="px-4 py-2 bg-gray-100 text-[#6E7178] text-xs font-bold rounded-xl hover:bg-gray-200 transition">Batal</button>
                <button @click="alert('Simpan data berhasil!'); modalOpen = false;" class="px-4 py-2 bg-[#FF7A59] text-white text-xs font-bold rounded-xl hover:bg-[#e0684a] transition">Simpan Data</button>
            </div>
        </div>
    </div>

</body>
</html>
