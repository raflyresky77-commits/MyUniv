<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Minat Bakat - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-strong { background: linear-gradient(135deg, #3650A2 0%, #1E2D62 100%); }
        .bg-gradient-coral { background: linear-gradient(135deg, #FF7A59 0%, #E85D3A 100%); }
        .card-glass {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 245, 255, 0.9) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid rgba(54, 80, 162, 0.12);
            box-shadow: 0 20px 40px -15px rgba(54, 80, 162, 0.08);
        }
        /* Custom Styling untuk Radio Button Interaktif */
        .option-input:checked + .option-label {
            background-color: #EEF3FF;
            border-color: #3650A2;
            color: #3650A2;
            box-shadow: 0 4px 12px rgba(54, 80, 162, 0.15);
            transform: translateY(-1px);
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
                <div class="w-11 h-11 flex items-center justify-center bg-indigo-50 rounded-[14px] border border-indigo-200/80 p-1.5 shrink-0 overflow-hidden shadow-sm">
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

                <!-- Asesmen (Aktif) -->
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

        <!-- Sidebar Footer -->
        <div class="p-5 border-t border-gray-100 bg-white">
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
            <span class="text-sm font-bold text-gray-700 hidden sm:inline">Asesmen / <span class="text-[#3650A2]">Tes Minat Bakat</span></span>
        </div>

        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-extrabold text-gray-900 leading-tight">{{ $user->name ?? 'Anggia Tresa' }}</div>
                <div class="text-xs font-semibold text-indigo-500">Siswa</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-gradient-strong text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-900/20">
                {{ strtoupper(substr($user->name ?? 'Anggia Tresa', 0, 2)) }}
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="md:ml-72 pt-28 min-h-screen flex flex-col">
        <main class="p-6 md:p-10 space-y-8 max-w-6xl w-full mx-auto flex-1">

            <!-- Title & Top Banner Box -->
            <div class="space-y-6">
                <!-- Judul Utama -->
                <div class="text-center space-y-2">
                    <span class="inline-block px-4 py-1 rounded-full bg-indigo-50 text-[#3650A2] text-xs font-extrabold tracking-wider uppercase border border-indigo-100">Tahap 1 dari 3 Asesmen</span>
                    <h1 class="text-2xl sm:text-4xl font-black text-[#3650A2] tracking-tight">Tes Minat Bakat</h1>
                </div>

                <!-- Banner Gambar -->
                <div class="card-glass rounded-[32px] p-4 sm:p-6 flex flex-col items-center justify-center relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-indigo-200/30 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="absolute -left-10 -top-10 w-48 h-48 bg-orange-200/20 rounded-full blur-2xl pointer-events-none"></div>

                    <div class="w-full h-56 sm:h-72 rounded-[24px] overflow-hidden relative shadow-sm group">
                        <!-- Ganti asset('images/banner-minat-bakat.png') dengan path file gambar kamu di folder public -->
                        <img src="{{ asset('images/banner-minat.bakat.png') }}" alt="Kenali Potensi & Bidang Impianmu" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        <!-- Overlay Gradient & Text -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent flex items-end p-6 sm:p-8">
                            <div class="text-white space-y-1">
                                <h3 class="text-base sm:text-xl font-extrabold">Kenali Potensi & Bidang Impianmu</h3>
                                <p class="text-xs sm:text-sm text-gray-200 leading-relaxed">Pilihlah skala penilaian yang paling mencerminkan tingkat kesukaanmu secara jujur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Instruksi Cantik -->
            <div class="bg-gradient-to-r from-indigo-900 to-[#2B4185] rounded-2xl p-6 text-white shadow-md flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center shrink-0 border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF7A59]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-xs font-black uppercase tracking-widest text-[#FF7A59]">Instruksi Pengisian</h2>
                        <p class="text-xs sm:text-sm font-medium text-indigo-100 mt-0.5">Berikan penilaian dari Sangat Tidak Suka hingga Sangat Suka pada setiap pernyataan berikut.</p>
                    </div>
                </div>
                <div class="px-4 py-2 bg-white/10 backdrop-blur-md rounded-xl border border-white/15 text-[11px] font-bold text-white shrink-0">
                    Wajib Diisi Semua
                </div>
            </div>

            <!-- Tabel Kuesioner Pernyataan Interaktif -->
            <form action="{{ route('student.assessment.minat-bakat.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="bg-white border border-[#E2E8F0] rounded-[28px] overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-indigo-50/70 text-[#3650A2] text-xs font-black uppercase tracking-wider border-b border-indigo-100">
                                    <th class="py-4 px-6 w-3/5">Pernyataan Aktivitas / Pekerjaan</th>
                                    <th class="py-4 px-4 text-center">Sangat Tidak Suka</th>
                                    <th class="py-4 px-4 text-center">Netral</th>
                                    <th class="py-4 px-4 text-center">Sangat Suka</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-xs sm:text-sm">
                                @forelse($questions as $index => $question)
                                    <tr class="hover:bg-indigo-50/30 transition duration-150 group">
                                        <td class="py-4 px-6 font-semibold text-gray-700 leading-relaxed">
                                            <span class="text-[#3650A2] font-bold mr-1.5">{{ $index + 1 }}.</span> {{ $question->question_text }}
                                        </td>
                                        <!-- Opsi 1: Sangat Tidak Suka -->
                                        <td class="py-4 px-4 text-center align-middle">
                                            <label class="relative flex items-center justify-center cursor-pointer">
                                                <input type="radio" name="responses[{{ $question->id }}]" value="1" class="option-input sr-only" required onchange="highlightRow(this)">
                                                <div class="option-label w-9 h-9 sm:w-10 sm:h-10 rounded-xl border-2 border-gray-200 bg-gray-50 flex items-center justify-center font-bold text-gray-500 transition-all duration-200 hover:border-indigo-300 hover:bg-indigo-50/50">
                                                    1
                                                </div>
                                            </label>
                                        </td>
                                        <!-- Opsi 2: Netral -->
                                        <td class="py-4 px-4 text-center align-middle">
                                            <label class="relative flex items-center justify-center cursor-pointer">
                                                <input type="radio" name="responses[{{ $question->id }}]" value="2" class="option-input sr-only" onchange="highlightRow(this)">
                                                <div class="option-label w-9 h-9 sm:w-10 sm:h-10 rounded-xl border-2 border-gray-200 bg-gray-50 flex items-center justify-center font-bold text-gray-500 transition-all duration-200 hover:border-indigo-300 hover:bg-indigo-50/50">
                                                    2
                                                </div>
                                            </label>
                                        </td>
                                        <!-- Opsi 3: Sangat Suka -->
                                        <td class="py-4 px-4 text-center align-middle">
                                            <label class="relative flex items-center justify-center cursor-pointer">
                                                <input type="radio" name="responses[{{ $question->id }}]" value="3" class="option-input sr-only" onchange="highlightRow(this)">
                                                <div class="option-label w-9 h-9 sm:w-10 sm:h-10 rounded-xl border-2 border-gray-200 bg-gray-50 flex items-center justify-center font-bold text-gray-500 transition-all duration-200 hover:border-indigo-300 hover:bg-indigo-50/50">
                                                    3
                                                </div>
                                            </label>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-10 text-center text-gray-500 font-medium">
                                            Belum ada pertanyaan asesmen minat bakat yang diatur oleh Admin di database.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tombol Navigasi Bawah -->
                <div class="flex justify-between items-center pt-4">
                    <a href="{{ route('student.assessment.index') }}" class="px-6 py-3.5 rounded-2xl bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-bold text-xs shadow-xs transition flex items-center gap-2">
                        &larr; Kembali
                    </a>
                    <button type="submit" class="px-8 py-3.5 rounded-2xl bg-gradient-coral text-white font-extrabold text-xs shadow-lg shadow-orange-950/20 hover:scale-105 transition flex items-center gap-2">
                        <span>Selanjutnya</span> &rarr;
                    </button>
                </div>
            </form>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        // Fungsi opsional untuk memberi efek background tipis pada baris tabel yang sudah dipilih
        function highlightRow(radio) {
            const row = radio.closest('tr');
            // Hapus kelas aktif dari semua baris terkait dalam grup atau beri tanda terpenuhi
            row.style.backgroundColor = '#F8FAFC';
        }
    </script>
</body>
</html>
