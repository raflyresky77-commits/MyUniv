<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Minat Bakat - MyUniv</title>
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
        /* Custom Styling untuk Radio Button Interaktif */
        .option-input:checked + .option-label {
            background-color: #EEF3FF;
            border-color: #3650A2;
            color: #3650A2;
            box-shadow: 0 4px 12px rgba(54, 80, 162, 0.15);
            transform: translateY(-1px);
        }

        /* Tampilan tabel lebih ringkas di layar HP: pernyataan penuh di atas, opsi sejajar di bawah. */
        @media (max-width: 640px) {
            .questionnaire-table { table-layout: fixed; width: 100%; }
            .questionnaire-table thead { display: none; }
            .questionnaire-table,
            .questionnaire-table tbody { display: block; width: 100%; }
            .questionnaire-table tbody tr {
                display: flex;
                flex-wrap: wrap;
                width: 100%;
                border-bottom: 1px solid #E5E7EB;
                padding: 4px 0 10px;
            }
            .questionnaire-table tbody tr:last-child { border-bottom: 0; }
            .questionnaire-table tbody td { box-sizing: border-box; }
            .questionnaire-table tbody td:first-child {
                display: block;
                width: 100%;
                padding: 12px 16px 8px;
                font-size: 13px;
                line-height: 1.55;
                overflow-wrap: anywhere;
            }
            .questionnaire-table tbody td:not(:first-child) {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                width: 33.3333%;
                padding: 5px 3px 4px;
            }
            .questionnaire-table tbody td:not(:first-child)::before {
                content: attr(data-label);
                display: block;
                min-height: 26px;
                margin-bottom: 5px;
                color: #64748B;
                font-size: 9px;
                font-weight: 700;
                line-height: 1.25;
                text-align: center;
                overflow-wrap: anywhere;
            }
            .questionnaire-table .option-label {
                width: 36px;
                height: 36px;
                border-radius: 10px;
            }
        }
    </style>
