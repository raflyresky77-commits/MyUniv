    <!-- SECTION: Percaya Diri Melangkah -->
    <section class="py-20 bg-white border-y border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <h2 class="text-3xl font-extrabold text-indigoPrimary">
                    Percaya Diri Melangkah
                </h2>
                <p class="text-gray-500 mt-2 text-base">
                    Dari <span class="text-indigoPrimary font-bold">Minat & Bakat</span> Hingga <span class="text-coralOrange font-bold">Universitas Impian</span>
                </p>
            </div>

            <!-- Interactive Spotlight Box -->
            <div class="max-w-4xl mx-auto mb-10 bg-softSky rounded-3xl p-6 sm:p-8 border-2 border-indigoPrimary/20 shadow-lg relative transition-all duration-300" id="testimonial-spotlight">
                <div class="flex items-start gap-4">
                    <div class="text-coralOrange text-3xl sm:text-4xl"><i class="fa-solid fa-quote-left"></i></div>
                    <div>
                        <p class="text-base sm:text-lg text-gray-800 font-medium italic leading-relaxed" id="spotlight-text">
                            "Tesnya sangat interaktif dan hasilnya sesuai banget dengan minat koding saya. Rekomendasi kampusnya membantu saya menentukan SNBP!"
                        </p>
                        <div class="mt-4 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-indigoPrimary text-white font-bold flex items-center justify-center text-sm" id="spotlight-avatar">
                                A
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-indigoPrimary" id="spotlight-author">Anggia Tresa</h4>
                                <p class="text-xs text-gray-500" id="spotlight-role">Siswa XII RPL - Lolos SNBP Teknik Informatika</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interaktif Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Testi 1 -->
                <div onclick="setActiveTestimonial(1)" id="testi-card-1" class="testi-card p-6 rounded-2xl bg-white border-2 border-coralOrange ring-2 ring-coralOrange/20 cursor-pointer transition-all duration-300 hover:shadow-md flex flex-col justify-between">
                    <p class="text-xs sm:text-sm text-gray-700 italic leading-relaxed mb-6">
                        "Tesnya sangat interaktif dan hasilnya sesuai banget dengan minat koding saya. Rekomendasi kampusnya membantu saya menentukan SNBP!"
                    </p>
                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                        <div class="w-9 h-9 rounded-full bg-indigoPrimary/20 text-indigoPrimary font-bold flex items-center justify-center text-xs">
                            A
                        </div>
                        <div>
                            <h4 class="font-bold text-xs text-indigoPrimary">Anggia Tresa</h4>
                            <p class="text-[10px] text-gray-400">Kelas XII RPL</p>
                        </div>
                    </div>
                </div>

                <!-- Testi 2 -->
                <div onclick="setActiveTestimonial(2)" id="testi-card-2" class="testi-card p-6 rounded-2xl bg-white border border-gray-200 cursor-pointer transition-all duration-300 hover:border-indigoPrimary hover:shadow-md flex flex-col justify-between opacity-80 hover:opacity-100">
                    <p class="text-xs sm:text-sm text-gray-700 italic leading-relaxed mb-6">
                        "Awalnya bingung bedanya S1 dan D4, tapi lewat fitur Education Planning di MyUniv semuanya jadi terstruktur dengan rapi."
                    </p>
                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                        <div class="w-9 h-9 rounded-full bg-coralOrange/20 text-coralOrange font-bold flex items-center justify-center text-xs">
                            B
                        </div>
                        <div>
                            <h4 class="font-bold text-xs text-indigoPrimary">Tiara Maharani</h4>
                            <p class="text-[10px] text-gray-400">Kelas XII TKJ</p>
                        </div>
                    </div>
                </div>

                <!-- Testi 3 -->
                <div onclick="setActiveTestimonial(3)" id="testi-card-3" class="testi-card p-6 rounded-2xl bg-white border border-gray-200 cursor-pointer transition-all duration-300 hover:border-indigoPrimary hover:shadow-md flex flex-col justify-between opacity-80 hover:opacity-100">
                    <p class="text-xs sm:text-sm text-gray-700 italic leading-relaxed mb-6">
                        "Fitur konsultasi ke Guru BK via WhatsApp gampang banget, tinggal klik langsung terhubung dengan template pesan yang sopan."
                    </p>
                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                        <div class="w-9 h-9 rounded-full bg-indigoPrimary/20 text-indigoPrimary font-bold flex items-center justify-center text-xs">
                            C
                        </div>
                        <div>
                            <h4 class="font-bold text-xs text-indigoPrimary">Salsabila</h4>
                            <p class="text-[10px] text-gray-400">Kelas XII AKL</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 bg-softSky">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-indigoPrimary uppercase tracking-wide">Pertanyaan Yang Sering Diajukan</h2>
            </div>

            <div class="space-y-4">

                <div class="bg-white rounded-xl border border-indigoPrimary/10 p-4 cursor-pointer faq-item shadow-sm">
                    <div class="flex justify-between items-center font-bold text-indigoPrimary text-sm sm:text-base">
                        <span>Apakah tes peminatan ini gratis?</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 mt-3 hidden leading-relaxed">
                        Ya, seluruh rangkaian tes peminatan awal dan perencanaan pendidikan di MyUniv disediakan secara gratis untuk seluruh siswa sekolah yang terintegrasi.
                    </p>
                </div>

                <div class="bg-white rounded-xl border border-indigoPrimary/10 p-4 cursor-pointer faq-item shadow-sm">
                    <div class="flex justify-between items-center font-bold text-indigoPrimary text-sm sm:text-base">
                        <span>Bagaimana cara berkonsultasi dengan Guru BK?</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 mt-3 hidden leading-relaxed">
                        Kamu cukup masuk ke menu Konsultasi BK, pilih jadwal ketersediaan guru, lalu klik tombol konsultasi untuk diarahkan otomatis ke WhatsApp dengan template pesan resmi.
                    </p>
                </div>

                <div class="bg-white rounded-xl border border-indigoPrimary/10 p-4 cursor-pointer faq-item shadow-sm">
                    <div class="flex justify-between items-center font-bold text-indigoPrimary text-sm sm:text-base">
                        <span>Apakah data hasil tes disimpan dengan aman?</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 mt-3 hidden leading-relaxed">
                        Sangat aman. Seluruh data hasil asesmen dan nilai terlindungi dan hanya dapat diakses oleh kamu dan Guru BK pendamping sekolah.
                    </p>
                </div>

                <div class="bg-white rounded-xl border border-indigoPrimary/10 p-4 cursor-pointer faq-item shadow-sm">
                    <div class="flex justify-between items-center font-bold text-indigoPrimary text-sm sm:text-base">
                        <span>Apakah rekomendasi universitas mencakup PTN dan PTS?</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 mt-3 hidden leading-relaxed">
                        Ya, MyUniv menyediakan direktori lengkap perguruan tinggi negeri maupun swasta beserta info akreditasi dan lokasi.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Banner CTA Siap Menemukan Jurusan Kuliah Impianmu -->
    <section class="py-16 sm:py-20 bg-gradient-to-r from-indigoPrimary to-indigo-800 text-white relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-80 h-80 bg-coralOrange/20 rounded-full blur-3xl"></div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-6">
            <h2 class="text-3xl sm:text-4xl font-extrabold">
                Siap Menemukan Jurusan Kuliah Impianmu?
            </h2>
            <p class="text-indigo-100 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed">
                Mauny siap mendampingimu kapan saja! Bergabunglah dengan ribuan siswa lain yang telah menemukan arah studi mereka.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto bg-coralOrange hover:bg-orange-600 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-coralOrange/30 hover:shadow-xl transition-all transform hover:-translate-y-1 text-sm text-center">
                    Daftar Sekarang
                </a>
                <a href="#alur" class="w-full sm:w-auto border-2 border-white/40 hover:border-white text-white font-bold px-8 py-4 rounded-xl transition-all hover:bg-white/10 text-sm">
                    Pelajari Alur
                </a>
            </div>
        </div>
    </section>

