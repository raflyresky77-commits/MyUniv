<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Halaman Kedaluwarsa - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #F4F7FE;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
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

    <main class="card-error rounded-[32px] p-8 sm:p-12 max-w-lg w-full text-center space-y-6 animate-fade-in relative overflow-hidden" role="main">

        <!-- Aksen Dekoratif -->
        <div class="absolute -top-12 -right-12 w-36 h-36 bg-[#FF7A59]/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -left-12 w-36 h-36 bg-[#3650A2]/10 rounded-full blur-2xl pointer-events-none"></div>

        <!-- Ilustrasi / Ikon 419 -->
        <div class="w-24 h-24 mx-auto bg-indigo-50 border-2 border-indigo-100 rounded-[28px] flex items-center justify-center text-[#3650A2] shadow-sm relative mt-2">
            <svg class="w-12 h-12" viewBox="0 0 100 100" fill="none">
                <path d="M28 18h30l17 17v44a7 7 0 0 1-7 7H28a7 7 0 0 1-7-7V25a7 7 0 0 1 7-7Z" fill="#fff" stroke="#3650A2" stroke-width="4"/>
                <path d="M58 19v17h17" stroke="#3650A2" stroke-width="4" stroke-linejoin="round"/>
                <path d="M36 49h27M36 61h18" stroke="#A8B6DE" stroke-width="4" stroke-linecap="round"/>
                <circle cx="68" cy="70" r="17" fill="#FF7A59" stroke="#fff" stroke-width="4"/>
                <path d="M68 61v10" stroke="#fff" stroke-width="4" stroke-linecap="round"/>
                <circle cx="68" cy="77" r="2.3" fill="#fff"/>
            </svg>
            <div class="absolute top-2 right-2 w-4 h-4 bg-[#FF7A59] rounded-full ring-4 ring-white"></div>
        </div>

        <!-- Informasi Teks -->
        <div class="space-y-2">
            <span class="inline-block px-3.5 py-1 bg-indigo-50 text-[#3650A2] border border-indigo-200/70 text-[10px] font-extrabold rounded-full uppercase tracking-wider">
                Error 419 &bull; Page Expired
            </span>
            <h1 class="text-2xl sm:text-3xl font-black text-[#3650A2] tracking-tight">
                Halaman Sudah Kedaluwarsa
            </h1>
            <p class="text-xs sm:text-sm text-gray-500 font-medium leading-relaxed max-w-sm mx-auto">
                Sesi atau token keamanan pada halaman ini sudah tidak berlaku. Muat ulang halaman, lalu coba lakukan tindakanmu kembali.
            </p>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <button class="w-full sm:w-auto px-6 py-3.5 bg-[#3650A2] hover:bg-[#283C7E] text-white text-xs font-extrabold rounded-2xl shadow-lg shadow-indigo-900/20 transition-all hover:scale-105 active:scale-95 cursor-pointer" type="button" onclick="window.location.reload()">
                Muat Ulang Halaman
            </button>
            <a class="w-full sm:w-auto px-6 py-3.5 bg-white hover:bg-gray-50 text-[#3650A2] border border-gray-200 text-xs font-extrabold rounded-2xl shadow-sm transition-all hover:scale-105 active:scale-95 text-center" href="{{ url('/') }}">
                Kembali ke Beranda
            </a>
        </div>

        <!-- Catatan / Petunjuk Tambahan -->
        <p class="text-[11px] text-gray-400 leading-relaxed pt-2">
            Jika masalah terus muncul, masuk kembali ke akun MyUniv dan ulangi tindakan sebelumnya.
        </p>

    </main>

</body>
</html>
