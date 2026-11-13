<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MyUniv</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #F4FAFF;
            background-image:
                radial-gradient(circle at 88% 12%, rgba(54, 80, 162, 0.18) 0%, transparent 45%),
                radial-gradient(circle at 12% 88%, rgba(255, 122, 89, 0.16) 0%, transparent 45%),
                radial-gradient(circle at 50% 50%, rgba(201, 215, 238, 0.25) 0%, transparent 60%);
        }

        /* Bingkai Glassmorphism di Luar Card Utama */
        .glass-outer-frame {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1.5px solid rgba(255, 255, 255, 0.85);
            box-shadow:
                0 25px 60px -15px rgba(54, 80, 162, 0.18),
                inset 0 1px 1px rgba(255, 255, 255, 0.9);
            padding: 12px;
            border-radius: 38px;
            width: 100%;
            max-width: 1174px;
            transition: all 0.3s ease;
        }

        /* Efek kurva gelombang khas */
        .wave-curve {
            background: #FFFFFF;
            border-bottom-right-radius: 160px;
            border-top-left-radius: 26px;
            border-bottom-left-radius: 26px;
            overflow: hidden;
            position: relative;
        }
        @media (max-width: 1024px) {
            .wave-curve {
                border-bottom-right-radius: 0;
                border-radius: 0;
            }
        }

        /* Responsif halaman register & glass frame */
        @media (max-width: 1023px) {
            body {
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                min-height: 100svh;
                padding: 16px !important;
                box-sizing: border-box;
            }

            .glass-outer-frame {
                max-width: 446px;
                padding: 8px;
                border-radius: 28px;
                margin: auto;
                transform: translateY(-20px);
            }

            .register-card {
                width: 100%;
                max-width: 100%;
                margin: 0;
                transform: none !important;
                border-radius: 22px;
                flex-shrink: 0;
            }

            .register-illustration {
                padding: 8px !important;
            }

            .register-illustration .wave-curve {
                height: 210px;
                min-height: 210px;
                border-radius: 16px;
            }

            .register-form {
                padding: 22px 24px 20px !important;
            }
        }

        @media (min-width: 1024px) {
            .register-card {
                min-height: 650px;
            }
            .register-illustration .wave-curve {
                min-height: 620px;
            }
        }
    </style>
