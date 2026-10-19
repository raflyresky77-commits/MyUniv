<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Kemampuan - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-strong { background: linear-gradient(135deg, #3650A2 0%, #1E2D62 100%); }
        .bg-gradient-coral { background: linear-gradient(135deg, #FF7A59 0%, #E85D3A 100%); }
        .card-glass {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 245, 255, 0.9) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid rgba(54, 80, 162, 0.12);
            box-shadow: 0 20px 40px -15px rgba(54, 80, 162, 0.08);
        }
        input[type="radio"]:checked + div {
            background-color: #EEF3FF;
            border-color: #3650A2;
            color: #3650A2;
            box-shadow: 0 10px 25px -5px rgba(54, 80, 162, 0.15);
        }
        input[type="radio"]:checked + div .radio-bullet {
            border-color: #3650A2;
            background-color: #3650A2;
        }
        input[type="radio"]:checked + div .radio-bullet::after {
            transform: scale(1);
        }
        .drawingCanvas {
            touch-action: none;
            cursor: crosshair;
        }
    </style>
</head>
<body class="bg-[#F4F7FE] text-gray-800 antialiased">

    {{-- Backdrop dikelola oleh komponen sidebar reusable. Jangan tambahkan backdrop kedua. --}}
    <x-student.student-sidebar active="assessment" />

    <!-- Topbar melalui component reusable -->
    <x-student.student-topbar
        title="Tes Kemampuan"
        subtitle="Asesmen"
        :user="$user ?? auth()->user()"
        progress-id="progressTextHeader"
        progress-bar-id="progressBarHeader"
    />

    <!-- Main Content Area -->
    <div class="md:ml-72 pt-28 min-h-screen flex flex-col">
        <main class="p-6 md:p-10 space-y-8 max-w-6xl w-full mx-auto flex-1">

            <!-- Title & Top 4-Column Interaktif Banner -->
            <div class="space-y-6">
                <div class="text-center space-y-2">
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-indigo-50 text-[#3650A2] text-xs font-extrabold tracking-wider uppercase border border-indigo-100 shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-[#FF7A59] animate-pulse"></span>
                        Tahap 2 dari 3 Asesmen
                    </span>
                    <h1 class="text-3xl sm:text-4xl font-black text-[#3650A2] tracking-tight">Tes Kemampuan Akademik & Kreativitas</h1>
                </div>

                <!-- Banner 4 Kolom Interaktif -->
                <div class="card-glass rounded-[32px] p-4 sm:p-6 relative overflow-hidden">
                    <div class="grid grid-cols-2 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-gray-200/80 bg-white rounded-[24px] border border-gray-100 shadow-sm overflow-hidden text-center">

                        <!-- Kolom 1: Numerik -->
                        <div onclick="scrollToSection('numerik')" class="p-6 flex flex-col items-center justify-between space-y-4 hover:bg-indigo-50/60 hover:scale-[1.02] cursor-pointer transition-all duration-200 group">
                            <div class="flex flex-wrap justify-center items-center gap-4 py-2 text-indigo-600 opacity-80 group-hover:scale-110 transition-transform">
                                <span class="text-xl">✖</span>
                                <span class="text-lg font-bold">%</span>
                                <span class="text-xl font-bold">+</span>
                                <span class="text-xl font-bold">−</span>
                            </div>
                            <h3 class="font-black text-[#3650A2] tracking-wider text-base uppercase group-hover:text-indigo-700">NUMERIK</h3>
                            <div class="flex flex-wrap justify-center items-center gap-3 py-2 text-gray-400 opacity-60 text-xs">
                                <span>✖</span><span>%</span><span>+</span><span>−</span>
                            </div>
                        </div>

                        <!-- Kolom 2: Verbal -->
                        <div onclick="scrollToSection('verbal')" class="p-6 flex flex-col items-center justify-between space-y-4 hover:bg-indigo-50/60 hover:scale-[1.02] cursor-pointer transition-all duration-200 group">
                            <div class="flex flex-wrap justify-center items-center gap-4 py-2 text-indigo-600 opacity-80 group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <h3 class="font-black text-[#3650A2] tracking-wider text-base uppercase group-hover:text-indigo-700">VERBAL</h3>
                            <div class="flex flex-wrap justify-center items-center gap-3 py-2 text-gray-400 opacity-60 text-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                        </div>

                        <!-- Kolom 3: Abstrak -->
                        <div onclick="scrollToSection('abstrak')" class="p-6 flex flex-col items-center justify-between space-y-4 hover:bg-indigo-50/60 hover:scale-[1.02] cursor-pointer transition-all duration-200 group">
                            <div class="flex flex-wrap justify-center items-center gap-4 py-2 text-indigo-600 opacity-80 group-hover:scale-110 transition-transform">
                                <span class="text-lg">❖</span>
                                <span class="text-lg">▰</span>
                                <span class="text-lg">⚙</span>
                            </div>
                            <h3 class="font-black text-[#3650A2] tracking-wider text-base uppercase group-hover:text-indigo-700">ABSTRAK</h3>
                            <div class="flex flex-wrap justify-center items-center gap-3 py-2 text-gray-400 opacity-60 text-xs">
                                <span>❖</span><span>▰</span><span>⚙</span>
                            </div>
                        </div>

                        <!-- Kolom 4: Kreativitas -->
                        <div onclick="scrollToSection('kreativitas')" class="p-6 flex flex-col items-center justify-between space-y-4 hover:bg-orange-50/60 hover:scale-[1.02] cursor-pointer transition-all duration-200 group">
                            <div class="flex flex-wrap justify-center items-center gap-4 py-2 text-orange-500 opacity-80 group-hover:scale-110 transition-transform">
                                <span class="text-lg">🎨</span>
                                <span class="text-lg">💡</span>
                                <span class="text-lg">✏️</span>
                            </div>
                            <h3 class="font-black text-[#3650A2] tracking-wider text-base uppercase group-hover:text-orange-600">KREATIVITAS</h3>
                            <div class="flex flex-wrap justify-center items-center gap-3 py-2 text-gray-400 opacity-60 text-xs">
                                <span>🎨</span><span>💡</span><span>✏</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Box Instruksi dengan Timer Aktif -->
            <div class="bg-gradient-to-r from-indigo-900 via-[#3650A2] to-[#2B4185] rounded-[24px] p-6 sm:p-8 text-white shadow-xl shadow-indigo-950/15 relative overflow-hidden flex flex-col sm:flex-row justify-between items-center gap-6">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
                <div class="space-y-2 text-center sm:text-left z-10">
                    <div class="inline-block text-[10px] font-black uppercase tracking-widest text-[#FF7A59] bg-orange-950/40 px-3 py-1 rounded-lg border border-orange-500/30">Instruksi Interaktif</div>
                    <p class="text-xs sm:text-sm font-medium text-indigo-100 max-w-xl leading-relaxed">
                        Klik pada pilihan jawaban atau selesaikan gambar pada kanvas untuk mengisi soal. Indikator nomor di panel samping kanan akan otomatis berubah hijau saat soal terjawab.
                    </p>
                </div>
                <div class="bg-white/10 backdrop-blur-md border border-white/20 px-6 py-4 rounded-2xl text-center shrink-0 z-10 shadow-inner">
                    <div class="text-[10px] uppercase font-extrabold text-indigo-200 tracking-wider">Sisa Waktu Ujian</div>
                    <div class="text-2xl sm:text-3xl font-black text-orange-300 tracking-wider mt-0.5" id="timerDisplay">40:00</div>
                </div>
            </div>

            <!-- Layout Utama: Form Kiri & Panel Nomor Soal Interaktif di Kanan -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">

                <!-- Form Ujian -->
                <form id="assessmentForm" action="{{ route('student.assessment.kemampuan.store') }}" method="POST" class="lg:col-span-3 space-y-10">
                    @csrf

                    <!-- ================= SUBTES 1: NUMERIK (5 Soal) ================= -->
                    <div class="space-y-6" id="section-numerik">
                        <div class="bg-indigo-900 text-white px-6 py-3 rounded-2xl font-black text-sm uppercase tracking-wider flex justify-between items-center shadow-md">
                            <span>Subtes 1: Numerik (Pilihan Ganda Grid)</span>
                            <span class="text-xs bg-indigo-800 px-3 py-1 rounded-xl text-indigo-200">5 Soal</span>
                        </div>

                        @php
                            $numerikQuestions = [
                                ['q' => 'Seorang pedagang membeli 4 kg apel dengan harga Rp15.000 per kg. Ia menjual semuanya dengan harga Rp70.000. Berapa keuntungan pedagang tersebut?', 'opts' => ['Rp5.000', 'Rp10.000', 'Rp15.000', 'Rp20.000']],
                                ['q' => 'Jika 3 orang pekerja dapat menyelesaikan sebuah proyek dalam waktu 12 hari, berapa hari waktu yang dibutuhkan jika pekerjaan dikerjakan oleh 9 orang?', 'opts' => ['2 Hari', '3 Hari', '4 Hari', '6 Hari']],
                                ['q' => 'Berapakah nilai dari 15% dari 240?', 'opts' => ['32', '36', '40', '48']],
                                ['q' => 'Selesaikan deret angka berikut: 2, 5, 10, 17, 26, ...', 'opts' => ['35', '37', '39', '42']],
                                ['q' => 'Sebuah mobil menempuh jarak 180 km dengan kecepatan rata-rata 60 km/jam. Berapa jam waktu perjalanan yang diperlukan?', 'opts' => ['2 Jam', '2.5 Jam', '3 Jam', '3.5 Jam']]
                            ];
                        @endphp

                        @foreach($numerikQuestions as $index => $item)
                            <div id="card-question-{{ $index + 1 }}" class="bg-white border border-[#E2E8F0] rounded-[28px] p-6 sm:p-8 space-y-4 shadow-sm transition-all duration-200">
                                <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                                    <h3 class="text-sm font-extrabold text-[#3650A2]">Soal {{ $index + 1 }} dari {{ 16 + $drawingQuestions->count() }}</h3>
                                    <span class="text-[11px] font-bold text-gray-400 bg-gray-100 px-2.5 py-1 rounded-lg">Numerik</span>
                                </div>
                                <p class="text-sm sm:text-base font-bold text-gray-800">{{ $item['q'] }}</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                                    @foreach($item['opts'] as $opt)
                                        <label class="relative cursor-pointer">
                                            <input type="radio" name="responses[numerik][{{ $index + 1 }}]" value="{{ $opt }}" class="peer sr-only" onchange="updateProgress({{ $index + 1 }})">
                                            <div class="flex items-center gap-3.5 p-3.5 rounded-2xl border-2 border-gray-200 bg-white hover:border-indigo-200 transition-all">
                                                <div class="radio-bullet w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center shrink-0 relative"><div class="w-1.5 h-1.5 rounded-full bg-white transform scale-0 transition-transform"></div></div>
                                                <span class="text-sm font-bold text-gray-700">{{ $opt }}</span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- ================= SUBTES 2: VERBAL (5 Soal) ================= -->
                    <div class="space-y-6 pt-4" id="section-verbal">
                        <div class="bg-[#3650A2] text-white px-6 py-3 rounded-2xl font-black text-sm uppercase tracking-wider flex justify-between items-center shadow-md">
                            <span>Subtes 2: Verbal (Pilihan Ganda Vertikal)</span>
                            <span class="text-xs bg-indigo-800 px-3 py-1 rounded-xl text-indigo-200">5 Soal</span>
                        </div>

                        @php
                            $verbalQuestions = [
                                ['q' => 'Tuliskan sinonim (persamaan kata) dari kata "Cepat":', 'opts' => ['A. Lambat', 'B. Kilat', 'C. Tenang', 'D. Ragu']],
                                ['q' => 'Tuliskan antonim (lawan kata) dari "Nomaden":', 'opts' => ['A. Menetap', 'B. Berpindah', 'C. Menjelajah', 'D. Liar']],
                                ['q' => 'Lengkapi analogi berikut: "Buku : Membaca" &rarr; "Pensil : ..."', 'opts' => ['A. Menghapus', 'B. Menulis', 'C. Menggambar', 'D. Menyimpan']],
                                ['q' => 'Apa arti atau makna dari kata baku "Efektif"?', 'opts' => ['A. Berhasil guna / membawa hasil', 'B. Membutuhkan waktu lama', 'C. Sesuai keinginan pribadi', 'D. Penuh dengan keraguan']],
                                ['q' => 'Tuliskan istilah lain yang sepadan dengan kata "Analogi":', 'opts' => ['A. Perbedaan mutlak', 'B. Persamaan / kiasan', 'C. Lawan kata', 'D. Asal-usul kata']]
                            ];
                        @endphp

                        @foreach($verbalQuestions as $index => $item)
                            @php $qNum = $index + 6; @endphp
                            <div id="card-question-{{ $qNum }}" class="bg-white border border-[#E2E8F0] rounded-[28px] p-6 sm:p-8 space-y-4 shadow-sm transition-all duration-200">
                                <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                                    <h3 class="text-sm font-extrabold text-[#3650A2]">Soal {{ $qNum }} dari {{ 16 + $drawingQuestions->count() }}</h3>
                                    <span class="text-[11px] font-bold text-gray-400 bg-gray-100 px-2.5 py-1 rounded-lg">Verbal</span>
                                </div>
                                <p class="text-sm sm:text-base font-bold text-gray-800">{!! $item['q'] !!}</p>
                                <div class="space-y-2.5 pt-2">
                                    @foreach($item['opts'] as $opt)
                                        <label class="block relative cursor-pointer">
                                            <input type="radio" name="responses[verbal][{{ $index + 1 }}]" value="{{ $opt }}" class="peer sr-only" onchange="updateProgress({{ $qNum }})">
                                            <div class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl border-2 border-gray-200 bg-white hover:border-indigo-200 transition-all">
                                                <div class="radio-bullet w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center shrink-0 relative"><div class="w-1.5 h-1.5 rounded-full bg-white transform scale-0 transition-transform"></div></div>
                                                <span class="text-sm font-bold text-gray-700">{{ $opt }}</span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- ================= SUBTES 3: ABSTRAK (6 Soal: No 11 sampai 16) ================= -->
                    <div class="space-y-6 pt-4" id="section-abstrak">
                        <div class="bg-indigo-900 text-white px-6 py-3 rounded-2xl font-black text-sm uppercase tracking-wider flex justify-between items-center shadow-md">
                            <span>Subtes 3: Abstrak</span>
                            <span class="text-xs bg-indigo-800 px-3 py-1 rounded-xl text-indigo-200">6 Soal</span>
                        </div>

                        @php
                            $abstrakQuestions = [
                                'Tentukan bentuk/pola matriks kelanjutan yang paling tepat untuk nomor 1:',
                                'Tentukan bentuk/pola matriks kelanjutan yang paling tepat untuk nomor 2:',
                                'Tentukan bentuk/pola matriks kelanjutan yang paling tepat untuk nomor 3:',
                                'Tentukan bentuk/pola matriks kelanjutan yang paling tepat untuk nomor 4:',
                                'Tentukan bentuk/pola matriks kelanjutan yang paling tepat untuk nomor 5:',
                                'Tentukan bentuk/pola matriks kelanjutan yang paling tepat untuk nomor 6:',
                            ];
                        @endphp

                        @foreach($abstrakQuestions as $index => $questionText)
                            @php $qNum = $index + 11; @endphp
                            <div id="card-question-{{ $qNum }}" class="bg-white border border-[#E2E8F0] rounded-[28px] p-6 sm:p-8 space-y-4 shadow-sm transition-all duration-200">
                                <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                                    <h3 class="text-sm font-extrabold text-[#3650A2]">Soal {{ $qNum }} dari {{ 16 + $drawingQuestions->count() }}</h3>
                                    <span class="text-[11px] font-bold text-gray-400 bg-gray-100 px-2.5 py-1 rounded-lg">Abstrak</span>
                                </div>
                                <p class="text-sm sm:text-base font-bold text-gray-800">{{ $questionText }}</p>
                                <div class="p-6 bg-indigo-50/40 rounded-2xl border border-indigo-100 text-center font-bold text-indigo-900 text-sm tracking-wide shadow-inner">
                                    [ Ilustrasi Pola Matriks Visual #{{ $index + 1 }} ]
                                </div>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2">
                                    @foreach(['A', 'B', 'C', 'D'] as $opt)
                                        <label class="relative cursor-pointer">
                                            <input type="radio" name="responses[abstrak][{{ $index + 1 }}]" value="{{ $opt }}" class="peer sr-only" onchange="updateProgress({{ $qNum }})">
                                            <div class="flex flex-col items-center justify-center p-5 rounded-2xl border-2 border-gray-200 bg-white hover:border-indigo-300 transition-all">
                                                <span class="font-black text-[#3650A2] text-lg">{{ $opt }}</span>
                                                <span class="text-[10px] text-gray-400 font-bold uppercase mt-1">Pilihan</span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- ================= SUBTES 4: KREATIVITAS (5 Soal dari Supabase) ================= -->
                    <div class="space-y-6 pt-4" id="section-kreativitas">
                        <div class="bg-gradient-coral text-white px-6 py-3 rounded-2xl font-black text-sm uppercase tracking-wider flex justify-between items-center shadow-md">
                            <span>Subtes 4: Kreativitas (Drawing Test)</span>
                            <span class="text-xs bg-orange-900/40 px-3 py-1 rounded-xl text-orange-100">{{ $drawingQuestions->count() }} Gambar</span>
                        </div>

                        @foreach ($drawingQuestions as $index => $question)
                            @php
                                $canvasId = $index + 1;
                                $questionNumber = 17 + $index;
                            @endphp
                            <div id="card-question-{{ $questionNumber }}" class="bg-white border border-[#E2E8F0] rounded-[32px] p-6 sm:p-8 space-y-6 shadow-sm">
                                <div class="flex flex-wrap justify-between items-center border-b border-gray-100 pb-4 gap-2">
                                    <div>
                                        <h3 class="text-base font-black text-[#3650A2]">Soal {{ $questionNumber }} dari {{ 16 + $drawingQuestions->count() }}</h3>
                                        <p class="text-xs text-gray-500 font-semibold mt-1">{{ $question->question_text }}</p>
                                    </div>
                                    <span class="text-xs font-bold text-orange-600 bg-orange-50 px-3 py-1 rounded-xl border border-orange-100">KREATIVITAS {{ $canvasId }}</span>
                                </div>

                                <div class="flex flex-wrap items-center justify-between gap-4 bg-gray-50 p-4 rounded-2xl border border-gray-200">
                                    <div class="flex items-center gap-4 flex-wrap">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-bold text-gray-600">Warna:</span>
                                            <button type="button" onclick="setBrushColor({{ $canvasId }}, '#1E2D62')" class="w-6 h-6 rounded-full bg-[#1E2D62] border-2 border-white shadow-md" aria-label="Biru"></button>
                                            <button type="button" onclick="setBrushColor({{ $canvasId }}, '#FF7A59')" class="w-6 h-6 rounded-full bg-[#FF7A59] border-2 border-white shadow-md" aria-label="Oranye"></button>
                                            <button type="button" onclick="setBrushColor({{ $canvasId }}, '#10B981')" class="w-6 h-6 rounded-full bg-emerald-500 border-2 border-white shadow-md" aria-label="Hijau"></button>
                                            <button type="button" onclick="setBrushColor({{ $canvasId }}, '#111827')" class="w-6 h-6 rounded-full bg-gray-900 border-2 border-white shadow-md" aria-label="Hitam"></button>
                                        </div>
                                        <div class="flex items-center gap-2 pl-3 border-l border-gray-300">
                                            <label for="brushSize{{ $canvasId }}" class="text-xs font-bold text-gray-600">Kuas:</label>
                                            <select id="brushSize{{ $canvasId }}" onchange="setBrushSize({{ $canvasId }}, this.value)" class="text-xs border border-gray-300 rounded-xl px-2.5 py-1.5 bg-white font-bold text-gray-700">
                                                <option value="2">Tipis</option>
                                                <option value="5" selected>Sedang</option>
                                                <option value="10">Tebal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button type="button" onclick="undoCanvas({{ $canvasId }})" class="px-3.5 py-1.5 bg-white border border-gray-300 hover:bg-gray-100 rounded-xl text-xs font-bold text-gray-700 shadow-xs">Undo</button>
                                        <button type="button" onclick="resetCanvas({{ $canvasId }})" class="px-3.5 py-1.5 bg-red-50 border border-red-200 text-red-600 rounded-xl text-xs font-bold">Reset</button>
                                    </div>
                                </div>

                                <div class="w-full h-80 border-2 border-dashed border-indigo-200 rounded-2xl bg-white relative overflow-hidden flex justify-center items-center shadow-inner">
                                    <canvas id="drawingCanvas{{ $canvasId }}" class="drawingCanvas w-full h-full bg-white"></canvas>
                                </div>
                                <input type="hidden" name="responses[kreativitas][{{ $question->id }}]" id="kreativitasImageInput{{ $canvasId }}">
                            </div>
                        @endforeach
                    </div>


                    <!-- Tombol Navigasi Bawah -->
                    <div class="flex justify-between items-center pt-6">
                        <a href="{{ route('student.assessment.minat-bakat') }}" class="px-6.5 py-4 rounded-2xl bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold text-xs shadow-xs transition flex items-center gap-2">
                            &larr; Kembali ke Minat Bakat
                        </a>
                        <button type="button" onclick="validateAndSubmit()" class="px-8 py-4 rounded-2xl bg-gradient-coral text-white font-extrabold text-xs shadow-lg shadow-orange-950/20 hover:scale-[1.02] transition flex items-center gap-2">
                            <span>Selanjutnya ke Kepribadian</span> &rarr;
                        </button>
                    </div>
                </form>

                <!-- Panel Nomor Soal Interaktif di Kanan -->
                <div class="lg:col-span-1 space-y-4 sticky top-32">
                    <div class="bg-white border border-[#E2E8F0] rounded-[28px] p-5 shadow-sm space-y-4">
                        <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                            <span class="text-xs font-black uppercase text-[#3650A2] tracking-wider">Navigasi Soal</span>
                            <span id="paletteAnsweredCount" class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-full">0/{{ 16 + $drawingQuestions->count() }} Terjawab</span>
                        </div>
                        <div class="grid grid-cols-5 gap-2" id="questionPaletteGrid">
                            @for ($i = 1; $i <= 16 + $drawingQuestions->count(); $i++)
                                <button type="button" onclick="scrollToQuestion({{ $i }})" id="palette-btn-{{ $i }}" class="w-full aspect-square rounded-xl bg-gray-100 hover:bg-indigo-50 border border-gray-200 text-gray-700 font-extrabold text-xs transition flex items-center justify-center shadow-2xs">
                                    {{ $i }}
                                </button>
                            @endfor
                        </div>
                        <div class="pt-2 border-t border-gray-100 space-y-1.5 text-[11px] font-semibold text-gray-500">
                            <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-md bg-emerald-500"></div> <span>Sudah Dijawab / Digambar</span></div>
                            <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-md bg-gray-100 border border-gray-200"></div> <span>Belum Dijawab</span></div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Modal peringatan reusable: component student.assessment-warning-modal -->
    <x-student.assessment-warning-modal
        modal-id="warningModal"
        message-id="warningModalMessage"
        title="Peringatan: Belum Selesai!"
        initial-message="Masih ada beberapa soal yang belum Anda selesaikan. Silakan lengkapi terlebih dahulu sebelum melanjutkan."
        close-action="closeWarningModal"
        continue-action="forceSubmitAssessment"
        cancel-text="Periksa Kembali"
        confirm-text="Tetap Kirim"
    />

    <!-- Modal Pop-up Konfirmasi Berhasil / Lanjut ke Tahap Kepribadian (Baru) -->
    <div id="successModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center backdrop-blur-xs transition-opacity p-4">
        <div class="bg-white rounded-[28px] max-w-md w-full p-6 sm:p-8 shadow-2xl border border-gray-100 text-center space-y-5 transform scale-95 transition-transform duration-300" id="successModalContent">
            <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto text-2xl font-black shadow-inner">
                ✓
            </div>
            <div class="space-y-2">
                <h3 class="text-xl font-black text-[#3650A2]">Semua Soal Selesai!</h3>
                <p class="text-xs sm:text-sm font-medium text-gray-600 leading-relaxed">
                    Hebat! Anda telah menyelesaikan seluruh soal Tes Kemampuan Akademik & Kreativitas. Lanjutkan ke tahap asesmen kepribadian?
                </p>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeSuccessModal()" class="flex-1 py-3.5 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-2xl font-extrabold text-xs transition">
                    Batal
                </button>
                <button type="button" onclick="submitAssessmentForm()" class="flex-1 py-3.5 px-4 bg-gradient-coral text-white rounded-2xl font-extrabold text-xs shadow-lg shadow-orange-950/20 transition">
                    Lanjut ke Kepribadian
                </button>
            </div>
        </div>
    </div>

    <!-- Script Fungsionalitas Timer, Multi-Canvas, & Navigasi Interaktif -->
    <script>
        let totalSeconds = 40 * 60;
        const timerDisplay = document.getElementById('timerDisplay');
        const countdownInterval = setInterval(() => {
            if (totalSeconds <= 0) {
                clearInterval(countdownInterval);
                alert("Waktu ujian habis! Sistem otomatis mengirimkan jawaban Anda.");
                prepareAllCanvasData();
                document.getElementById('assessmentForm').submit();
                return;
            }
            totalSeconds--;
            let m = Math.floor(totalSeconds / 60);
            let s = totalSeconds % 60;
            timerDisplay.textContent = `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
        }, 1000);

        const answeredQuestions = new Set();
        const totalQuestions = 16 + {{ $drawingQuestions->count() }};

        function updateProgress(questionNumber) {
            answeredQuestions.add(questionNumber);

            const btn = document.getElementById('palette-btn-' + questionNumber);
            if (btn) {
                btn.classList.remove('bg-gray-100', 'text-gray-700', 'border-gray-200', 'hover:bg-indigo-50');
                btn.classList.add('bg-emerald-500', 'text-white', 'border-emerald-600', 'shadow-sm');
            }

            let totalAnswered = answeredQuestions.size;
            document.getElementById('paletteAnsweredCount').textContent = `${totalAnswered}/${totalQuestions} Terjawab`;
            const progressText = document.getElementById('progressTextHeader');
            const progressBar = document.getElementById('progressBarHeader');
            if (progressText) progressText.textContent = `Terjawab: ${totalAnswered} / ${totalQuestions} Soal`;
            let percent = (totalAnswered / totalQuestions) * 100;
            if (progressBar) progressBar.style.width = `${percent}%`;
        }

        function scrollToQuestion(num) {
            const el = document.getElementById('card-question-' + num);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                el.classList.add('ring-4', 'ring-indigo-300');
                setTimeout(() => el.classList.remove('ring-4', 'ring-indigo-300'), 1500);
            }
        }

        function scrollToSection(sectionName) {
            const el = document.getElementById('section-' + sectionName);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                el.classList.add('ring-4', 'ring-indigo-300', 'rounded-3xl', 'transition-all');
                setTimeout(() => el.classList.remove('ring-4', 'ring-indigo-300'), 1500);
            }
        }

        function validateAndSubmit() {
            prepareAllCanvasData();
            let missing = [];
            for (let i = 1; i <= totalQuestions; i++) {
                if (!answeredQuestions.has(i)) {
                    missing.push(i);
                }
            }

            if (missing.length > 0) {
                showWarningModal(missing);
                return;
            }

            // Tampilkan pop-up modal sukses jika semua soal terjawab
            showSuccessModal();
        }

        function showWarningModal(missingArray) {
            const modal = document.getElementById('warningModal');
            const modalContent = modal?.querySelector('[data-warning-content]');
            const msg = document.getElementById('warningModalMessage');

            if (!modal || !msg) return;
            msg.textContent = `Masih ada ${missingArray.length} soal yang belum Anda selesaikan (contoh: soal nomor ${missingArray[0]}). Silakan lengkapi terlebih dahulu atau pilih tetap kirim jika sudah yakin.`;

            modal.classList.remove('hidden');
            modal.style.display = 'grid';
            if (modalContent) {
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }
        }

        function closeWarningModal() {
            const modal = document.getElementById('warningModal');
            const modalContent = modal?.querySelector('[data-warning-content]');

            if (modalContent) {
                modalContent.classList.remove('scale-100');
                modalContent.classList.add('scale-95');
            }
            if (modal) {
                modal.style.display = 'none';
                modal.classList.add('hidden');
            }

            for (let i = 1; i <= totalQuestions; i++) {
                if (!answeredQuestions.has(i)) {
                    scrollToQuestion(i);
                    break;
                }
            }
        }

        function showSuccessModal() {
            const modal = document.getElementById('successModal');
            const modalContent = document.getElementById('successModalContent');

            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        function closeSuccessModal() {
            const modal = document.getElementById('successModal');
            const modalContent = document.getElementById('successModalContent');

            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        function submitAssessmentForm() {
            prepareAllCanvasData();
            document.getElementById('assessmentForm').submit();
        }

        function forceSubmitAssessment() {
            // Konfirmasi sudah ditangani oleh modal kedua dari component.
            prepareAllCanvasData();
            document.getElementById('assessmentForm').submit();
        }

        const canvasCount = {{ $drawingQuestions->count() }};
        const canvasConfigs = {};

        // Setiap soal memiliki garis/bentuk awal yang berbeda sesuai instruksi soal.
        for (let id = 1; id <= canvasCount; id++) {
            canvasConfigs[id] = {
                color: '#1E2D62',
                size: 5,
                history: [],
                step: -1,
                type: id
            };
        }

        function drawSample(id) {
            const canvas = document.getElementById('drawingCanvas' + id);
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            const w = canvas.width;
            const h = canvas.height;
            const cx = w / 2;
            const cy = h / 2;

            ctx.clearRect(0, 0, w, h);
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, w, h);
            ctx.save();
            ctx.strokeStyle = '#3650A2';
            ctx.lineWidth = 5;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            ctx.beginPath();

            switch (id) {
                case 1:
                    // Soal 26: garis lengkung sebagai awal gambar.
                    ctx.moveTo(cx - 85, cy + 15);
                    ctx.quadraticCurveTo(cx - 10, cy - 90, cx + 75, cy + 15);
                    break;
                case 2:
                    // Soal 27: garis lengkung bergelombang untuk dikembangkan menjadi objek.
                    ctx.moveTo(cx - 100, cy);
                    ctx.bezierCurveTo(cx - 65, cy - 75, cx - 25, cy + 75, cx + 10, cy);
                    ctx.bezierCurveTo(cx + 40, cy - 65, cx + 70, cy + 55, cx + 100, cy - 5);
                    break;
                case 3:
                    // Soal 28: bentuk dasar terbuka untuk dilanjutkan.
                    ctx.moveTo(cx - 55, cy + 35);
                    ctx.lineTo(cx, cy - 45);
                    ctx.lineTo(cx + 55, cy + 35);
                    break;
                case 4:
                    // Soal 29: bentuk dasar berupa sudut siku.
                    ctx.moveTo(cx - 55, cy - 45);
                    ctx.lineTo(cx - 55, cy + 45);
                    ctx.lineTo(cx + 45, cy + 45);
                    break;
                default:
                    // Soal 30: garis zig-zag sebagai pemicu gambar imajinatif.
                    ctx.moveTo(cx - 90, cy + 25);
                    ctx.lineTo(cx - 35, cy - 30);
                    ctx.lineTo(cx + 15, cy + 25);
                    ctx.lineTo(cx + 70, cy - 35);
                    break;
            }

            ctx.stroke();
            ctx.restore();
        }

        function initCanvas(id) {
            const canvas = document.getElementById('drawingCanvas' + id);
            const rect = canvas.getBoundingClientRect();
            canvas.width = rect.width;
            canvas.height = rect.height;

            const cfg = canvasConfigs[id];
            if (cfg.step >= 0) {
                let img = new Image();
                img.src = cfg.history[cfg.step];
                img.onload = () => canvas.getContext('2d').drawImage(img, 0, 0);
            } else {
                drawSample(id);
                saveCanvasState(id);
            }

            let isDrawing = false;
            const ctx = canvas.getContext('2d');
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

            const start = (clientX, clientY) => {
                isDrawing = true;
                ctx.beginPath();
                const r = canvas.getBoundingClientRect();
                ctx.moveTo(clientX - r.left, clientY - r.top);
            };

            const move = (clientX, clientY) => {
                if (!isDrawing) return;
                const r = canvas.getBoundingClientRect();
                ctx.strokeStyle = cfg.color;
                ctx.lineWidth = cfg.size;
                ctx.lineTo(clientX - r.left, clientY - r.top);
                ctx.stroke();
            };

            const stop = () => {
                if (isDrawing) {
                    isDrawing = false;
                    saveCanvasState(id);
                    updateProgress(16 + id);
                }
            };

            canvas.onmousedown = (e) => start(e.clientX, e.clientY);
            canvas.onmousemove = (e) => move(e.clientX, e.clientY);
            canvas.onmouseup = stop;
            canvas.onmouseleave = stop;

            canvas.ontouchstart = (e) => { e.preventDefault(); start(e.touches[0].clientX, e.touches[0].clientY); };
            canvas.ontouchmove = (e) => { e.preventDefault(); move(e.touches[0].clientX, e.touches[0].clientY); };
            canvas.ontouchend = stop;
        }

        function saveCanvasState(id) {
            const cfg = canvasConfigs[id];
            const canvas = document.getElementById('drawingCanvas' + id);
            cfg.step++;
            if (cfg.step < cfg.history.length) cfg.history.length = cfg.step;
            cfg.history.push(canvas.toDataURL());
        }

        window.addEventListener('load', () => {
            for (let id = 1; id <= canvasCount; id++) {
                initCanvas(id);
            }
        });

        function setBrushColor(id, color) { canvasConfigs[id].color = color; }
        function setBrushSize(id, size) { canvasConfigs[id].size = parseInt(size); }

        function undoCanvas(id) {
            const cfg = canvasConfigs[id];
            if (cfg.step > 0) {
                cfg.step--;
                let img = new Image();
                img.src = cfg.history[cfg.step];
                img.onload = () => {
                    const canvas = document.getElementById('drawingCanvas' + id);
                    const ctx = canvas.getContext('2d');
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(img, 0, 0);
                }
            }
        }

        function resetCanvas(id) {
            const cfg = canvasConfigs[id];
            cfg.history = [];
            cfg.step = -1;
            drawSample(id);
            saveCanvasState(id);
        }

        function prepareAllCanvasData() {
            for (let id = 1; id <= canvasCount; id++) {
                const canvas = document.getElementById('drawingCanvas' + id);
                const input = document.getElementById('kreativitasImageInput' + id);
                if (canvas && input) input.value = canvas.toDataURL('image/png');
            }
        }

    </script>
</body>
</html>
