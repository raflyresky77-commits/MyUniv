@php
    // Ranking hanya memakai data QS WUR 2027 yang sudah diverifikasi.
    // Universitas tanpa peringkat tetap ditampilkan setelah kampus yang memiliki ranking.
    $universities = $universities
        ->reject(function ($university) {
            $name = mb_strtolower((string) ($university->name ?? ''));
            $notes = mb_strtolower((string) ($university->branch_notes ?? ''));

            return str_contains($name, 'uji import')
                || str_contains($notes, 'data uji import');
        })
        ->sortBy(function ($university) {
            return $university->ranking !== null
                ? (int) $university->ranking
                : PHP_INT_MAX;
        })
        ->values();
@endphp

{{-- Konten Eksplorasi bersama untuk Student dan Counselor. Navigasi tetap dikelola masing-masing role. --}}
<main class="w-full min-w-0 max-w-6xl mx-auto flex-1 space-y-6 sm:space-y-8 p-4 sm:p-6 lg:p-10">
            <!-- Hero Banner Section -->
            <div class="bg-gradient-strong min-w-0 rounded-[24px] sm:rounded-[32px] p-5 sm:p-8 lg:p-10 text-white relative overflow-hidden shadow-xl shadow-indigo-950/15">
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute right-20 top-0 w-32 h-32 bg-[#FF7A59]/20 rounded-full blur-xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl space-y-3">
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-bold text-indigo-100">
                        <svg class="w-3.5 h-3.5 text-[#FF7A59]" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.788 0l7-3a1 1 0 000-1.84l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.17 1 1 0 00-.01-1.98c.35.035.7.093 1.05.17V16.5a1 1 0 001 1h8a1 1 0 001-1v-4.148c.35-.077.7-.135 1.05-.17a1 1 0 01.01 1.98 8.969 8.969 0 00-1.05.17v-4.102l1.69-.723a1 1 0 000-1.84l-7-3a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84z"/></svg>
                        Direktori Kampus PTN &amp; PTS Unggulan (Database Supabase)
                    </span>
                    <h1 class="text-2xl sm:text-4xl font-black tracking-tight leading-tight">Temukan Masa Depanmu di Kampus Impian</h1>
                    <p class="text-xs sm:text-sm text-indigo-100 font-medium leading-relaxed">
                        Jelajahi profil lengkap Perguruan Tinggi Negeri (PTN) dan Swasta (PTS) terbaik langsung dari database Supabase, informasi akreditasi, hingga program studi pilihanmu.
                    </p>

                    <!-- Pencarian dan Filter Direktori -->
                    <div class="pt-2 space-y-3">
                        <div class="relative max-w-lg">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5 text-[#3650A2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </span>
                            <input type="text" id="searchInput" oninput="filterUniversities()" placeholder="Cari nama kampus, kota, atau program studi..." class="w-full pl-12 pr-4 py-3.5 bg-white text-gray-900 rounded-2xl font-semibold text-xs shadow-lg focus:outline-none focus:ring-4 focus:ring-[#FF7A59]/30 transition-all placeholder:text-gray-400">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-lg">
                            <select id="typeFilter" onchange="filterUniversities()" class="w-full px-4 py-3 bg-white text-gray-800 rounded-xl text-xs font-bold shadow-md border border-white/50 focus:outline-none focus:ring-2 focus:ring-[#FF7A59]/40">
                                <option value="">Semua Jenis Kampus</option>
                                <option value="PTN">Perguruan Tinggi Negeri (PTN)</option>
                                <option value="PTS">Perguruan Tinggi Swasta (PTS)</option>
                            </select>
                            <select id="locationFilter" onchange="filterUniversities()" class="w-full px-4 py-3 bg-white text-gray-800 rounded-xl text-xs font-bold shadow-md border border-white/50 focus:outline-none focus:ring-2 focus:ring-[#FF7A59]/40">
                                <option value="">Semua Lokasi</option>
                                @foreach(($universities->pluck('location')->filter()->unique()->sort() ?? collect()) as $location)
                                    <option value="{{ strtolower($location) }}">{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- List Perguruan Tinggi -->
            <div class="space-y-6" id="universityList">

                @forelse($universities as $univ)
                <div class="university-card card-glass min-w-0 rounded-[24px] sm:rounded-[32px] p-4 sm:p-6 lg:p-8 flex flex-col lg:flex-row gap-5 sm:gap-6 items-stretch lg:items-center justify-between transition-all duration-300 hover:-translate-y-1" data-search="{{ strtolower($univ->name . ' ' . $univ->location . ' ' . ($univ->type ?? '') . ' ' . ($univ->majors ? $univ->majors->pluck('name')->implode(' ') : '')) }}"
                    data-type="{{ strtoupper($univ->type ?? '') }}"
                    data-location="{{ strtolower($univ->location ?? '') }}">

                    <!-- Kiri: Foto Kampus / Banner & Tombol Web -->
                    <div class="w-full min-w-0 lg:w-5/12 flex flex-col gap-4">
                        <div class="w-full h-48 rounded-2xl relative overflow-hidden shadow-md shrink-0 group bg-gray-200">

                            @php
                                $imageName = trim((string) ($univ->thumbnail ?: ($univ->image ?? '')));
                                $imageName = basename(str_replace('\\', '/', $imageName));

                                $imageUrl = $imageName !== ''
                                    ? asset('images/universities/' . $imageName)
                                    : asset('images/ilustrasi.jpg');
                            @endphp

                            <img
                                src="{{ $imageUrl }}"
                                alt="{{ $univ->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                onerror="this.onerror=null; this.src='{{ asset('images/ilustrasi.jpg') }}';"
                            >

                                                        <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#141F43]/90 via-[#141F43]/30 to-transparent"></div>

                            <!-- Badge Atas -->
                            <div class="absolute top-3 left-3 right-3 flex justify-between items-center z-10">
                                <span class="px-2.5 py-1 {{ ($univ->type ?? 'PTN') == 'PTS' ? 'bg-[#FF7A59]/90 text-white' : 'bg-white/20 text-white' }} backdrop-blur-md rounded-lg text-[10px] font-extrabold uppercase tracking-wider border border-white/20 shadow-xs">
                                    {{ $univ->type ?? 'Belum ditentukan' }} • Akreditasi {{ $univ->accreditation ?: 'Belum tersedia' }}
                                </span>
                            </div>

                            <!-- Keterangan Bawah di atas Foto -->
                            <div class="absolute bottom-3 left-3 right-3 z-10 text-white">
                                <h4 class="text-sm font-extrabold tracking-tight drop-shadow-sm">{{ $univ->name }}</h4>
                                <p class="text-[11px] text-indigo-100 flex items-center gap-1 mt-0.5 font-medium">
                                    <svg class="w-3 h-3 text-[#FF7A59]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $univ->location }}
                                </p>
                            </div>
                        </div>

                        <!-- TOMBOL KUNJUNGI WEBSITE -->
                        @if(!empty($univ->website))
                        <a href="{{ $univ->website }}" target="_blank" rel="noopener noreferrer" class="w-full py-3.5 px-5 bg-gradient-to-r from-[#FF7A59] to-[#FF5233] text-white rounded-2xl text-xs font-black shadow-lg shadow-orange-500/30 hover:opacity-95 hover:scale-[1.02] transition-all flex items-center justify-center gap-2.5 uppercase tracking-wider group">
                            <span>Kunjungi Website Resmi</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                        @endif
                    </div>

                    <!-- Kanan: Informasi Detail -->
                    <div class="w-full min-w-0 lg:w-7/12 space-y-4 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="min-w-0 break-words text-lg sm:text-xl font-black text-gray-900 tracking-tight">{{ $univ->name }}</h3>
                                <span class="px-2 py-0.5 text-[10px] font-extrabold rounded-md {{ ($univ->type ?? 'PTN') == 'PTS' ? 'bg-orange-100 text-[#FF7A59]' : 'bg-indigo-100 text-[#3650A2]' }}">{{ $univ->type ?? 'PTN' }}</span>
                            </div>
                            <p class="text-xs text-gray-500 font-medium mt-0.5">{{ $univ->location ?: 'Lokasi belum tersedia' }}</p>
                            <div class="flex flex-wrap items-center gap-2 mt-3">
                                @if(!is_null($univ->ranking))
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-50 text-amber-700 text-[10px] font-extrabold border border-amber-100">
                                        <span>★</span>
                                        {{ $univ->ranking_category ?: ('Peringkat dunia #' . $univ->ranking) }}
                                        @if($univ->ranking_year) <span class="font-semibold">({{ $univ->ranking_year }})</span> @endif
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1.5 rounded-lg bg-gray-100 text-gray-500 text-[10px] font-bold">Peringkat belum tersedia</span>
                                @endif
                                @if($univ->ranking_source)
                                    <span class="text-[10px] text-gray-400">Sumber: {{ $univ->ranking_source }}</span>
                                @endif
                            </div>
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
                                        <td class="py-2.5 px-4 font-bold text-gray-600">Akreditasi Institusi</td>
                                        <td class="py-2.5 px-4 font-semibold {{ $univ->accreditation ? 'text-emerald-600' : 'text-gray-400' }}">
                                            {{ $univ->accreditation ?: 'Belum tersedia di database' }}
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-indigo-50/40 transition">
                                        <td class="py-2.5 px-4 font-bold text-gray-600">Peringkat</td>
                                        <td class="py-2.5 px-4 font-semibold text-gray-900">
                                            @if(!is_null($univ->ranking))
                                                {{ $univ->ranking_category ?: ('Peringkat dunia #' . $univ->ranking) }}
                                                @if($univ->ranking_year) • {{ $univ->ranking_year }} @endif
                                            @else
                                                <span class="text-gray-400 font-medium">Belum tersedia</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-indigo-50/40 transition">
                                        <td class="py-2.5 px-4 font-bold text-gray-600">Lokasi Kampus</td>
                                        <td class="py-2.5 px-4 font-medium text-gray-900">{{ $univ->location ?: 'Belum tersedia' }}</td>
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

<script>
    // Pencarian dan filter bekerja bersamaan pada direktori kampus.
    function filterUniversities() {
        const searchInput = document.getElementById('searchInput');
        const typeFilter = document.getElementById('typeFilter');
        const locationFilter = document.getElementById('locationFilter');

        const keyword = (searchInput?.value || '').toLowerCase().trim();
        const selectedType = (typeFilter?.value || '').toUpperCase();
        const selectedLocation = (locationFilter?.value || '').toLowerCase();
        const cards = document.querySelectorAll('#universityList .university-card');

        cards.forEach(card => {
            const searchData = (card.dataset.search || '').toLowerCase();
            const cardType = (card.dataset.type || '').toUpperCase();
            const cardLocation = (card.dataset.location || '').toLowerCase();

            const matchesKeyword = !keyword || searchData.includes(keyword);
            const matchesType = !selectedType || cardType === selectedType;
            const matchesLocation = !selectedLocation || cardLocation === selectedLocation;

            card.style.display = matchesKeyword && matchesType && matchesLocation ? '' : 'none';
        });
    }
</script>
