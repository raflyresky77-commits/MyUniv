<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyUniv - Temukan Jurusan Impianmu</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        indigoPrimary: '#3650A2',
                        coralOrange: '#FF7A59',
                        softSky: '#F4FAFF',
                        brand: {
                            indigo: '#3650A2',
                            coral: '#FF7A59',
                            bgLight: '#F4F7FF',
                            cardBg: '#FFFFFF',
                            pillBg: '#FFEBE6',
                            textGray: '#6B7280',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- FontAwesome & Lucide Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Google Fonts (Plus Jakarta Sans & Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Custom Style & Clip Paths -->
    <style>
        /* Clip path panah unik dari Code 1 */
        .arrow-card-outer {
            clip-path: polygon(0 0, 82% 0, 100% 50%, 82% 100%, 0 100%);
        }

        .arrow-card-inner {
            clip-path: polygon(0 0, 81.5% 0, 99.2% 50%, 81.5% 100%, 0 100%);
        }

        .clip-arrow-card {
            clip-path: polygon(0% 0%, 92% 0%, 100% 50%, 92% 100%, 0% 100%);
        }

        @media (max-width: 640px) {
            .arrow-card-outer, .arrow-card-inner, .clip-arrow-card {
                clip-path: none; /* Fallback responsif untuk layar kecil agar layout tetap presisi */
                border-radius: 1rem;
            }
        }

        .wavy-underline {
            text-decoration: underline;
            text-decoration-style: wavy;
            text-decoration-color: #FF7A59;
            text-underline-offset: 6px;
        }

        @keyframes floatMascot {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(2deg); }
        }
        .animate-float-mascot {
            animation: floatMascot 4s ease-in-out infinite;
        }

        @keyframes bgGlow {
            0%, 100% { opacity: 0.6; transform: scale(1); }
            50% { opacity: 0.85; transform: scale(1.08); }
        }
        .animate-bg-glow {
            animation: bgGlow 6s ease-in-out infinite;
        }

        /* Pentagon / Chevron Down Style untuk Alur Langkah */
        .step-chevron-card {
            clip-path: polygon(0% 0%, 100% 0%, 100% 85%, 50% 100%, 0% 85%);
            background: #FFFFFF;
            border: 1px solid #C9D7EE;
            transition: all 0.3s ease;
        }
        .step-chevron-card:hover {
            border-color: #FF7A59;
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(54, 80, 162, 0.1);
        }
    </style>
</head>
<body class="bg-softSky font-sans text-gray-800 antialiased overflow-x-hidden">

    <!-- Header Navigation -->
    <header class="fixed top-0 left-0 right-0 z-50 px-4 sm:px-8 py-3">
        <nav class="max-w-7xl mx-auto backdrop-blur-md bg-white/80 border border-white/50 shadow-sm rounded-2xl px-5 sm:px-6 py-3 flex items-center justify-between transition-all duration-300">
            <!-- Brand Logo -->
            <a href="#beranda" class="group flex items-center gap-3">
                <div class="relative w-10 h-10 bg-gradient-to-tr from-indigoPrimary to-indigo-600 rounded-xl flex items-center justify-center text-white shadow-md shadow-indigoPrimary/20 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 ease-out">
                    <i class="fa-solid fa-graduation-cap text-lg group-hover:animate-bounce"></i>
                    <span class="absolute -top-1 -right-1 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-coralOrange opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-coralOrange"></span>
                    </span>
                </div>
                <span class="font-extrabold text-2xl tracking-tight text-indigoPrimary group-hover:text-coralOrange transition-colors">
                    MyUniv<span class="text-coralOrange">.</span>
                </span>
            </a>

            <!-- Navigation Links -->
            <div class="hidden lg:flex items-center gap-6 xl:gap-8 font-semibold text-gray-600 text-sm">
                <a href="#beranda" class="hover:text-indigoPrimary transition-colors">Beranda</a>
                <a href="#tentang" class="hover:text-indigoPrimary transition-colors">Tentang</a>
                <a href="#fitur" class="hover:text-indigoPrimary transition-colors">Fitur</a>
                <a href="#kuis" class="hover:text-indigoPrimary transition-colors">Tes Cepat</a>
                <a href="#alur" class="hover:text-indigoPrimary transition-colors">Alur</a>
                <a href="#rekomendasi" class="hover:text-indigoPrimary transition-colors">Rekomendasi</a>
                <a href="#faq" class="hover:text-indigoPrimary transition-colors">FAQ</a>
            </div>

            <!-- Action CTA & Mobile Toggle -->
            <div class="flex items-center gap-2 sm:gap-3">
                <button onclick="openModal('masuk')" class="text-indigoPrimary hover:bg-indigoPrimary/10 border border-indigoPrimary/30 px-3.5 sm:px-4 py-2 rounded-xl font-bold transition-all text-xs sm:text-sm">
                    Masuk
                </button>
                <button onclick="openModal('daftar')" class="bg-coralOrange hover:bg-orange-600 text-white px-4 sm:px-5 py-2 rounded-xl font-bold shadow-md shadow-coralOrange/25 hover:shadow-lg transition-all transform hover:-translate-y-0.5 text-xs sm:text-sm">
                    Daftar
                </button>
                <button onclick="toggleMobileMenu()" class="lg:hidden text-indigoPrimary text-2xl ml-2 focus:outline-none">
                    <i class="fa-solid fa-bars" id="menuIcon"></i>
                </button>
            </div>
        </nav>

        <!-- Mobile Navigation Menu -->
        <div id="mobileMenu" class="hidden lg:hidden max-w-7xl mx-auto mt-2 bg-white/95 backdrop-blur-md border border-gray-100 rounded-2xl p-5 shadow-xl space-y-3 font-semibold text-gray-700">
            <a href="#beranda" onclick="toggleMobileMenu()" class="block py-2 hover:text-indigoPrimary border-b border-gray-100">Beranda</a>
            <a href="#tentang" onclick="toggleMobileMenu()" class="block py-2 hover:text-indigoPrimary border-b border-gray-100">Tentang</a>
            <a href="#fitur" onclick="toggleMobileMenu()" class="block py-2 hover:text-indigoPrimary border-b border-gray-100">Fitur</a>
            <a href="#kuis" onclick="toggleMobileMenu()" class="block py-2 hover:text-indigoPrimary border-b border-gray-100">Tes Cepat</a>
            <a href="#alur" onclick="toggleMobileMenu()" class="block py-2 hover:text-indigoPrimary border-b border-gray-100">Alur</a>
            <a href="#rekomendasi" onclick="toggleMobileMenu()" class="block py-2 hover:text-indigoPrimary border-b border-gray-100">Rekomendasi</a>
            <a href="#faq" onclick="toggleMobileMenu()" class="block py-2 hover:text-indigoPrimary">FAQ</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="beranda" class="relative pt-32 pb-20 md:pt-40 md:pb-32 overflow-hidden">
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-gradient-to-tr from-indigoPrimary/15 to-coralOrange/15 rounded-full blur-3xl -z-10 animate-bg-glow"></div>
        <div class="absolute top-12 right-10 w-72 h-72 bg-coralOrange/10 rounded-full blur-2xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-12 gap-12 items-center">

                <div class="md:col-span-7 text-center md:text-left space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 border border-indigoPrimary/10 shadow-sm backdrop-blur-sm text-indigoPrimary text-xs sm:text-sm font-semibold">
                        <span class="bg-coralOrange text-white text-xs px-2 py-0.5 rounded-full font-bold">NEW</span>
                        <span>Dampingi Perjalanan Kuliahmu Bersama Mauny 🐉</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-indigoPrimary leading-tight tracking-tight">
                        Bingung menentukan jurusan kuliah yang sesuai <span class="italic text-coralOrange wavy-underline">minat & bakat</span>?
                    </h1>

                    <p class="text-gray-600 text-base sm:text-lg max-w-2xl leading-relaxed">
                        Jangan biarkan salah pilih jurusan mengganggu masa depanmu. Dengan analisis psikometri modern berbasis AI dan bimbingan interaktif Mauny, temukan alur studi yang paling pas untukmu!
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-4 pt-4">
                        <a href="#kuis" class="w-full sm:w-auto bg-coralOrange hover:bg-[#e06545] text-white px-8 py-4 rounded-xl font-bold shadow-lg shadow-coralOrange/30 hover:shadow-coralOrange/40 transition-all transform hover:-translate-y-1 text-center">
                            Mulai Tes Gratis <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                        <a href="#alur" class="w-full sm:w-auto border-2 border-indigoPrimary/30 hover:border-indigoPrimary text-indigoPrimary hover:bg-indigoPrimary/5 px-8 py-4 rounded-xl font-bold transition-all text-center">
                            Pelajari Alur
                        </a>
                    </div>

                    <div class="pt-6 flex items-center justify-center md:justify-start gap-6 text-xs text-gray-500">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-green-500"></i>
                            <span>100% Gratis Tes Awal</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-green-500"></i>
                            <span>Hasil Akurat & Cepat</span>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-5 relative flex flex-col items-center justify-center">
                    <div class="relative z-20 mb-3 animate-bounce sm:animate-none">
                        <div class="bg-white border-2 border-indigoPrimary/20 rounded-2xl px-5 py-3 shadow-xl backdrop-blur-md relative max-w-xs text-center">
                            <p class="text-xs sm:text-sm font-bold text-indigoPrimary">
                                "Halo! Aku Mauny 🐉 Yuk temukan jurusan impianmu!"
                            </p>
                            <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white border-b-2 border-r-2 border-indigoPrimary/20 rotate-45"></div>
                        </div>
                    </div>

                    <div class="relative group animate-float-mascot">
                        <div class="absolute inset-0 bg-gradient-to-r from-coralOrange/30 to-indigoPrimary/30 rounded-3xl blur-2xl transform group-hover:scale-105 transition-transform"></div>

                        <div class="relative bg-white/60 backdrop-blur-xl p-4 sm:p-6 rounded-3xl border border-white/80 shadow-2xl overflow-hidden max-w-xs sm:max-w-sm">
                            <img src="image_88917e.jpg"
                                 onerror="this.onerror=null; this.src='https://placehold.co/400x400/F4FAFF/3650A2?text=Mauny+Mascot'"
                                 alt="Mauny Mascot"
                                 class="w-full h-auto object-contain drop-shadow-md rounded-2xl transform hover:scale-105 transition-transform duration-300">

                            <div class="mt-4 text-center">
                                <span class="bg-indigoPrimary/10 text-indigoPrimary font-bold text-xs px-3 py-1 rounded-full">Maskot Resmi MyUniv</span>
                                <h3 class="font-extrabold text-indigoPrimary text-lg mt-1">Mauny Si Naga Pemandu</h3>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- LOGO SEKOLAH & MYUNIV -->
    <section class="py-10 bg-white/60 border-y border-indigoPrimary/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-center gap-10 sm:gap-16 opacity-80 pointer-events-none">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-indigoPrimary text-white rounded-2xl flex items-center justify-center font-bold text-2xl shadow-sm">
                        <i class="fa-solid fa-school"></i>
                    </div>
                    <div class="text-left">
                        <span class="block text-[10px] font-bold tracking-wider uppercase text-gray-400">Sekolah Mitra / Pengembang</span>
                        <span class="font-extrabold text-gray-800 text-sm sm:text-base">SMK Budi Bakti Ciwidey</span>
                    </div>
                </div>

                <div class="hidden sm:block w-px h-8 bg-gray-300"></div>

                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-tr from-indigoPrimary to-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-sm">
                        <i class="fa-solid fa-graduation-cap text-2xl"></i>
                    </div>
                    <div class="text-left">
                        <span class="block text-[10px] font-bold tracking-wider uppercase text-gray-400">Platform Resmi</span>
                        <span class="font-extrabold text-2xl text-indigoPrimary">MyUniv<span class="text-coralOrange">.</span></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kendala Dalam Memilih Jurusan -->
    <section id="tentang" class="py-16 bg-white border-y border-gray-200 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center max-w-3xl mx-auto mb-12">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-indigoPrimary">
                    Sering Alami Kendala Ini Saat Pilih Jurusan?
                </h2>
                <p class="text-gray-500 mt-2 text-sm sm:text-base">
                    Banyak siswa kelas XII yang terjebak dalam dilema penentuan pendidikan lanjutan.
                </p>
            </div>

            <!-- 4 Problem Box Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="p-6 rounded-2xl bg-softSky border border-indigoPrimary/10 hover:border-indigoPrimary transition-all text-center group shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center mx-auto mb-4 text-xl group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-brain"></i>
                    </div>
                    <h3 class="font-bold text-indigoPrimary mb-2 text-base">Minat dan bakat sering tidak seimbang</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Suka suatu bidang tapi merasa ragu dengan potensi kemampuan akademiknya.</p>
                </div>

                <div class="p-6 rounded-2xl bg-softSky border border-indigoPrimary/10 hover:border-indigoPrimary transition-all text-center group shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center mx-auto mb-4 text-xl group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-map-signs"></i>
                    </div>
                    <h3 class="font-bold text-indigoPrimary mb-2 text-base">Sulit menentukan masa depan kuliah</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Bingung memilih antara PTN, PTS, atau pilihan kedinasan yang sesuai.</p>
                </div>

                <div class="p-6 rounded-2xl bg-softSky border border-indigoPrimary/10 hover:border-indigoPrimary transition-all text-center group shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center mx-auto mb-4 text-xl group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <h3 class="font-bold text-indigoPrimary mb-2 text-base">Bingung memilih universitas yang tepat</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Informasi kampus tersebar dan sulit membandingkan akreditasi prodi.</p>
                </div>

                <div class="p-6 rounded-2xl bg-softSky border border-indigoPrimary/10 hover:border-indigoPrimary transition-all text-center group shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center mx-auto mb-4 text-xl group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-user-ninja"></i>
                    </div>
                    <h3 class="font-bold text-indigoPrimary mb-2 text-base">Ikut-ikutan dengan pilihan teman</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Memilih jurusan tanpa menganalisis hasil tes peminatan pribadi.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION: Layanan Utama Kami Bantu Menemukan Jurusan yang Tepat (DITEMPEL PERSIS DARI KODE 1) -->
    <section id="fitur" class="py-16 md:py-20 bg-brand-bgLight">
        <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 text-center">

            <!-- Badge / Pill Header -->
            <div class="inline-block bg-brand-pillBg text-brand-coral font-bold text-xs tracking-wider uppercase px-4 py-1.5 rounded-full mb-4">
                LAYANAN UTAMA
            </div>

            <!-- Main Title -->
            <h2 class="text-3xl md:text-4xl font-extrabold text-brand-indigo mb-3 leading-tight max-w-2xl mx-auto">
                Kami Bantu Menemukan Jurusan yang Tepat.
            </h2>

            <!-- Subtitle -->
            <p class="text-brand-textGray text-sm md:text-base max-w-2xl mx-auto mb-14 font-medium">
                Empat pilar utama platform MyUniv yang dirancang khusus untuk memandu langkah studi lanjutanmu.
            </p>

            <!-- Cards Grid Container -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch">

                <!-- Card 1: Tes Psikotes -->
                <div class="arrow-card-outer bg-brand-indigo p-[2px] transition-transform duration-300 hover:-translate-y-1 drop-shadow-md">
                    <div class="arrow-card-inner bg-white h-full p-6 pr-12 text-left flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center mb-6 text-brand-indigo">
                                <i data-lucide="file-text" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-lg font-bold text-brand-indigo mb-2">Tes Psikotes</h3>
                            <p class="text-xs text-brand-textGray leading-relaxed mb-6">
                                Uji minat, bakat, kemampuan, dan kepribadian diri secara mendalam.
                            </p>
                        </div>
                        <a href="#" class="inline-flex items-center text-xs font-bold text-brand-coral hover:underline gap-1">
                            Mulai Tes <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 2: Explore Jurusan -->
                <div class="arrow-card-outer bg-brand-indigo p-[2px] transition-transform duration-300 hover:-translate-y-1 drop-shadow-md">
                    <div class="arrow-card-inner bg-white h-full p-6 pr-12 text-left flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center mb-6 text-brand-indigo">
                                <i data-lucide="compass" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-lg font-bold text-brand-indigo mb-2">Explore Jurusan</h3>
                            <p class="text-xs text-brand-textGray leading-relaxed mb-6">
                                Cari data informasi lengkap tentang program studi favorit.
                            </p>
                        </div>
                        <a href="#" class="inline-flex items-center text-xs font-bold text-brand-coral hover:underline gap-1">
                            Jelajahi <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 3: Rencanakan Pendidikan -->
                <div class="arrow-card-outer bg-brand-indigo p-[2px] transition-transform duration-300 hover:-translate-y-1 drop-shadow-md">
                    <div class="arrow-card-inner bg-white h-full p-6 pr-12 text-left flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center mb-6 text-brand-indigo">
                                <i data-lucide="git-fork" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-lg font-bold text-brand-indigo mb-2">Rencanakan Pendidikan</h3>
                            <p class="text-xs text-brand-textGray leading-relaxed mb-6">
                                Buat roadmap rencana studi sesuai target impianmu.
                            </p>
                        </div>
                        <a href="#" class="inline-flex items-center text-xs font-bold text-brand-coral hover:underline gap-1">
                            Atur Target <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 4: Konsultasi BK -->
                <div class="arrow-card-outer bg-brand-indigo p-[2px] transition-transform duration-300 hover:-translate-y-1 drop-shadow-md">
                    <div class="arrow-card-inner bg-white h-full p-6 pr-12 text-left flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center mb-6 text-brand-indigo">
                                <i data-lucide="message-square" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-lg font-bold text-brand-indigo mb-2">Konsultasi BK</h3>
                            <p class="text-xs text-brand-textGray leading-relaxed mb-6">
                                Diskusi langsung bersama Guru BK secara profesional via WhatsApp.
                            </p>
                        </div>
                        <a href="#" class="inline-flex items-center text-xs font-bold text-brand-coral hover:underline gap-1">
                            Jadwalkan <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Fitur Kuis Interaktif Cepat Minat & Bakat -->
    <section id="kuis" class="py-16 sm:py-24 bg-gradient-to-tr from-indigoPrimary/5 via-softSky to-coralOrange/5 relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-coralOrange font-bold text-sm tracking-widest uppercase">Coba Tes Langsung</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-indigoPrimary mt-2">
                    Kuis Cepat Minat & Bakat
                </h2>
                <p class="text-gray-600 mt-2 text-sm sm:text-base">
                    Jawab 3 pertanyaan singkat di bawah ini untuk melihat rekomendasi awal dari Mauny!
                </p>
            </div>

            <div class="bg-white rounded-3xl p-6 sm:p-10 border border-indigoPrimary/10 shadow-xl relative overflow-hidden">
                <!-- Progress Bar Kuis -->
                <div class="mb-8">
                    <div class="flex justify-between text-xs font-bold text-indigoPrimary mb-2">
                        <span id="quiz-progress-text">Pertanyaan 1 dari 3</span>
                        <span id="quiz-progress-percent">33%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                        <div id="quiz-progress-bar" class="bg-gradient-to-r from-indigoPrimary to-coralOrange h-full transition-all duration-300" style="width: 33%"></div>
                    </div>
                </div>

                <!-- Kontainer Pertanyaan Kuis -->
                <div id="quiz-container">
                    <!-- Pertanyaan 1 -->
                    <div class="quiz-step" data-step="1">
                        <h3 class="text-lg sm:text-xl font-bold text-indigoPrimary mb-4">1. Kegiatan apa yang paling kamu nikmati saat ada waktu luang?</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <button onclick="nextQuizStep(1, 'tekno')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-indigoPrimary hover:bg-softSky transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-xl bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center font-bold text-xs group-hover:bg-indigoPrimary group-hover:text-white transition-colors">A</span>
                                <span>Mengkulik aplikasi, koding, atau gadget baru</span>
                            </button>
                            <button onclick="nextQuizStep(1, 'desain')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-indigoPrimary hover:bg-softSky transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-xl bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center font-bold text-xs group-hover:bg-indigoPrimary group-hover:text-white transition-colors">B</span>
                                <span>Menggambar, membuat konten, atau desain digital</span>
                            </button>
                            <button onclick="nextQuizStep(1, 'bisnis')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-indigoPrimary hover:bg-softSky transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-xl bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center font-bold text-xs group-hover:bg-indigoPrimary group-hover:text-white transition-colors">C</span>
                                <span>Merencanakan usaha kecil atau berjualan online</span>
                            </button>
                            <button onclick="nextQuizStep(1, 'sosial')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-indigoPrimary hover:bg-softSky transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-xl bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center font-bold text-xs group-hover:bg-indigoPrimary group-hover:text-white transition-colors">D</span>
                                <span>Berdiskusi, mendengarkan curhat, atau organisasi</span>
                            </button>
                        </div>
                    </div>

                    <!-- Pertanyaan 2 -->
                    <div class="quiz-step hidden" data-step="2">
                        <h3 class="text-lg sm:text-xl font-bold text-indigoPrimary mb-4">2. Lingkungan kerja seperti apa yang kamu cita-citakan?</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <button onclick="nextQuizStep(2, 'tekno')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-indigoPrimary hover:bg-softSky transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-xl bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center font-bold text-xs group-hover:bg-indigoPrimary group-hover:text-white transition-colors">A</span>
                                <span>Perusahaan teknologi modern / Software House</span>
                            </button>
                            <button onclick="nextQuizStep(2, 'desain')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-indigoPrimary hover:bg-softSky transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-xl bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center font-bold text-xs group-hover:bg-indigoPrimary group-hover:text-white transition-colors">B</span>
                                <span>Studio Kreatif, Agensi Desain, atau Media</span>
                            </button>
                            <button onclick="nextQuizStep(2, 'bisnis')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-indigoPrimary hover:bg-softSky transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-xl bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center font-bold text-xs group-hover:bg-indigoPrimary group-hover:text-white transition-colors">C</span>
                                <span>Kantor Korporasi, Startup, atau Bisnis Mandiri</span>
                            </button>
                            <button onclick="nextQuizStep(2, 'sosial')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-indigoPrimary hover:bg-softSky transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-xl bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center font-bold text-xs group-hover:bg-indigoPrimary group-hover:text-white transition-colors">D</span>
                                <span>Lembaga Pendidikan, Konsultan, atau RS/Klinik</span>
                            </button>
                        </div>
                    </div>

                    <!-- Pertanyaan 3 -->
                    <div class="quiz-step hidden" data-step="3">
                        <h3 class="text-lg sm:text-xl font-bold text-indigoPrimary mb-4">3. Apa mata pelajaran sekolah favoritmu?</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <button onclick="showQuizResult('tekno')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-indigoPrimary hover:bg-softSky transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-xl bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center font-bold text-xs group-hover:bg-indigoPrimary group-hover:text-white transition-colors">A</span>
                                <span>Matematika, Informatika, atau Fisika</span>
                            </button>
                            <button onclick="showQuizResult('desain')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-indigoPrimary hover:bg-softSky transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-xl bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center font-bold text-xs group-hover:bg-indigoPrimary group-hover:text-white transition-colors">B</span>
                                <span>Seni Budaya, Bahasa, atau Prakarya</span>
                            </button>
                            <button onclick="showQuizResult('bisnis')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-indigoPrimary hover:bg-softSky transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-xl bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center font-bold text-xs group-hover:bg-indigoPrimary group-hover:text-white transition-colors">C</span>
                                <span>Ekonomi, Akuntansi, atau Kewirausahaan</span>
                            </button>
                            <button onclick="showQuizResult('sosial')" class="p-4 text-left rounded-2xl border border-gray-200 hover:border-indigoPrimary hover:bg-softSky transition-all text-sm font-semibold text-gray-700 flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-xl bg-indigoPrimary/10 text-indigoPrimary flex items-center justify-center font-bold text-xs group-hover:bg-indigoPrimary group-hover:text-white transition-colors">D</span>
                                <span>Sosiologi, Geografi, atau Bimbingan Konseling</span>
                            </button>
                        </div>
                    </div>

                    <!-- Hasil Kuis -->
                    <div id="quiz-result" class="hidden text-center space-y-6">
                        <div class="w-20 h-20 bg-coralOrange/10 rounded-full flex items-center justify-center mx-auto text-coralOrange text-4xl">
                            🐉
                        </div>
                        <h3 class="text-2xl font-extrabold text-indigoPrimary" id="result-title">Rekomendasi Awal Mauny:</h3>
                        <p class="text-gray-600 text-sm max-w-lg mx-auto leading-relaxed" id="result-desc">
                            Berdasarkan jawabanmu, kamu memiliki potensi kuat di bidang Teknologi Informasi dan Rekayasa Perangkat Lunak!
                        </p>
                        <div class="pt-2">
                            <button onclick="resetQuiz()" class="bg-indigoPrimary hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold text-xs sm:text-sm transition-all shadow-md">
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
                    <h4 class="font-bold text-indigoPrimary text-sm mb-1">Hasil Tes Psikotes</h4>
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

    <!-- SECTION: Rekomendasi Universitas & Fitur Pencarian Interaktif -->
    <section id="rekomendasi" class="py-16 sm:py-24 bg-softSky relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-10">
                <span class="text-coralOrange font-bold text-sm tracking-widest uppercase">Pilihan Kampus & Jurusan</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-indigoPrimary mt-2">
                    Rekomendasi Universitas Sesuai Potensimu
                </h2>
                <p class="text-gray-600 mt-2 text-sm sm:text-base">
                    Sistem pemetaan pintar MyUniv mencocokkan profil minat, bakat, dan akademismu dengan kampus impian.
                </p>
            </div>

            <!-- Fitur Search Bar Kampus -->
            <div class="max-w-md mx-auto mb-12">
                <div class="relative">
                    <input type="text" id="searchCampus" onkeyup="filterCards()" placeholder="Cari jurusan atau nama kampus..." class="w-full px-5 py-3 pl-12 rounded-2xl border border-indigoPrimary/20 focus:outline-none focus:ring-2 focus:ring-indigoPrimary/50 text-sm shadow-sm bg-white">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 items-start">
                <!-- Sidebar Asesmen -->
                <div class="lg:col-span-4 bg-white rounded-2xl p-6 border border-indigoPrimary/10 shadow-md relative overflow-hidden">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                        <div class="w-12 h-12 bg-indigoPrimary rounded-xl flex items-center justify-center text-white text-xl shadow-md">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-indigoPrimary text-lg">Hasil Asesmenku</h3>
                            <p class="text-xs text-gray-500">Ringkasan Psikotes & TKA</p>
                        </div>
                    </div>

                    <div class="space-y-4 text-sm">
                        <div>
                            <div class="flex justify-between text-xs font-semibold mb-1">
                                <span class="text-indigoPrimary">Logika & Sains Data</span>
                                <span class="text-coralOrange font-bold">92%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-indigoPrimary h-2 rounded-full" style="width: 92%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-xs font-semibold mb-1">
                                <span class="text-indigoPrimary">Desain & Kreativitas</span>
                                <span class="text-coralOrange font-bold">88%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-coralOrange h-2 rounded-full" style="width: 88%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-xs font-semibold mb-1">
                                <span class="text-indigoPrimary">Manajemen & Komunikasi</span>
                                <span class="text-coralOrange font-bold">75%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-indigoPrimary/70 h-2 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100">
                        <span class="text-xs font-semibold text-gray-500 block mb-2">Karakter Utama:</span>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-softSky text-indigoPrimary text-xs font-bold px-3 py-1 rounded-lg border border-indigoPrimary/20"><i class="fa-solid fa-bolt text-coralOrange mr-1"></i> Analitis</span>
                            <span class="bg-softSky text-indigoPrimary text-xs font-bold px-3 py-1 rounded-lg border border-indigoPrimary/20"><i class="fa-solid fa-lightbulb text-amber-500 mr-1"></i> Problem Solver</span>
                            <span class="bg-softSky text-indigoPrimary text-xs font-bold px-3 py-1 rounded-lg border border-indigoPrimary/20"><i class="fa-solid fa-palette text-purple-500 mr-1"></i> Kreatif</span>
                        </div>
                    </div>

                    <div class="mt-6 bg-indigoPrimary/5 rounded-xl p-4 border border-indigoPrimary/15 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white p-1 border border-indigoPrimary/20 shrink-0">
                            <img src="image_88917e.jpg" onerror="this.onerror=null; this.src='https://placehold.co/100x100/F4FAFF/3650A2?text=Mauny'" alt="Mauny" class="w-full h-full rounded-full object-cover">
                        </div>
                        <p class="text-xs text-indigoPrimary leading-tight">
                            <strong class="block text-coralOrange">Catatan Mauny:</strong>
                            Potensimu tinggi di bidang teknologi & kreatif! Cek pilihan kampus di samping.
                        </p>
                    </div>
                </div>

                <!-- Campus Grid -->
                <div class="lg:col-span-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6" id="campusGrid">

                    <!-- Kampus 1 -->
                    <div class="campus-card bg-white rounded-2xl border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                        <div>
                            <div class="bg-gradient-to-r from-indigoPrimary to-indigo-700 p-4 text-white relative">
                                <span class="absolute top-3 right-3 bg-coralOrange text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider">Top Match 96%</span>
                                <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center text-white mb-2">
                                    <i class="fa-solid fa-building-columns text-lg"></i>
                                </div>
                                <h4 class="font-extrabold text-base leading-snug campus-title">Universitas Indonesia / ITB</h4>
                                <p class="text-xs text-indigo-100">PTN - Akreditasi Unggul</p>
                            </div>
                            <div class="p-5 space-y-3">
                                <div>
                                    <span class="text-xs text-gray-400 block font-medium">Rekomendasi Program Studi:</span>
                                    <span class="font-bold text-indigoPrimary text-sm block mt-0.5 campus-major">Teknik Informatika / Data Science</span>
                                </div>
                                <div class="text-xs text-gray-600 space-y-1">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-graduation-cap text-coralOrange"></i>
                                        <span>Daya Tampung: 120 Kursi</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-briefcase text-indigoPrimary"></i>
                                        <span>Prospek: Software Engineer, AI Specialist</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 pt-0">
                            <a href="#detail" class="w-full bg-softSky hover:bg-indigoPrimary hover:text-white text-indigoPrimary text-xs font-bold py-2.5 rounded-xl transition-all flex items-center justify-center gap-2 border border-indigoPrimary/10">
                                <span>Lihat Detail Kampus</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Kampus 2 -->
                    <div class="campus-card bg-white rounded-2xl border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                        <div>
                            <div class="bg-gradient-to-r from-indigoPrimary to-indigo-700 p-4 text-white relative">
                                <span class="absolute top-3 right-3 bg-indigoPrimary/80 border border-white/30 text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider">Match 89%</span>
                                <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center text-white mb-2">
                                    <i class="fa-solid fa-building-columns text-lg"></i>
                                </div>
                                <h4 class="font-extrabold text-base leading-snug campus-title">Telkom University</h4>
                                <p class="text-xs text-indigo-100">PTS - Akreditasi Unggul</p>
                            </div>
                            <div class="p-5 space-y-3">
                                <div>
                                    <span class="text-xs text-gray-400 block font-medium">Rekomendasi Program Studi:</span>
                                    <span class="font-bold text-indigoPrimary text-sm block mt-0.5 campus-major">Desain Komunikasi Visual (DKV)</span>
                                </div>
                                <div class="text-xs text-gray-600 space-y-1">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-graduation-cap text-coralOrange"></i>
                                        <span>Daya Tampung: 200 Kursi</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-briefcase text-indigoPrimary"></i>
                                        <span>Prospek: UI/UX Designer, Art Director</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 pt-0">
                            <a href="#detail" class="w-full bg-softSky hover:bg-indigoPrimary hover:text-white text-indigoPrimary text-xs font-bold py-2.5 rounded-xl transition-all flex items-center justify-center gap-2 border border-indigoPrimary/10">
                                <span>Lihat Detail Kampus</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Kampus 3 -->
                    <div class="campus-card bg-white rounded-2xl border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col justify-between group">
                        <div>
                            <div class="bg-gradient-to-r from-indigoPrimary to-indigo-700 p-4 text-white relative">
                                <span class="absolute top-3 right-3 bg-indigoPrimary/80 border border-white/30 text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider">Match 84%</span>
                                <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center text-white mb-2">
                                    <i class="fa-solid fa-building-columns text-lg"></i>
                                </div>
                                <h4 class="font-extrabold text-base leading-snug campus-title">Universitas Padjadjaran</h4>
                                <p class="text-xs text-indigo-100">PTN - Akreditasi Unggul</p>
                            </div>
                            <div class="p-5 space-y-3">
                                <div>
                                    <span class="text-xs text-gray-400 block font-medium">Rekomendasi Program Studi:</span>
                                    <span class="font-bold text-indigoPrimary text-sm block mt-0.5 campus-major">Bisnis Digital / Manajemen</span>
                                </div>
                                <div class="text-xs text-gray-600 space-y-1">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-graduation-cap text-coralOrange"></i>
                                        <span>Daya Tampung: 90 Kursi</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-briefcase text-indigoPrimary"></i>
                                        <span>Prospek: Digital Marketer, Consultant</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 pt-0">
                            <a href="#detail" class="w-full bg-softSky hover:bg-indigoPrimary hover:text-white text-indigoPrimary text-xs font-bold py-2.5 rounded-xl transition-all flex items-center justify-center gap-2 border border-indigoPrimary/10">
                                <span>Lihat Detail Kampus</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

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
                                <h4 class="font-bold text-sm text-indigoPrimary" id="spotlight-author">Anisa Rahmawati</h4>
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
                            <h4 class="font-bold text-xs text-indigoPrimary">Anisa Rahmawati</h4>
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
                            <h4 class="font-bold text-xs text-indigoPrimary">Budi Santoso</h4>
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
                            <h4 class="font-bold text-xs text-indigoPrimary">Citra Dewi</h4>
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
                        <span>Apakah tes psikotes peminatan ini gratis?</span>
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
                <button onclick="openModal('daftar')" class="w-full sm:w-auto bg-coralOrange hover:bg-orange-600 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-coralOrange/30 hover:shadow-xl transition-all transform hover:-translate-y-1 text-sm">
                    Daftar Sekarang
                </button>
                <a href="#alur" class="w-full sm:w-auto border-2 border-white/40 hover:border-white text-white font-bold px-8 py-4 rounded-xl transition-all hover:bg-white/10 text-sm">
                    Pelajari Alur
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 pt-16 pb-12 text-xs text-gray-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

                <!-- Col 1: Platform Info -->
                <div class="space-y-4">
                    <a href="#beranda" class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-gradient-to-tr from-indigoPrimary to-indigo-600 rounded-xl flex items-center justify-center text-white shadow-md">
                            <i class="fa-solid fa-graduation-cap text-base"></i>
                        </div>
                        <span class="font-extrabold text-2xl tracking-tight text-indigoPrimary">
                            MyUniv<span class="text-coralOrange">.</span>
                        </span>
                    </a>
                    <p class="text-gray-500 leading-relaxed text-xs">
                        Platform tes minat bakat interaktif berbasis AI yang mendampingi siswa SMA/SMK dalam menemukan jurusan perkuliahan & karir impian bersama maskot Mauny.
                    </p>
                    <div class="pt-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 block mb-1">Pengembang</span>
                        <span class="font-bold text-indigoPrimary text-xs">SKYNIS Prism (Anisa & Rafly)</span>
                    </div>
                </div>

                <!-- Col 2: Sekolah Mitra -->
                <div class="space-y-3">
                    <h5 class="font-extrabold text-indigoPrimary text-sm uppercase tracking-wider">Sekolah Mitra / Pengembang</h5>
                    <p class="font-bold text-gray-800 text-xs">SMK Budi Bakti Ciwidey</p>
                    <p class="leading-relaxed text-gray-500">
                        Jl. Babakan Tiga No. 82, Ciwidey, Kec. Ciwidey, Kabupaten Bandung, Jawa Barat 40925
                    </p>
                    <div class="pt-1 space-y-1 text-gray-500">
                        <p><i class="fa-solid fa-phone text-coralOrange mr-2"></i>(022) 5928123 / Hotline BK</p>
                        <p><i class="fa-solid fa-envelope text-coralOrange mr-2"></i>info@smkbudibakticiwidey.sch.id</p>
                    </div>
                </div>

                <!-- Col 3: Tautan Cepat -->
                <div class="space-y-3">
                    <h5 class="font-extrabold text-indigoPrimary text-sm uppercase tracking-wider">Tautan Cepat</h5>
                    <ul class="space-y-2 text-gray-600 font-medium">
                        <li><a href="#beranda" class="hover:text-coralOrange transition-colors flex items-center gap-1.5"><i class="fa-solid fa-angle-right text-[10px] text-coralOrange"></i> Beranda</a></li>
                        <li><a href="#tentang" class="hover:text-coralOrange transition-colors flex items-center gap-1.5"><i class="fa-solid fa-angle-right text-[10px] text-coralOrange"></i> Tentang MyUniv</a></li>
                        <li><a href="#fitur" class="hover:text-coralOrange transition-colors flex items-center gap-1.5"><i class="fa-solid fa-angle-right text-[10px] text-coralOrange"></i> Fitur Utama</a></li>
                        <li><a href="#alur" class="hover:text-coralOrange transition-colors flex items-center gap-1.5"><i class="fa-solid fa-angle-right text-[10px] text-coralOrange"></i> Alur 5-Step</a></li>
                        <li><a href="#faq" class="hover:text-coralOrange transition-colors flex items-center gap-1.5"><i class="fa-solid fa-angle-right text-[10px] text-coralOrange"></i> FAQ</a></li>
                    </ul>
                </div>

                <!-- Col 4: Maps & Lokasi -->
                <div class="space-y-3">
                    <h5 class="font-extrabold text-indigoPrimary text-sm uppercase tracking-wider">Petunjuk Lokasi Google Maps</h5>
                    <div class="w-full h-32 bg-gray-200 rounded-2xl overflow-hidden border border-gray-200 relative group">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.907312154245!2d107.4582!3d-7.0903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e688c2f1f0e4271%3A0x6291a27e7b561081!2sSMK%20Budi%20Bakti%20Ciwidey!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                            class="w-full h-full border-0 grayscale group-hover:grayscale-0 transition-all duration-300"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>

            <div class="pt-8 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-gray-400 text-[11px]">
                <p>&copy; 2026 MyUniv - SKYNIS Prism SMK Budi Bakti Ciwidey. All rights reserved.</p>
                <div class="flex space-x-4 text-sm text-indigoPrimary">
                    <a href="#" class="hover:text-coralOrange transition-colors"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="hover:text-coralOrange transition-colors"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="hover:text-coralOrange transition-colors"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Chatbot Floating Widget Mauny -->
    <div class="fixed bottom-6 right-6 z-50">
        <!-- Floating Toggle Button -->
        <button onclick="toggleChatbot()" class="relative bg-gradient-to-tr from-indigoPrimary to-indigo-600 hover:from-coralOrange hover:to-orange-600 text-white p-3.5 sm:p-4 rounded-full shadow-2xl transition-all duration-300 transform hover:scale-110 flex items-center justify-center group border-2 border-white/50">
            <span class="absolute -top-1 -right-1 flex h-3.5 w-3.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-coralOrange opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-coralOrange"></span>
            </span>
            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full overflow-hidden shrink-0 border border-white/40">
                <img src="image_88917e.jpg" onerror="this.onerror=null; this.src='https://placehold.co/100x100/3650A2/FFFFFF?text=Mauny'" alt="Mauny Chat" class="w-full h-full object-cover">
            </div>
        </button>

        <!-- Chatbot Window Container -->
        <div id="chatbotContainer" class="hidden absolute bottom-16 right-0 w-[88vw] sm:w-[360px] bg-white/95 backdrop-blur-xl border border-indigoPrimary/20 rounded-3xl shadow-2xl overflow-hidden transition-all duration-300 transform origin-bottom-right">
            <!-- Header Chatbot -->
            <div class="bg-gradient-to-r from-indigoPrimary to-indigo-700 p-4 text-white flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-white/20 border border-white/30 p-0.5 overflow-hidden">
                        <img src="image_88917e.jpg" onerror="this.onerror=null; this.src='https://placehold.co/100x100/FFFFFF/3650A2?text=Mauny'" alt="Mauny AI" class="w-full h-full rounded-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-extrabold text-sm leading-tight">Asisten Mauny 🐉</h4>
                        <span class="text-[10px] text-emerald-300 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Online AI Assistant
                        </span>
                    </div>
                </div>
                <button onclick="toggleChatbot()" class="text-white/80 hover:text-white text-lg px-2">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Area Percakapan Chat -->
            <div id="chatMessages" class="p-4 h-72 overflow-y-auto space-y-3 text-xs bg-softSky/50">
                <div class="flex items-start gap-2 max-w-[85%]">
                    <div class="w-7 h-7 rounded-full bg-indigoPrimary text-white flex items-center justify-center shrink-0 font-bold text-[10px]">🐉</div>
                    <div class="bg-white border border-indigoPrimary/10 p-3 rounded-2xl rounded-tl-none shadow-sm text-gray-700 leading-relaxed">
                        Halo! Aku Mauny 🐉 Ada yang bisa kubantu terkait jurusan kuliah atau kampus impianmu hari ini?
                    </div>
                </div>
            </div>

            <!-- Quick Action Chips -->
            <div class="px-3 py-2 bg-white border-t border-gray-100 flex gap-2 overflow-x-auto no-scrollbar text-[11px]">
                <button onclick="sendQuickMessage('Rekomendasi jurusan RPL')" class="bg-indigoPrimary/10 hover:bg-indigoPrimary hover:text-white text-indigoPrimary px-2.5 py-1 rounded-full whitespace-nowrap font-medium transition-colors">
                    💻 Jurusan RPL
                </button>
                <button onclick="sendQuickMessage('Cara daftar tes')" class="bg-indigoPrimary/10 hover:bg-indigoPrimary hover:text-white text-indigoPrimary px-2.5 py-1 rounded-full whitespace-nowrap font-medium transition-colors">
                    📝 Cara Tes
                </button>
            </div>

            <!-- Input Form Chatbot -->
            <div class="p-3 bg-white border-t border-gray-100">
                <form onsubmit="handleChatSubmit(event)" class="flex gap-2">
                    <input type="text" id="chatInput" placeholder="Ketik pertanyaanmu..." class="flex-1 bg-softSky border border-indigoPrimary/15 rounded-xl px-3 py-2 text-xs focus:outline-none focus:ring-1 focus:ring-indigoPrimary text-gray-800">
                    <button type="submit" class="bg-coralOrange hover:bg-orange-600 text-white px-3 py-2 rounded-xl text-xs font-bold transition-all shadow">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript Interactivity & Lucide Initialization -->
    <script>
        // Inisialisasi Lucide Icon dari Code 1
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        function toggleChatbot() {
            const chatbot = document.getElementById('chatbotContainer');
            chatbot.classList.toggle('hidden');
        }

        // Accordion FAQ Interactivity
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            item.addEventListener('click', () => {
                const p = item.querySelector('p');
                const icon = item.querySelector('i');
                const isHidden = p.classList.contains('hidden');

                faqItems.forEach(other => {
                    other.querySelector('p').classList.add('hidden');
                    other.querySelector('i').style.transform = 'rotate(0deg)';
                });

                if (isHidden) {
                    p.classList.remove('hidden');
                    icon.style.transform = 'rotate(180deg)';
                }
            });
        });

        // Filter Cards Kampus (Pencarian Rekomendasi Kampus)
        function filterCards() {
            const query = document.getElementById('searchCampus').value.toLowerCase();
            const cards = document.querySelectorAll('.campus-card');

            cards.forEach(card => {
                const title = card.querySelector('.campus-title').textContent.toLowerCase();
                const major = card.querySelector('.campus-major').textContent.toLowerCase();

                if (title.includes(query) || major.includes(query)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Interaktivitas Percaya Diri Melangkah (Testimonial Spotlight)
        const testimonialData = {
            1: {
                text: '"Tesnya sangat interaktif dan hasilnya sesuai banget dengan minat koding saya. Rekomendasi kampusnya membantu saya menentukan SNBP!"',
                author: 'Anisa Rahmawati',
                role: 'Siswa XII RPL - Lolos SNBP Teknik Informatika',
                avatar: 'A'
            },
            2: {
                text: '"Awalnya bingung bedanya S1 dan D4, tapi lewat fitur Education Planning di MyUniv semuanya jadi terstruktur dengan rapi."',
                author: 'Budi Santoso',
                role: 'Siswa XII TKJ - Persiapan Mandiri Telkom Univ',
                avatar: 'B'
            },
            3: {
                text: '"Fitur konsultasi ke Guru BK via WhatsApp gampang banget, tinggal klik langsung terhubung dengan template pesan yang sopan."',
                author: 'Citra Dewi',
                role: 'Siswa XII AKL - Lolos SNBP Akuntansi',
                avatar: 'C'
            }
        };

        function setActiveTestimonial(id) {
            const spotlightText = document.getElementById('spotlight-text');
            const spotlightAuthor = document.getElementById('spotlight-author');
            const spotlightRole = document.getElementById('spotlight-role');
            const spotlightAvatar = document.getElementById('spotlight-avatar');

            if (testimonialData[id]) {
                spotlightText.textContent = testimonialData[id].text;
                spotlightAuthor.textContent = testimonialData[id].author;
                spotlightRole.textContent = testimonialData[id].role;
                spotlightAvatar.textContent = testimonialData[id].avatar;

                document.querySelectorAll('.testi-card').forEach(card => {
                    card.classList.remove('border-2', 'border-coralOrange', 'ring-2', 'ring-coralOrange/20');
                    card.classList.add('border', 'border-gray-200', 'opacity-80');
                });

                const activeCard = document.getElementById(`testi-card-${id}`);
                if (activeCard) {
                    activeCard.classList.remove('border', 'border-gray-200', 'opacity-80');
                    activeCard.classList.add('border-2', 'border-coralOrange', 'ring-2', 'ring-coralOrange/20');
                }
            }
        }

        // Kuis Interaktif Steps & Logic
        function nextQuizStep(currentStep, category) {
            const currentStepEl = document.querySelector(`.quiz-step[data-step="${currentStep}"]`);
            const nextStepEl = document.querySelector(`.quiz-step[data-step="${currentStep + 1}"]`);

            if (currentStepEl && nextStepEl) {
                currentStepEl.classList.add('hidden');
                nextStepEl.classList.remove('hidden');

                const percent = Math.round(((currentStep + 1) / 3) * 100);
                document.getElementById('quiz-progress-text').textContent = `Pertanyaan ${currentStep + 1} dari 3`;
                document.getElementById('quiz-progress-percent').textContent = `${percent}%`;
                document.getElementById('quiz-progress-bar').style.width = `${percent}%`;
            }
        }

        function showQuizResult(category) {
            document.querySelectorAll('.quiz-step').forEach(step => step.classList.add('hidden'));
            const resultEl = document.getElementById('quiz-result');
            resultEl.classList.remove('hidden');

            document.getElementById('quiz-progress-text').textContent = 'Selesai!';
            document.getElementById('quiz-progress-percent').textContent = '100%';
            document.getElementById('quiz-progress-bar').style.width = '100%';

            const titleEl = document.getElementById('result-title');
            const descEl = document.getElementById('result-desc');

            if (category === 'tekno') {
                titleEl.textContent = 'Rekomendasi Awal Mauny: Bidang Teknologi & IT 💻';
                descEl.textContent = 'Kamu memiliki ketertarikan tinggi pada logika, pemrograman, dan teknologi digital! Jurusan yang pas: Teknik Informatika, Rekayasa Perangkat Lunak, atau Data Science.';
            } else if (category === 'desain') {
                titleEl.textContent = 'Rekomendasi Awal Mauny: Bidang Industri Kreatif 🎨';
                descEl.textContent = 'Jiwa seni dan visualmu sangat menonjol! Jurusan rekomendasi: Desain Komunikasi Visual (DKV), Desain Produk, Animasi, atau UI/UX Design.';
            } else if (category === 'bisnis') {
                titleEl.textContent = 'Rekomendasi Awal Mauny: Bidang Bisnis & Manajemen 📊';
                descEl.textContent = 'Kamu bakat dalam kepemimpinan dan analisis peluang! Jurusan rekomendasi: Bisnis Digital, Manajemen, Kewirausahaan, atau Akuntansi.';
            } else {
                titleEl.textContent = 'Rekomendasi Awal Mauny: Bidang Humaniora & Sosial 🤝';
                descEl.textContent = 'Kamu memiliki kepedulian sosial dan komunikasi interpersonal yang baik! Jurusan rekomendasi: Psikologi, Ilmu Komunikasi, atau Bimbingan Konseling.';
            }
        }

        function resetQuiz() {
            document.getElementById('quiz-result').classList.add('hidden');
            document.querySelectorAll('.quiz-step').forEach((step, idx) => {
                if (idx === 0) step.classList.remove('hidden');
                else step.classList.add('hidden');
            });

            document.getElementById('quiz-progress-text').textContent = 'Pertanyaan 1 dari 3';
            document.getElementById('quiz-progress-percent').textContent = '33%';
            document.getElementById('quiz-progress-bar').style.width = '33%';
        }

        // Chatbot Handlers
        function sendQuickMessage(text) {
            const input = document.getElementById('chatInput');
            input.value = text;
            handleChatSubmit(new Event('submit'));
        }

        function handleChatSubmit(e) {
            e.preventDefault();
            const input = document.getElementById('chatInput');
            const message = input.value.trim();
            if (!message) return;

            const chatMessages = document.getElementById('chatMessages');

            // User Message
            const userBubble = document.createElement('div');
            userBubble.className = 'flex items-start gap-2 justify-end max-w-[85%] ml-auto';
            userBubble.innerHTML = `
                <div class="bg-indigoPrimary text-white p-3 rounded-2xl rounded-tr-none shadow-sm leading-relaxed">
                    ${message}
                </div>
            `;
            chatMessages.appendChild(userBubble);
            input.value = '';
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Bot Response Simulation
            setTimeout(() => {
                const botBubble = document.createElement('div');
                botBubble.className = 'flex items-start gap-2 max-w-[85%]';
                botBubble.innerHTML = `
                    <div class="w-7 h-7 rounded-full bg-indigoPrimary text-white flex items-center justify-center shrink-0 font-bold text-[10px]">🐉</div>
                    <div class="bg-white border border-indigoPrimary/10 p-3 rounded-2xl rounded-tl-none shadow-sm text-gray-700 leading-relaxed">
                        Terima kasih pertanyaannya! Mauny menyarankan kamu untuk mencoba fitur <strong>Tes Psikotes</strong> atau mengecek halaman <strong>Rekomendasi Kampus</strong> untuk informasi lebih detail.
                    </div>
                `;
                chatMessages.appendChild(botBubble);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 800);
        }
    </script>
</body>
</html>
