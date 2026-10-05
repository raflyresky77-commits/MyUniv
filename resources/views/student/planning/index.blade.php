<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Planning - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #1E2D62 100%); }
        .bg-gradient-strong { background: linear-gradient(135deg, #2B4185 0%, #141F43 100%); }
        .card-notion {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            box-shadow: 0 10px 30px -5px rgba(54, 80, 162, 0.06);
            transition: all 0.3s ease;
        }
        .card-notion:hover {
            border-color: #cbd5e1;
            box-shadow: 0 14px 35px -5px rgba(54, 80, 162, 0.1);
        }
        /* Animasi Transisi Teks & Checkbox */
        .task-text {
            transition: all 0.25s ease-in-out;
        }
    </style>
</head>
<body class="bg-[#F4F7FE] text-gray-800 antialiased selection:bg-[#FF7A59] selection:text-white">

    <!-- Backdrop Mobile Sidebar -->
    <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 md:hidden hidden backdrop-blur-xs transition-opacity"></div>

    <!-- Sidebar Navigation -->
    <aside id="mobileSidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-[#E2E8F0] flex flex-col justify-between transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl md:shadow-[4px_0_24px_rgba(54,80,162,0.05)] overflow-y-auto">
        <div>
            <!-- Brand Logo -->
            <div class="px-6 py-6 border-b border-gray-100 flex items-center gap-3.5">
                <div class="w-11 h-11 flex items-center justify-center bg-indigo-50 rounded-[16px] border border-indigo-200/80 p-1.5 shrink-0 overflow-hidden shadow-sm">
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
                <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all">Beranda</a>
                <a href="{{ route('student.assessment.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all">Assesmen</a>
                <a href="{{ route('student.exploration.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all">Eksplorasi</a>
                <a href="{{ route('student.planning.index') }}" class="flex items-center gap-3.5 px-4.5 py-4 rounded-2xl bg-gradient-strong text-white font-bold text-sm shadow-lg shadow-indigo-900/25 relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#FF7A59]"></div>
                    <span>Education Planning</span>
                </a>
                <a href="{{ route('student.consultation.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all">Konsultasi BK</a>
                <a href="{{ route('student.profile.index') }}" class="flex items-center gap-3.5 px-4.5 py-3.5 rounded-2xl text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold text-sm transition-all">Profil</a>
            </nav>
        </div>

        <div class="p-5 border-t border-gray-100 bg-white">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-red-600 hover:bg-red-50 font-bold text-sm transition-all">Keluar (Logout)</button>
            </form>
        </div>
    </aside>

    <!-- Top Navbar -->
    <header class="bg-white/90 backdrop-blur-md border-b border-[#E2E8F0] px-6 lg:px-10 py-5 flex justify-between items-center fixed top-0 right-0 left-0 md:left-72 z-40 shadow-xs">
        <div class="flex items-center gap-3">
            <button type="button" onclick="toggleSidebar()" class="md:hidden p-2 rounded-xl text-gray-700 bg-gray-100 hover:bg-indigo-50 hover:text-[#3650A2]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <span class="text-sm font-extrabold text-[#3650A2] hidden sm:inline">Education Planning &amp; Roadmap Karir</span>
        </div>

        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-extrabold text-gray-900 leading-tight">{{ Auth::user()->name ?? 'Siswa' }}</div>
                <div class="text-xs font-semibold text-indigo-500">Siswa</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-gradient-strong text-white flex items-center justify-center font-extrabold text-xs shadow-md">
                {{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 2)) }}
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="md:ml-72 pt-28 min-h-screen flex flex-col">
        <main class="p-6 md:p-10 space-y-8 max-w-6xl w-full mx-auto flex-1">

            <!-- Flash Message -->
            @if(session('success'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Banner Header -->
            <div class="relative rounded-[36px] overflow-hidden px-8 sm:px-12 py-10 shadow-lg border border-indigo-100 flex flex-col justify-center">
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset('images/2!.png') }}" alt="Background" class="w-full h-full object-cover object-center filter scale-105">
                </div>
                <div class="absolute inset-0 z-5 bg-gradient-to-r from-[#141F43]/70 via-[#1E2D62]/80 to-[#3650A2]/80"></div>
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 relative z-20 text-white">
                    <div class="space-y-3 max-w-2xl">
                        <span class="px-4 py-1.5 bg-[#FF7A59] text-white rounded-full text-xs font-extrabold tracking-wider uppercase inline-block">Roadmap Studi &amp; Karir</span>
                        <h1 class="text-2xl sm:text-4xl font-black tracking-tight text-white">Education Planning 🚀</h1>
                        <p class="text-gray-200 text-xs sm:text-sm font-medium leading-relaxed">
                            Rancang target kuliah, atur milestone persiapan, dan pantau langkah sukses masa depanmu bersama MyUniv.
                        </p>
                    </div>
                    <button onclick="openModal()" class="px-6 py-3.5 bg-[#FF7A59] hover:bg-[#e0684a] text-white font-extrabold text-xs sm:text-sm rounded-2xl shadow-lg shadow-orange-500/30 transition hover:scale-105 shrink-0 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        <span>Buat Rencana Baru</span>
                    </button>
                </div>
            </div>

            <!-- Tab Navigation Interaktif -->
            <div class="flex items-center gap-8 border-b border-gray-200 text-sm font-bold">
                <button onclick="switchTab('plans')" id="tab-plans" class="pb-3 border-b-2 border-[#3650A2] text-[#3650A2] transition-all">Rencana Saya</button>
                <button onclick="switchTab('targets')" id="tab-targets" class="pb-3 border-b-2 border-transparent text-gray-400 hover:text-gray-600 transition-all">Target Kuliah &amp; Karir</button>
                <button onclick="switchTab('deadlines')" id="tab-deadlines" class="pb-3 border-b-2 border-transparent text-gray-400 hover:text-gray-600 transition-all">Timeline &amp; Deadline</button>
            </div>

            <!-- KONTEN TAB 1: RENCANA SAYA -->
            <div id="content-plans" class="space-y-6">
                @forelse($plans ?? [] as $plan)
                <div class="card-notion rounded-3xl p-6 sm:p-8 space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#FF7A59]"></span>
                                <h2 class="text-lg font-black text-gray-900">{{ $plan['title'] ?? $plan->title }}</h2>
                            </div>
                            <p class="text-xs text-gray-500 mt-1 ml-4.5">{{ $plan['description'] ?? $plan->description }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <form action="{{ url('/student/planning/' . ($plan['id'] ?? $plan->id)) }}" method="POST" onsubmit="return confirm('Hapus rencana ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3.5 py-2 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition">Hapus</button>
                            </form>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs font-extrabold text-gray-600">
                            <span>Progress Keseluruhan</span>
                            <span class="text-[#3650A2]" id="progress-text-{{ $loop->index }}">
                                @php
                                    $tasks = $plan['tasks'] ?? $plan->tasks ?? [];
                                    $completedCount = collect($tasks)->where('status', 'Selesai')->count();
                                    $totalCount = count($tasks);
                                    $percent = $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0;
                                    echo $percent . '%';
                                @endphp
                            </span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden p-0.5 border border-gray-200/60">
                            <div id="progress-bar-{{ $loop->index }}" class="bg-gradient-to-r from-[#3650A2] to-[#FF7A59] h-2 rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>

                    <!-- Checklist Table / Items dengan Interaksi Animasi & Checkbox Aktif -->
                    <div class="space-y-3 pt-2 task-container">
                        @foreach(($plan['tasks'] ?? $plan->tasks ?? []) as $taskItem)
                        @php
                            $isDone = (isset($taskItem['status']) ? $taskItem['status'] : $taskItem->status) === 'Selesai';
                        @endphp
                        <div class="flex items-center justify-between p-4 rounded-2xl bg-[#F8FAFC] border border-gray-100 hover:border-indigo-200 transition shadow-xs">
                            <div class="flex items-center gap-3.5">
                                <!-- Checkbox interaktif aktif yang bisa di-check/uncheck -->
                                <input type="checkbox" {{ $isDone ? 'checked' : '' }}
                                    onchange="toggleTaskStatus(this)"
                                    class="w-4 h-4 rounded text-[#3650A2] focus:ring-[#3650A2] cursor-pointer transition transform active:scale-90">
                                <span class="text-xs sm:text-sm font-bold task-text {{ $isDone ? 'line-through text-gray-400' : 'text-gray-700' }}">
                                    {{ $taskItem['name'] ?? $taskItem->name }}
                                </span>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="text-[11px] font-semibold text-gray-400 hidden sm:flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $taskItem['date'] ?? $taskItem->date ?? '-' }}
                                </span>
                                <span class="task-badge px-3 py-1 rounded-xl text-[11px] font-extrabold border shadow-xs {{ $isDone ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-gray-100 text-gray-600 border-gray-200' }}">
                                    {{ $isDone ? 'Selesai' : 'Pending' }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @empty
                <div class="card-notion rounded-3xl p-12 text-center space-y-3">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-indigo-50 border border-indigo-200 flex items-center justify-center text-[#3650A2] text-xl font-bold">📋</div>
                    <h3 class="text-base font-black text-gray-900">Belum Ada Rencana Pendidikan</h3>
                    <p class="text-xs text-gray-500 max-w-sm mx-auto">Buat rencana pertamamu untuk mulai memetakan target kuliah dan langkah persiapan kariermu di MyUniv.</p>
                </div>
                @endforelse
            </div>

            <!-- KONTEN TAB 2: TARGET KULIAH & KARIR (Dataset Lengkap + Opsi Lainnya) -->
            <div id="content-targets" class="space-y-6 hidden">
                <div class="flex justify-between items-center bg-white p-5 rounded-2xl border border-gray-200 shadow-xs">
                    <div>
                        <h3 class="text-sm font-black text-gray-900">Pengaturan Target Studi &amp; Profesi</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Tentukan universitas, jurusan, dan karier impianmu menggunakan dataset atau masukkan manual.</p>
                    </div>
                    <button onclick="openTargetModal()" class="px-5 py-2.5 bg-[#3650A2] hover:bg-[#2b4185] text-white font-extrabold text-xs rounded-xl shadow-md transition">
                        Ubah Target Pilihan
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Card Universitas & Jurusan -->
                    <div class="card-notion rounded-3xl p-6 sm:p-8 space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-[#3650A2] font-black text-lg">🎯</div>
                        <div>
                            <span class="text-[11px] font-extrabold text-indigo-400 uppercase tracking-wider">Pilihan Utama</span>
                            <h3 class="text-lg font-black text-gray-900 mt-0.5">Universitas &amp; Jurusan</h3>
                        </div>
                        <div class="p-4 rounded-2xl bg-[#F8FAFC] border border-gray-100 space-y-2">
                            <div class="text-xs text-gray-500 font-semibold">Kampus Impian: <strong id="display-univ" class="text-gray-800">{{ $target->university ?? 'Institut Teknologi Bandung (ITB)' }}</strong></div>
                            <div class="text-xs text-gray-500 font-semibold">Program Studi: <strong id="display-major" class="text-gray-800">{{ $target->major ?? 'Teknik Informatika (S1)' }}</strong></div>
                            <div class="text-xs text-gray-500 font-semibold">Jalur Seleksi: <strong id="display-path" class="text-indigo-600">{{ $target->admission_path ?? 'SNBP &amp; SNBT' }}</strong></div>
                        </div>
                        <a href="{{ route('student.exploration.index') }}" class="block text-center py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs transition">Eksplorasi Kampus Lainnya</a>
                    </div>

                    <!-- Card Profesi & Karir -->
                    <div class="card-notion rounded-3xl p-6 sm:p-8 space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-orange-50 border border-orange-100 flex items-center justify-center text-[#FF7A59] font-black text-lg">💼</div>
                        <div>
                            <span class="text-[11px] font-extrabold text-[#FF7A59] uppercase tracking-wider">Masa Depan</span>
                            <h3 class="text-lg font-black text-gray-900 mt-0.5">Target Profesi / Karir</h3>
                        </div>
                        <div class="p-4 rounded-2xl bg-[#F8FAFC] border border-gray-100 space-y-2">
                            <div class="text-xs text-gray-500 font-semibold">Profesi Impian: <strong id="display-career" class="text-gray-800">{{ $target->career ?? 'Software Engineer / Full-Stack Dev' }}</strong></div>
                            <div class="text-xs text-gray-500 font-semibold">Skill Utama: <strong id="display-skill" class="text-gray-800">Laravel, PostgreSQL, Tailwind CSS</strong></div>
                            <div class="text-xs text-gray-500 font-semibold">Status Persiapan: <strong class="text-emerald-600">On Track (Sesuai Rencana)</strong></div>
                        </div>
                        <a href="{{ route('student.assessment.index') }}" class="block text-center py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs transition">Ulangi Asesmen Minat Bakat</a>
                    </div>
                </div>
            </div>

            <!-- KONTEN TAB 3: TIMELINE & DEADLINE (Pure Kalender Akademik Resmi) -->
            <div id="content-deadlines" class="space-y-6 hidden">
                <div class="card-notion rounded-3xl p-6 sm:p-8 space-y-6">
                    <div>
                        <span class="px-3 py-1 bg-indigo-50 text-[#3650A2] rounded-full text-[10px] font-extrabold tracking-wider uppercase inline-block mb-2">Kalender Resmi Nasional</span>
                        <h3 class="text-lg font-black text-gray-900">Timeline &amp; Deadline Penting Camaba</h3>
                        <p class="text-xs text-gray-500 mt-1">Timeline ini disusun otomatis berdasarkan jadwal seleksi masuk perguruan tinggi nasional.</p>
                    </div>

                    <div class="relative border-l-2 border-indigo-200 ml-4 space-y-6 py-2">
                        <div class="relative pl-6">
                            <div class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-[#3650A2] border-2 border-white shadow-xs"></div>
                            <div class="text-xs font-bold text-indigo-500">10 September 2026</div>
                            <div class="text-sm font-black text-gray-900">Riset Jurusan &amp; Universitas Selesai</div>
                            <div class="text-xs text-gray-500 mt-0.5">Menentukan pilihan prodi dan kriteria kampus yang dituju melalui fitur eksplorasi.</div>
                        </div>
                        <div class="relative pl-6">
                            <div class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-[#FF7A59] border-2 border-white shadow-xs"></div>
                            <div class="text-xs font-bold text-[#FF7A59]">30 November 2026</div>
                            <div class="text-sm font-black text-gray-900">Evaluasi &amp; Peningkatan Nilai Rapor Semester 5</div>
                            <div class="text-xs text-gray-500 mt-0.5">Batas akhir penguatan nilai akademik untuk persyaratan pendaftaran jalur SNBP.</div>
                        </div>
                        <div class="relative pl-6">
                            <div class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-gray-300 border-2 border-white shadow-xs"></div>
                            <div class="text-xs font-bold text-gray-400">31 Januari 2027</div>
                            <div class="text-sm font-black text-gray-900">Simulasi / Manasik &amp; Latihan Soal SNBT (UTBK)</div>
                            <div class="text-xs text-gray-500 mt-0.5">Pemantapan materi ujian tulis berbasis komputer dan tryout berkala.</div>
                        </div>
                        <div class="relative pl-6">
                            <div class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-gray-300 border-2 border-white shadow-xs"></div>
                            <div class="text-xs font-bold text-gray-400">28 Februari 2027</div>
                            <div class="text-sm font-black text-gray-900">Finalisasi Portofolio &amp; Pendaftaran SNBP</div>
                            <div class="text-xs text-gray-500 mt-0.5">Pengunggahan berkas akhir dan permanenisasi akun ke portal seleksi nasional.</div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- Modal Buat Rencana Baru -->
    <div id="planModal" class="fixed inset-0 bg-black/50 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-6 shadow-2xl">
            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                <h3 class="text-lg font-black text-gray-900">Buat Rencana Baru</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 font-bold">✕</button>
            </div>

            <form action="{{ route('student.planning.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">Judul Rencana</label>
                    <input type="text" name="title" placeholder="Contoh: Persiapan UTBK 2027" class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm" required>
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">Deskripsi (opsional)</label>
                    <textarea name="description" rows="3" placeholder="Tulis deskripsi singkat tentang rencanamu..." class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm resize-none"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal()" class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-sm">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#3650A2] hover:bg-[#2b4185] text-white font-bold text-sm shadow-md">Simpan Rencana</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Ubah Target Kuliah & Karir (Dataset + Lainnya) -->
    <div id="targetModal" class="fixed inset-0 bg-black/50 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-6 shadow-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                <h3 class="text-lg font-black text-gray-900">Atur Target Kuliah &amp; Karir</h3>
                <button onclick="closeTargetModal()" class="text-gray-400 hover:text-gray-600 font-bold">✕</button>
            </div>

            <form onsubmit="saveTargetForm(event)" class="space-y-4">
                <div>
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">Pilih Kampus / Universitas</label>
                    <select id="select-univ" onchange="checkCustomUniv(this)" class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm bg-white">
                        <option value="Institut Teknologi Bandung (ITB)">Institut Teknologi Bandung (ITB)</option>
                        <option value="Universitas Indonesia (UI)">Universitas Indonesia (UI)</option>
                        <option value="Universitas Gadjah Mada (UGM)">Universitas Gadjah Mada (UGM)</option>
                        <option value="Institut Teknologi Sepuluh Nopember (ITS)">Institut Teknologi Sepuluh Nopember (ITS)</option>
                        <option value="Telkom University">Telkom University</option>
                        <option value="Universitas Padjadjaran (Unpad)">Universitas Padjadjaran (Unpad)</option>
                        <option value="Lainnya">Lainnya (Catat Manual)</option>
                    </select>
                </div>
                <div id="custom-univ-wrapper" class="hidden">
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">Nama Kampus Lainnya</label>
                    <input type="text" id="input-custom-univ" placeholder="Ketik nama kampus pilihanmu..." class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm">
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">Program Studi (Jurusan)</label>
                    <select id="select-major" onchange="checkCustomMajor(this)" class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm bg-white">
                        <option value="Teknik Informatika (S1)">Teknik Informatika (S1)</option>
                        <option value="Sistem Informasi (S1)">Sistem Informasi (S1)</option>
                        <option value="Teknik Elektro (S1)">Teknik Elektro (S1)</option>
                        <option value="Manajemen Bisnis (S1)">Manajemen Bisnis (S1)</option>
                        <option value="Kedokteran (S1)">Kedokteran (S1)</option>
                        <option value="Lainnya">Lainnya (Catat Manual)</option>
                    </select>
                </div>
                <div id="custom-major-wrapper" class="hidden">
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">Nama Program Studi Lainnya</label>
                    <input type="text" id="input-custom-major" placeholder="Ketik nama prodi pilihanmu..." class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm">
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">Jalur Seleksi Utama</label>
                    <select id="select-path" class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm bg-white">
                        <option value="SNBP &amp; SNBT">SNBP &amp; SNBT</option>
                        <option value="SNBP (Jalur Rapor)">SNBP (Jalur Rapor)</option>
                        <option value="SNBT (UTBK)">SNBT (UTBK)</option>
                        <option value="Jalur Mandiri">Jalur Mandiri / UTUL</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">Profesi / Karir Impian</label>
                    <select id="select-career" onchange="checkCustomCareer(this)" class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm bg-white">
                        <option value="Software Engineer / Full-Stack Dev">Software Engineer / Full-Stack Dev</option>
                        <option value="Data Scientist / Data Analyst">Data Scientist / Data Analyst</option>
                        <option value="UI/UX Product Designer">UI/UX Product Designer</option>
                        <option value="Cyber Security Specialist">Cyber Security Specialist</option>
                        <option value="Digital Entrepreneur">Digital Entrepreneur</option>
                        <option value="Lainnya">Lainnya (Catat Manual)</option>
                    </select>
                </div>
                <div id="custom-career-wrapper" class="hidden">
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">Nama Profesi Lainnya</label>
                    <input type="text" id="input-custom-career" placeholder="Ketik profesi impianmu..." class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm">
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeTargetModal()" class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-sm">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#3650A2] hover:bg-[#2b4185] text-white font-bold text-sm shadow-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('mobileSidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebarBackdrop').classList.toggle('hidden');
        }
        function openModal() {
            document.getElementById('planModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('planModal').classList.add('hidden');
        }

        function openTargetModal() {
            document.getElementById('targetModal').classList.remove('hidden');
        }
        function closeTargetModal() {
            document.getElementById('targetModal').classList.add('hidden');
        }

        // Script untuk perpindahan Tab Interaktif
        function switchTab(tabName) {
            document.getElementById('content-plans').classList.add('hidden');
            document.getElementById('content-targets').classList.add('hidden');
            document.getElementById('content-deadlines').classList.add('hidden');

            document.getElementById('tab-plans').className = "pb-3 border-b-2 border-transparent text-gray-400 hover:text-gray-600 transition-all";
            document.getElementById('tab-targets').className = "pb-3 border-b-2 border-transparent text-gray-400 hover:text-gray-600 transition-all";
            document.getElementById('tab-deadlines').className = "pb-3 border-b-2 border-transparent text-gray-400 hover:text-gray-600 transition-all";

            document.getElementById('content-' + tabName).classList.remove('hidden');
            document.getElementById('tab-' + tabName).className = "pb-3 border-b-2 border-[#3650A2] text-[#3650A2] transition-all";
        }

        // Fungsi Animasi Checkbox & Perubahan Status Teks Real-Time
        function toggleTaskStatus(checkbox) {
            const card = checkbox.closest('.card-notion');
            const textSpan = checkbox.parentElement.querySelector('.task-text');
            const badge = checkbox.closest('.flex.items-center.justify-between').querySelector('.task-badge');

            if (checkbox.checked) {
                textSpan.classList.add('line-through', 'text-gray-400');
                textSpan.classList.remove('text-gray-700');
                badge.textContent = 'Selesai';
                badge.className = 'task-badge px-3 py-1 rounded-xl text-[11px] font-extrabold border shadow-xs bg-emerald-50 text-emerald-700 border-emerald-200';
            } else {
                textSpan.classList.remove('line-through', 'text-gray-400');
                textSpan.classList.add('text-gray-700');
                badge.textContent = 'Pending';
                badge.className = 'task-badge px-3 py-1 rounded-xl text-[11px] font-extrabold border shadow-xs bg-gray-100 text-gray-600 border-gray-200';
            }

            updateCardProgress(card);
        }

        // Hitung ulang progress bar card terkait
        function updateCardProgress(card) {
            const checkboxes = card.querySelectorAll('input[type="checkbox"]');
            const total = checkboxes.length;
            let checked = 0;
            checkboxes.forEach(cb => { if(cb.checked) checked++; });

            const percent = total > 0 ? Math.round((checked / total) * 100) : 0;

            // Cari elemen progress text dan bar di dalam card ini
            const progressText = card.querySelector('[id^="progress-text-"]');
            const progressBar = card.querySelector('[id^="progress-bar-"]');

            if(progressText) progressText.textContent = percent + '%';
            if(progressBar) progressBar.style.width = percent + '%';
        }

        // Handler Dataset Lainnya untuk Modal Target
        function checkCustomUniv(select) {
            const wrapper = document.getElementById('custom-univ-wrapper');
            if(select.value === 'Lainnya') {
                wrapper.classList.remove('hidden');
            } else {
                wrapper.classList.add('hidden');
            }
        }
        function checkCustomMajor(select) {
            const wrapper = document.getElementById('custom-major-wrapper');
            if(select.value === 'Lainnya') {
                wrapper.classList.remove('hidden');
            } else {
                wrapper.classList.add('hidden');
            }
        }
        function checkCustomCareer(select) {
            const wrapper = document.getElementById('custom-career-wrapper');
            if(select.value === 'Lainnya') {
                wrapper.classList.remove('hidden');
            } else {
                wrapper.classList.add('hidden');
            }
        }

        function saveTargetForm(event) {
            event.preventDefault();

            const univSelect = document.getElementById('select-univ').value;
            const customUniv = document.getElementById('input-custom-univ').value;
            const finalUniv = (univSelect === 'Lainnya' && customUniv) ? customUniv : univSelect;

            const majorSelect = document.getElementById('select-major').value;
            const customMajor = document.getElementById('input-custom-major').value;
            const finalMajor = (majorSelect === 'Lainnya' && customMajor) ? customMajor : majorSelect;

            const finalPath = document.getElementById('select-path').value;

            const careerSelect = document.getElementById('select-career').value;
            const customCareer = document.getElementById('input-custom-career').value;
            const finalCareer = (careerSelect === 'Lainnya' && customCareer) ? customCareer : careerSelect;

            // Update DOM Tampilan Target
            document.getElementById('display-univ').textContent = finalUniv;
            document.getElementById('display-major').textContent = finalMajor;
            document.getElementById('display-path').innerHTML = finalPath;
            document.getElementById('display-career').textContent = finalCareer;

            closeTargetModal();
        }
    </script>
</body>
</html>
