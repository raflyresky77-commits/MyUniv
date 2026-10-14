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
            background-image: radial-gradient(circle at 90% 10%, rgba(54, 80, 162, 0.12) 0%, transparent 40%),
            radial-gradient(circle at 10% 90%, rgba(255, 122, 89, 0.08) 0%, transparent 40%);
        }
        /* Efek kurva gelombang khas */
        .wave-curve {
            background: #FFFFFF;
            border-bottom-right-radius: 160px;
            border-top-left-radius: 28px;
            border-bottom-left-radius: 28px;
            overflow: hidden;
            position: relative;
        }
        @media (max-width: 1024px) {
            .wave-curve {
                border-bottom-right-radius: 0;
                border-radius: 0;
            }
        }
    </style>
</head>
<body class="min-h-screen font-['Plus_Jakarta_Sans'] flex items-center justify-center p-4 sm:p-6 lg:p-8">

    <!-- Container Utama Card -->
    <main class="w-full max-w-[1150px] bg-[#3650A2] rounded-[28px] overflow-hidden shadow-[0_20px_50px_rgba(54,80,162,0.2)] relative flex flex-col lg:flex-row justify-between border border-[#C9D7EE]/40">

        <div class="grid grid-cols-1 lg:grid-cols-12 w-full">

            {{-- KIRI: AREA ILUSTRASI DENGAN KURVA GELOMBANG --}}
            <section class="lg:col-span-7 bg-[#3650A2] relative z-10 p-2 sm:p-3 lg:p-3">
                <div class="wave-curve h-[260px] sm:h-[320px] lg:h-full min-h-[340px] w-full relative flex flex-col justify-between shadow-sm">

                    {{-- Gambar Ilustrasi Full Cover di dalam Kurva --}}
                    <div class="absolute inset-0 w-full h-full overflow-hidden">
                        <img src="{{ asset('images/ilustrasi.png') }}" alt="Ilustrasi MyUniv" class="w-full h-full object-cover object-center">
                    </div>

                    {{-- Logo & Instansi (Floating di atas gambar) --}}
                    <div class="relative z-20 p-5 sm:p-6">
                        <div class="inline-flex items-center gap-2.5 sm:gap-3 bg-white/90 backdrop-blur-md px-3.5 py-2 rounded-xl border border-[#C9D7EE] shadow-sm">
                            <div class="w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center">
                                <img src="{{ asset('images/icon.png') }}" alt="Logo MyUniv" class="w-full h-full object-contain">
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
            <section class="lg:col-span-5 px-6 py-6 sm:px-12 flex flex-col justify-center text-white relative z-10 bg-[#3650A2]">

                <div class="mb-4">
                    <h1 class="text-[32px] sm:text-[38px] font-bold tracking-tight text-white leading-[40px] sm:leading-[48px]">
                        Register
                    </h1>
                    <p class="text-xs text-[#C9D7EE] mt-0.5">Buat akun baru untuk mulai merencanakan masa depanmu.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-3 rounded-[6px] border border-[#FF4D5A]/40 bg-[#FF4D5A]/20 px-4 py-2.5 text-xs text-white">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('register.store') }}" method="POST" class="space-y-3">
                    @csrf

                    <div>
                        <label for="name" class="block mb-1.5 text-xs font-semibold text-[#F4FAFF] tracking-wide">
                            Full Name
                        </label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" placeholder="Enter your full name" class="w-full h-12 rounded-full border border-[#C9D7EE]/40 bg-white/10 px-5 text-sm text-white placeholder-[#C9D7EE]/60 outline-none transition focus:bg-white/20 focus:border-[#FF7A59] focus:ring-2 focus:ring-[#FF7A59]/30">
                        @error('name')
                            <p class="mt-1 text-xs text-[#FF4D5A] pl-4 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="login" class="block mb-1.5 text-xs font-semibold text-[#F4FAFF] tracking-wide">
                             Email
                        </label>
                        <input id="login" name="login" type="text" value="{{ old('login') }}" autocomplete="username" placeholder="Enter your username or email" class="w-full h-12 rounded-full border border-[#C9D7EE]/40 bg-white/10 px-5 text-sm text-white placeholder-[#C9D7EE]/60 outline-none transition focus:bg-white/20 focus:border-[#FF7A59] focus:ring-2 focus:ring-[#FF7A59]/30">
                        @error('login')
                            <p class="mt-1 text-xs text-[#FF4D5A] pl-4 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block mb-1.5 text-xs font-semibold text-[#F4FAFF] tracking-wide">
                            Password
                        </label>
                        <div class="relative">
                            <input id="password" name="password" type="password" autocomplete="new-password" placeholder="Create a password" class="w-full h-12 rounded-full border border-[#C9D7EE]/40 bg-white/10 pl-5 pr-12 text-sm text-white placeholder-[#C9D7EE]/60 outline-none transition focus:bg-white/20 focus:border-[#FF7A59] focus:ring-2 focus:ring-[#FF7A59]/30">

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
                        @error('password')
                            <p class="mt-1 text-xs text-[#FF4D5A] pl-4 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block mb-1.5 text-xs font-semibold text-[#F4FAFF] tracking-wide">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Confirm your password" class="w-full h-12 rounded-full border border-[#C9D7EE]/40 bg-white/10 pl-5 pr-12 text-sm text-white placeholder-[#C9D7EE]/60 outline-none transition focus:bg-white/20 focus:border-[#FF7A59] focus:ring-2 focus:ring-[#FF7A59]/30">

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
                        Register
                    </button>
                </form>

                <div class="mt-4 text-center text-xs text-[#C9D7EE]">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-semibold text-white underline hover:text-[#FF7A59] transition">
                        Login Here
                    </a>
                </div>

                <div class="mt-6 pt-3 border-t border-white/15 flex justify-between items-center text-[10px] sm:text-[11px] text-[#C9D7EE]">
                    <a href="#" class="hover:underline">Terms and Services</a>
                    <a href="#" class="hover:underline">Have a problem? Contact us</a>
                </div>

            </section>

        </div>
    </main>

    <!-- Script JavaScript untuk Toggle Lihat/Sembunyikan Password -->
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
    </script>
</body>
</html>
