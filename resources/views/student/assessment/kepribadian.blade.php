
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tes Kepribadian Karier - MyUniv</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #F4F7FE;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .bg-gradient-strong {
            background: linear-gradient(135deg, #2B4185 0%, #141F43 100%);
        }

        .card-shadow {
            box-shadow: 0 10px 30px -5px rgba(54, 80, 162, 0.08);
        }

        .option-card {
            transition: all .25s ease-in-out;
        }

        input[type="radio"]:checked + .option-card {
            background-color: #F0F5FF;
            border-color: #3650A2;
            box-shadow: 0 4px 12px rgba(54, 80, 162, .12);
        }

        input[type="radio"]:checked + .option-card .radio-dot {
            background-color: #3650A2;
            border-color: #3650A2;
            box-shadow: inset 0 0 0 3px #fff;
        }

        input[type="radio"]:focus-visible + .option-card {
            outline: 3px solid rgba(54, 80, 162, .35);
            outline-offset: 2px;
        }
    </style>
</head>

<body class="bg-[#F4F7FE] text-gray-800 antialiased">

    {{-- Backdrop dikelola oleh komponen sidebar reusable. --}}

    {{-- Sidebar siswa --}}
    <x-student.student-sidebar active="assessment" />

    {{-- Topbar siswa --}}
    <x-student.student-topbar
        title="Tes Kepribadian Karier"
        :user="$user ?? auth()->user()"
    />

    {{-- Konten utama --}}
    <div class="md:ml-72 min-h-screen pt-24">
        <main class="mx-auto w-full max-w-6xl space-y-8 p-4 sm:p-6 md:p-10">

            {{-- Banner --}}
            <x-student.banner
                eyebrow="Tes Kepribadian Karier"
                title="Kenali Potensi & Karakter Dirimu 🎯"
                description="Kenali potensi unik dan karakter dirimu secara mendalam. Jawablah setiap pernyataan dengan jujur dan santai—tidak ada jawaban benar atau salah!"
            />

            {{-- Data pertanyaan --}}
            @php
                $displayQuestions = $questions ?? collect([
                    (object) [
                        'id' => 1,
                        'question_text' => 'Saya merasa sangat antusias ketika harus memimpin sebuah kelompok atau proyek kerja tim.'
                    ],
                    (object) [
                        'id' => 2,
                        'question_text' => 'Saya lebih menyukai pekerjaan yang berkaitan dengan analisis data, angka, dan pemecahan masalah logis.'
                    ],
                    (object) [
                        'id' => 3,
                        'question_text' => 'Saya senang mendengarkan dan membantu orang lain yang sedang menghadapi masalah pribadi atau sosial.'
                    ],
                    (object) [
                        'id' => 4,
                        'question_text' => 'Saya memiliki ketertarikan tinggi pada seni, desain visual, kreativitas, atau produksi media.'
                    ],
                    (object) [
                        'id' => 5,
                        'question_text' => 'Saya menyukai rutinitas kerja yang terstruktur, rapi, teliti, dan memiliki aturan operasional yang jelas.'
                    ],
                ]);
            @endphp

            {{-- Pesan validasi --}}
            @if ($errors->any())
                <div
                    class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700"
                    role="alert">

                    <p class="font-bold">Periksa kembali jawabanmu.</p>

                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form asesmen --}}
            <form
                action="{{ route('student.assessment.kepribadian.store') }}"
                method="POST"
                id="personalityAssessmentForm"
                novalidate
                class="space-y-6">
