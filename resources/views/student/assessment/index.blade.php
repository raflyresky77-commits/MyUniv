
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
                0 20px 45px -12px rgba(30, 45, 98, 0.12),
                0 0 0 1px rgba(54, 80, 162, 0.04);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card-interactive-strong:hover {
            transform: translateY(-6px) scale(1.01);
            border-color: rgba(54, 80, 162, 0.4);
            box-shadow:
                0 35px 65px -15px rgba(54, 80, 162, 0.22),
                0 0 0 2px rgba(255, 122, 89, 0.2);
        }

        @keyframes floatMascot {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-8px) rotate(1.5deg);
            }
        }

        .mascot-float {
            animation: floatMascot 4s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-[#F4F7FE] text-gray-800 antialiased">

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

    {{-- Sidebar reusable component.
    Backdrop dikelola oleh komponen sidebar, jangan buat backdrop kedua. --}}
    <x-student.student-sidebar active="assessment" />

    {{-- Topbar reusable component --}}
    <x-student.student-topbar
        title="Dashboard Asesmen Siswa"
        :user="auth()->user()"
    />

    {{-- Main Content Area --}}
    <div class="md:ml-72 pt-28 min-h-screen flex flex-col">
        <main class="p-6 md:p-10 space-y-8 max-w-7xl w-full mx-auto flex-1">

            {{-- Banner Asesmen --}}
            <x-student.banner
                eyebrow="Pusat Asesmen"
                title="Kenali Potensi Dirimu"
                description="Pilih dan selesaikan rangkaian tes minat, bakat, kemampuan, serta kepribadian kariermu untuk rekomendasi masa depan terbaik."
            />

            {{-- Progress Keseluruhan --}}
            <x-card
                variant="strong"
                class="card-interactive-strong rounded-[36px] p-7 sm:p-8 space-y-4 relative overflow-hidden group"
            >
                <div class="absolute right-0 top-0 bottom-0 w-3.5 bg-gradient-to-b from-[#3650A2] to-[#FF7A59]"></div>

                <div class="flex justify-between items-center">
                    <span class="text-sm font-extrabold text-gray-900 flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center text-[#3650A2] transition-transform group-hover:rotate-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        Progress Keseluruhan Asesmen
                    </span>

                    <span class="text-xs font-extrabold px-4 py-1.5 bg-indigo-50 text-[#3650A2] rounded-full border border-indigo-200">
                        {{ $progress }}% Selesai
                    </span>
                </div>

                <div class="w-full bg-gray-100 h-3.5 rounded-full overflow-hidden p-0.5 border border-indigo-50">
                    <div class="bg-gradient-to-r from-[#3650A2] via-indigo-600 to-[#FF7A59] h-full rounded-full transition-all duration-700 shadow-sm" style="width: {{ $progress }}%;"></div>
                </div>

                <div class="text-xs font-bold text-gray-500">
                    {{ $completedCount }} dari 3 tes telah disimpan ke database.
                </div>
            </x-card>

            {{-- Grid 3 Kartu Asesmen --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- 1. Tes Minat & Bakat --}}
                <x-card
                    variant="strong"
                    class="card-interactive-strong rounded-[40px] p-7 flex flex-col justify-between group relative overflow-hidden"
                >
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-100/60 rounded-full blur-3xl group-hover:bg-indigo-200/90 transition-all duration-500"></div>

                    <div class="space-y-5 relative z-10">
                        <div class="flex justify-between items-center border-b border-indigo-100/60 pb-4">
                            <span class="text-xs font-extrabold text-[#3650A2] uppercase tracking-wider">
                                Modul 01
                            </span>

                            <span class="px-3 py-1 bg-emerald-100/80 text-emerald-800 rounded-xl text-[10px] font-extrabold uppercase tracking-wide border border-emerald-200 flex items-center gap-1.5 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full {{ isset($submissions['minat_bakat']) ? 'bg-emerald-600' : 'bg-amber-600' }}"></span>
                                {{ isset($submissions['minat_bakat']) ? 'Tersimpan' : 'Belum' }}
                            </span>
                        </div>

                        <div class="space-y-2">
                            <h3 class="text-xl font-black text-gray-900 group-hover:text-[#3650A2] transition-colors">
                                Tes Minat &amp; Bakat
                            </h3>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Mengetahui bidang minat spesifik dan kecenderungan bakat utamamu untuk masa depan.
                            </p>
                        </div>

                        <div class="bg-indigo-50/60 border border-indigo-100 p-4 rounded-2xl space-y-1 shadow-2xs">
                            <div class="text-xs font-extrabold text-[#3650A2]">{{ isset($submissions['minat_bakat']) ? 'Jawaban Tersimpan' : 'Belum Dikerjakan' }}</div>
                            <div class="text-[11px] text-gray-500 font-medium">{{ isset($submissions['minat_bakat']) ? 'Terakhir disimpan ' . \Carbon\Carbon::parse($submissions['minat_bakat']->submitted_at)->format('d M Y, H:i') : 'Selesaikan tes untuk menyimpan jawaban.' }}</div>
                        </div>
                    </div>

                    <div class="pt-8 relative z-10 flex justify-end">
                        <x-button
                            href="{{ route('student.assessment.minat-bakat') }}"
                            variant="primary"
                            size="md"
                            block
                            class="w-full text-center px-5 py-3 !bg-[#3650A2] hover:!bg-[#FF7A59] active:!bg-[#FF7A59] text-white text-xs font-extrabold rounded-2xl transition-all duration-300 border border-[#3650A2] hover:border-[#FF7A59] shadow-md shadow-indigo-900/20 hover:shadow-orange-500/25"
                        >
                            {{ isset($submissions['minat_bakat']) ? 'Ulangi Tes' : 'Mulai Tes' }}
                        </x-button>
                    </div>
                </x-card>

                {{-- 2. Tes Kemampuan --}}
                <x-card
                    variant="strong-highlight"
                    class="card-interactive-strong rounded-[40px] p-7 flex flex-col justify-between group relative overflow-hidden border-2 border-[#3650A2]/30 shadow-xl"
                >
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-orange-100/80 rounded-full blur-3xl group-hover:bg-orange-200 transition-all duration-500"></div>

                    <div class="space-y-5 relative z-10">
                        <div class="flex justify-between items-center border-b border-indigo-100/60 pb-4">
                            <span class="text-xs font-extrabold text-[#3650A2] uppercase tracking-wider">
                                Modul 02
                            </span>

                            <span class="px-3 py-1 bg-amber-100 text-amber-900 rounded-xl text-[10px] font-extrabold uppercase tracking-wide border border-amber-200 flex items-center gap-1.5 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full {{ isset($submissions['kemampuan']) ? 'bg-emerald-600' : 'bg-amber-600' }}"></span>
                                {{ isset($submissions['kemampuan']) ? 'Tersimpan' : 'Belum' }}
                            </span>
                        </div>

                        <div class="space-y-2">
                            <h3 class="text-xl font-black text-gray-900 group-hover:text-[#FF7A59] transition-colors">
                                Tes Kemampuan
                            </h3>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Mengukur tingkat kognitif, kemampuan numerik, abstrak, serta problem solving-mu.
                            </p>
                        </div>

                        <div class="bg-white border border-indigo-100 p-4 rounded-2xl space-y-2.5 shadow-xs">
                            <div class="flex justify-between items-center">
                                <ul class="text-xs font-bold text-gray-700 space-y-1">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#3650A2]"></span>
                                        Abstrak &amp; Logika
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#3650A2]"></span>
                                        Numerik
                                    </li>
                                </ul>

                                <span class="px-2.5 py-1 bg-indigo-100/80 border border-indigo-200 rounded-xl text-[11px] font-extrabold text-[#3650A2]">
                                    40 Menit
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8 relative z-10 flex justify-end">
                        <x-button
                            href="{{ route('student.assessment.kemampuan') }}"
                            variant="primary"
                            size="lg"
                            block
                            class="w-full text-center px-6 py-3.5 !bg-[#3650A2] hover:!bg-[#FF7A59] active:!bg-[#FF7A59] text-white text-xs font-extrabold rounded-2xl transition-all duration-300 border border-[#3650A2] hover:border-[#FF7A59] shadow-md shadow-indigo-900/20 hover:shadow-orange-500/25 hover:scale-[1.02]"
                        >
                            {{ isset($submissions['kemampuan']) ? 'Ulangi Tes' : 'Mulai Tes' }}
                        </x-button>
                    </div>
                </x-card>

                {{-- 3. Tes Kepribadian Karier --}}
                <x-card
                    variant="strong"
                    class="card-interactive-strong rounded-[40px] p-7 flex flex-col justify-between group relative overflow-hidden"
                >
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-100/60 rounded-full blur-3xl group-hover:bg-indigo-200/90 transition-all duration-500"></div>

                    <div class="space-y-5 relative z-10">
                        <div class="flex justify-between items-center border-b border-indigo-100/60 pb-4">
                            <span class="text-xs font-extrabold text-[#3650A2] uppercase tracking-wider">
                                Modul 03
                            </span>

                            <span class="px-3 py-1 bg-emerald-100/80 text-emerald-800 rounded-xl text-[10px] font-extrabold uppercase tracking-wide border border-emerald-200 flex items-center gap-1.5 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full {{ isset($submissions['kepribadian']) ? 'bg-emerald-600' : 'bg-amber-600' }}"></span>
                                {{ isset($submissions['kepribadian']) ? 'Tersimpan' : 'Belum' }}
                            </span>
                        </div>

                        <div class="space-y-2">
                            <h3 class="text-xl font-black text-gray-900 group-hover:text-[#3650A2] transition-colors">
                                Tes Kepribadian Karier
                            </h3>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Mengetahui tipe kepribadian dan lingkungan kerja yang paling selaras dengan karaktermu.
                            </p>
                        </div>

                        <div class="bg-indigo-50/60 border border-indigo-100 p-4 rounded-2xl space-y-1 shadow-2xs">
                            <div class="text-xs font-extrabold text-[#3650A2]">{{ isset($submissions['kepribadian']) ? 'Jawaban Tersimpan' : 'Belum Dikerjakan' }}</div>
                            <div class="text-[11px] text-gray-500 font-medium">{{ isset($submissions['kepribadian']) ? 'Terakhir disimpan ' . \Carbon\Carbon::parse($submissions['kepribadian']->submitted_at)->format('d/m/Y H:i') : 'Selesaikan tes untuk menyimpan jawaban.' }}</div>
                        </div>
                    </div>

                    <div class="pt-8 relative z-10 flex justify-end">
                        <x-button
                            href="{{ route('student.assessment.kepribadian') }}"
                            variant="primary"
                            size="md"
                            block
                            class="w-full text-center px-5 py-3 !bg-[#3650A2] hover:!bg-[#FF7A59] active:!bg-[#FF7A59] text-white text-xs font-extrabold rounded-2xl transition-all duration-300 border border-[#3650A2] hover:border-[#FF7A59] shadow-md shadow-indigo-900/20 hover:shadow-orange-500/25"
                        >
                            {{ isset($submissions['kepribadian']) ? 'Ulangi Tes' : 'Mulai Tes' }}
                        </x-button>
                    </div>
                </x-card>

            </div>

            {{-- Kartu Hasil Asesmen --}}
            <x-card variant="strong" class="card-interactive-strong rounded-[32px] p-7 flex flex-col sm:flex-row items-center justify-between gap-5">
                <div>
                    <h3 class="text-lg font-black text-gray-900">Hasil Asesmen</h3>
                    <p class="text-sm text-gray-600 mt-1">Lihat halaman hasil asesmen yang terkait dengan akunmu.</p>
                    <p class="text-xs font-bold text-gray-500 mt-2">{{ $completedCount === 3 ? 'Semua tes sudah tersimpan.' : 'Tes tersimpan: ' . $completedCount . ' dari 3.' }}</p>
                </div>
                <x-button href="{{ route('student.result.index') }}" variant="primary" size="lg" class="px-7 py-3.5 !bg-[#3650A2] text-white text-xs font-extrabold rounded-2xl">
                    Lihat Hasil Asesmen &rarr;
                </x-button>
            </x-card>

            {{-- Footer Bantuan / Konsultasi BK --}}
            <x-card
                variant="strong"
                class="w-full card-interactive-strong rounded-[40px] p-7 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-sm group"
            >
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#3650A2] to-[#1E2D62] text-white flex items-center justify-center font-extrabold shrink-0 shadow-md shadow-indigo-900/20 transition-transform group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>

                    <div class="space-y-1">
                        <div class="text-base font-extrabold text-gray-900 group-hover:text-[#3650A2] transition-colors">
                            Butuh panduan atau interpretasi hasil asesmen?
                        </div>
                        <div class="text-xs text-gray-600 font-medium leading-relaxed">
                            Jadwalkan sesi diskusi langsung bersama Guru Bimbingan Konseling (BK) sekolahmu untuk mendapatkan insight mendalam.
                        </div>
                    </div>
                </div>

                <x-button
                    href="{{ route('student.consultation.index') }}"
                    variant="primary"
                    size="lg"
                    class="px-7 py-3.5 bg-[#3650A2] hover:bg-[#1E2D62] text-white text-xs font-extrabold rounded-2xl transition-all duration-300 shadow-md shadow-indigo-900/25 hover:scale-105 shrink-0"
                >
                    Hubungi Guru BK
                </x-button>
            </x-card>

        </main>
    </div>

    {{-- Tidak perlu script toggleSidebar di halaman ini.
    Hamburger dan backdrop dikendalikan oleh komponen sidebar. --}}

</body>
</html>
