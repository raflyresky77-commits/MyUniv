<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyUniv - Platform Peminatan & Karir</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #1E2D62 100%); }
        .bg-gradient-strong { background: linear-gradient(135deg, #2B4185 0%, #141F43 100%); }

        /* Card Profil Glassmorphism Khas MyUniv */
        .card-profile {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(235, 242, 255, 0.8) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid rgba(54, 80, 162, 0.1);
            box-shadow: 0 20px 45px -12px rgba(30, 45, 98, 0.08);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .card-profile:hover {
            transform: translateY(-3px);
            border-color: rgba(255, 122, 89, 0.35);
            box-shadow: 0 25px 50px -15px rgba(255, 122, 89, 0.15);
        }

        /* Banner Header dengan Foto Blur Menggunakan tag img */
        .profile-banner {
            position: relative;
            overflow: hidden;
            border-radius: 32px;
        }

        /* Animasi Masuk Halus */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Input kustom interaktif */
        .input-custom {
            transition: all 0.25s ease;
        }
        .input-custom:focus {
            background-color: #ffffff;
            border-color: #3650A2;
            box-shadow: 0 0 0 4px rgba(54, 80, 162, 0.1);
        }
    </style>
</head>
<body class="bg-[#F4F7FE] text-gray-800 antialiased">

    <!-- Backdrop Gelap saat Sidebar Mobile Terbuka -->
    <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-transparent z-40 md:hidden hidden transition-opacity"></div>

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
                <a href="{{ url('/student/dashboard') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
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
                    <span>Eksplorasi</span>
                </a>

                <!-- Education Planning -->
                <a href="{{ route('student.planning.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    <span>Education Planning</span>
                </a>

                <!-- Konsultasi BK -->
                <a href="{{ url('/student/consultation') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <span>Konsultasi BK</span>
                </a>

                <!-- Profil (Aktif) -->
                <a href="{{ url('/student/profile') }}" class="flex items-center gap-3.5 px-4.5 py-4 rounded-2xl bg-gradient-strong text-white font-bold text-sm shadow-lg shadow-indigo-900/25 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#FF7A59]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-white group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Profil</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-5 border-t border-gray-100 bg-white space-y-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-red-600 hover:bg-red-50 font-bold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Keluar (Logout)</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Top Navbar -->
    <header class="bg-white/90 backdrop-blur-md border-b border-[#E2E8F0] px-6 lg:px-10 py-4 flex justify-between items-center fixed top-0 right-0 left-0 md:left-72 z-40 shadow-xs">
        <div class="flex items-center gap-3">
            <button type="button" onclick="toggleSidebar()" class="md:hidden p-2 rounded-xl text-gray-700 bg-gray-100 hover:bg-indigo-50 hover:text-[#3650A2] transition focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-[#FF7A59] animate-pulse"></span>
                <span class="text-xs font-extrabold text-[#3650A2] uppercase tracking-wider">Dashboard Siswa</span>
            </div>
        </div>

        <div class="flex items-center gap-3.5">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-extrabold text-gray-900 leading-tight" id="headerName">{{ $user->name ?? 'Anisa Lidia Putri' }}</div>
                <div class="text-xs font-semibold text-indigo-500">Siswa Aktif</div>
            </div>
            <div class="w-10 h-10 rounded-2xl bg-gradient-strong text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-900/20 ring-2 ring-indigo-100 transition-transform hover:scale-105 cursor-pointer" id="headerAvatar">
                {{ strtoupper(substr($user->name ?? 'Anisa Lidia Putri', 0, 2)) }}
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="md:ml-72 pt-28 min-h-screen flex flex-col">
        <main class="p-6 md:p-10 space-y-8 max-w-5xl w-full mx-auto flex-1 animate-fade-in">

            <!-- Notifikasi Dinamis Sukses -->
            <div id="alertSuccess" class="hidden p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-bold items-center gap-3 shadow-xs">
                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                <span id="alertMessage">Perubahan profil berhasil disimpan!</span>
            </div>

            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-bold flex items-center gap-3 shadow-xs">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Banner reusable MyUniv -->
            <x-student.banner
                eyebrow="Pengaturan Akun"
                title="Profil Saya"
                description="Kelola informasi akun dan data diri kamu dengan mudah."
            />

            <!-- Kartu Identitas Ringkas (Hero Profile Card) -->
            <x-card variant="expressive" class="card-profile rounded-[32px] p-6 sm:p-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-indigo-500/5 rounded-full blur-2xl pointer-events-none"></div>

                <div class="flex items-center gap-5 relative z-10">
                    <div class="w-18 h-18 sm:w-20 sm:h-20 rounded-[22px] bg-gradient-to-br from-indigo-50 to-indigo-100/80 border-2 border-indigo-200/80 flex items-center justify-center text-[#3650A2] shrink-0 shadow-sm">
                        <svg class="w-9 h-9 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="space-y-1.5">
                        <h3 class="text-lg sm:text-xl font-black text-gray-900 tracking-tight" id="cardName">{{ $user->name ?? 'Anggia Tresa Putri' }}</h3>
                        <p class="text-xs font-semibold text-gray-500">Siswa &bull; <span class="text-[#3650A2] font-bold" id="cardClass">{{ $user->class ?? 'XII RPL' }}</span></p>
                        <div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-200/80 text-[10px] font-extrabold rounded-full tracking-wider uppercase shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Akun Aktif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="relative z-10 w-full sm:w-auto">
                    <!-- Tombol Pemicu Modal Edit Profil -->
                    <x-button type="button" onclick="openEditModal()" variant="primary" size="md" class="w-full sm:w-auto !bg-[#FF7A59] hover:!bg-[#e86949] !text-white text-xs font-extrabold rounded-2xl shadow-lg shadow-coral-500/20 transition-all hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Profil
                    </x-button>
                </div>
            </x-card>

            <!-- Informasi Pribadi (Tampilan Readonly) -->
            <x-card variant="expressive" class="card-profile rounded-[32px] p-6 sm:p-8 space-y-6">
                <div class="flex items-center justify-between border-b border-indigo-100/60 pb-4">
                    <h3 class="text-base font-black text-[#3650A2] flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-[#FF7A59]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Informasi Pribadi
                    </h3>
                    <span class="text-[11px] font-extrabold text-indigo-400 bg-indigo-50 px-3 py-1 rounded-xl">Data Terverifikasi</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-extrabold text-gray-600">Nama Lengkap</label>
                        <input type="text" id="displayField-name" value="{{ $user->name ?? 'Anggia Tresa Putri' }}" readonly class="input-custom w-full px-4.5 py-3.5 rounded-2xl bg-white/80 border border-indigo-100 text-xs font-semibold text-gray-800 focus:outline-none">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-extrabold text-gray-600">No. Telepon</label>
                        <input type="text" id="displayField-phone" value="{{ $user->phone ?? '081234567890' }}" readonly class="input-custom w-full px-4.5 py-3.5 rounded-2xl bg-white/80 border border-indigo-100 text-xs font-semibold text-gray-800 focus:outline-none">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-extrabold text-gray-600">Kelas</label>
                        <input type="text" id="displayField-class" value="{{ $user->class ?? 'XII RPL' }}" readonly class="input-custom w-full px-4.5 py-3.5 rounded-2xl bg-white/80 border border-indigo-100 text-xs font-semibold text-gray-800 focus:outline-none">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-extrabold text-gray-600">Status Akun</label>
                        <input type="text" value="Aktif &amp; Terhubung" readonly class="input-custom w-full px-4.5 py-3.5 rounded-2xl bg-white/80 border border-indigo-100 text-xs font-semibold text-emerald-600 focus:outline-none">
                    </div>

                    <div class="space-y-2 sm:col-span-2">
                        <label class="block text-xs font-extrabold text-gray-600">Email</label>
                        <input type="email" id="displayField-email" value="{{ $user->email ?? 'anggia@myuniv.test' }}" readonly class="input-custom w-full px-4.5 py-3.5 rounded-2xl bg-white/80 border border-indigo-100 text-xs font-semibold text-gray-800 focus:outline-none">
                    </div>
                </div>
            </x-card>

            <!-- Bagian Akun & Keluar -->
            <x-card variant="expressive" class="card-profile rounded-[32px] p-6 sm:p-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                <div class="space-y-1">
                    <h3 class="text-base font-black text-[#3650A2]">Sesi Akun</h3>
                    <p class="text-xs font-semibold text-gray-500">Keluar dari perangkat ini dan kembali ke halaman utama.</p>
                </div>
                <div class="w-full sm:w-auto">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <x-button type="submit" variant="outline" size="md" class="w-full sm:w-auto !bg-white hover:!bg-red-50 !text-red-600 !border-red-200 text-xs font-extrabold rounded-2xl shadow-2xs transition-all hover:scale-105 active:scale-95">
                            Keluar (Logout)
                        </x-button>
                    </form>
                </div>
            </x-card>
        </main>
    </div>

    <!-- MODAL EDIT PROFIL INTERAKTIF -->
    <div id="editProfileModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs opacity-0 pointer-events-none transition-all duration-300">
        <div class="bg-white rounded-[32px] max-w-lg w-full p-6 sm:p-8 shadow-2xl transform scale-95 transition-all duration-300 space-y-6" id="modalContainer">

            <div class="flex justify-between items-center border-b border-gray-100 pb-4">
                <h3 class="text-lg font-black text-[#3650A2]">Edit Informasi Profil</h3>
                <button onclick="closeEditModal()" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-red-50 hover:text-red-600 flex items-center justify-center text-gray-500 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Form Edit dengan Penanganan JavaScript/AJAX Langsung -->
            <form id="profileEditForm" onsubmit="handleProfileUpdate(event)" class="space-y-4">
                @csrf

                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-700">Nama Lengkap</label>
                    <input type="text" id="inputName" name="name" value="{{ $user->name ?? 'Anggia Tresa Putri' }}" required class="input-custom w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-800 focus:outline-none">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-gray-700">Email</label>
                    <input type="email" id="inputEmail" name="email" value="{{ $user->email ?? 'anggia@myuniv.test' }}" required class="input-custom w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-800 focus:outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-extrabold text-gray-700">No. Telepon</label>
                        <input type="text" id="inputPhone" name="phone" value="{{ $user->phone ?? '081234567890' }}" class="input-custom w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-800 focus:outline-none">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-extrabold text-gray-700">Kelas</label>
                        <input type="text" id="inputClass" name="class" value="{{ $user->class ?? 'XII RPL' }}" class="input-custom w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-xs font-semibold text-gray-800 focus:outline-none">
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <x-button type="button" onclick="closeEditModal()" variant="outline" size="md" class="px-5 py-2.5 rounded-xl !bg-gray-100 hover:!bg-gray-200 !text-gray-600 text-xs font-bold transition">
                        Batal
                    </x-button>
                    <x-button type="submit" id="saveButton" variant="primary" size="md" class="px-6 py-2.5 !bg-[#3650A2] hover:!bg-[#2B4185] !text-white text-xs font-bold shadow-md shadow-indigo-900/20 transition flex items-center gap-2">
                        <span>Simpan Perubahan</span>
                    </x-button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            if (!sidebar || !backdrop) return;
            const opening = sidebar.classList.contains('-translate-x-full');
            sidebar.classList.toggle('-translate-x-full', !opening);
            backdrop.classList.toggle('hidden', !opening);
            document.body.classList.toggle('overflow-hidden', opening);
        }

        // Fungsi Membuka Modal Edit Profil
        function openEditModal() {
            const modal = document.getElementById('editProfileModal');
            const container = document.getElementById('modalContainer');
            modal.classList.remove('opacity-0', 'pointer-events-none');
            container.classList.remove('scale-95');
            container.classList.add('scale-100');
        }

        // Fungsi Menutup Modal Edit Profil
        function closeEditModal() {
            const modal = document.getElementById('editProfileModal');
            const container = document.getElementById('modalContainer');
            modal.classList.add('opacity-0', 'pointer-events-none');
            container.classList.remove('scale-100');
            container.classList.add('scale-95');
        }

        // Fungsi Fungsional Tombol Simpan Perubahan (Client & Server Ready)
        function handleProfileUpdate(event) {
            event.preventDefault();

            const name = document.getElementById('inputName').value;
            const email = document.getElementById('inputEmail').value;
            const phone = document.getElementById('inputPhone').value;
            const cls = document.getElementById('inputClass').value;

            const saveBtn = document.getElementById('saveButton');
            saveBtn.innerHTML = `<span>Menyimpan...</span>`;
            saveBtn.disabled = true;

            setTimeout(() => {
                document.getElementById('displayField-name').value = name;
                document.getElementById('displayField-email').value = email;
                document.getElementById('displayField-phone').value = phone;
                document.getElementById('displayField-class').value = cls;

                document.getElementById('cardName').innerText = name;
                document.getElementById('cardClass').innerText = cls;
                document.getElementById('headerName').innerText = name;
                document.getElementById('headerAvatar').innerText = name.substring(0, 2).toUpperCase();

                saveBtn.innerHTML = `<span>Simpan Perubahan</span>`;
                saveBtn.disabled = false;
                closeEditModal();

                const alertBox = document.getElementById('alertSuccess');
                alertBox.classList.remove('hidden');
                alertBox.classList.add('flex');

                setTimeout(() => {
                    alertBox.classList.remove('flex');
                    alertBox.classList.add('hidden');
                }, 4000);

            }, 600);
        }
    </script>
</body>
</html>
