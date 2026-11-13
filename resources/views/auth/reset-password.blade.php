<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - MyUniv</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }
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

    <div class="max-w-md w-full space-y-8">

        <!-- Logo & Brand Header -->
        <div class="text-center space-y-3">
            <div class="inline-flex w-16 h-16 items-center justify-center bg-white rounded-[22px] border border-indigo-100 p-2 shadow-md">
                <img src="{{ asset('images/icon.png') }}" alt="Logo MyUniv" class="w-full h-full object-contain">
            </div>
            <div>
                <h2 class="text-2xl font-black text-[#3650A2] tracking-tight">Atur Kata Sandi Baru</h2>
                <p class="text-xs font-semibold text-gray-500 mt-1">Buat kata sandi baru yang aman untuk akun MyUniv kamu.</p>
            </div>
        </div>

        <!-- Kartu Form (Glassmorphism) -->
        <div class="card-glass rounded-[32px] p-8 sm:p-10 space-y-6">

            <!-- Notifikasi Error Validasi -->
            @if ($errors->any())
                <div class="p-4 bg-red-50 border border-red-200 text-red-600 rounded-2xl text-xs font-semibold space-y-1">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Input Email -->
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-[#3650A2] uppercase tracking-wider block">Email Terdaftar</label>
                    <input type="email" name="email" value="{{ old('email', $email) }}" required class="w-full px-4 py-3.5 bg-white/80 border border-indigo-100 text-gray-900 rounded-2xl font-semibold text-xs shadow-inner focus:outline-none focus:ring-4 focus:ring-[#FF7A59]/20 focus:border-[#FF7A59] transition-all">
                </div>

                <!-- Input Password Baru -->
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-[#3650A2] uppercase tracking-wider block">Password Baru</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter" required class="w-full px-4 py-3.5 bg-white/80 border border-indigo-100 text-gray-900 rounded-2xl font-semibold text-xs shadow-inner focus:outline-none focus:ring-4 focus:ring-[#FF7A59]/20 focus:border-[#FF7A59] transition-all placeholder:text-gray-400">
                </div>

                <!-- Konfirmasi Password -->
                <div class="space-y-1.5">
                    <label class="text-xs font-extrabold text-[#3650A2] uppercase tracking-wider block">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password baru" required class="w-full px-4 py-3.5 bg-white/80 border border-indigo-100 text-gray-900 rounded-2xl font-semibold text-xs shadow-inner focus:outline-none focus:ring-4 focus:ring-[#FF7A59]/20 focus:border-[#FF7A59] transition-all placeholder:text-gray-400">
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-[#FF7A59] to-[#FF5233] text-white rounded-2xl text-xs font-black shadow-lg shadow-orange-500/30 hover:opacity-95 hover:scale-[1.01] transition-all uppercase tracking-wider flex items-center justify-center gap-2 mt-2">
                    <span>Simpan Password Baru</span>
                </button>
            </form>

        </div>

        <!-- Footer Kecil -->
        <div class="text-center text-[11px] font-bold text-gray-400">
            &copy; 2026 MyUniv. Platform Ekspektasi Karir &amp; Pendidikan Tinggi.
        </div>

    </div>

</body>
</html>