</head>
<body class="bg-[#F4F7FE] text-gray-800 antialiased">

    {{-- Sidebar reusable component: backdrop dan kontrol mobile dikelola komponen --}}
    <x-student.student-sidebar active="assessment" />

    {{-- Topbar reusable component --}}
    <x-student.student-topbar title="Tes Minat Bakat" subtitle="Asesmen" />

    <!-- Main Content Area -->
    <div class="md:ml-72 pt-28 min-h-screen flex flex-col">
        <main class="p-6 md:p-10 space-y-8 max-w-6xl w-full mx-auto flex-1">

            <!-- Title & Top Banner Box -->
            <div class="space-y-6">
                <!-- Judul Utama -->
                <div class="text-center space-y-2">
                    <span class="inline-block px-4 py-1 rounded-full bg-indigo-50 text-[#3650A2] text-xs font-extrabold tracking-wider uppercase border border-indigo-100">Tahap 1 dari 3 Asesmen</span>
                    <h1 class="text-2xl sm:text-4xl font-black text-[#3650A2] tracking-tight">Tes Minat Bakat</h1>
                </div>

                <!-- Banner Gambar -->
                <x-student.assessment-panel variant="glass" class="rounded-[32px] p-4 sm:p-6 flex flex-col items-center justify-center relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-indigo-200/30 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="absolute -left-10 -top-10 w-48 h-48 bg-orange-200/20 rounded-full blur-2xl pointer-events-none"></div>

                    <div class="w-full h-56 sm:h-72 rounded-[24px] overflow-hidden relative shadow-sm group">
                        <!-- Ganti asset('images/banner-minat-bakat.png') dengan path file gambar kamu di folder public -->
                        <img src="{{ asset('images/banner-minat.bakat.png') }}" alt="Kenali Potensi & Bidang Impianmu" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        <!-- Overlay Gradient & Text -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent flex items-end p-6 sm:p-8">
                            <div class="text-white space-y-1">
                                <h3 class="text-base sm:text-xl font-extrabold">Kenali Potensi & Bidang Impianmu</h3>
                                <p class="text-xs sm:text-sm text-gray-200 leading-relaxed">Pilihlah skala penilaian yang paling mencerminkan tingkat kesukaanmu secara jujur.</p>
                            </div>
                        </div>
                    </div>
                </x-student.assessment-panel>
            </div>

            <!-- Bagian Instruksi Cantik -->
            <x-student.assessment-panel variant="instruction" class="rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center shrink-0 border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF7A59]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-xs font-black uppercase tracking-widest text-[#FF7A59]">Instruksi Pengisian</h2>
                        <p class="text-xs sm:text-sm font-medium text-indigo-100 mt-0.5">Berikan penilaian dari Sangat Tidak Suka hingga Sangat Suka pada setiap pernyataan berikut.</p>
                    </div>
                </div>
                <div class="px-4 py-2 bg-white/10 backdrop-blur-md rounded-xl border border-white/15 text-[11px] font-bold text-white shrink-0">
                    Wajib Diisi Semua
                </div>
            </x-student.assessment-panel>

            <!-- Tabel Kuesioner Pernyataan Interaktif -->
            <form action="{{ route('student.assessment.minat-bakat.store') }}" method="POST" id="interestAssessmentForm" novalidate class="space-y-6">
                @csrf
                <x-student.assessment-panel variant="questionnaire" class="rounded-[28px] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="questionnaire-table w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-indigo-50/70 text-[#3650A2] text-xs font-black uppercase tracking-wider border-b border-indigo-100">
                                <th class="py-4 px-6 w-3/5">
                                    Pernyataan Aktivitas / Pekerjaan
                                </th>
                                <th class="py-4 px-3 text-center">Sangat Tidak Suka</th>
                                <th class="py-4 px-3 text-center">Tidak Suka</th>
                                <th class="py-4 px-3 text-center">Netral</th>
                                <th class="py-4 px-3 text-center">Suka</th>
                                <th class="py-4 px-3 text-center">Sangat Suka</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 text-xs sm:text-sm">
                            @forelse ($questions as $index => $question)
                                <tr class="hover:bg-indigo-50/30 transition duration-150 group">
                                    <td class="py-4 px-6 font-semibold text-gray-700 leading-relaxed">
                                        <span class="text-[#3650A2] font-bold mr-1.5">
                                            {{ $index + 1 }}.
                                        </span>
                                        {{ $question->question_text }}
                                    </td>

                                    @php
                                        $scaleOptions = $question->options
                                            ->sortBy('score')
                                            ->values();
                                    @endphp

                                    @foreach ($scaleOptions as $option)
                                        <x-student.assessment-option
                                            :question-id="$question->id"
                                            :value="$option->score"
                                            :label="$option->option_text"
                                            :required="$loop->first"
                                        />
                                    @endforeach

                                    @if ($scaleOptions->isEmpty())
                                        <td colspan="5" class="py-4 px-6 text-center text-amber-700">
                                            Opsi jawaban belum diatur untuk pertanyaan ini.
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-10 text-center text-gray-500 font-medium">
                                        Belum ada pertanyaan asesmen minat bakat yang diatur oleh Admin di database.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                        </table>
                    </div>

                </x-student.assessment-panel>

                <!-- Tombol Navigasi Bawah -->
                <div class="flex justify-between items-center pt-4">
                    <x-button href="{{ route('student.assessment.index') }}" variant="outline" size="lg" class="!px-6 !py-3.5 !text-xs !font-bold !text-gray-700 !border-gray-300 hover:!bg-gray-100 !shadow-xs">
                        &larr; Kembali
                    </x-button>
                    <x-button type="submit" variant="coral-gradient" size="lg" class="!px-8 !py-3.5 !text-xs !font-extrabold hover:scale-105 !shadow-orange-950/20">
                        <span>Selanjutnya</span> &rarr;
                    </x-button>
                </div>
            </form>
        </main>
    </div>

    <!-- Modal reusable untuk peringatan soal yang belum dijawab -->
    <x-student.assessment-warning-modal
        modal-id="interestAssessmentWarning"
        message-id="interestAssessmentWarningMessage"
        title="Peringatan: Belum Selesai!"
        initial-message="Masih ada pernyataan yang belum Anda jawab. Silakan lengkapi terlebih dahulu atau pilih tetap kirim jika sudah yakin."
        close-action="closeInterestAssessmentWarning"
        continue-action="forceSubmitInterestAssessment"
    />

    <script>
        const interestAssessmentForm = document.getElementById('interestAssessmentForm');
        const interestQuestionGroups = [...new Set(
            [...interestAssessmentForm.querySelectorAll('input[type="radio"][name^="responses["]')].map(input => input.name)
        )];

        interestAssessmentForm.addEventListener('submit', function (event) {
            const missing = interestQuestionGroups.filter(name =>
                !interestAssessmentForm.querySelector(`input[name="${CSS.escape(name)}"]:checked`)
            );

            if (missing.length > 0) {
                event.preventDefault();
                const firstMissingInput = interestAssessmentForm.querySelector(`input[name="${CSS.escape(missing[0])}"]`);
                const firstQuestionRow = firstMissingInput?.closest('tr');
                const questionNumber = firstQuestionRow?.querySelector('td:first-child span')?.textContent?.trim() || '—';
                const message = `Masih ada ${missing.length} pernyataan yang belum dijawab (dimulai dari nomor ${questionNumber.replace('.', '')}). Silakan lengkapi terlebih dahulu atau pilih tetap kirim jika sudah yakin.`;
                document.getElementById('interestAssessmentWarningMessage').textContent = message;
                showInterestAssessmentWarning();
            }
        });

        function showInterestAssessmentWarning() {
            const modal = document.getElementById('interestAssessmentWarning');
            const content = modal.querySelector('[data-warning-content]');
            modal.classList.remove('hidden');
            modal.style.display = 'grid';
            requestAnimationFrame(() => {
                if (content) {
                    content.classList.remove('scale-95');
                    content.classList.add('scale-100');
                }
            });
        }

        function closeInterestAssessmentWarning() {
            const modal = document.getElementById('interestAssessmentWarning');
            const content = modal.querySelector('[data-warning-content]');
            if (content) {
                content.classList.remove('scale-100');
                content.classList.add('scale-95');
            }
            modal.style.display = 'none';
            setTimeout(() => modal.classList.add('hidden'), 200);

            const missing = interestQuestionGroups.find(name =>
                !interestAssessmentForm.querySelector(`input[name="${CSS.escape(name)}"]:checked`)
            );
            if (missing) {
                const input = interestAssessmentForm.querySelector(`input[name="${CSS.escape(missing)}"]`);
                input?.closest('tr')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }

        function forceSubmitInterestAssessment() {
            // Dipanggil setelah pengguna menekan tombol 'Ya, Kirim' pada modal custom.
            HTMLFormElement.prototype.submit.call(interestAssessmentForm);
        }

// Fungsi opsional untuk memberi efek background tipis pada baris tabel yang sudah dipilih
        function highlightRow(radio) {
            const row = radio.closest('tr');
            // Hapus kelas aktif dari semua baris terkait dalam grup atau beri tanda terpenuhi
            row.style.backgroundColor = '#F8FAFC';
        }
    </script>
</body>
</html>