@csrf

                {{-- Daftar pertanyaan dan pilihan jawaban --}}
                @forelse ($displayQuestions as $question)
                    @php
                        $qid = is_object($question)
                            ? $question->id
                            : $question['id'];

                        $qtext = is_object($question)
                            ? $question->question_text
                            : $question['question_text'];

                        $oldResponse = old("responses.$qid");
                    @endphp

                    <section class="card-shadow rounded-2xl border border-slate-200 bg-white p-5 sm:p-6">

                        {{-- Teks pertanyaan --}}
                        <p class="mb-5 font-semibold leading-relaxed text-gray-800">
                            <span class="mr-1 font-bold text-[#3650A2]">
                                {{ $loop->iteration }}.
                            </span>
                            {{ $qtext }}
                        </p>

                        {{-- Tiga pilihan jawaban --}}
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">

                            {{-- Tidak Sesuai --}}
                            <label class="cursor-pointer">
                                <input
                                    type="radio"
                                    name="responses[{{ $qid }}]"
                                    value="tidak_sesuai"
                                    class="sr-only"
                                    @checked($oldResponse === 'tidak_sesuai')
                                    required>

                                <div class="option-card flex h-full items-center gap-3 rounded-xl border border-slate-200 p-4">
                                    <span class="radio-dot h-5 w-5 shrink-0 rounded-full border-2 border-slate-300"></span>

                                    <span class="text-sm font-medium">
                                        Tidak Sesuai
                                    </span>
                                </div>
                            </label>

                            {{-- Netral --}}
                            <label class="cursor-pointer">
                                <input
                                    type="radio"
                                    name="responses[{{ $qid }}]"
                                    value="netral"
                                    class="sr-only"
                                    @checked($oldResponse === 'netral')
                                    required>

                                <div class="option-card flex h-full items-center gap-3 rounded-xl border border-slate-200 p-4">
                                    <span class="radio-dot h-5 w-5 shrink-0 rounded-full border-2 border-slate-300"></span>

                                    <span class="text-sm font-medium">
                                        Netral
                                    </span>
                                </div>
                            </label>

                            {{-- Sesuai --}}
                            <label class="cursor-pointer">
                                <input
                                    type="radio"
                                    name="responses[{{ $qid }}]"
                                    value="sesuai"
                                    class="sr-only"
                                    @checked($oldResponse === 'sesuai')
                                    required>

                                <div class="option-card flex h-full items-center gap-3 rounded-xl border border-slate-200 p-4">
                                    <span class="radio-dot h-5 w-5 shrink-0 rounded-full border-2 border-slate-300"></span>

                                    <span class="text-sm font-medium">
                                        Sesuai
                                    </span>
                                </div>
                            </label>

                        </div>
                    </section>

                @empty
                    <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-800">
                        Belum ada pertanyaan yang tersedia. Silakan hubungi administrator.
                    </div>
                @endforelse

                {{-- Tombol navigasi dan aksi --}}
                <div class="flex flex-col gap-4 border-t border-slate-200 pt-6 pb-12 sm:flex-row sm:items-center sm:justify-between">

                    {{-- Kembali ke tes kemampuan --}}
                    <x-button
                        :href="route('student.assessment.kemampuan')"
                        variant="outline"
                        size="lg">

                        <span aria-hidden="true">&larr;</span>
                        Kembali ke Kemampuan
                    </x-button>

                    <div class="flex flex-col gap-3 sm:flex-row">

                        {{-- Lihat hasil asesmen --}}
                        <x-button
                            :href="url('/student/assessment/result')"
                            variant="outline"
                            size="lg">

                            Lihat Hasil Asesmen
                            <span aria-hidden="true">&rarr;</span>
                        </x-button>

                        {{-- Simpan dan selesaikan asesmen --}}
                        <x-button
                            type="submit"
                            variant="coral-gradient"
                            size="lg">

                            Simpan &amp; Selesaikan Asesmen
                            <span aria-hidden="true">&rarr;</span>
                        </x-button>

                    </div>
                </div>

            </form>

        </main>
    </div>

    {{-- Toggle sidebar ditangani oleh komponen student-sidebar. --}}

    <div
        id="assessmentToast"
        class="fixed top-5 right-5 z-[100] w-[calc(100%-2rem)] max-w-sm
            translate-x-8 opacity-0 pointer-events-none
            transition-all duration-300 ease-out"
        role="alert"
        aria-live="assertive"
    >
        <div class="flex items-start gap-3 rounded-2xl border border-orange-200
                    bg-white p-4 shadow-xl shadow-slate-900/10">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center
                        rounded-xl bg-orange-100 text-orange-600">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" class="h-5 w-5">
                    <path d="M12 9v4m0 4h.01M10.3 3.9 1.8 18a2 2 0 0 0
                            1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"
                        stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="min-w-0 flex-1">
                <p class="text-sm font-extrabold text-slate-800">
                    Jawaban belum lengkap
                </p>
                <p id="assessmentToastMessage"
                class="mt-1 text-xs leading-relaxed text-slate-500">
                    Silakan pilih jawaban untuk semua pertanyaan.
                </p>
            </div>

            <button type="button" id="assessmentToastClose"
                    class="text-slate-400 hover:text-slate-700"
                    aria-label="Tutup notifikasi">
                &times;
            </button>
        </div>
    </div>



    {{-- Modal peringatan reusable MyUniv --}}
    <x-student.assessment-warning-modal
        modal-id="personalityAssessmentWarning"
        message-id="personalityAssessmentWarningMessage"
        title="Peringatan: Belum Selesai!"
        initial-message="Masih ada pertanyaan yang belum kamu jawab. Silakan lengkapi terlebih dahulu."
        close-action="closePersonalityAssessmentWarning"
        continue-action="forceSubmitPersonalityAssessment"
        cancel-text="Periksa Kembali"
        confirm-text="Tetap Kirim"
    />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('personalityAssessmentForm');
            const modal = document.getElementById('personalityAssessmentWarning');
            const message = document.getElementById('personalityAssessmentWarningMessage');

            if (!form || !modal || !message) return;

            window.closePersonalityAssessmentWarning = function () {
                const content = modal.querySelector('[data-warning-content]');

                if (content) {
                    content.classList.remove('scale-100');
                    content.classList.add('scale-95');
                }

                setTimeout(function () {
                    modal.classList.add('hidden');
                    modal.style.display = 'none';
                }, 200);
            };

            window.forceSubmitPersonalityAssessment = function () {
                HTMLFormElement.prototype.submit.call(form);
            };

            form.addEventListener('submit', function (event) {
                const groups = [
                    ...new Set(
                        [...form.querySelectorAll('input[type="radio"][name^="responses["]')]
                            .map(input => input.name)
                    )
                ];

                const missing = groups.filter(function (name) {
                    return !form.querySelector(
                        `input[type="radio"][name="${CSS.escape(name)}"]:checked`
                    );
                });

                if (missing.length === 0) return;

                event.preventDefault();

                message.textContent =
                    `Masih ada ${missing.length} pertanyaan yang belum dijawab. Lengkapi terlebih dahulu atau pilih Tetap Kirim jika ingin melanjutkan.`;

                modal.classList.remove('hidden');
                modal.style.display = 'grid';

                requestAnimationFrame(function () {
                    const content = modal.querySelector('[data-warning-content]');
                    if (content) {
                        content.classList.remove('scale-95');
                        content.classList.add('scale-100');
                    }
                });
            });
        });
    </script>

</body>
</html>