</head>
<body class="min-h-screen font-['Plus_Jakarta_Sans'] flex items-center justify-center p-4 sm:p-6 lg:p-8 relative overflow-x-hidden">

    <!-- Aksen Dekoratif Ambient Glow di Belakang Bingkai Kaca -->
    <div class="pointer-events-none fixed -top-24 -right-24 w-96 h-96 rounded-full bg-[#3650A2]/15 blur-3xl -z-10"></div>
    <div class="pointer-events-none fixed -bottom-24 -left-24 w-96 h-96 rounded-full bg-[#FF7A59]/15 blur-3xl -z-10"></div>

    <!-- Outer Border Glassmorphism Wrapper -->
    <div class="glass-outer-frame">

        <!-- Container Utama Card -->
        <main class="register-card w-full bg-[#3650A2] rounded-[28px] overflow-hidden shadow-[0_12px_32px_rgba(54,80,162,0.22)] relative flex flex-col lg:flex-row justify-between border border-white/15">

            <div class="grid grid-cols-1 lg:grid-cols-12 w-full">

                {{-- KIRI: AREA ILUSTRASI DENGAN KURVA GELOMBANG --}}
                <section class="register-illustration lg:col-span-7 bg-[#3650A2] relative z-10 p-2 sm:p-3 lg:p-3">
                    <div class="wave-curve h-[260px] sm:h-[320px] lg:h-full min-h-[340px] w-full relative flex flex-col justify-between shadow-sm">

                        {{-- Gambar Ilustrasi Full Cover di dalam Kurva --}}
                        <div class="absolute inset-0 w-full h-full overflow-hidden">
                            <img src="{{ asset('images/ilustrasi.jpg') }}" alt="Ilustrasi MyUniv" class="w-full h-full object-cover object-center">
                        </div>

                        {{-- Logo & Instansi (Floating di atas gambar) --}}
                        <div class="relative z-20 p-5 sm:p-6">
                            <div class="inline-flex items-center gap-2.5 sm:gap-3 bg-white/90 backdrop-blur-md px-3.5 py-2 rounded-xl border border-[#C9D7EE] shadow-sm">
                                <div class="w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center">
                                    <img src="{{ asset('images/icon.jpg') }}" alt="Logo MyUniv" class="w-full h-full object-contain">
                                </div>
                                <div>
                                    <h2 class="text-xs font-bold text-[#2F3136] leading-tight">MyUniv</h2>
                                    <p class="text-[9px] sm:text-[10px] text-[#6E7178] font-medium">Sistem Informasi Peminatan Siswa</p>
                                </div>
                            </div>
                        </div>

                        {{-- Copyright di Pojok Bawah Kiri --}}
                        <div class="relative z-20 p-5 sm:p-6 pt-0">
                            <span class="text-[10px] sm:text-[11px] text-white font-medium bg-black/40 backdrop-blur-xs px-2.5 sm:px-3 py-1 rounded-lg inline-block">
                                &copy; 2026 MyUniv. All rights reserved.
                            </span>
                        </div>

                    </div>
                </section>

                {{-- KANAN: FORM REGISTER --}}
                <section class="register-form lg:col-span-5 px-6 py-6 sm:px-12 flex flex-col justify-center text-white relative z-10 bg-[#3650A2]">

                    <div class="mb-4">
                        <h1 class="text-[32px] sm:text-[38px] font-bold tracking-tight text-white leading-[40px] sm:leading-[48px]">
                            Daftar Akun
                        </h1>
                        <p class="text-xs text-[#C9D7EE] mt-0.5">Buat akun baru untuk mulai merencanakan masa depanmu.</p>
                    </div>

                    {{-- Kotak error global di atas sudah DIHAPUS agar pesan error hanya tampil di bawah masing-masing input --}}

                    <form action="{{ route('register.store') }}" method="POST" class="space-y-3">
                        @csrf

                        <div>
                            <label for="name" class="block mb-1.5 text-xs font-semibold text-[#F4FAFF] tracking-wide">
                                Nama Lengkap
                            </label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" placeholder="Masukkan nama lengkapmu" class="w-full h-12 rounded-full border border-[#C9D7EE]/40 bg-white/10 px-5 text-sm text-white placeholder-[#C9D7EE]/60 outline-none transition focus:bg-white/20 focus:border-[#FF7A59] focus:ring-2 focus:ring-[#FF7A59]/30">
                            @error('name')
                                <p class="mt-1 text-xs text-[#FF4D5A] pl-4 font-medium">⚠️ Nama lengkap wajib diisi ya!</p>
                            @enderror
                        </div>

                        <div>
                            <label for="login" class="block mb-1.5 text-xs font-semibold text-[#F4FAFF] tracking-wide">
                                Email atau Username
                            </label>
                            <input id="login" name="login" type="text" value="{{ old('login') }}" autocomplete="username" placeholder="Masukkan email atau username" class="w-full h-12 rounded-full border border-[#C9D7EE]/40 bg-white/10 px-5 text-sm text-white placeholder-[#C9D7EE]/60 outline-none transition focus:bg-white/20 focus:border-[#FF7A59] focus:ring-2 focus:ring-[#FF7A59]/30">
                            @error('login')
                                <p class="mt-1 text-xs text-[#FF4D5A] pl-4 font-medium">⚠️ Email atau username wajib diisi!</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block mb-1.5 text-xs font-semibold text-[#F4FAFF] tracking-wide">
                                Kata Sandi
                            </label>
                            <div class="relative">
                                <input id="password" name="password" type="password" oninput="checkPasswordStrength(this.value)" autocomplete="new-password" placeholder="Buat kata sandi baru" class="w-full h-12 rounded-full border border-[#C9D7EE]/40 bg-white/10 pl-5 pr-12 text-sm text-white placeholder-[#C9D7EE]/60 outline-none transition focus:bg-white/20 focus:border-[#FF7A59] focus:ring-2 focus:ring-[#FF7A59]/30">

                                <!-- Tombol Toggle Mata Password -->
                                <button type="button" onclick="togglePassword('password', 'eyeOpen1', 'eyeClosed1')" class="absolute right-4 top-1/2 -translate-y-1/2 text-[#C9D7EE] hover:text-white transition focus:outline-none">
                                    <svg id="eyeOpen1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg id="eyeClosed1" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                                    </svg>
                                </button>
                            </div>

                            <!-- Indikator Kekuatan Password & Informasi Syarat -->
                            <div class="mt-2 px-2 space-y-1.5">
                                <div class="flex gap-1 h-1.5 w-full bg-white/10 rounded-full overflow-hidden">
                                    <div id="strengthBar" class="h-full w-0 transition-all duration-300 rounded-full"></div>
                                </div>
                                <div class="flex justify-between items-center text-[11px]">
                                    <span id="strengthText" class="text-[#C9D7EE] font-medium">Minimal 8 karakter</span>
                                    <span id="charCount" class="text-[#C9D7EE]/70 font-mono">0/8</span>
                                </div>
                            </div>

                            @error('password')
                                <p class="mt-1 text-xs text-[#FF4D5A] pl-4 font-medium">⚠️ Kata sandi wajib diisi (minimal 8 karakter).</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block mb-1.5 text-xs font-semibold text-[#F4FAFF] tracking-wide">
                                Konfirmasi Kata Sandi
                            </label>
                            <div class="relative">
                                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Ulangi kata sandi" class="w-full h-12 rounded-full border border-[#C9D7EE]/40 bg-white/10 pl-5 pr-12 text-sm text-white placeholder-[#C9D7EE]/60 outline-none transition focus:bg-white/20 focus:border-[#FF7A59] focus:ring-2 focus:ring-[#FF7A59]/30">

                                <!-- Tombol Toggle Mata Confirm Password -->
                                <button type="button" onclick="togglePassword('password_confirmation', 'eyeOpen2', 'eyeClosed2')" class="absolute right-4 top-1/2 -translate-y-1/2 text-[#C9D7EE] hover:text-white transition focus:outline-none">
                                    <svg id="eyeOpen2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg id="eyeClosed2" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="w-full h-12 rounded-full bg-[#FF7A59] hover:bg-[#e0684a] text-[#F4FAFF] text-sm font-bold transition shadow-md shadow-[#FF7A59]/20 focus:outline-none mt-2">
                            Daftar Akun
                        </button>
                    </form>

                    <div class="mt-4 text-center text-xs text-[#C9D7EE]">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-semibold text-white underline hover:text-[#FF7A59] transition">
                            Masuk di sini
                        </a>
                    </div>

                    <div class="mt-6 pt-3 border-t border-white/15 flex justify-between items-center text-[10px] sm:text-[11px] text-[#C9D7EE]">
                        <a href="{{ route('terms') }}" class="hover:underline">Ketentuan Layanan</a>
                        <a href="//wa.me/6283801528378" class="hover:underline">Mengalami kendala? Hubungi kami</a>
                    </div>

                </section>

            </div>
        </main>
    </div>

    <!-- Script JavaScript untuk Toggle Password & Password Strength Indicator -->
    <script>
        function togglePassword(fieldId, openId, closedId) {
            const inputField = document.getElementById(fieldId);
            const eyeOpen = document.getElementById(openId);
            const eyeClosed = document.getElementById(closedId);

            if (inputField.type === 'password') {
                inputField.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                inputField.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }

        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            const charCount = document.getElementById('charCount');

            const length = password.length;
            charCount.textContent = `${length}/8`;

            if (length === 0) {
                strengthBar.style.width = '0%';
                strengthBar.className = 'h-full transition-all duration-300 rounded-full bg-transparent';
                strengthText.textContent = 'Minimal 8 karakter';
                strengthText.className = 'text-[#C9D7EE] font-medium';
                return;
            }

            let score = 0;
            if (length >= 8) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;

            if (length < 8) {
                strengthBar.style.width = '33%';
                strengthBar.className = 'h-full transition-all duration-300 rounded-full bg-[#FF4D5A]';
                strengthText.textContent = 'Kurang dari 8 karakter (Belum aman)';
                strengthText.className = 'text-[#FF4D5A] font-semibold';
            } else if (score <= 2) {
                strengthBar.style.width = '66%';
                strengthBar.className = 'h-full transition-all duration-300 rounded-full bg-amber-400';
                strengthText.textContent = 'Cukup aman (Tambah angka/simbol)';
                strengthText.className = 'text-amber-300 font-semibold';
            } else {
                strengthBar.style.width = '100%';
                strengthBar.className = 'h-full transition-all duration-300 rounded-full bg-emerald-400';
                strengthText.textContent = 'Kata sandi sangat aman!';
                strengthText.className = 'text-emerald-300 font-semibold';
            }
        }
    </script>
</body>
</html>
