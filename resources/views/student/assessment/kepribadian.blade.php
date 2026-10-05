<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Kepribadian Karier - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #1E2D62 100%); }
        .bg-gradient-strong { background: linear-gradient(135deg, #2B4185 0%, #141F43 100%); }
        .card-shadow { box-shadow: 0 10px 30px -5px rgba(54, 80, 162, 0.08); }

        /* Interactive Option Cards Style */
        .option-card {
            transition: all 0.25s ease-in-out;
        }
        input[type="radio"]:checked + .option-card {
            background-color: #F0F5FF;
            border-color: #3650A2;
            box-shadow: 0 4px 12px rgba(54, 80, 162, 0.12);
        }
        input[type="radio"]:checked + .option-card .radio-dot {
            background-color: #3650A2;
            border-color: #3650A2;
            box-shadow: inset 0 0 0 3px #ffffff;
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Beranda</span>
                </a>

                <!-- Asesmen (Aktif) -->
                <a href="{{ route('student.assessment.index') }}" class="flex items-center gap-3.5 px-4.5 py-4 rounded-2xl bg-gradient-strong text-white font-bold text-sm shadow-lg shadow-indigo-900/25 transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#FF7A59]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    <span>Asesmen</span>
                </a>

                <!-- Eksplorasi -->
                <a href="{{ route('student.exploration.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>Eksplorasi</span>
                </a>

                <!-- Education Planning -->
                <a href="{{ route('student.planning.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    <span>Education Planning</span>
                </a>

                <!-- Konsultasi BK -->
                <a href="{{ route('student.consultation.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <span>Konsultasi BK</span>
                </a>

                <!-- Profil -->
                <a href="{{ route('student.profile.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all duration-200 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-[#3650A2] transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Profil</span>
                </a>
            </nav>
        </div>

        <!-- Logout Section -->
        <div class="p-5 border-t border-gray-100 bg-white">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 rounded-xl transition font-bold group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 group-hover:text-red-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Keluar Sistem</span>
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
            <span class="text-xs font-extrabold px-3.5 py-1.5 bg-indigo-50 text-[#3650A2] rounded-xl tracking-wide border border-indigo-100/50">Panel Siswa</span>
            <span class="text-gray-300 font-light hidden sm:inline">/</span>
            <h1 class="text-sm font-black text-gray-800 tracking-tight hidden sm:inline">Tes Kepribadian Karier</h1>
        </div>

        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-extrabold text-gray-900 leading-tight">{{ $user->name ?? 'Anggia Tresa' }}</div>
                <div class="text-xs font-semibold text-indigo-500">Siswa</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-gradient-strong text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-900/20">
                {{ strtoupper(substr($user->name ?? 'AT', 0, 2)) }}
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="md:ml-72 pt-24 min-h-screen flex flex-col">
        <main class="p-6 md:p-10 space-y-8 max-w-6xl w-full mx-auto flex-1">

            <!-- Header Banner Persis Dashboard -->
            <div class="relative rounded-[40px] overflow-hidden px-8 sm:px-12 py-10 sm:py-14 shadow-lg border border-indigo-100 flex flex-col justify-center">
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset('images/banner.kemampuan.png') }}" alt="Background Asesmen" class="w-full h-full object-cover object-center filter scale-105">
                </div>
                <div class="absolute inset-0 z-5 bg-gradient-to-r from-[#141F43]/80 via-[#1E2D62]/85 to-[#3650A2]/80 backdrop-blur-[1px]"></div>

                <div class="space-y-3 relative z-20 max-w-2xl text-white">
                    <span class="px-4 py-1.5 bg-[#FF7A59] text-white rounded-full text-xs font-extrabold tracking-wider uppercase shadow-md inline-block">Tes Kepribadian Karier</span>
                    <h1 class="text-2xl sm:text-4xl font-black tracking-tight text-white drop-shadow-sm">Kenali Potensi & Karakter Dirimu 🎯</h1>
                    <p class="text-gray-200 text-xs sm:text-sm font-medium leading-relaxed drop-shadow">
                        Kenali potensi unik dan karakter dirimu secara mendalam. Jawablah setiap pernyataan dengan jujur dan santai—tidak ada jawaban benar atau salah!
                    </p>
                </div>
            </div>

            <!-- Form Tabel Pertanyaan Interaktif -->
            <form action="{{ route('student.assessment.kepribadian.store') }}" method="POST" class="space-y-6">
                @csrf

                @php
                    $displayQuestions = $questions ?? [
                        (object)['id' => 1, 'question_text' => 'Saya merasa sangat antusias ketika harus memimpin sebuah kelompok atau proyek kerja tim.'],
                        (object)['id' => 2, 'question_text' => 'Saya lebih menyukai pekerjaan yang berkaitan dengan analisis data, angka, dan pemecahan masalah logis.'],
                        (object)['id' => 3, 'question_text' => 'Saya senang mendengarkan dan membantu orang lain yang sedang menghadapi masalah pribadi atau sosial.'],
                        (object)['id' => 4, 'question_text' => 'Saya memiliki ketertarikan tinggi pada seni, desain visual, kreativitas, atau produksi media.'],
                        (object)['id' => 5, 'question_text' => 'Saya menyukai rutinitas kerja yang terstruktur, rapi, teliti, dan memiliki aturan operasional yang jelas.']
                    ];
                @endphp

                <div class="bg-white border border-[#E2E8F0] rounded-[32px] overflow-hidden card-shadow">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/90 border-b border-gray-200 text-gray-700 text-xs font-black uppercase tracking-wider">
                                    <th class="py-6 px-8 lg:w-3/5">Pernyataan Karakter & Kepribadian</th>
                                    <th class="py-6 px-4 text-center lg:w-1/5">Sangat Sesuai</th>
                                    <th class="py-6 px-4 text-center lg:w-1/5">Sangat Tidak Sesuai</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm font-semibold text-gray-700">
                                @foreach($displayQuestions as $index => $q)
                                    @php
                                        $qid = is_object($q) ? $q->id : $q['id'];
                                        $qtext = is_object($q) ? $q->question_text : $q['text'];
                                    @endphp
                                    <tr class="hover:bg-indigo-50/20 transition-colors duration-150">
                                        <td class="py-6 px-8 font-bold text-gray-800 leading-relaxed">
                                            <div class="flex items-start gap-3.5">
                                                <span class="text-xs font-black text-[#3650A2] bg-indigo-50 border border-indigo-100 rounded-xl px-3 py-1.5 shrink-0 mt-0.5">#{{ $index + 1 }}</span>
                                                <span class="pt-1">{{ $qtext }}</span>
                                            </div>
                                        </td>
                                        <!-- Opsi Sangat Sesuai -->
                                        <td class="py-6 px-4 text-center">
                                            <label class="relative flex items-center justify-center cursor-pointer group">
                                                <input type="radio" name="responses[{{ $qid }}]" value="sangat_sesuai" required class="sr-only">
                                                <div class="option-card w-12 h-12 rounded-2xl border-2 border-gray-200 bg-white flex items-center justify-center group-hover:border-[#3650A2]/50 group-hover:bg-indigo-50/30">
                                                    <div class="radio-dot w-5 h-5 rounded-full border-2 border-gray-300 bg-white transition-all"></div>
                                                </div>
                                            </label>
                                        </td>
                                        <!-- Opsi Sangat Tidak Sesuai -->
                                        <td class="py-6 px-4 text-center">
                                            <label class="relative flex items-center justify-center cursor-pointer group">
                                                <input type="radio" name="responses[{{ $qid }}]" value="sangat_tidak_sesuai" required class="sr-only">
                                                <div class="option-card w-12 h-12 rounded-2xl border-2 border-gray-200 bg-white flex items-center justify-center group-hover:border-[#3650A2]/50 group-hover:bg-indigo-50/30">
                                                    <div class="radio-dot w-5 h-5 rounded-full border-2 border-gray-300 bg-white transition-all"></div>
                                                </div>
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tombol Aksi Navigasi Bawah -->
                <div class="flex items-center justify-between pt-6 pb-16">
                    <a href="{{ route('student.assessment.kemampuan') }}" class="px-8 py-4 rounded-2xl bg-white border border-gray-300 text-gray-700 font-extrabold text-xs shadow-sm hover:bg-gray-50 transition flex items-center gap-2">
                        &larr; Kembali ke Kemampuan
                    </a>
                    <button type="submit" class="px-9 py-4 rounded-2xl bg-[#FF7A59] text-white font-black text-xs shadow-xl shadow-orange-950/20 hover:bg-[#e86a4b] transition transform hover:-translate-y-0.5">
                        Simpan & Selesaikan Asesmen &rarr;
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
    </script>
</body>
</html>
