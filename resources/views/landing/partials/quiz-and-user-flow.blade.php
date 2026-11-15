    <!-- Fitur Kuis Interaktif Cepat Minat & Bakat (Vibrant Background) -->
    <section id="kuis" class="py-16 sm:py-24 bg-gradient-to-br from-brand-indigo/10 via-brand-bgLight to-brand-coral/10 relative overflow-hidden border-y border-brand-indigo/15">

        <!-- Pola Titik-Titik Halus (Dot Pattern) yang Kontras -->
        <div class="absolute inset-0 opacity-40 pointer-events-none -z-10" style="background-image: radial-gradient(#3650A2 1.5px, transparent 1.5px); background-size: 28px 28px;"></div>

        <!-- Efek Cahaya Gradien Mengalir / Blobs yang Lebih Menonjol -->
        <div class="absolute -top-20 -left-20 w-96 h-96 bg-brand-coral/20 rounded-full blur-3xl pointer-events-none -z-10 animate-pulse"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-brand-indigo/20 rounded-full blur-3xl pointer-events-none -z-10"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="inline-block bg-brand-coral text-white font-bold text-xs tracking-wider uppercase px-4 py-1.5 rounded-full mb-3 shadow-md shadow-brand-coral/20">
                    Coba Tes Langsung
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-brand-indigo mt-2">
                    Kuis Cepat Minat & Bakat
                </h2>
                <p class="text-brand-textGray mt-2 text-sm sm:text-base font-medium">
                    Jawab 3 pertanyaan singkat di bawah ini untuk melihat rekomendasi awal dari Mauny!
                </p>
            </div>

            <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-6 sm:p-10 border border-white shadow-2xl shadow-brand-indigo/10 relative overflow-hidden">
                <!-- Progress Bar Kuis -->
                <div class="mb-8">
                    <div class="flex justify-between text-xs font-bold text-brand-indigo mb-2">
                        <span id="quiz-progress-text">Pertanyaan 1 dari 3</span>
                        <span id="quiz-progress-percent">33%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden shadow-inner">
                        <div id="quiz-progress-bar" class="bg-gradient-to-r from-brand-indigo to-brand-coral h-full transition-all duration-300" style="width: 33%"></div>
                    </div>
                </div>

                <!-- Kontainer Pertanyaan Kuis -->
                <div id="quiz-container">
                    <!-- Pertanyaan 1 -->
                    <div class="quiz-step" data-step="1">
                        <h3 class="text-lg sm:text-xl font-bold text-brand-indigo mb-4">1. Kegiatan apa yang paling kamu nikmati saat ada waktu luang?</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <button onclick="nextQuizStep(1, 'tekno')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-brand-indigo hover:bg-brand-bgLight transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group shadow-sm">
                                <span class="w-8 h-8 rounded-xl bg-brand-indigo/10 text-brand-indigo flex items-center justify-center font-bold text-xs group-hover:bg-brand-indigo group-hover:text-white transition-colors">A</span>
                                <span>Mengkulik aplikasi, koding, atau gadget baru</span>
                            </button>
                            <button onclick="nextQuizStep(1, 'desain')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-brand-indigo hover:bg-brand-bgLight transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group shadow-sm">
                                <span class="w-8 h-8 rounded-xl bg-brand-indigo/10 text-brand-indigo flex items-center justify-center font-bold text-xs group-hover:bg-brand-indigo group-hover:text-white transition-colors">B</span>
                                <span>Menggambar, membuat konten, atau desain digital</span>
                            </button>
                            <button onclick="nextQuizStep(1, 'bisnis')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-brand-indigo hover:bg-brand-bgLight transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group shadow-sm">
                                <span class="w-8 h-8 rounded-xl bg-brand-indigo/10 text-brand-indigo flex items-center justify-center font-bold text-xs group-hover:bg-brand-indigo group-hover:text-white transition-colors">C</span>
                                <span>Merencanakan usaha kecil atau berjualan online</span>
                            </button>
                            <button onclick="nextQuizStep(1, 'sosial')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-brand-indigo hover:bg-brand-bgLight transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group shadow-sm">
                                <span class="w-8 h-8 rounded-xl bg-brand-indigo/10 text-brand-indigo flex items-center justify-center font-bold text-xs group-hover:bg-brand-indigo group-hover:text-white transition-colors">D</span>
                                <span>Berdiskusi, mendengarkan curhat, atau organisasi</span>
                            </button>
                        </div>
                    </div>

                    <!-- Pertanyaan 2 -->
                    <div class="quiz-step hidden" data-step="2">
                        <h3 class="text-lg sm:text-xl font-bold text-brand-indigo mb-4">2. Lingkungan kerja seperti apa yang kamu cita-citakan?</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <button onclick="nextQuizStep(2, 'tekno')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-brand-indigo hover:bg-brand-bgLight transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group shadow-sm">
                                <span class="w-8 h-8 rounded-xl bg-brand-indigo/10 text-brand-indigo flex items-center justify-center font-bold text-xs group-hover:bg-brand-indigo group-hover:text-white transition-colors">A</span>
                                <span>Perusahaan teknologi modern / Software House</span>
                            </button>
                            <button onclick="nextQuizStep(2, 'desain')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-brand-indigo hover:bg-brand-bgLight transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group shadow-sm">
                                <span class="w-8 h-8 rounded-xl bg-brand-indigo/10 text-brand-indigo flex items-center justify-center font-bold text-xs group-hover:bg-brand-indigo group-hover:text-white transition-colors">B</span>
                                <span>Studio Kreatif, Agensi Desain, atau Media</span>
                            </button>
                            <button onclick="nextQuizStep(2, 'bisnis')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-brand-indigo hover:bg-brand-bgLight transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group shadow-sm">
                                <span class="w-8 h-8 rounded-xl bg-brand-indigo/10 text-brand-indigo flex items-center justify-center font-bold text-xs group-hover:bg-brand-indigo group-hover:text-white transition-colors">C</span>
                                <span>Kantor Korporasi, Startup, atau Bisnis Mandiri</span>
                            </button>
                            <button onclick="nextQuizStep(2, 'sosial')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-brand-indigo hover:bg-brand-bgLight transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group shadow-sm">
                                <span class="w-8 h-8 rounded-xl bg-brand-indigo/10 text-brand-indigo flex items-center justify-center font-bold text-xs group-hover:bg-brand-indigo group-hover:text-white transition-colors">D</span>
                                <span>Lembaga Pendidikan, Konsultan, atau RS/Klinik</span>
                            </button>
                        </div>
                    </div>

                    <!-- Pertanyaan 3 -->
                    <div class="quiz-step hidden" data-step="3">
                        <h3 class="text-lg sm:text-xl font-bold text-brand-indigo mb-4">3. Apa mata pelajaran sekolah favoritmu?</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <button onclick="showQuizResult('tekno')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-brand-indigo hover:bg-brand-bgLight transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group shadow-sm">
                                <span class="w-8 h-8 rounded-xl bg-brand-indigo/10 text-brand-indigo flex items-center justify-center font-bold text-xs group-hover:bg-brand-indigo group-hover:text-white transition-colors">A</span>
                                <span>Matematika, Informatika, atau Fisika</span>
                            </button>
                            <button onclick="showQuizResult('desain')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-brand-indigo hover:bg-brand-bgLight transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group shadow-sm">
                                <span class="w-8 h-8 rounded-xl bg-brand-indigo/10 text-brand-indigo flex items-center justify-center font-bold text-xs group-hover:bg-brand-indigo group-hover:text-white transition-colors">B</span>
                                <span>Seni Budaya, Bahasa, atau Prakarya</span>
                            </button>
                            <button onclick="showQuizResult('bisnis')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-brand-indigo hover:bg-brand-bgLight transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group shadow-sm">
                                <span class="w-8 h-8 rounded-xl bg-brand-indigo/10 text-brand-indigo flex items-center justify-center font-bold text-xs group-hover:bg-brand-indigo group-hover:text-white transition-colors">C</span>
                                <span>Ekonomi, Akuntansi, atau Kewirausahaan</span>
                            </button>
                            <button onclick="showQuizResult('sosial')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-brand-indigo hover:bg-brand-bgLight transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group shadow-sm">
                                <span class="w-8 h-8 rounded-xl bg-brand-indigo/10 text-brand-indigo flex items-center justify-center font-bold text-xs group-hover:bg-brand-indigo group-hover:text-white transition-colors">D</span>
                                <span>Sosiologi, Geografi, atau Bimbingan Konseling</span>
                            </button>
                        </div>
                    </div>

                    <!-- Hasil Kuis -->
                    <div id="quiz-result" class="hidden text-center space-y-6">
                        <div class="w-20 h-20 bg-brand-coral/10 rounded-full flex items-center justify-center mx-auto text-brand-coral text-4xl shadow-md">
                            🐉
                        </div>
                        <h3 class="text-2xl font-extrabold text-brand-indigo" id="result-title">Rekomendasi Awal Mauny:</h3>
                        <p class="text-brand-textGray text-sm max-w-lg mx-auto leading-relaxed" id="result-desc">
                            Berdasarkan jawabanmu, kamu memiliki potensi kuat di bidang Teknologi Informasi dan Rekayasa Perangkat Lunak!
                        </p>
                        <div class="pt-2">
                            <button onclick="resetQuiz()" class="bg-brand-indigo hover:bg-indigo-900 text-white px-6 py-3 rounded-xl font-bold text-xs sm:text-sm transition-all shadow-lg shadow-brand-indigo/20">
                                Ulangi Kuis
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur 5-Step Langkah Mudah -->
    <section id="alur" class="py-20 bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-indigoPrimary">
                    Langkah Mudah Menuju Masa Depanmu
                </h2>
                <p class="text-gray-500 mt-2 text-base">Alur terstruktur 5 tahap dari asesmen hingga konsultasi</p>
            </div>

            <!-- 5 Steps Flow Layout -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 relative">

                <div class="step-chevron-card p-5 text-center flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-indigoPrimary text-white font-extrabold flex items-center justify-center text-sm mb-3 shadow">
                        1
                    </div>
                    <div class="text-coralOrange text-2xl mb-2"><i class="fa-solid fa-clipboard-question"></i></div>
                    <h4 class="font-bold text-indigoPrimary text-sm mb-1">Hasil Tes Peminatan</h4>
                    <p class="text-[11px] text-gray-500">Isi asesmen minat dan bakat mandiri.</p>
                </div>

                <div class="step-chevron-card p-5 text-center flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-indigoPrimary text-white font-extrabold flex items-center justify-center text-sm mb-3 shadow">
                        2
                    </div>
                    <div class="text-coralOrange text-2xl mb-2"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
                    <h4 class="font-bold text-indigoPrimary text-sm mb-1">Cocokkan Jurusan</h4>
                    <p class="text-[11px] text-gray-500">Sistem memadukan hasil dengan rekomendasi.</p>
                </div>

                <div class="step-chevron-card p-5 text-center flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-indigoPrimary text-white font-extrabold flex items-center justify-center text-sm mb-3 shadow">
                        3
                    </div>
                    <div class="text-coralOrange text-2xl mb-2"><i class="fa-solid fa-building-flag"></i></div>
                    <h4 class="font-bold text-indigoPrimary text-sm mb-1">Rekomendasi Universitas</h4>
                    <p class="text-[11px] text-gray-500">Berdasarkan jurusan, lokasi, dan akreditasi.</p>
                </div>

                <div class="step-chevron-card p-5 text-center flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-indigoPrimary text-white font-extrabold flex items-center justify-center text-sm mb-3 shadow">
                        4
                    </div>
                    <div class="text-coralOrange text-2xl mb-2"><i class="fa-solid fa-calendar-check"></i></div>
                    <h4 class="font-bold text-indigoPrimary text-sm mb-1">Rencanakan Pendidikan</h4>
                    <p class="text-[11px] text-gray-500">Membuat roadmap persiapan perkuliahan.</p>
                </div>

                <div class="step-chevron-card p-5 text-center flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-indigoPrimary text-white font-extrabold flex items-center justify-center text-sm mb-3 shadow">
                        5
                    </div>
                    <div class="text-coralOrange text-2xl mb-2"><i class="fa-solid fa-user-tie"></i></div>
                    <h4 class="font-bold text-indigoPrimary text-sm mb-1">Konsultasi Dengan Guru BK</h4>
                    <p class="text-[11px] text-gray-500">Diskusi langsung tentang arahan sekolah.</p>
                </div>

            </div>
        </div>
    </section>
