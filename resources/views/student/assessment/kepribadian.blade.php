
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

        .option-card:hover {
            border-color: #9CAEDB;
            background-color: #F8FAFF;
        }
    </style>
</head>

<body class="bg-[#F4F7FE] text-gray-800 antialiased">

    @include('components.global-loading')

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
                $displayQuestions = $questions ?? collect();
                $savedResponses = $savedResponses ?? [];
            @endphp

            {{-- Pesan validasi --}}
            @if ($errors->any())
                <div
                    class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700"
                    role="alert"
                >
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
                class="space-y-5"
            >
                @csrf

                {{-- Daftar pertanyaan --}}
                @forelse ($displayQuestions as $question)

                    @php
                        $qid = $question->id;
                        $qtext = $question->question_text;
                        $options = $question->options ?? collect();

                        $oldResponse = old(
                            "responses.$qid",
                            $savedResponses[$qid] ?? null
                        );
                    @endphp

                    {{-- Kartu pertanyaan --}}
                    <section class="card-shadow rounded-2xl border border-slate-200 bg-white p-5 sm:p-6">

                        {{-- Teks pertanyaan --}}
                        <p class="mb-5 font-semibold leading-relaxed text-gray-800">
                            <span class="mr-1 font-bold text-[#3650A2]">
                                {{ $loop->iteration }}.
                            </span>

                            {{ $qtext }}
                        </p>

                        {{-- Pilihan jawaban --}}
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-5">

                            @foreach ($options as $option)

                                <label class="block h-full cursor-pointer">

                                    <input
                                        type="radio"
                                        name="responses[{{ $qid }}]"
                                        value="{{ $option->id }}"
                                        class="sr-only"
                                        @checked((string) $oldResponse === (string) $option->id)
                                        required
                                    >

                                    <div class="option-card flex min-h-[64px] h-full items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3">

                                        {{-- Radio button --}}
                                        <span class="radio-dot h-5 w-5 shrink-0 rounded-full border-2 border-slate-300"></span>

                                        {{-- Teks pilihan --}}
                                        <span class="text-sm font-medium leading-snug text-gray-700">
                                            {{ $option->option_text }}
                                        </span>

                                    </div>

                                </label>

                            @endforeach

                        </div>

                        {{-- Pesan jika opsi kosong --}}
                        @if ($options->isEmpty())
                            <p class="mt-3 text-sm text-red-500">
                                Pilihan jawaban belum tersedia untuk pertanyaan ini.
                            </p>
                        @endif

                    </section>

                @empty

                    <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-800">
                        Belum ada pertanyaan yang tersedia. Silakan hubungi administrator.
                    </div>

                @endforelse

                {{-- Tombol navigasi dan aksi --}}
                <div class="flex flex-col gap-4 border-t border-slate-200 pt-6 pb-12 sm:flex-row sm:items-center sm:justify-between">

                    {{-- Kembali ke halaman asesmen --}}
                    <x-button
                        :href="route('student.assessment.index')"
                        variant="outline"
                        size="lg"
                    >
                        <span aria-hidden="true">&larr;</span>
                        Kembali ke Halaman Asesmen
                    </x-button>

                    {{-- Tombol simpan --}}
                    <div class="flex flex-col gap-3 sm:flex-row">

                        <x-button
                            type="submit"
                            variant="coral-gradient"
                            size="lg"
                        >
                            Simpan Jawaban
                            <span aria-hidden="true">&rarr;</span>
                        </x-button>

                    </div>

                </div>

            </form>

        </main>

    </div>

    {{-- Notifikasi jawaban belum lengkap --}}
    <div
        id="assessmentToast"
        class="fixed top-5 right-5 z-[100] w-[calc(100%-2rem)] max-w-sm translate-x-8 opacity-0 pointer-events-none transition-all duration-300 ease-out"
        role="alert"
        aria-live="assertive"
    >
        <div class="flex items-start gap-3 rounded-2xl border border-orange-200 bg-white p-4 shadow-xl shadow-slate-900/10">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-100 text-orange-600">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    class="h-5 w-5"
                >
                    <path
                        d="M12 9v4m0 4h.01M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>

            </div>

            <div class="min-w-0 flex-1">

                <p class="text-sm font-extrabold text-slate-800">
                    Jawaban belum lengkap
                </p>

                <p
                    id="assessmentToastMessage"
                    class="mt-1 text-xs leading-relaxed text-slate-500"
                >
                    Silakan pilih jawaban untuk semua pertanyaan.
                </p>

            </div>

            <button
                type="button"
                id="assessmentToastClose"
                class="text-slate-400 hover:text-slate-700"
                aria-label="Tutup notifikasi"
            >
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

    {{-- JavaScript validasi --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('personalityAssessmentForm');

            const modal = document.getElementById('personalityAssessmentWarning');

            const message = document.getElementById('personalityAssessmentWarningMessage');

            if (!form || !modal || !message) return;

            // Menutup modal peringatan.
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

            // Tetap kirim jawaban jika pengguna memilih konfirmasi.
            window.forceSubmitPersonalityAssessment = function () {
                HTMLFormElement.prototype.submit.call(form);
            };

            // Validasi kelengkapan jawaban.
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
