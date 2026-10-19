
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

</body>
</html>
