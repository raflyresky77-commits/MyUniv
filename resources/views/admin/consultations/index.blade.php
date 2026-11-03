<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Konsultasi BK - Admin MyUniv</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #22346E 100%); }
        .custom-card-shape { clip-path: polygon(0 0, calc(100% - 16px) 0, 100% 16px, 100% 100%, 0 100%); }
    </style>
</head>
<body class="bg-[#F8FBFF] text-gray-800 antialiased min-h-screen overflow-x-hidden">

    @include('components.global-loading')

    <x-admin-sidebar active="consultations" />
    <x-admin-topbar module="Modul Layanan Siswa" page-title="Monitoring Konsultasi BK" />

    <div class="md:ml-72 pt-24 sm:pt-28 min-h-screen">
        <main class="p-4 sm:p-6 lg:p-8 space-y-6 sm:space-y-8 max-w-7xl w-full mx-auto">

            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: @json(session('success')),
                            timer: 2500,
                            showConfirmButton: false,
                            customClass: { popup: 'rounded-[24px]' }
                        });
                    });
                </script>
            @endif

            @if($errors->any())
                <div class="rounded-2xl border border-red-100 bg-red-50 px-5 py-4 text-xs font-semibold text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <x-admin-page-header
                label="Layanan & Konseling Siswa"
                title="Monitoring Konsultasi BK"
                description="Pantau pengajuan konsultasi siswa, informasi Guru BK, jadwal, metode, dan perkembangan status konsultasi."
            />

            <div class="flex min-w-0 flex-col items-stretch gap-3 rounded-[24px] border border-[#E2E8F0] bg-white p-3 shadow-xs sm:flex-row sm:items-center sm:p-4">
                <x-search-input
                    id="searchInput"
                    placeholder="Cari nama siswa, Guru BK, topik, atau status..."
                    onkeyup="filterConsultations()"
                    wrapper-class="relative min-w-0 w-full flex-1"
                    input-class="w-full min-w-0 rounded-xl border border-gray-200 bg-gray-50/50 py-3 pl-11 pr-4 text-xs font-medium transition focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20"
                />
                <div id="searchCounter" class="hidden whitespace-nowrap px-3 text-xs font-bold text-gray-400 sm:block"></div>
            </div>

            <div class="bg-white rounded-[24px] border border-[#E2E8F0] shadow-sm overflow-hidden custom-card-shape">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[900px] text-left border-collapse">
                        <thead>
                            <tr class="bg-[#F8FBFF] border-b border-[#E2E8F0] text-[10px] font-extrabold text-gray-400 uppercase tracking-wider">
                                <th class="py-4 px-6 w-12 text-center">No</th>
                                <th class="py-4 px-6">Siswa</th>
                                <th class="py-4 px-6">Guru BK</th>
                                <th class="py-4 px-6">Topik</th>
                                <th class="py-4 px-6">Jadwal</th>
                                <th class="py-4 px-6">Metode</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-xs font-medium text-gray-600" id="consultationsTableBody">
                            @forelse($consultations ?? [] as $consultation)
                                @php
                                    $statusLabels = ['pending' => 'Menunggu', 'approved' => 'Disetujui', 'rejected' => 'Ditolak', 'completed' => 'Selesai'];
                                    $statusColors = [
                                        'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                                        'approved' => 'bg-blue-50 text-blue-700 border-blue-100',
                                        'rejected' => 'bg-red-50 text-red-700 border-red-100',
                                        'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                    ];
                                @endphp
                                <tr class="consultation-row hover:bg-[#F8FBFF]/80 transition">
                                    <td class="py-4 px-6 text-center font-bold text-gray-400">{{ $loop->iteration }}</td>
                                    <td class="py-4 px-6 font-extrabold text-gray-900 text-sm">{{ $consultation->student?->user?->name ?? '-' }}</td>
                                    <td class="py-4 px-6">{{ $consultation->teacher?->user?->name ?? '-' }}</td>
                                    <td class="py-4 px-6 text-gray-500 max-w-xs"><span class="block truncate" title="{{ $consultation->topic }}">{{ $consultation->topic }}</span></td>
                                    <td class="py-4 px-6 whitespace-nowrap">{{ $consultation->scheduled_at?->format('d/m/Y H:i') ?? '-' }}</td>
                                    <td class="py-4 px-6">
                                        <span class="px-3 py-1 rounded-xl text-[10px] font-extrabold border {{ $consultation->method === 'online' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-indigo-50 text-[#3650A2] border-indigo-100' }}">
                                            {{ ucfirst($consultation->method ?? '-') }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex px-3 py-1 rounded-xl text-[10px] font-extrabold border {{ $statusColors[$consultation->status] ?? 'bg-gray-50 text-gray-600 border-gray-100' }}">
                                            {{ $statusLabels[$consultation->status] ?? $consultation->status }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <form method="POST" action="{{ route('admin.consultations.update', $consultation) }}" class="inline-flex items-center justify-end gap-2">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" aria-label="Ubah status konsultasi" class="max-w-[125px] rounded-xl border border-gray-200 bg-gray-50/50 px-2.5 py-2 text-[10px] font-bold text-gray-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20">
                                                <option value="pending" @selected($consultation->status === 'pending')>Menunggu</option>
                                                <option value="approved" @selected($consultation->status === 'approved')>Disetujui</option>
                                                <option value="rejected" @selected($consultation->status === 'rejected')>Ditolak</option>
                                                <option value="completed" @selected($consultation->status === 'completed')>Selesai</option>
                                            </select>
                                            <button type="submit" class="inline-flex items-center px-3.5 py-2 bg-gradient-myuniv text-white font-extrabold rounded-xl transition text-[10px] cursor-pointer shadow-sm hover:opacity-95">Simpan</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="py-12 text-center text-gray-400 font-medium text-xs">Belum ada data konsultasi yang tersimpan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        function filterConsultations() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const rows = document.querySelectorAll('#consultationsTableBody tr.consultation-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const match = row.textContent.toLowerCase().includes(filter);
                row.style.display = match ? '' : 'none';
                if (match) visibleCount++;
            });

            const counter = document.getElementById('searchCounter');
            if (filter.length > 0) {
                counter.textContent = `Ditemukan ${visibleCount} konsultasi`;
                counter.classList.remove('hidden');
            } else {
                counter.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
