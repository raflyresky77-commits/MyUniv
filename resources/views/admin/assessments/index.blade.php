<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Bank Soal - MyUniv</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahan CDN SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #22346E 100%); }
        /* Custom Polygon Card Shape yang unik & lucu */
        .custom-card-shape {
            clip-path: polygon(0 0, calc(100% - 16px) 0, 100% 16px, 100% 100%, 0 100%);
        }
        .custom-badge-shape {
            clip-path: polygon(8px 0%, 100% 0%, calc(100% - 8px) 100%, 0% 100%);
        }
        /* Tambahan Animasi Transisi Hapus ala Univ */
        .deleting-animation {
            transition: all 0.4s ease-in-out !important;
            opacity: 0 !important;
            transform: scale(0.95) !important;
            background-color: #fee2e2 !important;
        }
    </style>
</head>
<body class="bg-[#F8FBFF] text-gray-800 antialiased">

    <!-- Floating Toast Notification (Pop-up Sukses/Error) -->
    @if(session('success'))
    <div id="toastNotification" class="fixed top-6 right-6 z-50 flex items-center gap-3 bg-emerald-600 text-white px-5 py-3.5 rounded-2xl shadow-xl shadow-emerald-900/20 transform transition-all duration-300 translate-y-0 opacity-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
        <span class="text-xs font-bold">{{ session('success') }}</span>
    </div>
    @endif

    {{-- Component navigasi admin dan topbar --}}
    <x-admin-sidebar active="assessments" />

    <x-admin-topbar
        module="Modul Asesmen"
        page-title="Bank Soal & Kuesioner"
        admin-name="Administrator Utama"
        admin-email="admin@myuniv.test"
        initials="AD"
    />

    <!-- Konten Utama -->
    <div class="md:ml-72 pt-28 min-h-screen flex flex-col">
        <main class="px-6 lg:px-10 pb-12 space-y-8 max-w-7xl mx-auto w-full flex-1">

            <!-- Validasi Error -->
            @if($errors->any())
                <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-xs font-bold rounded-2xl shadow-sm">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Component header admin; form tambah tetap berada di halaman ini. --}}
            <x-admin-page-header
                label="Psikometrik & Minat Bakat"
                title="Daftar Paket Asesmen"
                description="Kelola kategori tes, peminatan siswa, dan atur butir pertanyaan dalam satu halaman interaktif."
                button-text="Tambah Paket Asesmen"
                button-onclick="toggleCreateForm()"
            />

            <!-- CARD FORM TAMBAH (Inline Collapse) -->
            <div id="createFormCard" class="bg-white rounded-[24px] border border-[#E2E8F0] shadow-sm p-8 hidden transition-all duration-300">
                <div class="mb-6 flex items-center justify-between border-b border-gray-100 pb-4">
                    <div>
                        <h3 class="text-lg font-black text-[#3650A2] tracking-tight">Konfigurasi Paket & Soal Asesmen Baru</h3>
                        <p class="text-xs text-gray-500 font-medium mt-0.5">Buat paket tes psikometrik baru dan tentukan kategori sub-testnya.</p>
                    </div>
                    <button onclick="toggleCreateForm()" class="text-gray-400 hover:text-gray-600 text-xs font-bold">Tutup &times;</button>
                </div>

                <form action="{{ route('admin.assessments.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Nama Paket Asesmen</label>
                        <input type="text" name="title" required class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-[#3650A2] transition" placeholder="Contoh: Paket Asesmen Komprehensif Kelas XII 2026">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Kategori Utama Tes</label>
                            <select name="category" id="categorySelect" required onchange="toggleSubTests('categorySelect', 'subtestContainer')" class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-[#3650A2] transition">
                                <option value="personality_career">Tes Kepribadian & Karir</option>
                                <option value="learning_style">Tes Gaya Belajar (VARK)</option>
                                <option value="cognitive_ability">Tes Kemampuan / Kognitif</option>
                            </select>
                        </div>
                        <div id="subtestContainer" class="hidden">
                            <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Pilih Sub-Test Kemampuan</label>
                            <select name="subtest_type" class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-[#3650A2] transition">
                                <option value="verbal">1. Verbal Reasoning (Penalaran Verbal)</option>
                                <option value="numerical">2. Numerical Reasoning (Penalaran Numerik)</option>
                                <option value="logical">3. Logical Reasoning (Penalaran Logika)</option>
                                <option value="spatial">4. Spatial Reasoning (Spasial/Abstrak)</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">Deskripsi & Instruksi Pengerjaan</label>
                        <textarea name="description" rows="3" class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:border-[#3650A2] transition" placeholder="Tuliskan petunjuk pengisian soal..."></textarea>
                    </div>
                    <div class="pt-2 flex items-center justify-end gap-3">
                        <button type="button" onclick="toggleCreateForm()" class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl text-xs font-bold hover:bg-gray-200 transition">Batal</button>
                        <button type="submit" class="px-6 py-3 bg-gradient-myuniv text-white rounded-xl text-xs font-bold shadow-lg shadow-indigo-200/60 transition">Simpan Paket &rarr;</button>
                    </div>
                </form>
            </div>

            <!-- Tabel Data Asesmen dengan Kartu Shape & Gradien Oval Estetik -->
            <div class="bg-white rounded-[28px] border border-[#E2E8F0] shadow-sm overflow-hidden relative p-4 sm:p-6 space-y-4">
                <div class="flex flex-col sm:flex-row justify-between gap-4 items-center pb-4 border-b border-gray-100">
                    {{-- Search live seperti halaman Kelola Perguruan Tinggi --}}
                    <div class="bg-white p-3 sm:p-4 rounded-2xl border border-[#E2E8F0] flex flex-col sm:flex-row sm:items-center gap-3 w-full sm:w-auto">
                        {{-- Component input search dengan filter langsung saat mengetik --}}
                        <x-search-input
                            id="assessmentSearchInput"
                            placeholder="Cari nama, kategori, atau deskripsi asesmen..."
                            onkeyup="filterAssessments()"
                            class="w-full sm:w-80"
                        />

                        {{-- Jumlah kartu yang cocok dengan kata pencarian --}}
                        <div id="assessmentSearchCounter" class="text-xs font-bold text-gray-400 sm:px-3 whitespace-nowrap" aria-live="polite">
                            {{ $assessments->count() }} paket ditampilkan
                        </div>
                    </div>
                </div>

                <!-- Grid Kartu Asesmen dengan Gradien Oval di Dalamnya -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($assessments as $assessment)
                    <!-- Ditambahkan id unik untuk target animasi delete -->
                    <div id="assessment-card-{{ $assessment->id }}" class="bg-[#F8FBFF] border border-indigo-100/90 p-5 rounded-2xl custom-card-shape shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between relative overflow-hidden group">

                        <!-- Aksen Gradien Oval di Dalam Kartu -->
                        <div class="absolute -right-10 -bottom-10 w-36 h-36 bg-indigo-500/10 rounded-full blur-2xl pointer-events-none group-hover:bg-indigo-500/20 transition duration-500"></div>
                        <div class="absolute -left-10 -top-10 w-36 h-36 bg-[#FF7A59]/10 rounded-full blur-2xl pointer-events-none group-hover:bg-[#FF7A59]/20 transition duration-500"></div>

                        <!-- Aksen Pojok Lucu -->
                        <div class="absolute top-0 right-0 w-8 h-8 bg-[#FF7A59]/15 rounded-bl-2xl flex items-center justify-center text-[#FF7A59] z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>

                        <div class="space-y-3 relative z-10">
                            <div class="flex items-center gap-2 flex-wrap pr-6">
                                <span class="px-3 py-1 bg-indigo-100/80 text-[#3650A2] font-extrabold rounded-lg text-[10px] custom-badge-shape shadow-xs">
                                    {{ $assessment->category ?? 'Umum' }}
                                </span>
                                @if(!empty($assessment->subtest_type))
                                <span class="px-2.5 py-0.5 bg-orange-100 text-[#FF7A59] font-bold rounded-md text-[10px]">
                                    Sub: {{ ucfirst($assessment->subtest_type) }}
                                </span>
                                @endif
                                <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full font-bold text-[9px]">Aktif</span>
                            </div>

                            <div>
                                <h3 class="font-black text-gray-900 text-base tracking-tight leading-snug">{{ $assessment->title }}</h3>
                                <p class="text-gray-500 text-xs mt-1 line-clamp-2 leading-relaxed">{{ $assessment->description ?? 'Tidak ada deskripsi tambahan untuk paket asesmen ini.' }}</p>
                            </div>
                        </div>

                        <div class="pt-4 mt-4 border-t border-indigo-100/60 flex flex-col sm:flex-row sm:items-center justify-between gap-3 relative z-10">
                            <div class="question-count text-xs font-extrabold text-[#3650A2] flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-[#FF7A59]"></span>
                                {{ $assessment->questions_count ?? 0 }} Butir Soal
                            </div>

                            <div class="flex flex-wrap items-center gap-1.5">
                                <!-- Tombol Kelola Soal -->
                                <button
                                    type="button"
                                    class="manage-questions-btn px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-[11px] shadow-sm transition"
                                    data-id="{{ $assessment->id }}"
                                    data-title="{{ $assessment->title }}"
                                    data-list-url="{{ route('admin.assessments.questions.index', $assessment->id) }}"
                                    data-store-url="{{ route('admin.questions.store', $assessment->id) }}"
                                    data-delete-base="{{ url('/admin/assessments/questions') }}">
                                    Kelola Soal
                                </button>

                                <!-- Tombol Edit -->
                                <button
                                    type="button"
                                    onclick="openEditModal('{{ $assessment->id }}', '{{ addslashes($assessment->title) }}', '{{ $assessment->category }}', '{{ addslashes($assessment->description ?? '') }}', '{{ $assessment->subtest_type ?? '' }}')"
                                    class="px-3 py-1.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold rounded-xl text-[11px] transition shadow-xs">
                                    Edit
                                </button>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.assessments.destroy', $assessment->id) }}" method="POST" onsubmit="handleDeleteAssessment(event, 'assessment-card-{{ $assessment->id }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 font-bold rounded-xl text-[11px] transition cursor-pointer">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 py-12 text-center text-gray-400 font-semibold bg-gray-50 rounded-2xl">
                        Belum ada data paket asesmen yang tersedia.
                    </div>
                    @endforelse
                </div>

                <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                    <div>Menampilkan data asesmen interaktif</div>
                    <div>{{ $assessments->links() }}</div>
                </div>
            </div>

        </main>
    </div>

    <!-- ================= MODAL 1: KELOLA SOAL (POP-UP) ================= -->
    <div id="manageQuestionsModal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-xs flex items-center justify-center hidden p-4">
        <div class="bg-white w-full max-w-3xl rounded-[28px] shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
            <div class="p-6 bg-gradient-myuniv text-white flex justify-between items-center relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-[#FF7A59]/20 rounded-full blur-2xl pointer-events-none"></div>
                <div class="relative z-10">
                    <h3 id="modalAssessmentTitle" class="text-lg font-black tracking-tight">Kelola Butir Soal</h3>
                    <p class="text-xs text-indigo-100 font-medium">Tambahkan atau hapus pertanyaan untuk paket asesmen ini.</p>
                </div>
                <button onclick="closeManageQuestionsModal()" class="text-white/80 hover:text-white text-lg font-bold p-2 relative z-10">&times;</button>
            </div>

            <div class="p-6 overflow-y-auto space-y-6 flex-1 bg-[#F8FBFF]">
                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-xs space-y-4">
                    <h4 class="text-xs font-extrabold text-[#3650A2] uppercase tracking-wider">+ Tambah Pertanyaan Baru</h4>

                    <form id="addQuestionForm" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label for="questionType" class="block text-xs font-bold text-gray-700 mb-1.5">Jenis Pertanyaan</label>
                            <select name="type" id="questionType" required class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#3650A2]">
                                <option value="multiple_choice">Pilihan Ganda</option>
                                <option value="likert">Skala Persetujuan</option>
                                <option value="preference">Skala Kesukaan</option>
                                <option value="image_choice">Pilihan Gambar</option>
                                <option value="visual">Penalaran Visual</option>
                                <option value="drawing">Menggambar</option>
                            </select>
                        </div>

                        <div>
                            <label for="questionText" class="block text-xs font-bold text-gray-700 mb-1.5">Pertanyaan / Instruksi</label>
                            <textarea name="question_text" id="questionText" rows="3" required placeholder="Tuliskan pertanyaan atau instruksi..." class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#3650A2]"></textarea>
                        </div>

                        <div id="questionImageSection" class="hidden">
                            <label for="questionImageUrl" class="block text-xs font-bold text-gray-700 mb-1.5">URL Gambar Soal (opsional)</label>
                            <input type="url" name="image_url" id="questionImageUrl" placeholder="https://..." class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#3650A2]">
                            <p class="mt-1 text-[10px] text-gray-500">Digunakan untuk soal yang membutuhkan gambar. URL disimpan di kolom image_url.</p>
                        </div>

                        <div id="answerOptionsSection" class="space-y-3">
                            <div class="flex justify-between items-center gap-2">
                                <label class="block text-xs font-bold text-gray-700">Opsi Jawaban</label>
                                <button type="button" id="addAnswerOptionBtn" class="text-xs font-bold text-indigo-600 hover:underline">+ Tambah Opsi</button>
                            </div>
                            <div id="answerOptionsList" class="space-y-2">
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="answer-option-row grid grid-cols-1 sm:grid-cols-[1fr_100px_auto] gap-2">
                                        <input type="text" name="options[{{ $i }}][option_text]" maxlength="1000" placeholder="Teks opsi {{ $i + 1 }}" class="answer-option-input min-w-0 px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#3650A2]">
                                        <input type="number" name="options[{{ $i }}][score]" value="0" step="1" placeholder="Skor" class="answer-score-input w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#3650A2]">
                                        <button type="button" class="remove-answer-option text-red-500 text-xs font-bold">Hapus</button>
                                    </div>
                                @endfor
                            </div>
                            <p id="answerOptionsHelp" class="text-[10px] text-gray-500">Isi teks dan skor setiap opsi sesuai aturan asesmen.</p>
                        </div>

                        <div id="fixedScalePreview" class="hidden rounded-xl border border-indigo-100 bg-indigo-50 p-3">
                            <p id="fixedScaleTitle" class="text-xs font-bold text-indigo-800"></p>
                            <p id="fixedScaleDescription" class="mt-1 text-[10px] text-indigo-700"></p>
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit" class="px-5 py-2.5 bg-[#3650A2] text-white text-xs font-bold rounded-xl shadow-md hover:bg-indigo-900 transition">Simpan Soal</button>
                        </div>
                    </form>
                </div>

                <div class="space-y-3">
                    <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">Daftar Pertanyaan Tersimpan</h4>
                    <div id="questionsListContainer" class="space-y-2" aria-live="polite">
                        <div class="p-4 bg-white border border-gray-200 rounded-xl text-xs text-gray-500">
                            Pilih paket asesmen untuk memuat daftar soal.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit soal -->
    <div id="editQuestionModal" class="fixed inset-0 z-[60] bg-black/50 backdrop-blur-xs flex items-center justify-center hidden p-4">
        <div class="bg-white w-full max-w-2xl rounded-[24px] shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
            <div class="p-5 bg-gradient-myuniv text-white flex items-center justify-between">
                <div>
                    <h3 class="text-base font-black">Edit Soal</h3>
                    <p class="text-xs text-indigo-100">Perbarui pertanyaan, tipe, dan opsi jawaban.</p>
                </div>
                <button type="button" onclick="closeEditQuestionModal()" class="text-white text-xl font-bold">&times;</button>
            </div>
            <form id="editQuestionForm" class="p-5 space-y-4 overflow-y-auto">
                @csrf
                @method('PUT')
                <div>
                    <label for="editQuestionType" class="block text-xs font-bold text-gray-700 mb-1.5">Jenis Pertanyaan</label>
                    <select name="type" id="editQuestionType" required class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs">
                        <option value="multiple_choice">Pilihan Ganda</option>
                        <option value="likert">Skala Persetujuan</option>
                        <option value="preference">Skala Kesukaan</option>
                        <option value="image_choice">Pilihan Gambar</option>
                        <option value="visual">Penalaran Visual</option>
                        <option value="drawing">Menggambar</option>
                    </select>
                </div>
                <div>
                    <label for="editQuestionText" class="block text-xs font-bold text-gray-700 mb-1.5">Pertanyaan / Instruksi</label>
                    <textarea name="question_text" id="editQuestionText" rows="3" required class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs"></textarea>
                </div>
                <div id="editQuestionImageSection" class="hidden">
                    <label for="editQuestionImageUrl" class="block text-xs font-bold text-gray-700 mb-1.5">URL Gambar Soal (opsional)</label>
                    <input type="url" name="image_url" id="editQuestionImageUrl" placeholder="https://..." class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs">
                </div>
                <div id="editAnswerOptionsSection" class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label class="block text-xs font-bold text-gray-700">Opsi Jawaban</label>
                        <button type="button" id="editAddAnswerOptionBtn" class="text-xs font-bold text-indigo-600 hover:underline">+ Tambah Opsi</button>
                    </div>
                    <div id="editAnswerOptionsList" class="space-y-2"></div>
                    <p class="text-[10px] text-gray-500">Ubah teks atau skor opsi sesuai kebutuhan. Untuk tipe tanpa opsi, bagian ini akan disembunyikan.</p>
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeEditQuestionModal()" class="px-4 py-2.5 bg-gray-100 text-gray-600 text-xs font-bold rounded-xl">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-[#3650A2] text-white text-xs font-bold rounded-xl">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal edit memakai wrapper component; field khusus asesmen tetap di halaman ini. -->
    <x-edit-modal
        id="editModal"
        title="Edit Paket Asesmen"
        form-id="editForm"
        close-function="closeEditModal()"
    >
        <div>
            <label class="mb-1.5 block text-xs font-extrabold uppercase tracking-wider text-gray-700">Nama Paket Asesmen</label>
            <input type="text" id="editTitle" name="title" required class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm font-medium focus:border-[#3650A2] focus:outline-none">
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="mb-1.5 block text-xs font-extrabold uppercase tracking-wider text-gray-700">Kategori Utama</label>
                <select name="category" id="editCategory" required onchange="toggleSubTests('editCategory', 'editSubtestContainer')" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm font-medium focus:border-[#3650A2] focus:outline-none">
                    <option value="personality_career">Tes Kepribadian & Karir</option>
                    <option value="learning_style">Tes Gaya Belajar (VARK)</option>
                    <option value="cognitive_ability">Tes Kemampuan / Kognitif</option>
                </select>
            </div>
            <div id="editSubtestContainer" class="hidden">
                <label class="mb-1.5 block text-xs font-extrabold uppercase tracking-wider text-gray-700">Sub-Test Kemampuan</label>
                <select name="subtest_type" id="editSubtestType" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm font-medium focus:border-[#3650A2] focus:outline-none">
                    <option value="verbal">1. Verbal Reasoning</option>
                    <option value="numerical">2. Numerical Reasoning</option>
                    <option value="logical">3. Logical Reasoning</option>
                    <option value="spatial">4. Spatial Reasoning</option>
                </select>
            </div>
        </div>

        <div>
            <label class="mb-1.5 block text-xs font-extrabold uppercase tracking-wider text-gray-700">Deskripsi</label>
            <textarea name="description" id="editDescription" rows="3" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm font-medium focus:border-[#3650A2] focus:outline-none"></textarea>
        </div>

        <div class="flex justify-end gap-2 pt-3">
            <button type="button" onclick="closeEditModal()" class="rounded-xl bg-gray-100 px-5 py-2.5 text-xs font-bold text-gray-600 transition hover:bg-gray-200">Batal</button>
            <button type="submit" class="rounded-xl bg-[#3650A2] px-5 py-2.5 text-xs font-bold text-white shadow-md transition hover:bg-[#22346E]">Simpan Perubahan</button>
        </div>
    </x-edit-modal>

    <!-- Component konfirmasi hapus asesmen (dipanggil satu kali) -->
    <x-confirm-delete
        function-name="handleDeleteAssessment"
        title="Hapus Paket Asesmen Ini?"
        text="Semua data butir soal di dalam paket asesmen ini akan ikut terhapus permanen!"
        confirm-text="Ya, Hapus Asesmen!"
    />


    <!-- Script JavaScript Kontrol Pop-up -->
    <script>
        function toggleCreateForm() {
            const formCard = document.getElementById('createFormCard');
            if (!formCard) return;
            formCard.classList.toggle('hidden');
            if (!formCard.classList.contains('hidden')) formCard.scrollIntoView({ behavior: 'smooth' });
        }

        function toggleSubTests(selectId, containerId) {
            const select = document.getElementById(selectId);
            const container = document.getElementById(containerId);
            if (select && container) container.classList.toggle('hidden', select.value !== 'cognitive_ability');
        }

        setTimeout(() => {
            const toast = document.getElementById('toastNotification');
            if (toast) {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }
        }, 4000);

        function closeToast() {
            const toast = document.getElementById('toastNotification');
            if (toast) toast.remove();
        }

        let currentAssessmentId = null;
        let currentListUrl = null;
        let currentStoreUrl = null;
        let currentDeleteBase = null;
        let currentUpdateBase = null;

        const manageModal = document.getElementById('manageQuestionsModal');
        const questionForm = document.getElementById('addQuestionForm');
        const answerOptionsList = document.getElementById('answerOptionsList');
        const addAnswerOptionBtn = document.getElementById('addAnswerOptionBtn');
        const questionTypeSelect = document.getElementById('questionType');
        const answerOptionsSection = document.getElementById('answerOptionsSection');
        const questionImageSection = document.getElementById('questionImageSection');
        const fixedScalePreview = document.getElementById('fixedScalePreview');
        const fixedScaleTitle = document.getElementById('fixedScaleTitle');
        const fixedScaleDescription = document.getElementById('fixedScaleDescription');
        const answerOptionsHelp = document.getElementById('answerOptionsHelp');
        const questionsContainer = document.getElementById('questionsListContainer');

        const fixedScales = {
            likert: {
                title: 'Skala Persetujuan',
                description: 'Sangat Tidak Setuju (1), Tidak Setuju (2), Netral (3), Setuju (4), Sangat Setuju (5). Opsi akan dibuat otomatis oleh controller.'
            },
            preference: {
                title: 'Skala Kesukaan',
                description: 'Sangat Tidak Suka (1), Tidak Suka (2), Netral (3), Suka (4), Sangat Suka (5). Opsi akan dibuat otomatis oleh controller.'
            }
        };

        function updateAnswerOptionLabels() {
            if (!answerOptionsList) return;
            const rows = answerOptionsList.querySelectorAll('.answer-option-row');
            rows.forEach((row, index) => {
                const input = row.querySelector('.answer-option-input');
                const score = row.querySelector('.answer-score-input');
                const removeButton = row.querySelector('.remove-answer-option');
                if (input) {
                    input.name = `options[${index}][option_text]`;
                    input.placeholder = `Teks opsi ${index + 1}`;
                    input.required = !input.disabled;
                }
                if (score) score.name = `options[${index}][score]`;
                if (removeButton) removeButton.classList.toggle('hidden', rows.length <= 2);
            });
        }

        function updateQuestionTypeForm() {
            if (!questionTypeSelect) return;
            const type = questionTypeSelect.value;
            const usesFixedScale = ['likert', 'preference'].includes(type);
            const usesOptions = ['multiple_choice', 'image_choice', 'visual'].includes(type);
            const needsImageField = ['image_choice', 'visual', 'drawing'].includes(type);

            answerOptionsSection?.classList.toggle('hidden', !usesOptions);
            fixedScalePreview?.classList.toggle('hidden', !usesFixedScale);
            questionImageSection?.classList.toggle('hidden', !needsImageField);

            if (usesFixedScale) {
                fixedScaleTitle.textContent = fixedScales[type].title;
                fixedScaleDescription.textContent = fixedScales[type].description;
            }

            if (answerOptionsList) {
                answerOptionsList.querySelectorAll('input').forEach(input => {
                    input.disabled = !usesOptions;
                    input.required = usesOptions && input.classList.contains('answer-option-input');
                });
            }

            if (answerOptionsHelp) {
                answerOptionsHelp.textContent = type === 'image_choice'
                    ? 'Masukkan label tiap opsi dan skor yang sesuai. Kolom question_options tidak memiliki kolom gambar khusus.'
                    : type === 'visual'
                        ? 'Masukkan opsi jawaban penalaran visual beserta skor masing-masing.'
                        : 'Isi teks dan skor tiap opsi. Untuk kunci benar/salah, gunakan skor sesuai aturan penilaian.';
            }
            updateAnswerOptionLabels();
        }

        questionTypeSelect?.addEventListener('change', updateQuestionTypeForm);

        addAnswerOptionBtn?.addEventListener('click', function () {
            const rows = answerOptionsList.querySelectorAll('.answer-option-row');
            if (rows.length >= 10) {
                Swal.fire({ icon: 'info', title: 'Batas opsi tercapai', text: 'Maksimal 10 opsi jawaban per pertanyaan.' });
                return;
            }

            const row = document.createElement('div');
            row.className = 'answer-option-row grid grid-cols-1 sm:grid-cols-[1fr_100px_auto] gap-2';
            row.innerHTML = `
                <input type="text" maxlength="1000" placeholder="Teks opsi" class="answer-option-input min-w-0 px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#3650A2]">
                <input type="number" value="0" step="1" placeholder="Skor" class="answer-score-input w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#3650A2]">
                <button type="button" class="remove-answer-option text-red-500 text-xs font-bold">Hapus</button>
            `;
            answerOptionsList.appendChild(row);
            updateAnswerOptionLabels();
            row.querySelector('input')?.focus();
        });

        answerOptionsList?.addEventListener('click', function (event) {
            const button = event.target.closest('.remove-answer-option');
            if (!button || button.classList.contains('hidden')) return;
            const rows = answerOptionsList.querySelectorAll('.answer-option-row');
            if (rows.length <= 2) return;
            button.closest('.answer-option-row').remove();
            updateAnswerOptionLabels();
        });

        updateQuestionTypeForm();

        document.querySelectorAll('.manage-questions-btn').forEach(button => {
            button.addEventListener('click', async function () {
                currentAssessmentId = this.dataset.id;
                currentListUrl = this.dataset.listUrl;
                currentStoreUrl = this.dataset.storeUrl;
                currentDeleteBase = this.dataset.deleteBase;
                currentUpdateBase = this.dataset.deleteBase;
                document.getElementById('modalAssessmentTitle').textContent = 'Kelola Soal: ' + this.dataset.title;
                questionForm.action = currentStoreUrl;
                questionForm.reset();
                updateQuestionTypeForm();
                manageModal.classList.remove('hidden');
                await loadQuestions();
            });
        });

        function closeManageQuestionsModal() {
            manageModal?.classList.add('hidden');
        }

        async function loadQuestions() {
            if (!questionsContainer || !currentListUrl) return;
            questionsContainer.innerHTML = '<div class="p-4 bg-white border rounded-xl text-xs text-gray-500">Memuat daftar soal...</div>';
            try {
                const response = await fetch(currentListUrl, {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                });
                if (!response.ok) throw new Error('Gagal mengambil data soal. HTTP ' + response.status);
                const data = await response.json();
                renderQuestions(data.questions || []);
            } catch (error) {
                questionsContainer.innerHTML = `<div class="p-4 bg-red-50 border border-red-200 rounded-xl text-xs text-red-600">${escapeHtml(error.message)}</div>`;
            }
        }

        function renderQuestions(questions) {
            questionsContainer.replaceChildren();
            if (!questions.length) {
                questionsContainer.innerHTML = '<div class="p-4 bg-white border border-gray-200 rounded-xl text-xs text-gray-500">Belum ada soal pada paket asesmen ini.</div>';
                updateQuestionCount(0);
                return;
            }
            questions.forEach((question, index) => {
                const item = document.createElement('div');
                item.className = 'p-3 bg-white border border-gray-200 rounded-xl flex gap-3 justify-between items-start';
                const content = document.createElement('div');
                content.className = 'flex-1 min-w-0 text-xs text-gray-700';
                const number = document.createElement('span');
                number.className = 'font-extrabold text-[#3650A2]';
                number.textContent = `${index + 1}. `;
                const text = document.createElement('span');
                text.textContent = question.question_text || '';
                content.append(number, text);
                const type = document.createElement('p');
                type.className = 'mt-1 text-[10px] text-gray-400';
                type.textContent = 'Tipe: ' + questionTypeLabel(question.type);
                content.appendChild(type);
                const actions = document.createElement('div');
                actions.className = 'shrink-0 flex items-center gap-3';
                const editButton = document.createElement('button');
                editButton.type = 'button';
                editButton.className = 'text-indigo-600 font-bold text-xs hover:underline';
                editButton.textContent = 'Edit';
                editButton.addEventListener('click', () => openEditQuestionModal(question));
                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.className = 'text-red-500 font-bold text-xs hover:underline';
                deleteButton.textContent = 'Hapus';
                deleteButton.addEventListener('click', () => deleteQuestion(question.id));
                actions.append(editButton, deleteButton);
                item.append(content, actions);
                questionsContainer.appendChild(item);
            });
            updateQuestionCount(questions.length);
        }

        function questionTypeLabel(type) {
            const labels = {
                multiple_choice: 'Pilihan Ganda',
                likert: 'Skala Persetujuan',
                preference: 'Skala Kesukaan',
                image_choice: 'Pilihan Gambar',
                visual: 'Penalaran Visual',
                drawing: 'Menggambar'
            };
            return labels[type] || type || '—';
        }

        const editQuestionModal = document.getElementById('editQuestionModal');
        const editQuestionForm = document.getElementById('editQuestionForm');
        const editQuestionType = document.getElementById('editQuestionType');
        const editQuestionText = document.getElementById('editQuestionText');
        const editQuestionImageUrl = document.getElementById('editQuestionImageUrl');
        const editQuestionImageSection = document.getElementById('editQuestionImageSection');
        const editAnswerOptionsSection = document.getElementById('editAnswerOptionsSection');
        const editAnswerOptionsList = document.getElementById('editAnswerOptionsList');
        const editAddAnswerOptionBtn = document.getElementById('editAddAnswerOptionBtn');

        function updateEditQuestionTypeForm() {
            const type = editQuestionType.value;
            const usesOptions = ['multiple_choice', 'likert', 'preference', 'image_choice', 'visual'].includes(type);
            const needsImage = ['image_choice', 'visual', 'drawing'].includes(type);
            editAnswerOptionsSection.classList.toggle('hidden', !usesOptions);
            editQuestionImageSection.classList.toggle('hidden', !needsImage);
            editAnswerOptionsList.querySelectorAll('input').forEach(input => {
                input.disabled = !usesOptions;
            });
        }

        function addEditOptionRow(option = {}, index = null) {
            const row = document.createElement('div');
            row.className = 'edit-answer-option-row grid grid-cols-1 sm:grid-cols-[1fr_100px_auto] gap-2';
            const text = document.createElement('input');
            text.type = 'text'; text.maxLength = 1000; text.required = true;
            text.className = 'edit-option-text min-w-0 px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs';
            text.placeholder = 'Teks opsi'; text.value = option.option_text || '';
            const score = document.createElement('input');
            score.type = 'number'; score.step = 'any'; score.className = 'edit-option-score px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs';
            score.placeholder = 'Skor'; score.value = option.score ?? 0;
            const remove = document.createElement('button');
            remove.type = 'button'; remove.className = 'text-red-500 text-xs font-bold'; remove.textContent = 'Hapus';
            remove.addEventListener('click', () => {
                const rows = editAnswerOptionsList.querySelectorAll('.edit-answer-option-row');
                if (rows.length <= 2) {
                    Swal.fire({ icon: 'info', title: 'Minimal 2 opsi', text: 'Tipe ini memerlukan minimal 2 opsi jawaban.' });
                    return;
                }
                row.remove(); updateEditOptionNames();
            });
            row.append(text, score, remove); editAnswerOptionsList.appendChild(row); updateEditOptionNames();
        }

        function updateEditOptionNames() {
            editAnswerOptionsList.querySelectorAll('.edit-answer-option-row').forEach((row, index) => {
                row.querySelector('.edit-option-text').name = `options[${index}][option_text]`;
                row.querySelector('.edit-option-score').name = `options[${index}][score]`;
            });
        }

        editAddAnswerOptionBtn?.addEventListener('click', () => {
            if (editAnswerOptionsList.querySelectorAll('.edit-answer-option-row').length >= 10) {
                Swal.fire({ icon: 'info', title: 'Batas opsi tercapai', text: 'Maksimal 10 opsi jawaban.' }); return;
            }
            addEditOptionRow();
        });
        editQuestionType?.addEventListener('change', updateEditQuestionTypeForm);

        async function openEditQuestionModal(question) {
            try {
                const response = await fetch(`${currentUpdateBase}/${question.id}`, {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || 'Gagal memuat detail soal.');
                const item = data.question || question;
                editQuestionForm.action = `${currentUpdateBase}/${item.id}`;
                editQuestionText.value = item.question_text || '';
                editQuestionType.value = item.type || 'multiple_choice';
                editQuestionImageUrl.value = item.image_url || '';
                editAnswerOptionsList.replaceChildren();
                (item.options || []).forEach(option => addEditOptionRow(option));
                if ((item.options || []).length === 0) {
                    addEditOptionRow(); addEditOptionRow();
                }
                updateEditQuestionTypeForm();
                editQuestionModal.classList.remove('hidden');
            } catch (error) {
                Swal.fire({ icon: 'error', title: 'Gagal membuka edit soal', text: error.message });
            }
        }

        function closeEditQuestionModal() {
            editQuestionModal?.classList.add('hidden');
        }

        editQuestionForm?.addEventListener('submit', async function (event) {
            event.preventDefault();
            const button = this.querySelector('button[type="submit"]');
            const type = editQuestionType.value;
            const optionsCount = editAnswerOptionsList.querySelectorAll('.edit-answer-option-row').length;
            if (['multiple_choice', 'likert', 'preference', 'image_choice', 'visual'].includes(type) && optionsCount < 2) {
                Swal.fire({ icon: 'warning', title: 'Opsi belum cukup', text: 'Tipe soal ini memerlukan minimal 2 opsi.' }); return;
            }
            button.disabled = true; button.textContent = 'Menyimpan...';
            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': this.querySelector('[name="_token"]').value },
                    body: new FormData(this)
                });
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || Object.values(data.errors || {}).flat().join('\n') || 'Gagal memperbarui soal.');
                closeEditQuestionModal(); await loadQuestions();
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message || 'Soal berhasil diperbarui.', timer: 1500, showConfirmButton: false });
            } catch (error) {
                Swal.fire({ icon: 'error', title: 'Gagal menyimpan perubahan', text: error.message });
            } finally { button.disabled = false; button.textContent = 'Simpan Perubahan'; }
        });

        questionForm?.addEventListener('submit', async function (event) {
            event.preventDefault();
            const submitButton = this.querySelector('button[type="submit"]');
            const textarea = this.querySelector('[name="question_text"]');
            const token = this.querySelector('[name="_token"]')?.value;
            if (!textarea?.value.trim()) { textarea?.focus(); return; }

            submitButton.disabled = true;
            submitButton.textContent = 'Menyimpan...';
            try {
                const response = await fetch(currentStoreUrl || this.action, {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': token || '' },
                    body: new FormData(this)
                });
                const data = await response.json();
                if (!response.ok) {
                    const message = data.message || Object.values(data.errors || {}).flat().join('\n') || 'Gagal menyimpan soal.';
                    throw new Error(message);
                }
                this.reset();
                updateQuestionTypeForm();
                await loadQuestions();
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message || 'Soal berhasil ditambahkan.', timer: 1500, showConfirmButton: false });
            } catch (error) {
                Swal.fire({ icon: 'error', title: 'Gagal menyimpan', text: error.message });
            } finally {
                submitButton.disabled = false;
                submitButton.textContent = 'Simpan Soal';
            }
        });

        async function deleteQuestion(questionId) {
            const result = await Swal.fire({
                icon: 'warning', title: 'Hapus soal ini?', text: 'Soal yang dihapus tidak dapat dipulihkan.',
                showCancelButton: true, confirmButtonText: 'Ya, hapus', cancelButtonText: 'Batal', confirmButtonColor: '#dc2626'
            });
            if (!result.isConfirmed) return;
            const token = questionForm.querySelector('[name="_token"]')?.value;
            try {
                const response = await fetch(`${currentDeleteBase}/${questionId}`, {
                    method: 'DELETE',
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': token || '' }
                });
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || 'Gagal menghapus soal.');
                await loadQuestions();
                Swal.fire({ icon: 'success', title: 'Terhapus!', text: data.message || 'Soal berhasil dihapus.', timer: 1500, showConfirmButton: false });
            } catch (error) {
                Swal.fire({ icon: 'error', title: 'Gagal menghapus', text: error.message });
            }
        }

        function updateQuestionCount(count) {
            const card = document.getElementById(`assessment-card-${currentAssessmentId}`);
            const countElement = card?.querySelector('.question-count');
            if (countElement) countElement.innerHTML = `<span class="w-2 h-2 rounded-full bg-[#FF7A59]"></span>${count} Butir Soal`;
        }

        function escapeHtml(value) {
            const element = document.createElement('span');
            element.textContent = value ?? '';
            return element.innerHTML;
        }

        function openEditModal(id, title, category, description, subtestType) {
            document.getElementById('editTitle').value = title || '';
            document.getElementById('editCategory').value = category || '';
            document.getElementById('editDescription').value = description || '';
            const subtestSelect = document.getElementById('editSubtestType');
            if (subtestSelect && subtestType) subtestSelect.value = subtestType;
            toggleSubTests('editCategory', 'editSubtestContainer');
            document.getElementById('editForm').action = '/admin/assessments/' + id;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal')?.classList.add('hidden');
        }

        function filterAssessments() {
            const input = document.getElementById('assessmentSearchInput');
            const filter = (input?.value || '').trim().toLowerCase();
            const cards = document.querySelectorAll('[id^="assessment-card-"]');
            const counter = document.getElementById('assessmentSearchCounter');
            let visibleCount = 0;
            cards.forEach(card => {
                const isMatch = card.textContent.toLowerCase().includes(filter);
                card.style.display = isMatch ? '' : 'none';
                if (isMatch) visibleCount++;
            });
            if (counter) counter.textContent = filter ? `Ditemukan ${visibleCount} paket asesmen` : `${visibleCount} paket ditampilkan`;
        }
    </script>
</body>
</html>
