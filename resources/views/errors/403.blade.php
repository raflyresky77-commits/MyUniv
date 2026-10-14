<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F4F7FE; font-family: 'Plus Jakarta Sans', sans-serif; }
        .card-error {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(235, 242, 255, 0.8) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid rgba(54, 80, 162, 0.1);
            box-shadow: 0 20px 45px -12px rgba(30, 45, 98, 0.08);
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 text-gray-800">

    <div class="card-error rounded-[32px] p-8 sm:p-12 max-w-lg w-full text-center space-y-6 animate-fade-in relative overflow-hidden">

        <!-- Aksen Dekoratif -->
        <div class="absolute -top-12 -right-12 w-36 h-36 bg-[#FF7A59]/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -left-12 w-36 h-36 bg-[#3650A2]/10 rounded-full blur-2xl pointer-events-none"></div>

        <!-- Ikon Peringatan -->
        <div class="w-20 h-20 mx-auto bg-red-50 border-2 border-red-200/80 rounded-[24px] flex items-center justify-center text-red-500 shadow-sm">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>

        <!-- Teks Informasi -->
        <div class="space-y-2">
            <span class="inline-block px-3 py-1 bg-red-50 text-red-600 border border-red-200 text-[10px] font-extrabold rounded-full uppercase tracking-wider">
                Error 403 &bull; Akses Ditolak
            </span>
            <h1 class="text-2xl sm:text-3xl font-black text-[#3650A2] tracking-tight">
                Ups, Halaman Terkunci!
            </h1>
            <p class="text-xs sm:text-sm text-gray-500 font-medium leading-relaxed">
                Maaf, kamu tidak memiliki hak akses (role) untuk membuka halaman milik role lain ini. Silakan kembali ke dashboard utama kamu.
            </p>
        </div>

        <!-- Tombol Navigasi Kembali -->
        <div class="pt-2">
            @php
                $dashboardRoute = '#';
                if (auth()->check()) {
                    $roleId = auth()->user()->role_id ?? 1;
                    if ($roleId == 1) $dashboardRoute = route('student.dashboard');
                    elseif ($roleId == 3) $dashboardRoute = route('admin.dashboard');
                    elseif ($roleId == 2) $dashboardRoute = route('counselor.dashboard');
                }
            @endphp

            <a href="{{ $dashboardRoute }}" class="inline-flex items-center justify-center w-full sm:w-auto px-8 py-3.5 bg-[#3650A2] hover:bg-[#2B4185] text-white text-xs font-extrabold rounded-2xl shadow-lg shadow-indigo-900/20 transition-all hover:scale-105 active:scale-95">
                Kembali ke Dashboard Utama
            </a>
        </div>

    </div>

</body>
</html>
