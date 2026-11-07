<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Asesmen Siswa - MyUniv</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #F4F7FE; }
        .glass-card { background: rgba(255,255,255,.94); border: 1px solid #E5EAF6; box-shadow: 0 12px 30px rgba(30,45,98,.06); }
    </style>
</head>
<body class="min-h-screen text-gray-800 antialiased">
    <x-counselor.sidebar active="assessment-results" />
    <div class="min-h-screen min-w-0 flex flex-col md:ml-72">
        <x-counselor.topbar title="Hasil Asesmen Siswa" subtitle="Pemantauan penyelesaian asesmen seluruh siswa MyUniv" />

        <main class="w-full max-w-7xl mx-auto flex-1 space-y-6 p-5 sm:p-7 lg:p-10">
            <section class="rounded-3xl bg-gradient-to-br from-[#2B4185] to-[#141F43] p-6 sm:p-8 text-white shadow-xl">
                <p class="text-xs font-bold uppercase tracking-widest text-indigo-200">Data Asesmen</p>
                <h1 class="mt-2 text-2xl sm:text-3xl font-black">Pantau Perkembangan Siswa</h1>
                <p class="mt-2 max-w-2xl text-sm leading-relaxed text-indigo-100">
                    Lihat status Minat Bakat, Kemampuan, dan Kepribadian dari seluruh siswa yang terdaftar di MyUniv.
                </p>
                <div class="mt-5 inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2 text-sm font-bold">
                    <span class="text-xl">{{ $totalStudents }}</span>
                    <span class="text-indigo-100">siswa ditemukan</span>
                </div>
            </section>

            <section class="glass-card rounded-2xl p-4 sm:p-5">
                <form method="GET" action="{{ route('counselor.assessment-results.index') }}" class="grid grid-cols-1 gap-3 md:grid-cols-[1fr_240px_auto_auto]">
                    <input type="text" name="search" value="{{ $search }}"
                           placeholder="Cari nama, email, NISN, atau kelas..."
                           class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-indigo-400 focus:ring-4 focus:ring-indigo-100">
                    <select name="class" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm outline-none focus:border-indigo-400">
                        <option value="">Semua Kelas</option>
                        @foreach($classes as $class)
                            <option value="{{ $class }}" @selected($selectedClass === $class)>{{ $class }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="rounded-xl bg-[#3650A2] px-5 py-3 text-sm font-bold text-white hover:bg-[#293F86]">Terapkan</button>
                    <a href="{{ route('counselor.assessment-results.index') }}" class="rounded-xl border border-gray-200 bg-white px-5 py-3 text-center text-sm font-bold text-gray-600 hover:bg-gray-50">Reset</a>
                </form>
            </section>

            <section class="glass-card overflow-hidden rounded-2xl">
                <div class="flex flex-col gap-1 border-b border-gray-100 px-5 py-4 sm:px-6">
                    <h2 class="font-extrabold text-gray-900">Daftar Siswa</h2>
                    <p class="text-xs text-gray-500">Status ditentukan dari keberadaan data pengumpulan pada assessment_submissions.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[900px] text-left text-sm">
                        <thead class="bg-indigo-50/70 text-[11px] uppercase tracking-wider text-indigo-700">
                            <tr>
                                <th class="px-5 py-4">Siswa</th>
                                <th class="px-5 py-4">Kelas</th>
                                <th class="px-4 py-4">Minat Bakat</th>
                                <th class="px-4 py-4">Kemampuan</th>
                                <th class="px-4 py-4">Kepribadian</th>
                                <th class="px-5 py-4 text-right">Detail</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($students as $student)
                                <tr class="hover:bg-indigo-50/30">
                                    <td class="px-5 py-4">
                                        <div class="font-bold text-gray-900">{{ $student->user->name }}</div>
                                        <div class="mt-0.5 text-xs text-gray-500">{{ $student->nisn ?: 'NISN belum tersedia' }}</div>
                                    </td>
                                    <td class="px-5 py-4 text-gray-600">{{ $student->class ?: 'Belum diatur' }}</td>
                                    @foreach(['minat_bakat', 'kemampuan', 'kepribadian'] as $type)
                                        <td class="px-4 py-4">
                                            @if($student->assessment_status[$type]['completed'])
                                                <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">Selesai</span>
                                                <div class="mt-1 text-[10px] text-gray-400">
                                                    {{ $student->assessment_status[$type]['submitted_at'] ? \Carbon\Carbon::parse($student->assessment_status[$type]['submitted_at'])->format('d M Y, H:i') : 'Waktu tidak tersedia' }}
                                                </div>
                                            @else
                                                <span class="inline-flex rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700">Belum dikerjakan</span>
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('counselor.assessment-results.show', $student->id) }}"
                                           class="inline-flex items-center rounded-xl bg-indigo-50 px-4 py-2 text-xs font-bold text-[#3650A2] hover:bg-indigo-100">
                                            Lihat Jawaban
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="px-6 py-12 text-center text-sm font-semibold text-gray-400">Tidak ada siswa yang sesuai dengan pencarian.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($students->hasPages())
                    <div class="border-t border-gray-100 px-5 py-4">{{ $students->links() }}</div>
                @endif
            </section>
        </main>
    </div>
</body>
</html>
