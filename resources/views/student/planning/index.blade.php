<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Education Planning - MyUniv</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    @include('components.global-loading')

    {{-- Backdrop Mobile Sidebar --}}
    <div
        id="sidebarBackdrop"
        aria-hidden="true"
        onclick="closeSidebar()"
        class="fixed inset-0 z-40 hidden md:hidden transition-opacity" style="background: transparent !important; backdrop-filter: none !important; -webkit-backdrop-filter: none !important;">
    </div>

    {{-- Komponen Sidebar Siswa --}}
    <x-student.student-sidebar active="planning" />

    {{-- Komponen Topbar --}}
    <div class="fixed top-0 right-0 left-0 z-30 md:left-72">
        <x-student.student-topbar
            title="Education Planning"
            :username="Auth::user()->name ?? 'Siswa'"
            :initials="strtoupper(substr(Auth::user()->name ?? 'S', 0, 2))"
        />
    </div>

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

            @if($errors->any())
                <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs font-bold">
                    <p class="mb-1">Ada data yang perlu diperbaiki:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Header menggunakan desain komponen header MyUniv yang sudah ada --}}
            <section class="bg-gradient-strong rounded-[32px] p-8 sm:p-10 text-white relative overflow-hidden shadow-xl shadow-indigo-950/15">
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute right-20 top-0 w-32 h-32 bg-[#FF7A59]/20 rounded-full blur-xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl space-y-3">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-bold text-indigo-100">
                        <svg class="w-3.5 h-3.5 text-[#FF7A59]" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.788 0l7-3a1 1 0 000-1.84l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.17 1 1 0 01.01-1.98c.35.035.7.093 1.05.17V16.5a1 1 0 001 1h8a1 1 0 001-1v-4.148c.35-.077.7-.135 1.05-.17a1 1 0 01.01 1.98 8.969 8.969 0 01-1.05.17v-4.102l1.69-.723a1 1 0 000-1.84l-7-3a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84z"/></svg>
                        Roadmap Studi &amp; Karir
                    </span>

                    <h1 class="text-2xl sm:text-4xl font-black tracking-tight leading-tight">Education Planning</h1>
                    <p class="text-xs sm:text-sm text-indigo-100 font-medium leading-relaxed">Rancang target kuliah, atur milestone persiapan, dan pantau langkah sukses masa depanmu bersama MyUniv.</p>

                    <div class="pt-2">
                        <x-button type="button" variant="coral" onclick="openModal()" class="!px-6 !py-3.5 !rounded-2xl !text-xs sm:!text-sm !shadow-lg !shadow-orange-500/30 hover:!scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            <span>Buat Rencana Baru</span>
                        </x-button>
                    </div>
                </div>
            </section>

            <!-- Tab Navigation Interaktif -->
            <div class="flex items-center gap-8 border-b border-gray-200 text-sm font-bold">
                <button onclick="switchTab('plans')" id="tab-plans" class="pb-3 border-b-2 border-[#3650A2] text-[#3650A2] transition-all">Rencana Saya</button>
                <button onclick="switchTab('targets')" id="tab-targets" class="pb-3 border-b-2 border-transparent text-gray-400 hover:text-gray-600 transition-all">Target Pilihan</button>
            </div>

            <!-- KONTEN TAB 1: RENCANA SAYA -->
            <div id="content-plans" class="space-y-6">
                @forelse($plans ?? [] as $plan)
                <x-card variant="default" class="card-notion !p-6 sm:!p-8 rounded-3xl space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#FF7A59]"></span>
                                <h2 class="text-lg font-black text-gray-900">{{ $plan['title'] ?? $plan->title }}</h2>
                            </div>
                            <p class="text-xs text-gray-500 mt-1 ml-4.5">{{ $plan['description'] ?? $plan->description }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button
                                type="button"
                                onclick="openEditPlanModal(this)"
                                data-id="{{ $plan['id'] ?? $plan->id }}"
                                data-title="{{ $plan['title'] ?? $plan->title }}"
                                data-description="{{ $plan['description'] ?? $plan->description }}"
                                class="px-3.5 py-2 text-xs font-bold text-[#3650A2] bg-indigo-50 hover:bg-indigo-100 rounded-xl transition">
                                Edit
                            </button>

                            <form action="{{ route('student.planning.destroy', $plan['id'] ?? $plan->id) }}"
                                method="POST"
                                class="delete-planning-form"
                                onsubmit="return confirmDeletePlanning(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3.5 py-2 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition">Hapus</button>
                            </form>
                        </div>
                    </div>

                    <!-- Progress Bar: komponen reusable, nilai tetap dihitung dari tasks -->
                    @php
                        $tasks = $plan['tasks'] ?? $plan->tasks ?? [];
                        $completedCount = collect($tasks)->where('status', 'Selesai')->count();
                        $totalCount = count($tasks);
                        $percent = $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 0;
                    @endphp
                    <x-progress
                        :value="$percent"
                        label="Progress Keseluruhan"
                        id="progress-container-{{ $loop->index }}"
                        class="progress-component"
                    />

                    <!-- Checklist Task -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2">
                        <div>
                            <h3 class="text-sm font-black text-gray-800">Checklist Persiapan</h3>
                            <p class="text-[11px] text-gray-400 mt-0.5">Tambahkan dan kelola langkah persiapanmu sendiri.</p>
                        </div>

                        <button
                            type="button"
                            onclick="openAddTaskModal(this)"
                            data-plan-id="{{ $plan['id'] ?? $plan->id }}"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-[#3650A2] hover:bg-[#2b4185] text-white text-xs font-extrabold shadow-sm transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v14m7-7H5"/>
                            </svg>
                            Tambah Task
                        </button>
                    </div>

                    <div class="space-y-3 task-container">
                        @forelse(($plan['tasks'] ?? $plan->tasks ?? []) as $taskItem)
                            @php
                                $isDone = (isset($taskItem['status']) ? $taskItem['status'] : $taskItem->status) === 'Selesai';
                                $taskId = $taskItem['id'] ?? $taskItem->id;
                                $taskName = $taskItem['name'] ?? $taskItem->name;
                                $taskDeadline = $taskItem['deadline'] ?? '';
                                $taskDate = $taskItem['date'] ?? $taskItem->date ?? '-';
                            @endphp

                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 rounded-2xl bg-[#F8FAFC] border border-gray-100 hover:border-indigo-200 transition shadow-xs">
                                <div class="flex items-start sm:items-center gap-3.5 min-w-0">
                                    <input
                                        type="checkbox"
                                        {{ $isDone ? 'checked' : '' }}
                                        data-update-url="{{ route('student.planning.checklist.update', ['checklist' => $taskId]) }}"
                                        onchange="toggleTaskStatus(this)"
                                        class="mt-0.5 sm:mt-0 w-4 h-4 shrink-0 rounded text-[#3650A2] focus:ring-[#3650A2] cursor-pointer transition transform active:scale-90">

                                    <div class="min-w-0">
                                        <span class="block text-xs sm:text-sm font-bold task-text {{ $isDone ? 'line-through text-gray-400' : 'text-gray-700' }}">
                                            {{ $taskName }}
                                        </span>
                                        <span class="sm:hidden mt-1 text-[10px] font-semibold text-gray-400">
                                            Deadline: {{ $taskDate }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between sm:justify-end gap-2 sm:gap-3 pl-7 sm:pl-0">
                                    <span class="hidden sm:flex text-[11px] font-semibold text-gray-400 items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $taskDate }}
                                    </span>

                                    <span class="task-badge px-3 py-1 rounded-xl text-[10px] sm:text-[11px] font-extrabold border shadow-xs {{ $isDone ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-gray-100 text-gray-600 border-gray-200' }}">
                                        {{ $isDone ? 'Selesai' : 'Pending' }}
                                    </span>

                                    <button
                                        type="button"
                                        onclick="openEditTaskModal(this)"
                                        data-id="{{ $taskId }}"
                                        data-title="{{ $taskName }}"
                                        data-deadline="{{ $taskDeadline }}"
                                        class="px-2.5 py-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-[#3650A2] text-[10px] font-bold transition">
                                        Edit
                                    </button>

                                    <form action="{{ route('student.planning.checklist.destroy', ['checklist' => $taskId]) }}"
                                        method="POST"
                                        onsubmit="confirmDeleteTask(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 text-[10px] font-bold transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="p-5 rounded-2xl border border-dashed border-gray-300 text-center text-xs text-gray-400">
                                Belum ada task. Klik <strong>Tambah Task</strong> untuk membuat task sendiri.
                            </div>
                        @endforelse
                    </div>
                </x-card>
                @empty
                <x-card variant="default" class="card-notion !p-12 rounded-3xl text-center space-y-3">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-indigo-50 border border-indigo-200 flex items-center justify-center text-[#3650A2] text-xl font-bold">📋</div>
                    <h3 class="text-base font-black text-gray-900">Belum Ada Rencana Pendidikan</h3>
                    <p class="text-xs text-gray-500 max-w-sm mx-auto">Buat rencana pertamamu untuk mulai memetakan target kuliah dan langkah persiapan kariermu di MyUniv.</p>
                </x-card>
                @endforelse
            </div>

            <!-- KONTEN TAB 2: TARGET KULIAH & KARIR (Dataset Lengkap + Opsi Lainnya) -->
            <div id="content-targets" class="space-y-6 hidden">
                <div class="flex justify-between items-center bg-white p-5 rounded-2xl border border-gray-200 shadow-xs">
                    <div>
                        <h3 class="text-sm font-black text-gray-900">Pengaturan Target Pilihan</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Tentukan universitas, program studi, jalur seleksi, dan profesi yang ingin kamu capai.</p>
                    </div>
                    <button onclick="openTargetModal()" class="px-5 py-2.5 bg-[#3650A2] hover:bg-[#2b4185] text-white font-extrabold text-xs rounded-xl shadow-md transition">
                        Ubah Target Pilihan
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Card Universitas & Jurusan -->
                    <x-card variant="default" class="card-notion !p-6 sm:!p-8 rounded-3xl space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-[#3650A2] font-black text-lg">🎯</div>
                        <div>
                            <span class="text-[11px] font-extrabold text-indigo-400 uppercase tracking-wider">Pilihan Utama</span>
                            <h3 class="text-lg font-black text-gray-900 mt-0.5">Universitas &amp; Jurusan</h3>
                        </div>
                        <div class="p-4 rounded-2xl bg-[#F8FAFC] border border-gray-100 space-y-2">
                            <div class="text-xs text-gray-500 font-semibold">Kampus Impian: <strong id="display-univ" class="text-gray-800">{{ $target->university ?? 'Belum ditentukan' }}</strong></div>
                            <div class="text-xs text-gray-500 font-semibold">Program Studi: <strong id="display-major" class="text-gray-800">{{ $target->major ?? 'Belum ditentukan' }}</strong></div>
                            <div class="text-xs text-gray-500 font-semibold">Jalur Seleksi: <strong id="display-path" class="text-indigo-600">{{ $target->admission_path ?? 'Belum ditentukan' }}</strong></div>
                        </div>
                        <a href="{{ route('student.exploration.index') }}" class="block text-center py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs transition">Eksplorasi Kampus Lainnya</a>
                    </x-card>

                    <!-- Card Profesi & Karir -->
                    <x-card variant="default" class="card-notion !p-6 sm:!p-8 rounded-3xl space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-orange-50 border border-orange-100 flex items-center justify-center text-[#FF7A59] font-black text-lg">💼</div>
                        <div>
                            <span class="text-[11px] font-extrabold text-[#FF7A59] uppercase tracking-wider">Masa Depan</span>
                            <h3 class="text-lg font-black text-gray-900 mt-0.5">Profesi &amp; Karier Impian</h3>
                        </div>
                        <div class="p-4 rounded-2xl bg-[#F8FAFC] border border-gray-100 space-y-2">
                            <div class="text-xs text-gray-500 font-semibold">Profesi Impian: <strong id="display-career" class="text-gray-800">{{ $target->career ?? 'Belum ditentukan' }}</strong></div>
                            <p class="text-[11px] text-gray-500 leading-relaxed">Profesi ini merupakan target pribadi yang kamu tentukan. Kamu bisa mengubahnya kapan saja sesuai perkembangan minat dan rencana pendidikan.</p>
                        </div>
                        <a href="{{ route('student.assessment.index') }}" class="block text-center py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs transition">Ulangi Asesmen Minat Bakat</a>
                    </x-card>
                </div>
            </div>

        </main>
    </div>

    <!-- Modal Tambah Task -->
    <div id="addTaskModal" class="fixed inset-0 bg-black/50 backdrop-blur-xs z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-6 shadow-2xl">
            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                <h3 class="text-lg font-black text-gray-900">Tambah Task</h3>
                <button type="button" onclick="closeAddTaskModal()" class="text-gray-400 hover:text-gray-600 font-bold">✕</button>
            </div>

            <form id="addTaskForm" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="add-task-title" class="block text-xs font-extrabold text-gray-700 mb-1.5">Nama Task</label>
                    <input id="add-task-title" type="text" name="title" maxlength="255" required
                        placeholder="Contoh: Mencari informasi beasiswa"
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm">
                </div>
                <div>
                    <label for="add-task-deadline" class="block text-xs font-extrabold text-gray-700 mb-1.5">Deadline (opsional)</label>
                    <input id="add-task-deadline" type="date" name="deadline"
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm">
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeAddTaskModal()" class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-sm">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#3650A2] hover:bg-[#2b4185] text-white font-bold text-sm shadow-md">Simpan Task</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Task -->
    <div id="editTaskModal" class="fixed inset-0 bg-black/50 backdrop-blur-xs z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-6 shadow-2xl">
            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                <h3 class="text-lg font-black text-gray-900">Edit Task</h3>
                <button type="button" onclick="closeEditTaskModal()" class="text-gray-400 hover:text-gray-600 font-bold">✕</button>
            </div>

            <form id="editTaskForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit-task-title" class="block text-xs font-extrabold text-gray-700 mb-1.5">Nama Task</label>
                    <input id="edit-task-title" type="text" name="title" maxlength="255" required
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm">
                </div>
                <div>
                    <label for="edit-task-deadline" class="block text-xs font-extrabold text-gray-700 mb-1.5">Deadline (opsional)</label>
                    <input id="edit-task-deadline" type="date" name="deadline"
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm">
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeEditTaskModal()" class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-sm">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#3650A2] hover:bg-[#2b4185] text-white font-bold text-sm shadow-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
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

    <!-- Modal Edit Rencana Pendidikan -->
    <div id="editPlanModal" class="fixed inset-0 bg-black/50 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-6 shadow-2xl">
            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                <h3 class="text-lg font-black text-gray-900">Edit Rencana Pendidikan</h3>
                <button type="button" onclick="closeEditPlanModal()" class="text-gray-400 hover:text-gray-600 font-bold">✕</button>
            </div>

            <form id="editPlanForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit-plan-title" class="block text-xs font-extrabold text-gray-700 mb-1.5">Judul Rencana</label>
                    <input id="edit-plan-title" type="text" name="title" maxlength="255" required
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm">
                </div>
                <div>
                    <label for="edit-plan-description" class="block text-xs font-extrabold text-gray-700 mb-1.5">Deskripsi (opsional)</label>
                    <textarea id="edit-plan-description" name="description" rows="3" maxlength="1000"
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm resize-none"></textarea>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeEditPlanModal()" class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-sm">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#3650A2] hover:bg-[#2b4185] text-white font-bold text-sm shadow-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Ubah Target Pilihan -->
    <div id="targetModal" class="fixed inset-0 bg-black/50 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-6 shadow-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                <h3 class="text-lg font-black text-gray-900">Atur Target Pilihan</h3>
                <button onclick="closeTargetModal()" class="text-gray-400 hover:text-gray-600 font-bold">✕</button>
            </div>


            <form action="{{ route('student.planning.target.update') }}"
                method="POST"
                class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">
                        Pilih Kampus / Universitas
                    </label>

                    <select
                        name="target_university_id"
                        id="select-univ"
                        required
                        onchange="filterMajors()"
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm bg-white">

                        <option value="">Pilih Universitas</option>

                        @foreach($universities as $university)
                            <option
                                value="{{ $university->id }}"
                                {{ old('target_university_id', $targetPlan?->target_university_id) == $university->id ? 'selected' : '' }}>
                                {{ $university->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">
                        Program Studi (Jurusan)
                    </label>

                    <select
                        name="target_major_id"
                        id="select-major"
                        required
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm bg-white">

                        <option value="">Pilih Jurusan</option>

                        @foreach($majors as $major)
                            <option
                                value="{{ $major->id }}"
                                data-universities="{{ $major->universities->pluck('id')->implode(',') }}"
                                {{ old('target_major_id', $targetPlan?->target_major_id) == $major->id ? 'selected' : '' }}>
                                {{ $major->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-gray-700 mb-1.5">
                        Jalur Seleksi Utama
                    </label>

                    <select
                        name="admission_path"
                        id="select-path"
                        required
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm bg-white">

                        <option value="SNBP & SNBT" {{ old('admission_path', $targetPlan?->admission_path) == 'SNBP & SNBT' ? 'selected' : '' }}>SNBP &amp; SNBT</option>
                        <option value="SNBP (Jalur Rapor)" {{ old('admission_path', $targetPlan?->admission_path) == 'SNBP (Jalur Rapor)' ? 'selected' : '' }}>SNBP (Jalur Rapor)</option>
                        <option value="SNBT (UTBK)" {{ old('admission_path', $targetPlan?->admission_path) == 'SNBT (UTBK)' ? 'selected' : '' }}>SNBT (UTBK)</option>
                        <option value="Jalur Mandiri" {{ old('admission_path', $targetPlan?->admission_path) == 'Jalur Mandiri' ? 'selected' : '' }}>Jalur Mandiri / UTUL</option>
                    </select>
                </div>

                <div>
                    <label for="career" class="block text-xs font-extrabold text-gray-700 mb-1.5">
                        Profesi / Karier Impian
                    </label>
                    <input
                        type="text"
                        name="career"
                        id="career"
                        maxlength="255"
                        value="{{ old('career', $targetPlan?->career) }}"
                        placeholder="Contoh: Software Engineer, UI/UX Designer, Pengusaha Digital"
                        class="w-full px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:border-[#3650A2] text-sm bg-white">
                    <p class="mt-1.5 text-[10px] text-gray-500">
                        Isi sesuai cita-cita atau profesi yang ingin kamu capai. Tidak harus berasal dari daftar jurusan.
                    </p>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button
                        type="button"
                        onclick="closeTargetModal()"
                        class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-sm">
                        Batal
                    </button>

                    <x-button type="submit" variant="primary"
                        class="!px-5 !py-2.5 !rounded-xl !text-sm !shadow-md">
                        Simpan Perubahan
                    </x-button>
                </div>
            </form>
        </div>
    </div>

    {{-- Komponen konfirmasi hapus reusable (di components/confirm-delete.blade.php, bukan di student) --}}
    <x-confirm-delete
        function-name="confirmDeletePlanning"
        title="Hapus Rencana Pendidikan?"
        text="Rencana ini akan dihapus permanen. Kamu yakin ingin melanjutkan?"
        confirm-text="Ya, Hapus Rencana"
    />

    <x-confirm-delete
        function-name="confirmDeleteTask"
        title="Hapus Task Ini?"
        text="Task yang dihapus tidak dapat dipulihkan. Yakin ingin melanjutkan?"
        confirm-text="Ya, Hapus Task"
    />

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (window.Swal) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: @json(session('success')),
                        timer: 1800,
                        showConfirmButton: false,
                        customClass: { popup: 'rounded-[24px]' }
                    });
                }
            });
        </script>
    @endif

    <script>
        // Gunakan mekanisme bawaan komponen student-sidebar (class .is-open).
        // Jangan membuat toggleSidebar baru karena itu menimpa fungsi milik komponen.
        function closeSidebar() {
            if (typeof window.myUnivToggleStudentSidebar === 'function') {
                window.myUnivToggleStudentSidebar(true);
            } else {
                const sidebar = document.getElementById('mobileSidebar');
                const backdrop = document.getElementById('sidebarBackdrop');
                if (sidebar) sidebar.classList.remove('is-open');
                if (backdrop) {
                    backdrop.classList.add('hidden');
                    backdrop.classList.remove('is-visible');
                }
                document.body.classList.remove('overflow-hidden');
            }
        }

        // Pastikan backdrop tidak mewarnai atau memburamkan halaman.
        function keepSidebarBackdropTransparent() {
            const backdrop = document.getElementById('sidebarBackdrop');
            if (!backdrop) return;
            backdrop.style.setProperty('background', 'transparent', 'important');
            backdrop.style.setProperty('backdrop-filter', 'none', 'important');
            backdrop.style.setProperty('-webkit-backdrop-filter', 'none', 'important');
        }

        document.addEventListener('DOMContentLoaded', function () {
            keepSidebarBackdropTransparent();
            if (window.innerWidth < 768) closeSidebar();
            document.querySelectorAll('#mobileSidebar nav a').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (window.innerWidth < 768) closeSidebar();
                });
            });
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') closeSidebar();
        });


        function openModal() {
            document.getElementById('planModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('planModal').classList.add('hidden');
        }

        // Tambah task ke rencana yang dipilih.
        function openAddTaskModal(button) {
            const planId = button.dataset.planId;
            const form = document.getElementById('addTaskForm');
            form.action = `/student/planning/${planId}/checklist`;
            form.reset();

            const modal = document.getElementById('addTaskModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.getElementById('add-task-title').focus();
        }

        function closeAddTaskModal() {
            const modal = document.getElementById('addTaskModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Edit task yang sudah tersimpan.
        function openEditTaskModal(button) {
            const id = button.dataset.id;
            const form = document.getElementById('editTaskForm');
            form.action = `/student/planning/checklist/${id}`;

            document.getElementById('edit-task-title').value = button.dataset.title || '';
            document.getElementById('edit-task-deadline').value = button.dataset.deadline || '';

            const modal = document.getElementById('editTaskModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditTaskModal() {
            const modal = document.getElementById('editTaskModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openTargetModal() {
            document.getElementById('targetModal').classList.remove('hidden');
        }
        function closeTargetModal() {
            document.getElementById('targetModal').classList.add('hidden');
        }

        // Script untuk perpindahan Tab Interaktif
        function switchTab(tabName) {
            const allowedTabs = ['plans', 'targets'];
            if (!allowedTabs.includes(tabName)) return;

            allowedTabs.forEach(function (tab) {
                document.getElementById('content-' + tab).classList.add('hidden');
                document.getElementById('tab-' + tab).className =
                    "pb-3 border-b-2 border-transparent text-gray-400 hover:text-gray-600 transition-all";
            });

            document.getElementById('content-' + tabName).classList.remove('hidden');
            document.getElementById('tab-' + tabName).className =
                "pb-3 border-b-2 border-[#3650A2] text-[#3650A2] transition-all";
        }

        // Edit rencana pendidikan
        function openEditPlanModal(button) {
            const id = button.dataset.id;
            document.getElementById('editPlanForm').action = `/student/planning/${id}`;
            document.getElementById('edit-plan-title').value = button.dataset.title || '';
            document.getElementById('edit-plan-description').value = button.dataset.description || '';
            document.getElementById('editPlanModal').classList.remove('hidden');
        }

        function closeEditPlanModal() {
            document.getElementById('editPlanModal').classList.add('hidden');
        }

        // Filter jurusan berdasarkan relasi pivot university_majors dari Supabase.
        function filterMajors() {
            const universitySelect = document.getElementById('select-univ');
            const majorSelect = document.getElementById('select-major');

            if (!universitySelect || !majorSelect) return;

            const universityId = String(universitySelect.value || '');
            const previousMajorId = String(majorSelect.value || '');
            let availableCount = 0;
            let previousMajorIsAvailable = false;

            Array.from(majorSelect.options).forEach(option => {
                if (!option.value) {
                    option.hidden = false;
                    option.disabled = false;
                    return;
                }

                const universityIds = (option.dataset.universities || '')
                    .split(',')
                    .map(id => id.trim())
                    .filter(Boolean);

                const available = universityId !== '' &&
                    universityIds.includes(universityId);

                option.hidden = !available;
                option.disabled = !available;

                if (available) availableCount++;
                if (available && String(option.value) === previousMajorId) {
                    previousMajorIsAvailable = true;
                }
            });

            // Jangan mempertahankan jurusan yang bukan milik universitas terpilih.
            if (!previousMajorIsAvailable) {
                majorSelect.value = '';
            }

            const placeholder = majorSelect.options[0];
            if (placeholder) {
                placeholder.textContent = !universityId
                    ? 'Pilih universitas terlebih dahulu'
                    : availableCount > 0
                        ? 'Pilih Jurusan'
                        : 'Belum ada jurusan terhubung untuk universitas ini';
            }

            majorSelect.disabled = universityId === '' || availableCount === 0;
        }

        // Simpan status checklist ke database, lalu perbarui tampilan jika berhasil
        async function toggleTaskStatus(checkbox) {
            const previousState = !checkbox.checked;
            const card = checkbox.closest('.card-notion');
            const row = checkbox.closest('.flex.items-center.justify-between');
            const textSpan = row?.querySelector('.task-text');
            const badge = row?.querySelector('.task-badge');
            const url = checkbox.dataset.updateUrl;

            checkbox.disabled = true;

            try {
                const response = await fetch(url, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ is_completed: checkbox.checked }),
                });

                if (!response.ok) {
                    throw new Error('Gagal menyimpan checklist.');
                }

                if (checkbox.checked) {
                    textSpan?.classList.add('line-through', 'text-gray-400');
                    textSpan?.classList.remove('text-gray-700');
                    if (badge) {
                        badge.textContent = 'Selesai';
                        badge.className = 'task-badge px-3 py-1 rounded-xl text-[11px] font-extrabold border shadow-xs bg-emerald-50 text-emerald-700 border-emerald-200';
                    }
                } else {
                    textSpan?.classList.remove('line-through', 'text-gray-400');
                    textSpan?.classList.add('text-gray-700');
                    if (badge) {
                        badge.textContent = 'Pending';
                        badge.className = 'task-badge px-3 py-1 rounded-xl text-[11px] font-extrabold border shadow-xs bg-gray-100 text-gray-600 border-gray-200';
                    }
                }

                if (card) updateCardProgress(card);
            } catch (error) {
                checkbox.checked = previousState;
                if (window.Swal) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Belum tersimpan',
                        text: 'Status checklist gagal diperbarui. Coba lagi.',
                        confirmButtonColor: '#3650A2',
                    });
                } else {
                    alert('Status checklist gagal diperbarui. Coba lagi.');
                }
            } finally {
                checkbox.disabled = false;
            }
        }

        function updateCardProgress(card) {
            const checkboxes = card.querySelectorAll('.task-container input[type="checkbox"]');
            const total = checkboxes.length;
            const checked = Array.from(checkboxes).filter(cb => cb.checked).length;
            const percent = total > 0 ? Math.round((checked / total) * 100) : 0;

            const progressRoot = card.querySelector('.progress-component');
            const progressText = progressRoot?.querySelector('.flex.justify-between span:last-child');
            const progressBar = progressRoot?.querySelector('[role="progressbar"] > div');
            const progressTrack = progressRoot?.querySelector('[role="progressbar"]');

            if (progressText) progressText.textContent = percent + '%';
            if (progressBar) progressBar.style.width = percent + '%';
            if (progressTrack) progressTrack.setAttribute('aria-valuenow', String(percent));
        }

        // Inisialisasi filter jurusan sesuai universitas yang tersimpan.
        document.addEventListener('DOMContentLoaded', function () {
            const universitySelect = document.getElementById('select-univ');
            const majorSelect = document.getElementById('select-major');

            if (universitySelect && majorSelect) filterMajors();
        });
    </script>
</body>
</html>
