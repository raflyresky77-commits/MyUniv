<!-- SECTION: Rekomendasi Universitas & Slider Top 10 PTN/PTS Jawa Barat -->
    <section id="rekomendasi" class="py-16 sm:py-24 bg-brand-bgLight relative overflow-hidden">
        <!-- Dekorasi Background Blur Blobs Halus -->
        <div class="absolute top-10 left-1/4 w-96 h-96 bg-brand-indigo/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-brand-coral/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <span class="inline-block bg-brand-pillBg text-brand-coral font-bold text-xs tracking-wider uppercase px-4 py-1.5 rounded-full mb-3 shadow-sm">
                        Pilihan Kampus & Jurusan
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-brand-indigo mt-1">
                        Top 10 PTN & PTS Unggulan di Jawa Barat
                    </h2>
                    <p class="text-brand-textGray mt-2 text-sm sm:text-base font-medium max-w-xl">
                        Geser untuk menjelajahi rekomendasi kampus terbaik yang disesuaikan dengan hasil asesmen minat & bakatmu.
                    </p>
                </div>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 items-start">
                <!-- Sidebar Asesmen -->
                <div class="lg:col-span-4 bg-white/90 backdrop-blur-md rounded-3xl p-6 sm:p-7 border border-brand-indigo/10 shadow-xl shadow-brand-indigo/5 relative overflow-hidden">
                    <div class="flex items-center gap-3.5 mb-6 pb-4 border-b border-gray-100">
                        <div class="w-12 h-12 bg-brand-indigo rounded-2xl flex items-center justify-center text-white text-xl shadow-md shadow-brand-indigo/20">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-brand-indigo text-base sm:text-lg">Hasil Asesmenku</h3>
                            <p class="text-xs text-brand-textGray font-medium">Ringkasan Psikotes & TKA</p>
                        </div>
                    </div>

                    <div class="space-y-4 text-sm">
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1.5">
                                <span class="text-brand-indigo">Logika & Sains Data</span>
                                <span class="text-brand-coral font-extrabold">92%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-brand-indigo h-full rounded-full transition-all duration-500" style="width: 92%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1.5">
                                <span class="text-brand-indigo">Desain & Kreativitas</span>
                                <span class="text-brand-coral font-extrabold">88%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-brand-coral h-full rounded-full transition-all duration-500" style="width: 88%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1.5">
                                <span class="text-brand-indigo">Manajemen & Komunikasi</span>
                                <span class="text-brand-coral font-extrabold">75%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-brand-indigo/70 h-full rounded-full transition-all duration-500" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan Mauny -->
                    <div class="mt-6 bg-gradient-to-br from-brand-indigo/5 to-brand-coral/5 rounded-2xl p-4 border border-brand-indigo/15 flex items-center gap-3.5 shadow-sm">
                        <div class="w-11 h-11 rounded-2xl bg-white p-1 border border-brand-indigo/20 shrink-0 shadow-sm overflow-hidden">
                            <img src="{{ asset('images/head.jpg') }}"
                            onerror="this.onerror=null; this.src='https://placehold.co/100x100/F4FAFF/3650A2?text=Mauny'"
                            alt="Mauny"
                            class="w-full h-full rounded-full object-cover">
                        </div>
                        <p class="text-xs text-brand-indigo leading-relaxed font-medium">
                            <strong class="block text-brand-coral font-bold text-xs mb-0.5">Catatan Mauny:</strong>
                            Semua kampus di samping lokasinya strategis di Jawa Barat. Yuk tentukan pilihanmu!
                        </p>
                    </div>
                </div>

                <!-- Campus Horizontal Slider (Top 10 PTN/PTS Jabar) dengan padding agar shadow aman -->
                <div class="lg:col-span-8 overflow-visible">
                    <div id="campusSlider" class="flex gap-6 overflow-x-auto py-6 -my-6 px-2 -mx-2 scroll-smooth snap-x snap-mandatory no-scrollbar">

                        <!-- Kampus 1: ITB -->
                        <div class="min-w-[280px] sm:min-w-[310px] snap-start bg-white rounded-3xl border border-brand-indigo/10 shadow-lg shadow-brand-indigo/5 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                            <div class="p-5 space-y-4">
                                <div class="relative h-44 -mx-5 -mt-5 overflow-hidden">
                                    <img src="/images/universities/BANNER-ITB.jpg" alt="ITB" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                    <span class="absolute top-3 right-3 bg-brand-coral text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md z-10">Match 98%</span>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center gap-2.5">
                                        <div class="w-9 h-9 bg-white rounded-xl p-1 shadow-md flex items-center justify-center shrink-0">
                                            <span class="text-xs font-bold text-brand-indigo">ITB</span>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-white text-sm leading-tight truncate">Institut Teknologi Bandung</h4>
                                            <p class="text-[11px] text-gray-200">PTN • Bandung</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-[11px] text-brand-textGray block font-semibold uppercase tracking-wider">Program Studi Unggulan:</span>
                                    <span class="font-bold text-brand-indigo text-xs block mt-0.5">Teknik Informatika & STEI</span>
                                </div>
                                <div class="text-xs text-brand-textGray flex items-center gap-2 font-medium pt-3 border-t border-gray-100">
                                    <i class="fa-solid fa-graduation-cap text-brand-coral"></i>
                                    <span>Akreditasi Unggul / Internasional</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kampus 2: Bina Nusantara -->
                        <div class="min-w-[280px] sm:min-w-[310px] snap-start bg-white rounded-3xl border border-brand-indigo/10 shadow-lg shadow-brand-indigo/5 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                            <div class="p-5 space-y-4">
                                <div class="relative h-44 -mx-5 -mt-5 overflow-hidden">
                                    <img src="/images/universities/BANNER-BINUS.png" alt="Bina Nusantara" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                    <span class="absolute top-3 right-3 bg-brand-coral text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md z-10">Match 95%</span>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center gap-2.5">
                                        <div class="w-9 h-9 bg-white rounded-xl p-1 shadow-md flex items-center justify-center shrink-0">
                                            <span class="text-xs font-bold text-brand-indigo">BINUS</span>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-white text-sm leading-tight truncate">Bina Nusantara</h4>
                                            <p class="text-[11px] text-gray-200">PTS • Jakarta, Tangerang, Bekasi, Bandung, Malang, Semarang, Medan.</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-[11px] text-brand-textGray block font-semibold uppercase tracking-wider">Program Studi Unggulan:</span>
                                    <span class="font-bold text-brand-indigo text-xs block mt-0.5">Ilmu Komputer & Sistem Informasi</span>
                                </div>
                                <div class="text-xs text-brand-textGray flex items-center gap-2 font-medium pt-3 border-t border-gray-100">
                                    <i class="fa-solid fa-graduation-cap text-brand-coral"></i>
                                    <span>Akreditasi Unggul / Internasional</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kampus 3: Universitas Indonesia -->
                        <div class="min-w-[280px] sm:min-w-[310px] snap-start bg-white rounded-3xl border border-brand-indigo/10 shadow-lg shadow-brand-indigo/5 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                            <div class="p-5 space-y-4">
                                <div class="relative h-44 -mx-5 -mt-5 overflow-hidden">
                                    <img src="/images/universities/BANNER-UI.jpg" alt="UI" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                    <span class="absolute top-3 right-3 bg-brand-coral text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md z-10">Match 95%</span>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center gap-2.5">
                                        <div class="w-9 h-9 bg-white rounded-xl p-1 shadow-md flex items-center justify-center shrink-0">
                                            <span class="text-xs font-bold text-brand-indigo">UI</span>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-white text-sm leading-tight truncate">Universitas Indonesia</h4>
                                            <p class="text-[11px] text-gray-200">PTN • Depok</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-[11px] text-brand-textGray block font-semibold uppercase tracking-wider">Program Studi Unggulan:</span>
                                    <span class="font-bold text-brand-indigo text-xs block mt-0.5">Ilmu Komputer & Sistem Informasi</span>
                                </div>
                                <div class="text-xs text-brand-textGray flex items-center gap-2 font-medium pt-3 border-t border-gray-100">
                                    <i class="fa-solid fa-graduation-cap text-brand-coral"></i>
                                    <span>Akreditasi Unggul / Internasional</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kampus 3: Universitas Padjadjaran -->
                        <div class="min-w-[280px] sm:min-w-[310px] snap-start bg-white rounded-3xl border border-brand-indigo/10 shadow-lg shadow-brand-indigo/5 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                            <div class="p-5 space-y-4">
                                <div class="relative h-44 -mx-5 -mt-5 overflow-hidden">
                                    <img src="/images/universities/BANNER-Unpad.jpg" alt="Unpad" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                    <span class="absolute top-3 right-3 bg-brand-indigo text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md z-10">Match 91%</span>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center gap-2.5">
                                        <div class="w-9 h-9 bg-white rounded-xl p-1 shadow-md flex items-center justify-center shrink-0">
                                            <span class="text-xs font-bold text-brand-indigo">UNPAD</span>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-white text-sm leading-tight truncate">Universitas Padjadjaran</h4>
                                            <p class="text-[11px] text-gray-200">PTN • Jatinangor, Sumedang</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-[11px] text-brand-textGray block font-semibold uppercase tracking-wider">Program Studi Unggulan:</span>
                                    <span class="font-bold text-brand-indigo text-xs block mt-0.5">Bisnis Digital & Ilmu Komunikasi</span>
                                </div>
                                <div class="text-xs text-brand-textGray flex items-center gap-2 font-medium pt-3 border-t border-gray-100">
                                    <i class="fa-solid fa-graduation-cap text-brand-coral"></i>
                                    <span>Akreditasi Unggul</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kampus 4: Telkom University -->
                        <div class="min-w-[280px] sm:min-w-[310px] snap-start bg-white rounded-3xl border border-brand-indigo/10 shadow-lg shadow-brand-indigo/5 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                            <div class="p-5 space-y-4">
                                <div class="relative h-44 -mx-5 -mt-5 overflow-hidden">
                                    <img src="/images/universities/BANNER-Telkom.jpg" alt="Telkom" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                    <span class="absolute top-3 right-3 bg-brand-indigo text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md z-10">Match 90%</span>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center gap-2.5">
                                        <div class="w-9 h-9 bg-white rounded-xl p-1 shadow-md flex items-center justify-center shrink-0">
                                            <span class="text-[10px] font-bold text-brand-indigo">TEL-U</span>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-white text-sm leading-tight truncate">Telkom University</h4>
                                            <p class="text-[11px] text-gray-200">PTS • Bandung</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-[11px] text-brand-textGray block font-semibold uppercase tracking-wider">Program Studi Unggulan:</span>
                                    <span class="font-bold text-brand-indigo text-xs block mt-0.5">DKV & Teknik Informatika</span>
                                </div>
                                <div class="text-xs text-brand-textGray flex items-center gap-2 font-medium pt-3 border-t border-gray-100">
                                    <i class="fa-solid fa-graduation-cap text-brand-coral"></i>
                                    <span>PTS #1 di Indonesia</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kampus 5: IPB University -->
                        <div class="min-w-[280px] sm:min-w-[310px] snap-start bg-white rounded-3xl border border-brand-indigo/10 shadow-lg shadow-brand-indigo/5 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                            <div class="p-5 space-y-4">
                                <div class="relative h-44 -mx-5 -mt-5 overflow-hidden">
                                    <img src="/images/universities/BANNER-IPB.jpg" alt="IPB" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                    <span class="absolute top-3 right-3 bg-brand-indigo text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md z-10">Match 88%</span>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center gap-2.5">
                                        <div class="w-9 h-9 bg-white rounded-xl p-1 shadow-md flex items-center justify-center shrink-0">
                                            <span class="text-xs font-bold text-brand-indigo">IPB</span>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-white text-sm leading-tight truncate">IPB University</h4>
                                            <p class="text-[11px] text-gray-200">PTN • Bogor</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-[11px] text-brand-textGray block font-semibold uppercase tracking-wider">Program Studi Unggulan:</span>
                                    <span class="font-bold text-brand-indigo text-xs block mt-0.5">Ilmu Komputer & Statistika</span>
                                </div>
                                <div class="text-xs text-brand-textGray flex items-center gap-2 font-medium pt-3 border-t border-gray-100">
                                    <i class="fa-solid fa-graduation-cap text-brand-coral"></i>
                                    <span>Akreditasi Unggul</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kampus 6: Universitas Pendidikan Indonesia (UPI) -->
                        <div class="min-w-[280px] sm:min-w-[310px] snap-start bg-white rounded-3xl border border-brand-indigo/10 shadow-lg shadow-brand-indigo/5 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                            <div class="p-5 space-y-4">
                                <div class="relative h-44 -mx-5 -mt-5 overflow-hidden">
                                    <img src="/images/universities/BANNER-UPI.jpg" alt="UPI" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                    <span class="absolute top-3 right-3 bg-brand-indigo text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md z-10">Match 86%</span>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center gap-2.5">
                                        <div class="w-9 h-9 bg-white rounded-xl p-1 shadow-md flex items-center justify-center shrink-0">
                                            <span class="text-xs font-bold text-brand-indigo">UPI</span>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-white text-sm leading-tight truncate">Universitas Pendidikan Indonesia</h4>
                                            <p class="text-[11px] text-gray-200">PTN • Bandung</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-[11px] text-brand-textGray block font-semibold uppercase tracking-wider">Program Studi Unggulan:</span>
                                    <span class="font-bold text-brand-indigo text-xs block mt-0.5">Pendidikan Ilmu Komputer & Desain</span>
                                </div>
                                <div class="text-xs text-brand-textGray flex items-center gap-2 font-medium pt-3 border-t border-gray-100">
                                    <i class="fa-solid fa-graduation-cap text-brand-coral"></i>
                                    <span>Akreditasi Unggul</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kampus 7: Universitas Islam Bandung (Unisba) -->
                        <div class="min-w-[280px] sm:min-w-[310px] snap-start bg-white rounded-3xl border border-brand-indigo/10 shadow-lg shadow-brand-indigo/5 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                            <div class="p-5 space-y-4">
                                <div class="relative h-44 -mx-5 -mt-5 overflow-hidden">
                                    <img src="/images/universities/BANNER-UNISBA.jpg" alt="Unisba" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                    <span class="absolute top-3 right-3 bg-brand-indigo text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md z-10">Match 84%</span>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center gap-2.5">
                                        <div class="w-9 h-9 bg-white rounded-xl p-1 shadow-md flex items-center justify-center shrink-0">
                                            <span class="text-[10px] font-bold text-brand-indigo">UNISBA</span>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-white text-sm leading-tight truncate">Universitas Islam Bandung</h4>
                                            <p class="text-[11px] text-gray-200">PTS • Bandung</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-[11px] text-brand-textGray block font-semibold uppercase tracking-wider">Program Studi Unggulan:</span>
                                    <span class="font-bold text-brand-indigo text-xs block mt-0.5">Teknik Informatika & Ilmu Komunikasi</span>
                                </div>
                                <div class="text-xs text-brand-textGray flex items-center gap-2 font-medium pt-3 border-t border-gray-100">
                                    <i class="fa-solid fa-graduation-cap text-brand-coral"></i>
                                    <span>PTS Favorit di Bandung</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kampus 8: Universitas Pasundan (Unpas) -->
                        <div class="min-w-[280px] sm:min-w-[310px] snap-start bg-white rounded-3xl border border-brand-indigo/10 shadow-lg shadow-brand-indigo/5 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                            <div class="p-5 space-y-4">
                                <div class="relative h-44 -mx-5 -mt-5 overflow-hidden">
                                    <img src="/images/universities/BANNER-UNPAS.jpg" alt="Unpas" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                    <span class="absolute top-3 right-3 bg-brand-indigo text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md z-10">Match 82%</span>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center gap-2.5">
                                        <div class="w-9 h-9 bg-white rounded-xl p-1 shadow-md flex items-center justify-center shrink-0">
                                            <span class="text-[10px] font-bold text-brand-indigo">UNPAS</span>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-white text-sm leading-tight truncate">Universitas Pasundan</h4>
                                            <p class="text-[11px] text-gray-200">PTS • Bandung</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-[11px] text-brand-textGray block font-semibold uppercase tracking-wider">Program Studi Unggulan:</span>
                                    <span class="font-bold text-brand-indigo text-xs block mt-0.5">Teknik Informatika & Manajemen</span>
                                </div>
                                <div class="text-xs text-brand-textGray flex items-center gap-2 font-medium pt-3 border-t border-gray-100">
                                    <i class="fa-solid fa-graduation-cap text-brand-coral"></i>
                                    <span>Akreditasi Unggul</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kampus 9: Institut Teknologi Sepuluh Nopember -->
                        <div class="min-w-[280px] sm:min-w-[310px] snap-start bg-white rounded-3xl border border-brand-indigo/10 shadow-lg shadow-brand-indigo/5 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                            <div class="p-5 space-y-4">
                                <div class="relative h-44 -mx-5 -mt-5 overflow-hidden">
                                    <img src="/images/universities/BANNER-ITS.jpg" alt="ITS" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                    <span class="absolute top-3 right-3 bg-brand-indigo text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md z-10">Match 80%</span>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center gap-2.5">
                                        <div class="w-9 h-9 bg-white rounded-xl p-1 shadow-md flex items-center justify-center shrink-0">
                                            <span class="text-[10px] font-bold text-brand-indigo">ITS</span>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-white text-sm leading-tight truncate">Institut Teknologi Sepuluh Nopember</h4>
                                            <p class="text-[11px] text-gray-200">PTS • Surabaya</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-[11px] text-brand-textGray block font-semibold uppercase tracking-wider">Program Studi Unggulan:</span>
                                    <span class="font-bold text-brand-indigo text-xs block mt-0.5">Teknik Informatika & Manajemen</span>
                                </div>
                                <div class="text-xs text-brand-textGray flex items-center gap-2 font-medium pt-3 border-t border-gray-100">
                                    <i class="fa-solid fa-graduation-cap text-brand-coral"></i>
                                    <span>Akreditasi Unggul</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kampus 10: Universitas Gadjah Mada -->
                        <div class="min-w-[280px] sm:min-w-[310px] snap-start bg-white rounded-3xl border border-brand-indigo/10 shadow-lg shadow-brand-indigo/5 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                            <div class="p-5 space-y-4">
                                <div class="relative h-44 -mx-5 -mt-5 overflow-hidden">
                                    <img src="/images/universities/BANNER-UGM.jpg" alt="Gadjah Mada" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                    <span class="absolute top-3 right-3 bg-brand-indigo text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md z-10">Match 79%</span>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center gap-2.5">
                                        <div class="w-9 h-9 bg-white rounded-xl p-1 shadow-md flex items-center justify-center shrink-0">
                                            <span class="text-[9px] font-bold text-brand-indigo">GDM</span>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-white text-sm leading-tight truncate">Universitas Gadjah Mada</h4>
                                            <p class="text-[11px] text-gray-200">PTS • Yogyakarta</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-[11px] text-brand-textGray block font-semibold uppercase tracking-wider">Program Studi Unggulan:</span>
                                    <span class="font-bold text-brand-indigo text-xs block mt-0.5">Arsitektur & DKV</span>
                                </div>
                                <div class="text-xs text-brand-textGray flex items-center gap-2 font-medium pt-3 border-t border-gray-100">
                                    <i class="fa-solid fa-graduation-cap text-brand-coral"></i>
                                    <span>Akreditas Unggul</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kampus 11: UIN -->
                        <div class="min-w-[280px] sm:min-w-[310px] snap-start bg-white rounded-3xl border border-brand-indigo/10 shadow-lg shadow-brand-indigo/5 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                            <div class="p-5 space-y-4">
                                <div class="relative h-44 -mx-5 -mt-5 overflow-hidden">
                                    <img src="/images/universities/BANNER-UIN.jpg" alt="UIN" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                    <span class="absolute top-3 right-3 bg-brand-indigo text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md z-10">Match 79%</span>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center gap-2.5">
                                        <div class="w-9 h-9 bg-white rounded-xl p-1 shadow-md flex items-center justify-center shrink-0">
                                            <span class="text-[9px] font-bold text-brand-indigo">UIN</span>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-white text-sm leading-tight truncate">Universitas Islam Negeri</h4>
                                            <p class="text-[11px] text-gray-200">PTS • Jakarta</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-[11px] text-brand-textGray block font-semibold uppercase tracking-wider">Program Studi Unggulan:</span>
                                    <span class="font-bold text-brand-indigo text-xs block mt-0.5">Arsitektur & DKV</span>
                                </div>
                                <div class="text-xs text-brand-textGray flex items-center gap-2 font-medium pt-3 border-t border-gray-100">
                                    <i class="fa-solid fa-graduation-cap text-brand-coral"></i>
                                    <span>Akreditasi Unggul/Internasional</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kampus 13: Universitas President -->
                        <div class="min-w-[280px] sm:min-w-[310px] snap-start bg-white rounded-3xl border border-brand-indigo/10 shadow-lg shadow-brand-indigo/5 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                            <div class="p-5 space-y-4">
                                <div class="relative h-44 -mx-5 -mt-5 overflow-hidden">
                                    <img src="/images/universities/BANNER-PRESIDENT.jpg" alt="President " class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                    <span class="absolute top-3 right-3 bg-brand-indigo text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md z-10">Match 79%</span>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center gap-2.5">
                                        <div class="w-9 h-9 bg-white rounded-xl p-1 shadow-md flex items-center justify-center shrink-0">
                                            <span class="text-[9px] font-bold text-brand-indigo">PRESIDENT</span>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-extrabold text-white text-sm leading-tight truncate">Universitas President</h4>
                                            <p class="text-[11px] text-gray-200">PTS • Jakarta</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-[11px] text-brand-textGray block font-semibold uppercase tracking-wider">Program Studi Unggulan:</span>
                                    <span class="font-bold text-brand-indigo text-xs block mt-0.5">Arsitektur & DKV</span>
                                </div>
                                <div class="text-xs text-brand-textGray flex items-center gap-2 font-medium pt-3 border-t border-gray-100">
                                    <i class="fa-solid fa-graduation-cap text-brand-coral"></i>
                                    <span>Akreditasi Unggul/International</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script Tambahan untuk Fungsi Tombol Geser -->
    <script>
        function scrollSlider(direction) {
            const slider = document.getElementById('campusSlider');
            const scrollAmount = 320; // Ukuran lebar card + gap
            if (direction === 'left') {
                slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            } else {
                slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }
    </script>

    <style>
        /* Utility untuk menyembunyikan scrollbar namun tetap bisa digeser */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

