<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Asesmen - MyUniv</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- html2canvas CDN untuk fitur Unduh PNG -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        body {
            background: #F4FAFF;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .result-card {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(54, 80, 162, .12);
            border-radius: 24px;
            background: linear-gradient(135deg, #FFFFFF 0%, #F8FBFF 100%);
            box-shadow: 0 14px 35px -10px rgba(54, 80, 162, .08), 0 0 0 1px rgba(54, 80, 162, .02);
            transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
        }

        .result-card:hover {
            transform: translateY(-3px);
            border-color: rgba(255, 122, 89, .3);
            box-shadow: 0 20px 40px -12px rgba(54, 80, 162, .14), 0 0 0 2px rgba(255, 122, 89, .08);
        }

        .result-card::before {
            content: '';
            position: absolute;
            width: 120px; height: 120px;
            top: -60px; right: -40px;
            border-radius: 999px;
            background: rgba(255, 122, 89, .08);
            filter: blur(16px);
            pointer-events: none;
        }

        .progress-track {
            height: 10px;
            overflow: hidden;
            border-radius: 999px;
            background: #EAEFF7;
        }

        .progress-fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #3650A2 0%, #5B6DCD 50%, #FF7A59 100%);
            transition: width .7s cubic-bezier(.16, 1, .3, 1);
        }

        .result-link {
            color: #3650A2;
            text-decoration: underline;
            text-underline-offset: 4px;
            font-weight: 700;
            transition: color .2s;
        }
        .result-link:hover {
            color: #FF7A59;
        }

    </style>
</head>

