<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asesmen Peminatan - MyUniv</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #F4F7FE;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .bg-gradient-myuniv {
            background: linear-gradient(135deg, #3650A2 0%, #1E2D62 100%);
        }

        .bg-gradient-strong {
            background: linear-gradient(135deg, #2B4185 0%, #141F43 100%);
        }

        .card-interactive-strong {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(54, 80, 162, 0.12);
            box-shadow:
                0 15px 35px -10px rgba(30, 45, 98, 0.08),
                0 0 0 1px rgba(54, 80, 162, 0.03);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card-interactive-strong:hover {
            transform: translateY(-4px);
            border-color: rgba(255, 122, 89, 0.35);
            box-shadow:
                0 25px 50px -12px rgba(54, 80, 162, 0.15),
                0 0 0 2px rgba(255, 122, 89, 0.2);
        }

        @keyframes floatMascot {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(1.5deg); }
        }

        .mascot-float {
            animation: floatMascot 4s ease-in-out infinite;
        }

        /* Transisi tombol dari biru ke oranye */
        .btn-hover-orange {
            background-color: #3650A2 !important;
            border-color: #3650A2 !important;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        }
        .btn-hover-orange:hover {
            background-color: #FF7A59 !important;
            border-color: #FF7A59 !important;
            box-shadow: 0 8px 20px -4px rgba(255, 122, 89, 0.4) !important;
            transform: translateY(-2px);
        }
        .btn-hover-orange:active {
            transform: translateY(0) scale(0.97);
        }
    </style>
</head>

<body class="bg-[#F4F7FE] text-gray-800 antialiased overflow-x-hidden">

    @include('components.global-loading')

    @php
        // Nilai default agar halaman tetap aman saat variabel belum dikirim controller.
        $submissions = $submissions ?? [];
        $completedCount = $completedCount ?? (
            (isset($submissions['minat_bakat']) ? 1 : 0)
            + (isset($submissions['kemampuan']) ? 1 : 0)
            + (isset($submissions['kepribadian']) ? 1 : 0)
        );
        $progress = $progress ?? (int) round(($completedCount / 3) * 100);
    @endphp

    {{-- Sidebar & Topbar --}}
    <x-student.student-sidebar active="assessment" />
    <x-student.student-topbar
        title="Dashboard Asesmen Siswa"
        :user="auth()->user()"
    />

    {{-- Main Content Area (Padding atas diperkecil agar pas dan tidak ada space kosong berlebih) --}}
    <div class="md:ml-72 pt-16 md:pt-20 min-h-screen flex flex-col">
        <main class="p-4 sm:p-6 md:p-10 space-y-6 md:space-y-8 max-w-7xl w-full mx-auto flex-1">

            {{-- Banner Asesmen (Warna Asli/Tidak Diubah) --}}
            <x-student.banner
                eyebrow="Pusat Asesmen"
                title="Kenali Potensi Dirimu"
                description="Pilih dan selesaikan rangkaian tes minat, bakat, kemampuan, serta kepribadian kariermu untuk rekomendasi masa depan terbaik."
            />

            {{-- Progress Keseluruhan --}}
            <x-card
                variant="strong"
                class="card-interactive-strong rounded-[24px] sm:rounded-[32px] p-5 sm:p-7 space-y-3.5 relative overflow-hidden group"
            >
                <div class="absolute right-0 top-0 bottom-0 w-3 bg-gradient-to-b from-[#3650A2] to-[#FF7A59]"></div>

                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
                    <span class="text-xs sm:text-sm font-extrabold text-gray-900 flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-[#3650A2] transition-transform group-hover:rotate-12 shrink-0 shadow-2xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        Progress Keseluruhan Asesmen
                    </span>

                    <span class="text-[11px] sm:text-xs font-extrabold px-3.5 py-1 bg-indigo-50/80 text-[#3650A2] rounded-full border border-indigo-100 w-fit shadow-2xs">
                        {{ $progress }}% Selesai
                    </span>
                </div>

                <div class="w-full bg-gray-100/80 h-3 rounded-full overflow-hidden p-0.5 border border-indigo-50">
                    <div class="bg-gradient-to-r from-[#3650A2] via-indigo-600 to-[#FF7A59] h-full rounded-full transition-all duration-700 shadow-sm" style="width: {{ $progress }}%;"></div>
                </div>

                <div class="text-[11px] sm:text-xs font-bold text-gray-500">
                    {{ $completedCount }} dari 3 tes telah disimpan ke database.
                </div>
            </x-card>

            {{-- Grid 3 Kartu Asesmen --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6">

                {{-- 1. Tes Minat & Bakat --}}
                <x-card
                    variant="strong"
                    class="card-interactive-strong rounded-[24px] sm:rounded-[32px] p-5 sm:p-6 flex flex-col justify-between group relative overflow-hidden"
                >
                    <div class="absolute -top-10 -right-10 w-36 h-36 bg-gradient-to-br from-indigo-100/60 to-orange-100/30 rounded-full blur-3xl group-hover:from-indigo-200/90 group-hover:to-orange-200/60 transition-all duration-500 pointer-events-none"></div>

                    <div class="space-y-4 relative z-10">
                        <div class="flex justify-between items-center border-b border-indigo-100/60 pb-3">
                            <span class="text-[11px] font-extrabold text-[#3650A2] uppercase tracking-wider bg-indigo-50/80 px-2.5 py-1 rounded-lg border border-indigo-100">
                                Modul 01
                            </span>

                            <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-lg text-[10px] font-extrabold uppercase tracking-wide border border-emerald-200/80 flex items-center gap-1.5 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full {{ isset($submissions['minat_bakat']) ? 'bg-emerald-600' : 'bg-amber-500' }}"></span>
                                {{ isset($submissions['minat_bakat']) ? 'Tersimpan' : 'Belum' }}
                            </span>
                        </div>

                        <div class="space-y-1.5">
                            <h3 class="text-base sm:text-lg font-black text-gray-900 group-hover:text-[#3650A2] transition-colors">
                                Tes Minat &amp; Bakat
                            </h3>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Mengetahui bidang minat spesifik dan kecenderungan bakat utamamu untuk masa depan.
                            </p>
                        </div>

                        {{-- Estimasi Waktu & Detail Kecil --}}
                        <div class="flex items-center gap-2 text-[11px] font-bold text-gray-500 pt-1">
                            <span class="flex items-center gap-1 bg-indigo-50/60 text-[#3650A2] px-2.5 py-1 rounded-md border border-indigo-100/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                ± 15 Menit
                            </span>
                        </div>

                        <div class="bg-indigo-50/50 border border-indigo-100/80 p-3 rounded-xl space-y-0.5 shadow-2xs">
                            <div class="text-[11px] font-extrabold text-[#3650A2]">{{ isset($submissions['minat_bakat']) ? 'Jawaban Tersimpan' : 'Belum Dikerjakan' }}</div>
                            <div class="text-[10px] text-gray-500 font-medium">{{ isset($submissions['minat_bakat']) ? 'Terakhir disimpan ' . \Carbon\Carbon::parse($submissions['minat_bakat']->submitted_at)->format('d M Y, H:i') : 'Selesaikan tes untuk menyimpan jawaban.' }}</div>
                        </div>
                    </div>

                    <div class="pt-5 sm:pt-6 relative z-10">
                        <x-button
                            href="{{ route('student.assessment.minat-bakat') }}"
                            variant="primary"
                            size="md"
                            block
                            class="w-full text-center px-4 py-2.5 text-white text-xs font-extrabold rounded-xl shadow-md shadow-indigo-900/20 btn-hover-orange"
                        >
                            {{ isset($submissions['minat_bakat']) ? 'Ulangi Tes' : 'Mulai Tes' }}
                        </x-button>
                    </div>
                </x-card>

                {{-- 2. Tes Kemampuan --}}
                <x-card
                    variant="strong"
                    class="card-interactive-strong rounded-[24px] sm:rounded-[32px] p-5 sm:p-6 flex flex-col justify-between group relative overflow-hidden"
                >
                    <div class="absolute -top-10 -right-10 w-36 h-36 bg-gradient-to-br from-indigo-100/60 to-orange-100/30 rounded-full blur-3xl group-hover:from-indigo-200/90 group-hover:to-orange-200/60 transition-all duration-500 pointer-events-none"></div>

                    <div class="space-y-4 relative z-10">
                        <div class="flex justify-between items-center border-b border-indigo-100/60 pb-3">
                            <span class="text-[11px] font-extrabold text-[#3650A2] uppercase tracking-wider bg-indigo-50/80 px-2.5 py-1 rounded-lg border border-indigo-100">
                                Modul 02
                            </span>

                            <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-lg text-[10px] font-extrabold uppercase tracking-wide border border-emerald-200/80 flex items-center gap-1.5 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full {{ isset($submissions['kemampuan']) ? 'bg-emerald-600' : 'bg-amber-500' }}"></span>
                                {{ isset($submissions['kemampuan']) ? 'Tersimpan' : 'Belum' }}
                            </span>
                        </div>

                        <div class="space-y-1.5">
                            <h3 class="text-base sm:text-lg font-black text-gray-900 group-hover:text-[#3650A2] transition-colors">
                                Tes Kemampuan
                            </h3>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Mengukur tingkat kognitif, kemampuan numerik, abstrak, serta problem solving-mu.
                            </p>
                        </div>

                        {{-- Estimasi Waktu & Detail Kecil --}}
                        <div class="flex items-center gap-2 text-[11px] font-bold text-gray-500 pt-1">
                            <span class="flex items-center gap-1 bg-indigo-50/60 text-[#3650A2] px-2.5 py-1 rounded-md border border-indigo-100/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                ± 20 Menit
                            </span>
                        </div>

                        <div class="bg-indigo-50/50 border border-indigo-100/80 p-3 rounded-xl space-y-0.5 shadow-2xs">
                            <div class="text-[11px] font-extrabold text-[#3650A2]">{{ isset($submissions['kemampuan']) ? 'Jawaban Tersimpan' : 'Belum Dikerjakan' }}</div>
                            <div class="text-[10px] text-gray-500 font-medium">{{ isset($submissions['kepribadian']) ? 'Terakhir disimpan ' . \Carbon\Carbon::parse($submissions['kepribadian']->submitted_at)->format('d/m/Y H:i') : 'Selesaikan tes untuk menyimpan jawaban.' }}</div>
                        </div>
                    </div>

                    <div class="pt-5 sm:pt-6 relative z-10">
                        <x-button
                            href="{{ route('student.assessment.kemampuan') }}"
                            variant="primary"
                            size="md"
                            block
                            class="w-full text-center px-4 py-2.5 text-white text-xs font-extrabold rounded-xl shadow-md shadow-indigo-900/20 btn-hover-orange"
                        >
                            {{ isset($submissions['kemampuan']) ? 'Ulangi Tes' : 'Mulai Tes' }}
                        </x-button>
                    </div>
                </x-card>

                {{-- 3. Tes Kepribadian Karier --}}
                <x-card
                    variant="strong"
                    class="card-interactive-strong rounded-[24px] sm:rounded-[32px] p-5 sm:p-6 flex flex-col justify-between group relative overflow-hidden"
                >
                    <div class="absolute -top-10 -right-10 w-36 h-36 bg-gradient-to-br from-indigo-100/60 to-orange-100/30 rounded-full blur-3xl group-hover:from-indigo-200/90 group-hover:to-orange-200/60 transition-all duration-500 pointer-events-none"></div>

                    <div class="space-y-4 relative z-10">
                        <div class="flex justify-between items-center border-b border-indigo-100/60 pb-3">
                            <span class="text-[11px] font-extrabold text-[#3650A2] uppercase tracking-wider bg-indigo-50/80 px-2.5 py-1 rounded-lg border border-indigo-100">
                                Modul 03
                            </span>

                            <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-lg text-[10px] font-extrabold uppercase tracking-wide border border-emerald-200/80 flex items-center gap-1.5 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full {{ isset($submissions['kepribadian']) ? 'bg-emerald-600' : 'bg-amber-500' }}"></span>
                                {{ isset($submissions['kepribadian']) ? 'Tersimpan' : 'Belum' }}
                            </span>
                        </div>

                        <div class="space-y-1.5">
                            <h3 class="text-base sm:text-lg font-black text-gray-900 group-hover:text-[#3650A2] transition-colors">
                                Tes Kepribadian Karier
                            </h3>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Mengetahui tipe kepribadian dan lingkungan kerja yang paling selaras dengan karaktermu.
                            </p>
                        </div>

                        {{-- Estimasi Waktu & Detail Kecil --}}
                        <div class="flex items-center gap-2 text-[11px] font-bold text-gray-500 pt-1">
                            <span class="flex items-center gap-1 bg-indigo-50/60 text-[#3650A2] px-2.5 py-1 rounded-md border border-indigo-100/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                ± 15 Menit
                            </span>
                        </div>

                        <div class="bg-indigo-50/50 border border-indigo-100/80 p-3 rounded-xl space-y-0.5 shadow-2xs">
                            <div class="text-[11px] font-extrabold text-[#3650A2]">{{ isset($submissions['kepribadian']) ? 'Jawaban Tersimpan' : 'Belum Dikerjakan' }}</div>
                            <div class="text-[10px] text-gray-500 font-medium">{{ isset($submissions['kepribadian']) ? 'Terakhir disimpan ' . \Carbon\Carbon::parse($submissions['kepribadian']->submitted_at)->format('d/m/Y H:i') : 'Selesaikan tes untuk menyimpan jawaban.' }}</div>
                        </div>
                    </div>

                    <div class="pt-5 sm:pt-6 relative z-10">
                        <x-button
                            href="{{ route('student.assessment.kepribadian') }}"
                            variant="primary"
                            size="md"
                            block
                            class="w-full text-center px-4 py-2.5 text-white text-xs font-extrabold rounded-xl shadow-md shadow-indigo-900/20 btn-hover-orange"
                        >
                            {{ isset($submissions['kepribadian']) ? 'Ulangi Tes' : 'Mulai Tes' }}
                        </x-button>
                    </div>
                </x-card>

            </div>

            {{-- Section Heading: Laporan & Layanan --}}
            <div class="pt-4 pb-1 space-y-1">
                <h2 class="text-lg sm:text-xl font-black text-gray-900 tracking-tight flex items-center gap-2">
                    <span class="w-2 h-6 bg-[#3650A2] rounded-full inline-block"></span>
                    Laporan &amp; Layanan Bimbingan
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 ml-4 font-medium">
                    Akses hasil rangkuman asesmen serta jadwalkan konsultasi dengan Guru BK.
                </p>
            </div>

            {{-- Kartu Hasil Asesmen --}}
            <x-card variant="strong" class="card-interactive-strong rounded-[24px] sm:rounded-[28px] p-5 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 relative overflow-hidden group">
                <div class="absolute left-0 top-0 bottom-0 w-2 bg-gradient-to-b from-[#3650A2] to-[#FF7A59]"></div>
                <div class="space-y-1 pl-1 sm:pl-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-[#FF7A59] bg-orange-50 px-2 py-0.5 rounded border border-orange-100">Laporan Akhir</span>
                    <h3 class="text-sm sm:text-base font-black text-gray-900">Hasil Asesmen</h3>
                    <p class="text-xs text-gray-600">Lihat halaman hasil asesmen yang terkait dengan akunmu.</p>
                    <p class="text-[11px] font-bold text-gray-500">{{ $completedCount === 3 ? 'Semua tes sudah tersimpan.' : 'Tes tersimpan: ' . $completedCount . ' dari 3.' }}</p>
                </div>
                <x-button href="{{ route('student.result.index') }}" variant="primary" size="md" class="w-full sm:w-auto text-center px-5 py-3 text-white text-xs font-extrabold rounded-xl shadow-md shadow-indigo-900/20 btn-hover-orange shrink-0">
                    Lihat Hasil Asesmen &rarr;
                </x-button>
            </x-card>

            {{-- Footer Bantuan / Konsultasi BK --}}
            <x-card
                variant="strong"
                class="w-full card-interactive-strong rounded-[24px] sm:rounded-[32px] p-5 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5 shadow-sm group relative overflow-hidden"
            >
                <div class="absolute right-0 top-0 bottom-0 w-2 bg-gradient-to-b from-[#3650A2] to-[#FF7A59]"></div>

                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3.5 sm:gap-4">
                    <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-gradient-to-br from-[#3650A2] to-[#1E2D62] text-white flex items-center justify-center font-extrabold shrink-0 shadow-md shadow-indigo-900/20 transition-transform group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>

                    <div class="space-y-0.5">
                        <div class="text-xs sm:text-sm font-extrabold text-gray-900 group-hover:text-[#3650A2] transition-colors">
                            Butuh panduan atau interpretasi hasil asesmen?
                        </div>
                        <div class="text-[11px] sm:text-xs text-gray-600 font-medium leading-relaxed">
                            Jadwalkan sesi diskusi langsung bersama Guru Bimbingan Konseling (BK) sekolahmu untuk mendapatkan insight mendalam.
                        </div>
                    </div>
                </div>

                <x-button
                    href="{{ route('student.consultation.index') }}"
                    variant="primary"
                    size="md"
                    class="w-full sm:w-auto text-center px-5 py-3 text-white text-xs font-extrabold rounded-xl shadow-md shadow-indigo-900/20 btn-hover-orange shrink-0"
                >
                    Hubungi Guru BK
                </x-button>
            </x-card>

        </main>
    </div>

</body>
</html>
