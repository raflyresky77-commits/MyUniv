<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Asesmen Siswa - MyUniv</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #F4F7FE; }
        .glass-card { background: rgba(255,255,255,.95); border: 1px solid #E5EAF6; box-shadow: 0 12px 30px rgba(30,45,98,.06); }
    </style>
</head>
<body class="min-h-screen text-gray-800 antialiased">
    <x-counselor.sidebar active="assessment-results" />
    <div class="min-h-screen min-w-0 flex flex-col md:ml-72">
        <x-counselor.topbar title="Detail Hasil Asesmen" subtitle="Riwayat pengumpulan asesmen siswa" />

        <main class="w-full max-w-6xl mx-auto flex-1 space-y-6 p-5 sm:p-7 lg:p-10">
            <a href="{{ route('counselor.assessment-results.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#3650A2] hover:underline">
                <span aria-hidden="true">←</span> Kembali ke Daftar Siswa
            </a>

            <section class="rounded-3xl bg-gradient-to-br from-[#2B4185] to-[#141F43] p-6 sm:p-8 text-white shadow-xl">
                <p class="text-xs font-bold uppercase tracking-widest text-indigo-200">Profil Siswa</p>
                <h1 class="mt-2 text-2xl sm:text-3xl font-black">{{ $student->user->name }}</h1>
                <div class="mt-3 flex flex-wrap gap-2 text-xs font-semibold text-indigo-100">
                    <span class="rounded-lg bg-white/10 px-3 py-2">Kelas: {{ $student->class ?: 'Belum diatur' }}</span>
                    <span class="rounded-lg bg-white/10 px-3 py-2">NISN: {{ $student->nisn ?: 'Belum tersedia' }}</span>
                </div>
            </section>

            @php
                $expectedTypes = ['minat_bakat' => 'Minat Bakat', 'kemampuan' => 'Kemampuan', 'kepribadian' => 'Kepribadian'];
                $existingTypes = $submissions->pluck('assessment_type')->all();
            @endphp

            @foreach($expectedTypes as $type => $label)
                @php $submission = $submissions->firstWhere('assessment_type', $type); @endphp
                <section class="glass-card overflow-hidden rounded-2xl">
                    <div class="flex flex-col gap-1 border-b border-gray-100 px-5 py-4 sm:px-6">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h2 class="font-extrabold text-gray-900">{{ $label }}</h2>
                            @if($submission)
                                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">Data terkumpul</span>
                            @else
                                <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700">Belum dikerjakan</span>
                            @endif
                        </div>
                        @if($submission)
                            <p class="text-xs text-gray-500">
                                Dikumpulkan: {{ $submission->submitted_at ? \Carbon\Carbon::parse($submission->submitted_at)->format('d M Y, H:i') : 'Waktu tidak tersedia' }}
                            </p>
                        @endif
                    </div>

                    @if($submission)
                        <div class="space-y-4 p-5 sm:p-6">
                            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                <p class="text-sm text-gray-500">Ringkasan jawaban yang telah dikirim siswa.</p>
                                <p class="text-xs text-gray-400">Untuk tes Kemampuan, status benar/salah hanya ditampilkan jika kunci jawaban tersedia dan tervalidasi.</p>
                            </div>

                            @if(!empty($submission->display_responses))
                                <div class="overflow-hidden rounded-xl border border-gray-100">
                                    <div class="hidden grid-cols-[minmax(0,2fr)_minmax(0,1fr)] gap-4 bg-slate-50 px-4 py-3 text-xs font-bold uppercase tracking-wide text-gray-500 sm:grid">
                                        <span>Pertanyaan</span>
                                        <span>Jawaban siswa</span>
                                    </div>
                                    @php
                                        $allResponses = $submission->display_responses;
                                        $previewResponses = array_slice($allResponses, 0, 5);
                                        $remainingResponses = array_slice($allResponses, 5);
                                    @endphp

                                    <div class="divide-y divide-gray-100">
                                        @foreach($previewResponses as $index => $response)
                                            <div class="grid gap-2 px-4 py-4 sm:grid-cols-[minmax(0,2fr)_minmax(0,1fr)] sm:items-start sm:gap-4">
                                                <div class="min-w-0">
                                                    <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400 sm:hidden">Pertanyaan {{ $index + 1 }}</p>
                                                    <p class="mt-1 text-sm leading-relaxed text-gray-700 sm:mt-0">{{ $response['question'] }}</p>
                                                </div>
                                                <div class="sm:border-l sm:border-gray-100 sm:pl-4">
                                                    <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400 sm:hidden">Jawaban siswa</p>
                                                    <p class="mt-1 inline-flex rounded-lg bg-indigo-50 px-3 py-2 text-sm font-semibold text-[#3650A2] sm:mt-0">{{ $response['answer'] }}</p>
                                                    @if($type === 'kemampuan' && !empty($response['grading_status']))
                                                        @php
                                                            $statusClass = match($response['grading_status']) {
                                                                'Benar' => 'bg-emerald-50 text-emerald-700',
                                                                'Salah' => 'bg-rose-50 text-rose-700',
                                                                'Tidak dijawab' => 'bg-amber-50 text-amber-700',
                                                                default => 'bg-slate-100 text-slate-600',
                                                            };
                                                        @endphp
                                                        <div class="mt-2"><span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $statusClass }}">{{ $response['grading_status'] }}</span></div>
                                                        @if(!empty($response['correct_answer']))
                                                            <p class="mt-2 text-xs text-gray-600"><span class="font-bold">Jawaban benar:</span> {{ $response['correct_answer'] }}</p>
                                                        @endif
                                                        @if(!empty($response['grading_note']))
                                                            <p class="mt-2 text-xs leading-relaxed text-amber-700">{{ $response['grading_note'] }}</p>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if(count($remainingResponses) > 0)
                                        <details class="group border-t border-gray-100">
                                            <summary class="flex cursor-pointer list-none items-center justify-center gap-2 bg-slate-50 px-4 py-4 text-sm font-bold text-[#3650A2] transition hover:bg-indigo-50 [&::-webkit-details-marker]:hidden">
                                                <span>Lihat selengkapnya ({{ count($remainingResponses) }} jawaban lainnya)</span>
                                                <svg class="h-4 w-4 transition-transform group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M5.22 7.22a.75.75 0 0 1 1.06 0L10 10.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 8.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                                </svg>
                                            </summary>
                                            <div class="divide-y divide-gray-100">
                                                @foreach($remainingResponses as $offset => $response)
                                                    @php $index = $offset + 5; @endphp
                                                    <div class="grid gap-2 px-4 py-4 sm:grid-cols-[minmax(0,2fr)_minmax(0,1fr)] sm:items-start sm:gap-4">
                                                        <div class="min-w-0">
                                                            <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400 sm:hidden">Pertanyaan {{ $index + 1 }}</p>
                                                            <p class="mt-1 text-sm leading-relaxed text-gray-700 sm:mt-0">{{ $response['question'] }}</p>
                                                        </div>
                                                        <div class="sm:border-l sm:border-gray-100 sm:pl-4">
                                                            <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400 sm:hidden">Jawaban siswa</p>
                                                            <p class="mt-1 inline-flex rounded-lg bg-indigo-50 px-3 py-2 text-sm font-semibold text-[#3650A2] sm:mt-0">{{ $response['answer'] }}</p>
                                                            @if($type === 'kemampuan' && !empty($response['grading_status']))
                                                                @php
                                                                    $statusClass = match($response['grading_status']) {
                                                                        'Benar' => 'bg-emerald-50 text-emerald-700',
                                                                        'Salah' => 'bg-rose-50 text-rose-700',
                                                                        'Tidak dijawab' => 'bg-amber-50 text-amber-700',
                                                                        default => 'bg-slate-100 text-slate-600',
                                                                    };
                                                                @endphp
                                                                <div class="mt-2"><span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $statusClass }}">{{ $response['grading_status'] }}</span></div>
                                                                @if(!empty($response['correct_answer']))
                                                                    <p class="mt-2 text-xs text-gray-600"><span class="font-bold">Jawaban benar:</span> {{ $response['correct_answer'] }}</p>
                                                                @endif
                                                                @if(!empty($response['grading_note']))
                                                                    <p class="mt-2 text-xs leading-relaxed text-amber-700">{{ $response['grading_note'] }}</p>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </details>
                                    @endif
                                </div>
                            @else
                                <div class="rounded-xl border border-dashed border-gray-200 bg-gray-50 px-5 py-8 text-center">
                                    <p class="text-sm font-semibold text-gray-600">Belum ada jawaban yang dapat ditampilkan.</p>
                                    <p class="mt-1 text-xs text-gray-400">Data pengumpulan tersedia, tetapi format jawabannya belum dikenali.</p>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="p-6 text-sm text-gray-400">Belum ada pengumpulan untuk asesmen ini.</div>
                    @endif
                </section>
            @endforeach
        </main>
    </div>
</body>
</html>
