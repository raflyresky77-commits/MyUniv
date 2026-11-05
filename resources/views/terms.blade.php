<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat & Ketentuan | MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #E2EEFF 0%, #F4F7FF 50%, #FFF0EC 100%);
            min-height: 100vh;
        }
        .myuniv-gradient { background: linear-gradient(135deg, #3650A2 0%, #1E2D62 100%); }

        /* Gaya Glassmorphism Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 20px 50px rgba(54, 80, 162, 0.1);
        }
    </style>
</head>
<body class="text-slate-800 relative overflow-x-hidden selection:bg-[#FF7A59] selection:text-white">

    <!-- Dekorasi Background Blobs Cahaya -->
    <div class="absolute top-10 left-10 w-[500px] h-[500px] bg-[#3650A2]/10 rounded-full blur-[100px] pointer-events-none -z-10"></div>
    <div class="absolute bottom-10 right-10 w-[500px] h-[500px] bg-[#FF7A59]/10 rounded-full blur-[100px] pointer-events-none -z-10"></div>

    <main class="min-h-screen px-4 py-12 sm:px-6 flex items-center justify-center relative z-10">
        <div class="w-full max-w-3xl">

            <!-- Header Ringkas -->
            <div class="text-center mb-6">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2.5 mb-3 group">
                    <div class="w-10 h-10 rounded-xl bg-white/80 backdrop-blur-md border border-indigo-100 p-2 shadow-sm group-hover:scale-105 transition">
                        <img src="{{ asset('images/icon.png') }}" onerror="this.src='https://placehold.co/100x100/F4FAFF/3650A2?text=M'" alt="MyUniv" class="w-full h-full object-contain">
                    </div>
                    <span class="text-xl font-black tracking-tight text-[#3650A2]">MyUniv<span class="text-[#FF7A59]">.</span></span>
                </a>
                <span class="block text-[11px] font-extrabold uppercase tracking-[.18em] text-[#FF7A59] mb-1">Kebijakan Pengguna</span>
                <h1 class="text-2xl sm:text-3xl font-black text-[#1E2D62]">Syarat & Ketentuan</h1>
                <p class="mt-1 text-xs sm:text-sm text-slate-500 max-w-lg mx-auto font-medium">
                    Ketentuan layanan dan pedoman penggunaan platform MyUniv bagi seluruh siswa dan sekolah mitra.
                </p>
            </div>

            <!-- Card Utama Glassmorphism -->
            <section class="glass-card rounded-[32px] overflow-hidden">

                <!-- Banner Top Card -->
                <div class="myuniv-gradient px-6 py-6 sm:px-8 sm:py-7 text-white relative">
                    <span class="inline-block px-3 py-1 rounded-full bg-white/15 text-[10px] font-extrabold uppercase tracking-widest text-indigo-100 mb-2">Pembaruan Terakhir: 2026</span>
                    <h2 class="text-xl sm:text-2xl font-black tracking-tight">Ketentuan Layanan MyUniv</h2>
                    <p class="text-xs text-indigo-100 mt-1 font-medium">Harap baca dengan seksama sebelum menggunakan fitur asesmen dan rekomendasi.</p>
                </div>

                <!-- Konten Syarat & Ketentuan -->
                <div class="p-6 sm:p-10 space-y-6 text-slate-600 text-xs sm:text-sm leading-relaxed">

                    <div class="space-y-2">
                        <h3 class="font-extrabold text-[#1E2D62] text-sm sm:text-base flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-indigo-50 text-[#3650A2] flex items-center justify-center text-xs font-black">1</span>
                            Penerimaan Ketentuan
                        </h3>
                        <p class="pl-8 font-medium">
                            Dengan mengakses atau menggunakan platform MyUniv, Anda menyatakan bahwa Anda telah membaca, memahami, dan menyetujui untuk terikat dengan syarat dan ketentuan yang berlaku di platform ini.
                        </p>
                    </div>

                    <div class="space-y-2">
                        <h3 class="font-extrabold text-[#1E2D62] text-sm sm:text-base flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-indigo-50 text-[#3650A2] flex items-center justify-center text-xs font-black">2</span>
                            Akun & Keamanan Data Siswa
                        </h3>
                        <p class="pl-8 font-medium">
                            Pengguna wajib memasukkan informasi data diri yang valid (seperti nama lengkap dan NISN yang sesuai). Seluruh data hasil asesmen minat & bakat dilindungi kerahasiaannya dan hanya digunakan untuk keperluan bimbingan konseling di sekolah mitra.
                        </p>
                    </div>

                    <div class="space-y-2">
                        <h3 class="font-extrabold text-[#1E2D62] text-sm sm:text-base flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-indigo-50 text-[#3650A2] flex items-center justify-center text-xs font-black">3</span>
                            Hasil Asesmen & Rekomendasi Kampus
                        </h3>
                        <p class="pl-8 font-medium">
                            Rekomendasi jurusan dan universitas yang dihasilkan oleh sistem (bersama maskot Mauny) bersifat sebagai referensi pendukung dan panduan perencanaan masa depan, yang dapat dikonsultasikan lebih lanjut kepada Guru BK sekolah.
                        </p>
                    </div>

                    <div class="space-y-2">
                        <h3 class="font-extrabold text-[#1E2D62] text-sm sm:text-base flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-indigo-50 text-[#3650A2] flex items-center justify-center text-xs font-black">4</span>
                            Hak Kekayaan Intelektual
                        </h3>
                        <p class="pl-8 font-medium">
                            Seluruh konten, desain antarmuka, maskot, logo, dan kode sumber pada platform MyUniv adalah hak milik resmi dari tim pengembang dan instansi mitra terkait.
                        </p>
                    </div>

                    <!-- Tombol Kembali -->
                    <div class="pt-6 border-t border-indigo-100 flex items-center justify-between">
                        <a href="{{ url('/') }}" class="bg-white/80 hover:bg-white text-slate-700 rounded-xl px-5 py-3 text-xs font-extrabold transition border border-slate-200 flex items-center gap-2 shadow-xs">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Kembali ke Beranda</span>
                        </a>

                        <a href="{{ url()->previous() }}" class="myuniv-gradient rounded-xl px-6 py-3 text-xs font-black text-white shadow-md hover:opacity-95 transition flex items-center gap-2">
                            <span>Kembali Sebelumnya</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>

                </div>
            </section>

            <p class="text-center text-[10px] text-slate-500 mt-6 font-medium">© {{ date('Y') }} MyUniv · Sistem Informasi Peminatan Siswa</p>
        </div>
    </main>
</body>
</html>