<body class="text-gray-800 antialiased">

    {{-- Sidebar --}}
    <x-student.student-sidebar active="assessment" />

    {{-- Topbar --}}
    <x-student.student-topbar
        title="Hasil Asesmen"
        subtitle="Rangkuman Potensi"
        :username="auth()->user()->name ?? 'Pengguna'"
        :initials="strtoupper(substr(auth()->user()->name ?? 'MU', 0, 2))"
    />

    <div class="md:ml-72 min-h-screen pt-24">
        <!-- Bagian yang akan di-capture jadi PNG dibungkus dengan id="captureArea" -->
        <main id="captureArea" class="mx-auto w-full max-w-7xl space-y-8 p-4 sm:p-6 md:p-10 bg-[#F4FAFF]">

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-800 shadow-sm flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Header halaman hasil asesmen --}}
            <section class="relative overflow-hidden rounded-[32px] bg-gradient-to-r from-[#3650A2] via-[#2A3F82] to-[#1C2C5E] p-6 text-white shadow-xl shadow-indigo-950/15 sm:p-10">
                <div class="pointer-events-none absolute -right-10 -bottom-12 h-64 w-64 rounded-full bg-[#FF7A59]/15 blur-3xl"></div>
                <div class="pointer-events-none absolute right-32 top-0 h-32 w-32 rounded-full bg-white/10 blur-2xl"></div>

                <div class="relative z-10 flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                    <div class="max-w-2xl">
                        <span class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/15 px-4 py-2 text-xs font-extrabold text-white backdrop-blur-md shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-[#FF7A59] animate-ping"></span>
                            <i class="fa-solid fa-award text-[#FF7A59]"></i>
                            Rangkuman Asesmen MyUniv
                        </span>
                        <h1 class="text-3xl font-black leading-tight tracking-tight text-white sm:text-4xl">
                            Hasil Asesmen Potensi Diri
                        </h1>
                        <p class="mt-3 text-sm font-medium leading-relaxed text-indigo-100 sm:text-base">
                            Lihat rangkuman hasil asesmenmu untuk mengenali minat, kemampuan, dan arah pendidikan yang sesuai.
                        </p>
                    </div>

                    <div class="flex shrink-0 flex-col gap-2.5 no-export-ui sm:flex-row">
                        <button type="button" onclick="downloadAssessmentImage()" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/30 text-white font-bold text-xs sm:text-sm backdrop-blur-md transition-all shadow-md group">
                            <i class="fa-solid fa-image text-[#FF7A59] group-hover:scale-110 transition-transform"></i>
                            <span id="downloadPngText">Unduh PNG</span>
                        </button>
                        <button type="button" onclick="downloadAssessmentDoc()" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/30 text-white font-bold text-xs sm:text-sm backdrop-blur-md transition-all shadow-md group">
                            <i class="fa-solid fa-file-word text-[#FF7A59] group-hover:scale-110 transition-transform"></i>
                            <span>Unduh DOC</span>
                        </button>
                    </div>
                </div>
            </section>

            {{-- Ringkasan hasil utama --}}
            <div class="result-card p-5 sm:p-7">
                <div class="grid grid-cols-1 items-center gap-6 md:grid-cols-3">

                    <div class="rounded-2xl border border-[#DCE4F0] bg-white p-6 shadow-sm md:col-span-2 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-2 h-full bg-gradient-to-b from-[#3650A2] to-[#FF7A59]"></div>
                        <p class="text-xs font-bold uppercase tracking-wider text-indigo-600">
                            Hasil Peminatan Utama
                        </p>

                        <h2 class="mt-2 text-2xl font-black text-gray-900 sm:text-3xl">
                            Belum tersedia
                        </h2>

                        <p class="mt-2 text-xs font-semibold text-gray-500">
                            Skor kecocokan
                        </p>

                        <div class="mt-2 flex items-center gap-4">
                            <span class="text-3xl font-black text-[#3650A2]">—</span>
                            <div class="progress-track flex-1">
                                <div class="progress-fill" style="width: 0%"></div>
                            </div>
                        </div>

                        <p class="mt-4 rounded-xl bg-[#F4FAFF] border border-indigo-100 p-3.5 text-xs leading-relaxed text-gray-600 flex items-start gap-2">
                            <i class="fa-solid fa-circle-info text-[#FF7A59] mt-0.5 shrink-0"></i>
                            <span>Hasil peminatan utama akan ditampilkan setelah skor asesmen berhasil dihitung oleh sistem.</span>
                        </p>
                    </div>

                    <div class="flex min-h-40 flex-col items-center justify-center rounded-2xl border border-indigo-100 bg-gradient-to-b from-white to-[#F8FBFF] p-5 text-center shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-[#FF7A59]/10 text-[#FF7A59] flex items-center justify-center mb-2 font-bold text-sm">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Kategori</p>
                        <h3 class="mt-1 text-2xl font-black text-[#3650A2]">
                            Belum tersedia
                        </h3>
                        <p class="mt-1 text-xs text-gray-500 font-medium">
                            Menunggu hasil asesmen
                        </p>
                    </div>

                </div>
            </div>

            {{-- Profil potensi --}}
            <section class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-black text-gray-900">
                            Profil Potensimu
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Ringkasan hasil dari beberapa aspek asesmen.
                        </p>
                    </div>
                    <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-coralOrange/10 text-[#FF7A59] text-xs font-bold">
                        <i class="fa-solid fa-chart-pie"></i> Analisis AI
                    </span>
                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-5">

                    {{-- Grafik hasil --}}
                    <div class="result-card p-5 sm:p-7 lg:col-span-3">
                        <h3 class="mb-6 text-center text-xl font-extrabold text-gray-900 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-chart-column text-[#3650A2]"></i> Grafik Hasil Asesmen
                        </h3>

                        @php
                            $profileMetrics = [
                                'Minat' => null,
                                'Bakat' => null,
                                'Kemampuan' => null,
                                'Kepribadian' => null,
                                'Kreativitas' => null,
                            ];
                        @endphp

                        <div class="space-y-4">
                            @foreach ($profileMetrics as $label =>$score)
                                <div class="grid grid-cols-[100px_minmax(0,1fr)_35px] items-center gap-3 bg-white p-3 rounded-xl border border-gray-100 shadow-2xs">
                                    <span class="text-xs font-bold text-indigo-900 flex items-center gap-1.5">
                                        <i class="fa-solid fa-angles-right text-[10px] text-[#FF7A59]"></i> {{ $label }}
                                    </span>

                                    <div class="progress-track">
                                        <div
                                            class="progress-fill"
                                            style="width: {{ is_numeric($score) ? max(0, min(100, $score)) : 0 }}%">
                                        </div>
                                    </div>

                                    <span class="text-right text-xs font-extrabold text-[#3650A2]">
                                        {{ is_numeric($score) ?$score : '—' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <p class="mt-6 text-xs leading-relaxed text-gray-500 bg-[#F4FAFF] p-3 rounded-xl border border-indigo-50">
                            <i class="fa-solid fa-lightbulb text-[#FF7A59] mr-1"></i> Grafik akan terisi secara otomatis setelah nilai setiap aspek selesai dianalisis.
                        </p>
                    </div>

                    {{-- Interpretasi --}}
                    <div class="result-card p-5 sm:p-7 lg:col-span-2">
                        <h3 class="mb-5 text-center text-xl font-extrabold text-gray-900 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-compass text-[#FF7A59]"></i> Interpretasi
                        </h3>

                        <div class="space-y-4 text-sm text-gray-600">
                            <div class="p-3.5 rounded-2xl bg-white border border-gray-100 shadow-2xs">
                                <p class="font-bold text-indigo-900 text-xs flex items-center gap-1.5 mb-1">
                                    <i class="fa-solid fa-shield-halved text-emerald-600"></i> Kekuatan utama
                                </p>
                                <p class="leading-relaxed text-xs text-gray-500">
                                    Belum dapat ditentukan sebelum hasil asesmen dianalisis.
                                </p>
                            </div>

                            <div class="p-3.5 rounded-2xl bg-white border border-gray-100 shadow-2xs">
                                <p class="font-bold text-indigo-900 text-xs flex items-center gap-1.5 mb-1">
                                    <i class="fa-solid fa-seedling text-[#FF7A59]"></i> Area yang dapat dikembangkan
                                </p>
                                <p class="leading-relaxed text-xs text-gray-500">
                                    Akan disesuaikan dengan hasil dan profil potensimu.
                                </p>
                            </div>

                            <div class="rounded-xl bg-gradient-to-r from-indigo-50 to-orange-50 border border-indigo-100/60 p-3.5 text-xs leading-relaxed text-indigo-950">
                                <strong class="text-[#FF7A59]"><i class="fa-solid fa-triangle-exclamation"></i> Catatan:</strong>
                                Hasil asesmen merupakan bahan pertimbangan pendukung, bukan penentu mutlak pilihan jurusan.
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            {{-- Rekomendasi jurusan --}}
            <section class="space-y-4">
                <div>
                    <h2 class="text-2xl font-black text-gray-900">
                        Rekomendasi Jurusan
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Jurusan yang akan disesuaikan dengan hasil asesmenmu.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="result-card p-5 group">
                            <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-tr from-[#3650A2] to-[#5B6DCD] text-white shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-graduation-cap text-base"></i>
                            </div>

                            <h3 class="font-extrabold text-gray-900 text-base">
                                Menunggu hasil
                            </h3>

                            <p class="mt-2 text-xs leading-relaxed text-gray-600">
                                Rekomendasi jurusan akan muncul berdasarkan kesesuaian profil minat dan kemampuan.
                            </p>

                            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-xs font-bold text-gray-400">
                                    Skor kecocokan: <span class="text-[#FF7A59]">—</span>
                                </span>
                                <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                            </div>
                        </div>
                    @endfor
                </div>
            </section>

            {{-- Tombol interaktif (Disembunyikan saat di-generate jadi gambar agar bersih) --}}
            <div class="result-card bg-gradient-to-br from-[#F8FBFF] to-[#EDF4FF] p-6 sm:p-8 border border-indigo-100 no-print shadow-md">
                <div class="max-w-2xl">
                    <span class="inline-block px-3 py-1 rounded-full bg-[#3650A2]/10 text-[#3650A2] text-xs font-extrabold mb-2">
                        <i class="fa-solid fa-compass-drafting text-[#FF7A59]"></i> Langkah Lanjutan
                    </span>
                    <h2 class="text-xl sm:text-2xl font-black text-indigo-950">
                        Langkah Selanjutnya
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 leading-relaxed">
                        Lanjutkan eksplorasi untuk merencanakan pendidikanmu bersama Mauny dan Guru BK.
                    </p>
                </div>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                    <x-button href="{{ route('student.exploration.index') }}" variant="primary" size="md" class="!bg-[#3650A2] hover:!bg-[#283C7E] !shadow-lg !shadow-indigo-900/15 !rounded-xl">
                        Explore Jurusan <i class="fa-solid fa-arrow-right ml-1"></i>
                    </x-button>

                    <x-button href="{{ route('student.planning.index') }}" variant="outline" size="md" class="!border-indigo-200 !text-indigo-900 hover:!bg-white !rounded-xl">
                        Buat Education Planning
                    </x-button>

                    <x-button href="{{ url('/student/consultation') }}" variant="outline" size="md" class="!border-indigo-200 !text-indigo-900 hover:!bg-white !rounded-xl">
                        Konsultasi BK
                    </x-button>
                </div>
            </div>

        </main>
    </div>

    {{-- Script unduh hasil asesmen sebagai PNG atau DOC --}}
    <script>
        async function downloadAssessmentImage() {
            const buttonText = document.getElementById('downloadPngText');
            const captureArea = document.getElementById('captureArea');
            const hiddenElements = document.querySelectorAll('.no-export-ui, .no-print');
            if (!captureArea || typeof html2canvas === 'undefined') {
                alert('Fitur PNG belum siap. Periksa koneksi internet lalu coba lagi.');
                return;
            }

            const originalText = buttonText ? buttonText.textContent : 'Unduh PNG';
            if (buttonText) buttonText.textContent = 'Memproses...';
            hiddenElements.forEach(element => element.dataset.previousDisplay = element.style.display);
            hiddenElements.forEach(element => element.style.display = 'none');

            try {
                const canvas = await html2canvas(captureArea, {
                    scale: Math.max(2, window.devicePixelRatio || 1),
                    useCORS: true,
                    backgroundColor: '#F4FAFF',
                    logging: false,
                    scrollX: 0,
                    scrollY: -window.scrollY,
                    windowWidth: document.documentElement.clientWidth
                });
                const link = document.createElement('a');
                link.download = 'hasil-asesmen-myuniv.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            } catch (error) {
                console.error('Gagal membuat PNG hasil asesmen:', error);
                alert('Gagal mengunduh PNG. Silakan coba lagi.');
            } finally {
                hiddenElements.forEach(element => {
                    element.style.display = element.dataset.previousDisplay || '';
                    delete element.dataset.previousDisplay;
                });
                if (buttonText) buttonText.textContent = originalText;
            }
        }

        function downloadAssessmentDoc() {
            const captureArea = document.getElementById('captureArea');
            if (!captureArea) return;

            const clone = captureArea.cloneNode(true);
            clone.querySelectorAll('.no-export-ui, .no-print, script, button, a').forEach(element => {
                if (element.matches('.no-export-ui, .no-print, script, button')) element.remove();
            });

            const styles = `
                <style>
                    body { font-family: 'Plus Jakarta Sans', Arial, sans-serif; color: #24324B; background: #F4FAFF; padding: 20px; }
                    h1, h2, h3 { color: #3650A2; }
                    section { margin-bottom: 24px; }
                    .result-card { border: 1px solid #DCE4F0; border-radius: 16px; background: #FFFFFF; padding: 24px; margin-bottom: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
                    .progress-track { height: 10px; background: #E7ECF4; border-radius: 999px; overflow: hidden; }
                    .progress-fill { height: 10px; background: linear-gradient(90deg, #3650A2 0%, #FF7A59 100%); border-radius: 999px; }
                    .bg-gradient-to-r { background: #3650A2 !important; }
                    .text-white { color: #FFFFFF !important; }
                </style>`;
            const documentHtml = `<!DOCTYPE html><html><head><meta charset="UTF-8">${styles}</head><body>${clone.innerHTML}</body></html>`;
            const blob = new Blob(['\ufeff', documentHtml], { type: 'application/msword;charset=utf-8' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = 'hasil-asesmen-myuniv.doc';
            document.body.appendChild(link);
            link.click();
            link.remove();
            URL.revokeObjectURL(url);
        }

    </script>

</body>
</html>
