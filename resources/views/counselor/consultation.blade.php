<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi BK - Dashboard Guru BK - MyUniv</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F4F7FE; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #1E2D62 100%); }
        .bg-gradient-strong { background: linear-gradient(135deg, #2B4185 0%, #141F43 100%); }

        .glass-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(235, 242, 255, 0.85) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid rgba(54, 80, 162, 0.15);
            box-shadow: 0 20px 45px -12px rgba(30, 45, 98, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.9);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .glass-card:hover {
            transform: translateY(-2px);
            border-color: #FF7A59;
            box-shadow: 0 25px 50px -12px rgba(255, 122, 89, 0.15);
        }
    </style>
</head>
<body class="bg-[#F4F7FE] min-h-screen text-gray-800 flex antialiased">

    <!-- Backdrop Mobile -->
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
                    <span class="text-[10px] font-extrabold text-indigo-400 uppercase tracking-wider mt-1 block">Panel Guru BK</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-5 space-y-2">
                <div class="px-4 py-2 text-[10px] font-extrabold text-indigo-400 uppercase tracking-widest">Menu Utama</div>

                <!-- Beranda -->
                <a href="{{ route('counselor.dashboard') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Beranda</span>
                </a>

                <!-- Eksplorasi -->
                <a href="{{ route('counselor.exploration') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>Eksplorasi</span>
                </a>

                <!-- Konsultasi BK (Aktif) -->
                <a href="{{ route('counselor.consultation') }}" class="flex items-center gap-3.5 px-4.5 py-4 rounded-2xl bg-gradient-strong text-white font-bold text-sm shadow-lg shadow-indigo-900/25 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#FF7A59]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-white group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <span>Konsultasi BK</span>
                </a>

                <!-- Profil -->
                <a href="{{ route('counselor.profile') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] group-hover:scale-110 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Profil</span>
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
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-h-screen md:ml-72">

        <!-- Top Navbar -->
        <header class="bg-white/90 backdrop-blur-md border-b border-[#E2E8F0] px-6 lg:px-10 py-5 flex justify-between items-center sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-3">
                <button type="button" onclick="toggleSidebar()" class="md:hidden p-2 rounded-xl text-gray-700 bg-gray-100 hover:bg-indigo-50 hover:text-[#3650A2] transition focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <span class="text-xs font-bold px-3 py-1 bg-indigo-50 text-[#3650A2] rounded-full tracking-wide">Panel Guru BK</span>
                <span class="text-gray-300 font-light hidden sm:inline">/</span>
                <h1 class="text-sm font-extrabold text-gray-800 tracking-tight hidden sm:inline">Konsultasi BK</h1>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <div class="text-sm font-extrabold text-gray-900 leading-tight">Eli Asrifah S. Pd.</div>
                    <div class="text-xs font-semibold text-indigo-500">Guru BK</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-gradient-strong text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-900/20 transition-transform hover:scale-105 cursor-pointer">
                    EA
                </div>
            </div>
        </header>

        <!-- Page Body Content -->
        <main class="p-6 md:p-10 space-y-8 max-w-7xl w-full mx-auto flex-1">

            <!-- Hero Banner dengan Foto Kampus -->
            <div class="relative rounded-[40px] overflow-hidden px-8 sm:px-12 py-12 sm:py-16 shadow-lg border border-indigo-100 flex flex-col justify-center">
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset('images/banner-consultation.png') }}" alt="Background Kampus" class="w-full h-full object-cover object-center filter scale-105">
                </div>
                <div class="absolute inset-0 z-5 bg-gradient-to-r from-[#141F43]/75 via-[#1E2D62]/80 to-[#3650A2]/75 backdrop-blur-[1px]"></div>

                <div class="space-y-4 relative z-20 max-w-2xl text-white">
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-[#FF7A59] text-white text-xs font-extrabold rounded-full shadow-md uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Sesi Bimbingan Siswa
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight text-white drop-shadow-sm">Manajemen Konsultasi Siswa</h2>
                    <p class="text-gray-200 text-sm sm:text-base leading-relaxed font-medium drop-shadow">
                        Kelola daftar sesi bimbingan, pertanyaan siswa, serta rekapitulasi jadwal konsultasi online maupun offline dengan mudah.
                    </p>
                </div>
            </div>

            <!-- Statistik Ringkas Konsultasi -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="glass-card p-6 rounded-[28px] flex items-center justify-between">
                    <div>
                        <p class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Permintaan Masuk</p>
                        <h3 class="text-2xl font-black text-gray-900">5 Siswa</h3>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-[#3650A2] flex items-center justify-center border border-indigo-100 font-bold">📬</div>
                </div>
                <div class="glass-card p-6 rounded-[28px] flex items-center justify-between">
                    <div>
                        <p class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Sesi Berlangsung</p>
                        <h3 class="text-2xl font-black text-gray-900">2 Sesi</h3>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100 font-bold">💬</div>
                </div>
                <div class="glass-card p-6 rounded-[28px] flex items-center justify-between">
                    <div>
                        <p class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Selesai Bulan Ini</p>
                        <h3 class="text-2xl font-black text-gray-900">28 Sesi</h3>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-orange-50 text-[#FF7A59] flex items-center justify-center border border-orange-100 font-bold">✅</div>
                </div>
            </div>

            <!-- Tabel Daftar Permintaan / Sesi Konsultasi -->
            <div class="glass-card p-6 sm:p-8 rounded-[32px] space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-extrabold text-[#3650A2] tracking-tight">Daftar Permintaan & Riwayat Konsultasi</h3>
                        <p class="text-xs text-gray-500 font-medium mt-0.5">Daftar siswa yang mengajukan sesi bimbingan karir atau perguruan tinggi.</p>
                    </div>
                    <!-- Filter Status -->
                    <div class="flex items-center gap-2">
                        <select class="px-4 py-2.5 bg-white border border-indigo-100 rounded-xl text-xs font-bold text-gray-700 focus:outline-none focus:border-[#3650A2] shadow-xs">
                            <option value="all">Semua Status</option>
                            <option value="pending">Menunggu Konfirmasi</option>
                            <option value="scheduled">Terjadwal</option>
                            <option value="completed">Selesai</option>
                        </select>
                    </div>
                </div>

                <!-- Tabel Data -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200/80 text-[11px] font-black text-indigo-400 uppercase tracking-wider">
                                <th class="pb-3.5 px-4">Nama Siswa</th>
                                <th class="pb-3.5 px-4">Topik / Jurusan Dituju</th>
                                <th class="pb-3.5 px-4">Metode</th>
                                <th class="pb-3.5 px-4">Waktu Pengajuan</th>
                                <th class="pb-3.5 px-4">Status</th>
                                <th class="pb-3.5 px-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm font-medium text-gray-700">
                            <!-- Contoh Baris 1 -->
                            <tr class="hover:bg-white/60 transition">
                                <td class="py-4 px-4 font-bold text-gray-900 flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-indigo-100 text-[#3650A2] flex items-center justify-center font-extrabold text-xs">R</div>
                                    <div>
                                        <div>Rian Ramadhan</div>
                                        <div class="text-[11px] text-gray-400 font-normal">XII IPA 1</div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-xs font-semibold text-gray-600">Bingung Pilih Teknik Informatika / Sistem Informasi</td>
                                <td class="py-4 px-4 text-xs">
                                    <span class="px-2.5 py-1 bg-indigo-50 text-[#3650A2] font-extrabold rounded-lg">Offline (Ruang BK)</span>
                                </td>
                                <td class="py-4 px-4 text-xs text-gray-500">Hari ini, 08:30</td>
                                <td class="py-4 px-4 text-xs">
                                    <span class="px-3 py-1 bg-amber-50 text-amber-600 font-extrabold rounded-full border border-amber-200">Menunggu</span>
                                </td>
                                <td class="py-4 px-4 text-right">
                                    <button onclick="openDetailModal('Rian Ramadhan', 'Teknik Informatika / Sistem Informasi', 'Offline')" class="px-3.5 py-2 bg-[#3650A2] hover:bg-[#2B4185] text-white text-xs font-bold rounded-xl transition shadow-xs">Kelola</button>
                                </td>
                            </tr>

                            <!-- Contoh Baris 2 -->
                            <tr class="hover:bg-white/60 transition">
                                <td class="py-4 px-4 font-bold text-gray-900 flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-orange-100 text-[#FF7A59] flex items-center justify-center font-extrabold text-xs">S</div>
                                    <div>
                                        <div>Siti Nurhaliza</div>
                                        <div class="text-[11px] text-gray-400 font-normal">XII IPS 2</div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-xs font-semibold text-gray-600">Konsultasi Jalur SNBP & Psikotes Karir</td>
                                <td class="py-4 px-4 text-xs">
                                    <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 font-extrabold rounded-lg">Online (WhatsApp)</span>
                                </td>
                                <td class="py-4 px-4 text-xs text-gray-500">Kemarin, 14:15</td>
                                <td class="py-4 px-4 text-xs">
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 font-extrabold rounded-full border border-emerald-200">Terjadwal</span>
                                </td>
                                <td class="py-4 px-4 text-right">
                                    <button onclick="openDetailModal('Siti Nurhaliza', 'Jalur SNBP & Psikotes Karir', 'Online')" class="px-3.5 py-2 bg-[#3650A2] hover:bg-[#2B4185] text-white text-xs font-bold rounded-xl transition shadow-xs">Kelola</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- Modal Detail & Aksi Konsultasi (Interaktif) -->
    <div id="consultationModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center backdrop-blur-xs p-4">
        <div class="bg-white rounded-[32px] max-w-lg w-full p-6 sm:p-8 space-y-6 shadow-2xl border border-indigo-100 transform transition-all">
            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                <h3 class="text-lg font-extrabold text-[#3650A2]">Detail Konsultasi Siswa</h3>
                <button onclick="closeDetailModal()" class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 hover:bg-red-50 hover:text-red-500 flex items-center justify-center font-bold">&times;</button>
            </div>

            <div class="space-y-4 text-sm">
                <div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Nama Siswa</span>
                    <p id="modalStudentName" class="font-extrabold text-gray-900 text-base mt-0.5">-</p>
                </div>
                <div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Topik / Pembahasan</span>
                    <p id="modalTopic" class="font-semibold text-gray-700 mt-0.5">-</p>
                </div>
                <div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Metode Konsultasi</span>
                    <p id="modalMethod" class="font-semibold text-gray-700 mt-0.5">-</p>
                </div>
                <div class="pt-2">
                    <label class="text-xs font-bold text-[#3650A2] uppercase tracking-wider block mb-1.5">Catatan / Tanggapan Guru BK</label>
                    <textarea rows="3" placeholder="Tuliskan catatan sesi bimbingan atau instruksi untuk siswa..." class="w-full px-4 py-3 rounded-2xl border border-indigo-100 bg-[#F8FBFF] text-xs font-medium focus:outline-none focus:border-[#3650A2]"></textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                <button onclick="closeDetailModal()" class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-600 text-xs font-extrabold hover:bg-gray-200 transition">Tutup</button>
                <button onclick="alert('Sesi konsultasi berhasil diperbarui!'); closeDetailModal();" class="px-5 py-2.5 rounded-xl bg-[#FF7A59] hover:bg-[#e0684a] text-white text-xs font-extrabold transition shadow-md">Simpan & Konfirmasi</button>
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

        function openDetailModal(name, topic, method) {
            document.getElementById('modalStudentName').innerText = name;
            document.getElementById('modalTopic').innerText = topic;
            document.getElementById('modalMethod').innerText = method;
            document.getElementById('consultationModal').classList.remove('hidden');
        }

        function closeDetailModal() {
            document.getElementById('consultationModal').classList.add('hidden');
        }
    </script>
</body>
</html>
