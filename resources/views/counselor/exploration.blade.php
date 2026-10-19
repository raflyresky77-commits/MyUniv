<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eksplorasi Perguruan Tinggi - Panel Guru BK | MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-strong { background: linear-gradient(135deg, #3650A2 0%, #1E2D61 100%); }
        .card-glass {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(54, 80, 162, 0.12);
            box-shadow: 0 20px 40px -15px rgba(30, 45, 98, 0.08);
        }
        .card-glass:hover {
            box-shadow: 0 25px 50px -12px rgba(54, 80, 162, 0.18);
            border-color: rgba(255, 122, 89, 0.3);
        }
    </style>
</head>
<body class="bg-[#F4F7FE] text-gray-800 antialiased selection:bg-[#FF7A59] selection:text-white">

    {{-- Navigasi khusus Guru BK; konten Explore tetap sama dengan halaman siswa --}}
    <x-counselor.sidebar active="exploration" />
    <x-counselor.topbar title="Eksplorasi" subtitle="Perguruan Tinggi & Jurusan" />

    <!-- Main Content Area -->
    <div class="md:ml-72 pt-28 min-h-screen flex flex-col">
        <main class="p-6 md:p-10 space-y-8 max-w-6xl w-full mx-auto flex-1">

            <!-- Hero Banner Section -->
            <div class="bg-gradient-strong rounded-[32px] p-8 sm:p-10 text-white relative overflow-hidden shadow-xl shadow-indigo-950/15">
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute right-20 top-0 w-32 h-32 bg-[#FF7A59]/20 rounded-full blur-xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl space-y-3">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-bold text-indigo-100">
                        <svg class="w-3.5 h-3.5 text-[#FF7A59]" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.788 0l7-3a1 1 0 000-1.84l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.17 1 1 0.01-1.98c.35.035.7.093 1.05.17V16.5a1 1 0 001 1h8a1 1 0 001-1v-4.148c.35-.077.7-.135 1.05-.17a1 1 0 01.01 1.98 8.969 8.969 0 01-1.05.17v-4.102l1.69-.723a1 1 0 000-1.84l-7-3a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84z"/></svg>
                        Direktori Kampus PTN &amp; PTS Unggulan (Database Supabase)
                    </span>
                    <h1 class="text-2xl sm:text-4xl font-black tracking-tight leading-tight">Eksplorasi Perguruan Tinggi untuk Bimbingan Siswa</h1>
                    <p class="text-xs sm:text-sm text-indigo-100 font-medium leading-relaxed">
                        Jelajahi profil perguruan tinggi negeri dan swasta, informasi akreditasi, lokasi, serta program studi untuk membantu proses bimbingan siswa.
                    </p>

                    <!-- Search Input Bar -->
                    <div class="pt-2">
                        <div class="relative max-w-lg">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5 text-[#3650A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </span>
                            <input type="text" id="searchInput" onkeyup="filterUniversities()" placeholder="Cari nama kampus (cth: UI, ITB, Unpad), kota, atau jenis..." class="w-full pl-12 pr-4 py-3.5 bg-white text-gray-900 rounded-2xl font-semibold text-xs shadow-lg focus:outline-none focus:ring-4 focus:ring-[#FF7A59]/30 transition-all placeholder:text-gray-400">
                        </div>
                    </div>
                </div>
            </div>

            <!-- List Perguruan Tinggi (Ditarik Dinamis dari Supabase Database) -->
            <div class="space-y-6" id="universityList">

                @forelse($universities as $univ)
                <div class="university-card card-glass rounded-[32px] p-6 sm:p-8 flex flex-col md:flex-row gap-6 items-center justify-between transition-all duration-300 hover:-translate-y-1" data-search="{{ strtolower($univ->name . ' ' . $univ->location . ' ' . ($univ->type ?? '')) }}">

                    <!-- Kiri: Foto Kampus / Banner & Tombol Web -->
                    <div class="w-full md:w-5/12 flex flex-col gap-4">
                        <div class="w-full h-48 rounded-2xl relative overflow-hidden shadow-md shrink-0 group bg-gray-200">
                            @php
                                // Nama file gambar kampus diambil dari database.
                                // File gambar disimpan di public/images/universities/.
                                $imageName = trim((string) ($univ->image ?? ''));
                                $imageName = str_replace('\\', '/', $imageName);
                                $imageName = basename($imageName);
                                $imageName = $imageName !== '' ? $imageName : 'default.png';
                            @endphp
                            <img
                                src="{{ asset('images/universities/' . $imageName) }}"
                                alt="{{ $univ->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                onerror="this.onerror=null; this.src='{{ asset('images/ilustrasi.png') }}';">

                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#141F43]/90 via-[#141F43]/30 to-transparent"></div>

                            <!-- Badge Atas -->
                            <div class="absolute top-3 left-3 right-3 flex justify-between items-center z-10">
                                <span class="px-2.5 py-1 {{ ($univ->type ?? 'PTN') == 'PTS' ? 'bg-[#FF7A59]/90 text-white' : 'bg-white/20 text-white' }} backdrop-blur-md rounded-lg text-[10px] font-extrabold uppercase tracking-wider border border-white/20 shadow-xs">
                                    {{ $univ->type ?? 'PTN' }} • Akreditasi {{ $univ->accreditation ?? 'Unggul' }}
                                </span>
                            </div>

                            <!-- Keterangan Bawah di atas Foto -->
                            <div class="absolute bottom-3 left-3 right-3 z-10 text-white">
                                <h4 class="text-sm font-extrabold tracking-tight drop-shadow-sm">{{ $univ->name }}</h4>
                                <p class="text-[11px] text-indigo-100 flex items-center gap-1 mt-0.5 font-medium">
                                    <svg class="w-3 h-3 text-[#FF7A59]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $univ->location }}
                                </p>
                            </div>
                        </div>

                        <!-- TOMBOL KUNJUNGI WEBSITE -->
                        @if(!empty($univ->website))
                        <a href="{{ $univ->website }}" target="_blank" class="w-full py-3.5 px-5 bg-gradient-to-r from-[#FF7A59] to-[#FF5233] text-white rounded-2xl text-xs font-black shadow-lg shadow-orange-500/30 hover:opacity-95 hover:scale-[1.02] transition-all flex items-center justify-center gap-2.5 uppercase tracking-wider group">
                            <span>Kunjungi Website Resmi</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                        @endif
                    </div>

                    <!-- Kanan: Informasi Detail -->
                    <div class="w-full md:w-7/12 space-y-4 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-lg sm:text-xl font-black text-gray-900 tracking-tight">{{ $univ->name }}</h3>
                                <span class="px-2 py-0.5 text-[10px] font-extrabold rounded-md {{ ($univ->type ?? 'PTN') == 'PTS' ? 'bg-orange-100 text-[#FF7A59]' : 'bg-indigo-100 text-[#3650A2]' }}">{{ $univ->type ?? 'PTN' }}</span>
                            </div>
                            <p class="text-xs text-gray-500 font-medium mt-0.5">{{ $univ->location }}</p>
                        </div>

                        <!-- Tabel Detail Informasi -->
                        <div class="bg-white/90 rounded-2xl border border-indigo-100 overflow-hidden shadow-xs">
                            <table class="w-full text-left text-xs">
                                <tbody class="divide-y divide-gray-100">
                                    <tr class="hover:bg-indigo-50/40 transition">
                                        <td class="py-2.5 px-4 font-bold text-gray-600 w-1/3">Jenis Institusi</td>
                                        <td class="py-2.5 px-4 font-semibold text-gray-900">{{ ($univ->type ?? 'PTN') == 'PTS' ? 'Perguruan Tinggi Swasta (PTS)' : 'Perguruan Tinggi Negeri (PTN)' }}</td>
                                    </tr>
                                    <tr class="hover:bg-indigo-50/40 transition">
                                        <td class="py-2.5 px-4 font-bold text-gray-600">Akreditasi</td>
                                        <td class="py-2.5 px-4 font-semibold text-emerald-600 flex items-center gap-1.5">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                            {{ $univ->accreditation ?? 'Unggul' }}
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-indigo-50/40 transition">
                                        <td class="py-2.5 px-4 font-bold text-gray-600">Lokasi Kampus</td>
                                        <td class="py-2.5 px-4 font-medium text-gray-900">{{ $univ->location }}</td>
                                    </tr>
                                    <tr class="hover:bg-indigo-50/40 transition">
                                        <td class="py-2.5 px-4 font-bold text-gray-600">Program Studi (Relasi)</td>
                                        <td class="py-2.5 px-4 font-medium text-gray-900">
                                            @if($univ->majors && $univ->majors->count() > 0)
                                                {{ $univ->majors->pluck('name')->implode(', ') }}
                                            @else
                                                <span class="text-gray-400 italic">Belum ada data jurusan terkait</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tentang Universitas -->
                        <div>
                            <span class="text-[11px] font-extrabold text-indigo-400 uppercase tracking-wider block">Tentang Kampus</span>
                            <p class="text-xs text-gray-600 font-medium mt-1 leading-relaxed">
                                {{ $univ->description ?? 'Belum ada deskripsi profil perguruan tinggi.' }}
                            </p>
                        </div>
                    </div>

                </div>
                @empty
                <div class="bg-white/90 rounded-[32px] p-12 text-center text-gray-500 text-sm font-bold">
                    Belum ada data perguruan tinggi di database Supabase.
                </div>
                @endforelse

            </div>

        </main>
    </div>

    <script>

        // Live search filter implementation
        function filterUniversities() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.university-card');

            cards.forEach(card => {
                const searchData = card.getAttribute('data-search');
                if (searchData.includes(input)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
