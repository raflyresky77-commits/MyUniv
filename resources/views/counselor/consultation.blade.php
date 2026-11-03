<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi BK - MyUniv</title>

    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F4F7FE; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #1E2D62 100%); }
        .bg-gradient-strong { background: linear-gradient(135deg, #2B4185 0%, #141F43 100%); }
        .glass-card { background: linear-gradient(135deg, rgba(255,255,255,.98) 0%, rgba(235,242,255,.85) 100%); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 2px solid rgba(54,80,162,.15); box-shadow: 0 20px 45px -12px rgba(30,45,98,.12), inset 0 1px 0 rgba(255,255,255,.9); transition: all .4s cubic-bezier(.16,1,.3,1); }
        .glass-card:hover { transform: translateY(-2px); border-color: #FF7A59; box-shadow: 0 25px 50px -12px rgba(255,122,89,.15); }
    </style>
</head>
<body class="bg-[#F4F7FE] min-h-screen text-gray-800 antialiased">

    @include('components.global-loading')

    <x-counselor.sidebar active="consultation" />

    <div class="flex min-h-screen min-w-0 flex-col md:ml-72">
        <x-counselor.topbar title="Konsultasi BK" subtitle="Manajemen Konsultasi Siswa" />

        <main id="consultationPageContent" class="p-6 md:p-10 space-y-8 max-w-7xl w-full mx-auto flex-1">
            @if(session('success'))
                <div class="mb-4 rounded-xl bg-emerald-50 border border-emerald-200 p-4 text-sm font-semibold text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Konten utama ini menjadi area scroll; banner ikut tergulir bersama statistik dan tabel. -->
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
                        {{ $stats['pending'] }} Pengajuan
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-[#3650A2] flex items-center justify-center border border-indigo-100 font-bold">📬</div>
                </div>
                <div class="glass-card p-6 rounded-[28px] flex items-center justify-between">
                    <div>
                        <p class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Sesi Berlangsung</p>
                        {{ $stats['active'] }} Sesi
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100 font-bold">💬</div>
                </div>
                <div class="glass-card p-6 rounded-[28px] flex items-center justify-between">
                    <div>
                        <p class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Selesai Bulan Ini</p>
                        {{ $stats['completed'] }} Sesi
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
                        <select id="statusFilter"
                            onchange="filterConsultations()"
                            class="px-4 py-2.5 bg-white border border-indigo-100 rounded-xl text-xs font-bold text-gray-700 focus:outline-none focus:border-[#3650A2] shadow-xs">
                            <option value="all">Semua Status</option>
                            <option value="pending">Menunggu Konfirmasi</option>
                            <option value="approved">Terjadwal</option>
                            <option value="rejected">Ditolak</option>
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
                            @forelse($consultations as $consultation)
                                @php
                                    $studentName = $consultation->student?->user?->name ?? 'Siswa';
                                    $statusLabels = [
                                        'pending' => 'Menunggu',
                                        'approved' => 'Terjadwal',
                                        'rejected' => 'Ditolak',
                                        'completed' => 'Selesai',
                                    ];
                                    $statusStyles = [
                                        'pending' => 'bg-amber-50 text-amber-600 border-amber-200',
                                        'approved' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                        'rejected' => 'bg-red-50 text-red-600 border-red-200',
                                        'completed' => 'bg-indigo-50 text-indigo-600 border-indigo-200',
                                    ];
                                @endphp

                                <tr class="consultation-row hover:bg-white/60 transition"
                                    data-status="{{ $consultation->status }}">

                                    <td class="py-4 px-4 font-bold text-gray-900">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-indigo-100 text-[#3650A2] flex items-center justify-center font-extrabold text-xs">
                                                {{ strtoupper(substr($studentName, 0, 1)) }}
                                            </div>
                                            <div>{{ $studentName }}</div>
                                        </div>
                                    </td>

                                    <td class="py-4 px-4 text-xs font-semibold text-gray-600">
                                        {{ $consultation->topic }}
                                    </td>

                                    <td class="py-4 px-4 text-xs">
                                        <span class="px-2.5 py-1 bg-indigo-50 text-[#3650A2] font-extrabold rounded-lg">
                                            {{ $consultation->method === 'online' ? 'Online' : 'Offline' }}
                                        </span>
                                    </td>

                                    <td class="py-4 px-4 text-xs text-gray-500">
                                        {{ $consultation->scheduled_at
                                            ? $consultation->scheduled_at->format('d/m/Y, H:i')
                                            : '-' }}
                                    </td>

                                    <td class="py-4 px-4 text-xs">
                                        <span class="px-3 py-1 font-extrabold rounded-full border {{ $statusStyles[$consultation->status] ?? 'bg-gray-50 text-gray-600 border-gray-200' }}">
                                            {{ $statusLabels[$consultation->status] ?? $consultation->status }}
                                        </span>
                                    </td>

                                    <td class="py-4 px-4 text-right">
                                        <button
                                            type="button"
                                            data-name="{{ $studentName }}"
                                            data-topic="{{ $consultation->topic }}"
                                            data-method="{{ $consultation->method }}"
                                            data-message="{{ $consultation->message }}"
                                            data-status="{{ $consultation->status }}"
                                            data-url="{{ route('counselor.consultation.update', $consultation->id) }}"
                                            onclick="openDetailModal(this)"
                                            class="px-3.5 py-2 bg-[#3650A2] hover:bg-[#2B4185] text-white text-xs font-bold rounded-xl transition shadow-xs">
                                            Kelola
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-10 text-center text-sm text-gray-400">
                                        Belum ada pengajuan konsultasi untuk Guru BK ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>


        <!-- Modal Detail & Aksi Konsultasi -->
        <div id="consultationModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center backdrop-blur-xs p-4">
            <div class="bg-white rounded-[32px] max-w-lg w-full p-6 sm:p-8 space-y-6 shadow-2xl border border-indigo-100 transform transition-all">

                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <h3 class="text-lg font-extrabold text-[#3650A2]">Detail Konsultasi Siswa</h3>
                    <button type="button" onclick="closeDetailModal()" class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 hover:bg-red-50 hover:text-red-500 flex items-center justify-center font-bold">&times;</button>
                </div>

                <form id="consultationUpdateForm" method="POST">
                    @csrf
                    @method('PUT')

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

                        <div>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Pesan Siswa</span>
                            <p id="modalMessage" class="font-medium text-gray-600 mt-1">-</p>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-[#3650A2] uppercase tracking-wider block mb-1.5">
                                Status Konsultasi
                            </label>
                            <select name="status" id="modalStatus" required class="w-full px-4 py-3 rounded-xl border border-indigo-100 bg-[#F8FBFF] text-xs font-semibold">
                                <option value="pending">Menunggu</option>
                                <option value="approved">Terjadwal</option>
                                <option value="rejected">Ditolak</option>
                                <option value="completed">Selesai</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-[#3650A2] uppercase tracking-wider block mb-1.5">
                                Catatan / Tanggapan Guru BK
                            </label>
                            <textarea name="response" rows="3" maxlength="3000"
                                placeholder="Tuliskan tanggapan untuk siswa..."
                                class="w-full px-4 py-3 rounded-2xl border border-indigo-100 bg-[#F8FBFF] text-xs font-medium focus:outline-none focus:border-[#3650A2]"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-5 mt-5 border-t border-gray-100">
                        <button type="button" onclick="closeDetailModal()" class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-600 text-xs font-extrabold hover:bg-gray-200 transition">
                            Tutup
                        </button>

                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#FF7A59] hover:bg-[#e0684a] text-white text-xs font-extrabold transition shadow-md">
                            Simpan & Konfirmasi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <form id="consultationUpdateForm" method="POST">
            @csrf
            @method('PUT')

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

                <div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block">Pesan Siswa</span>
                    <p id="modalMessage" class="font-medium text-gray-600 mt-1">-</p>
                </div>

                <div>
                    <label class="text-xs font-bold text-[#3650A2] uppercase tracking-wider block mb-1.5">
                        Status Konsultasi
                    </label>
                    <select name="status" id="modalStatus" required
                        class="w-full px-4 py-3 rounded-xl border border-indigo-100 bg-[#F8FBFF] text-xs font-semibold">
                        <option value="pending">Menunggu</option>
                        <option value="approved">Terjadwal</option>
                        <option value="rejected">Ditolak</option>
                        <option value="completed">Selesai</option>
                    </select>
                </div>

                <div>
                    <label class="text-xs font-bold text-[#3650A2] uppercase tracking-wider block mb-1.5">
                        Catatan / Tanggapan Guru BK
                    </label>
                    <textarea name="response" rows="3" maxlength="3000"
                        placeholder="Tuliskan tanggapan untuk siswa..."
                        class="w-full px-4 py-3 rounded-2xl border border-indigo-100 bg-[#F8FBFF] text-xs font-medium focus:outline-none focus:border-[#3650A2]"></textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-5 mt-5 border-t border-gray-100">
                <button type="button" onclick="closeDetailModal()"
                    class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-600 text-xs font-extrabold hover:bg-gray-200 transition">
                    Tutup
                </button>

                <button type="submit"
                    class="px-5 py-2.5 rounded-xl bg-[#FF7A59] hover:bg-[#e0684a] text-white text-xs font-extrabold transition shadow-md">
                    Simpan & Konfirmasi
                </button>
            </div>
        </form>

    <script>
        function openDetailModal(button) {
        const form = document.getElementById('consultationUpdateForm');

        // Mengisi modal berdasarkan konsultasi yang dipilih.
        document.getElementById('modalStudentName').innerText = button.dataset.name;
        document.getElementById('modalTopic').innerText = button.dataset.topic;
        document.getElementById('modalMethod').innerText =
            button.dataset.method === 'online' ? 'Online' : 'Offline';
        document.getElementById('modalMessage').innerText =
            button.dataset.message || 'Tidak ada pesan tambahan.';

        document.getElementById('modalStatus').value = button.dataset.status;
        form.action = button.dataset.url;

        document.getElementById('consultationModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('consultationModal').classList.add('hidden');
    }

    // Menyaring daftar konsultasi berdasarkan status.
    function filterConsultations() {
        const selectedStatus = document.getElementById('statusFilter').value;
        const rows = document.querySelectorAll('.consultation-row');

        rows.forEach(row => {
            const matches = selectedStatus === 'all' ||
                row.dataset.status === selectedStatus;

            row.style.display = matches ? '' : 'none';
        });
    }
    </script>
</body>
</html>
