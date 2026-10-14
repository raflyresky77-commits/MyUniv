<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-strong { background: linear-gradient(135deg, #3650A2 0%, #1E2D61 100%); }
        .card-glass {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(54, 80, 162, 0.12);
            box-shadow: 0 20px 40px -15px rgba(30, 45, 98, 0.08);
        }
    </style>
</head>
<body class="bg-[#F4F7FE] text-gray-800 antialiased selection:bg-[#FF7A59] selection:text-white min-h-screen flex items-center justify-center p-6">

    <!-- Container Utama -->
    <div class="max-w-md w-full space-y-8">

        <!-- Logo & Brand Header -->
        <div class="text-center space-y-3">
            <div class="inline-flex w-16 h-16 items-center justify-center bg-white rounded-[22px] border border-indigo-100 p-2 shadow-md hover:scale-105 transition-transform">
                <img src="{{ asset('images/icon.png') }}" alt="Logo MyUniv" class="w-full h-full object-contain">
            </div>
            <div>
                <h2 class="text-2xl font-black text-[#3650A2] tracking-tight">Lupa Kata Sandi?</h2>
                <p class="text-xs font-semibold text-gray-500 mt-1">Jangan khawatir, kami akan bantu memulihkan akses akun MyUniv kamu.</p>
            </div>
        </div>

        <!-- Kartu Form (Glassmorphism) -->
        <div class="card-glass rounded-[32px] p-8 sm:p-10 space-y-6">

            <!-- Pesan Sukses / Notifikasi Status (Laravel Standard) -->
            @if (session('status'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold leading-relaxed">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Notifikasi Error Validasi -->
            @if ($errors->any())
                <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-600 text-xs font-semibold space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <p class="text-xs text-gray-600 font-medium leading-relaxed">
                Masukkan alamat email yang terdaftar pada akun kamu. Kami akan mengirimkan tautan pengaturan ulang kata sandi ke email tersebut.
            </p>

            <!-- Form Reset Password -->
            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <!-- Input Email -->
                <div class="space-y-2">
                    <label for="email" class="text-xs font-extrabold text-[#3650A2] uppercase tracking-wider block">Email Terdaftar</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="contoh: nama@email.com" class="w-full pl-12 pr-4 py-3.5 bg-white/80 border border-indigo-100 text-gray-900 rounded-2xl font-semibold text-xs shadow-inner focus:outline-none focus:ring-4 focus:ring-[#FF7A59]/20 focus:border-[#FF7A59] transition-all placeholder:text-gray-400">
                    </div>
                </div>

                <!-- Tombol Kirim Tautan -->
                <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-[#FF7A59] to-[#FF5233] text-white rounded-2xl text-xs font-black shadow-lg shadow-orange-500/30 hover:opacity-95 hover:scale-[1.01] transition-all uppercase tracking-wider flex items-center justify-center gap-2">
                    <span>Kirim Tautan Pemulihan</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>

            <!-- Tombol Kembali ke Login -->
            <div class="pt-2 text-center border-t border-indigo-50">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-xs font-bold text-[#3650A2] hover:text-[#FF7A59] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Kembali ke Halaman Masuk (Login)</span>
                </a>
            </div>

        </div>

        <!-- Footer Kecil -->
        <div class="text-center text-[11px] font-bold text-gray-400">
            &copy; 2026 MyUniv. Platform Ekspektasi Karir &amp; Pendidikan Tinggi.
        </div>

    </div>

</body>
</html>
