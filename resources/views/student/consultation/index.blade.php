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

        /* Disamakan dengan card-interactive-strong pada halaman MyUniv lainnya */
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

        .section-bg {
            background: linear-gradient(135deg, rgba(54, 80, 162, 0.04) 0%, rgba(255, 122, 89, 0.04) 100%);
            border: 1px solid rgba(54, 80, 162, 0.08);
        }
    </style>
</head>
<body class="bg-[#F4F7FE] text-gray-800 antialiased">

    <!-- Backdrop Mobile Sidebar -->
    <div id="sidebarBackdrop" onclick="closeSidebar()" class="fixed inset-0 z-40 hidden bg-transparent md:hidden transition-none" style="background: transparent !important; opacity: 1 !important; backdrop-filter: none !important;" aria-hidden="true"></div>

    <!-- Komponen Sidebar Siswa -->
    <x-student.student-sidebar active="consultation" />

    <!-- Komponen Topbar Siswa -->
    <x-student.student-topbar
        title="Konsultasi BK"
        subtitle="Konsultasi Bimbingan Konseling"
        :username="Auth::user()->name ?? 'Siswa'"
        :initials="strtoupper(substr(Auth::user()->name ?? 'S', 0, 2))"
    />

    <!-- Main Content Area -->
    <div class="md:ml-72 pt-28 min-h-screen flex flex-col">
        <main class="p-6 md:p-10 space-y-8 max-w-7xl w-full mx-auto flex-1">

            <!-- Header Halaman Konsultasi BK (markup langsung; tidak memanggil komponen yang belum tersedia) -->
            <section class="relative rounded-3xl overflow-hidden px-8 sm:px-12 py-10 sm:py-12 shadow-lg border border-[#3650A2]/20 bg-gradient-to-br from-[#3650A2] via-[#2B4185] to-[#1E2D62] flex flex-col justify-center">
                <div aria-hidden="true" class="absolute -right-12 -top-16 w-64 h-64 rounded-full bg-white/5"></div>
                <div aria-hidden="true" class="absolute -right-2 -bottom-24 w-52 h-52 rounded-full bg-[#FF7A59]/15"></div>
                <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 text-white">
                    <div class="space-y-3 max-w-2xl">
                        <span class="px-4 py-1.5 bg-[#FF7A59] text-white rounded-full text-xs font-extrabold tracking-wider uppercase shadow-md inline-block">Layanan Bimbingan</span>
                        <h1 class="text-2xl sm:text-4xl font-black tracking-tight text-white drop-shadow-sm">Konsultasi Guru BK 💬</h1>
                        <p class="text-gray-200 text-xs sm:text-sm font-medium leading-relaxed drop-shadow">Punya kebingungan seputar pilihan jurusan, perguruan tinggi, atau kendala belajar? Diskusikan langsung secara online maupun offline dengan guru BK sekolahmu.</p>
                    </div>
                    <x-button type="button" variant="coral" onclick="openModal()" class="text-xs sm:text-sm rounded-2xl shadow-lg shadow-orange-500/30 hover:scale-105 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        <span>Buat Jadwal Baru</span>
                    </x-button>
                </div>
            </section>

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
                        <x-card variant="strong" class="card-interactive-strong !rounded-[40px] !p-7 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 group relative overflow-hidden">
                            <div aria-hidden="true" class="absolute right-0 top-0 bottom-0 w-3 bg-[#FF7A59] pointer-events-none"></div>
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
                        </x-card>

                        <!-- Sesi 2: Status Menunggu / Pending (Offline) -->
                        <x-card variant="strong" class="card-interactive-strong !rounded-[40px] !p-7 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 group relative overflow-hidden">
                            <div aria-hidden="true" class="absolute right-0 top-0 bottom-0 w-3 bg-amber-400 pointer-events-none"></div>
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
                                <x-button type="button" variant="secondary" class="w-full sm:w-auto text-xs rounded-xl">
                                    Batalkan
                                </x-button>
                            </div>
                        </x-card>
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
                            <x-card variant="strong" class="card-interactive-strong !rounded-[28px] !p-4 flex items-start gap-3.5 group">
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
                            </x-card>

                            <x-card variant="strong" class="card-interactive-strong !rounded-[28px] !p-4 flex items-start gap-3.5 group">
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
                            </x-card>
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
                    <x-button type="button" variant="secondary" onclick="closeModal()" class="text-xs">Batal</x-button>
                    <x-button type="submit" variant="primary" class="text-xs shadow-md shadow-indigo-900/20">Kirim Pengajuan</x-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sinkron dengan student-sidebar: drawer dibuka menggunakan class is-open,
        // bukan translate-x utilities. Backdrop tetap transparan (tanpa gelap/blur).
        window.toggleSidebar = function () {
            const sidebar = document.getElementById('mobileSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            if (!sidebar) return;

            if (window.innerWidth >= 768) return; // jangan mengubah sidebar desktop
            const shouldOpen = !sidebar.classList.contains('is-open');
            sidebar.classList.toggle('is-open', shouldOpen);
            sidebar.setAttribute('aria-hidden', String(!shouldOpen));

            if (backdrop) {
                backdrop.classList.toggle('hidden', !shouldOpen);
                backdrop.style.background = 'transparent';
                backdrop.style.opacity = '1';
                backdrop.style.backdropFilter = 'none';
                backdrop.setAttribute('aria-hidden', String(!shouldOpen));
            }
            document.body.classList.toggle('overflow-hidden', shouldOpen);
        };

        window.closeSidebar = function () {
            const sidebar = document.getElementById('mobileSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            if (sidebar) {
                sidebar.classList.remove('is-open');
                sidebar.setAttribute('aria-hidden', 'true');
            }
            if (backdrop) {
                backdrop.classList.add('hidden');
                backdrop.style.background = 'transparent';
                backdrop.style.opacity = '1';
                backdrop.style.backdropFilter = 'none';
                backdrop.setAttribute('aria-hidden', 'true');
            }
            document.body.classList.remove('overflow-hidden');
        };

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') window.closeSidebar();
        });

        function initializeConsultationSidebar() {
            if (window.innerWidth < 768) window.closeSidebar();
            const sidebar = document.getElementById('mobileSidebar');
            if (sidebar) {
                sidebar.querySelectorAll('a').forEach(function (link) {
                    link.addEventListener('click', function () {
                        if (window.innerWidth < 768) window.closeSidebar();
                    });
                });
            }
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeConsultationSidebar, { once: true });
        } else {
            initializeConsultationSidebar();
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
