
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kesalahan Server - MyUniv</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #F4F7FE;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .card-error {
            background: linear-gradient(135deg, #ffffff 0%, #EBF2FF 100%);
            border: 2px solid rgba(54, 80, 162, 0.1);
            box-shadow: 0 20px 45px -12px rgba(30, 45, 98, 0.08);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 text-gray-800">

    <div class="card-error rounded-[32px] p-8 sm:p-12 max-w-lg w-full text-center space-y-6">

        <div class="w-20 h-20 mx-auto bg-red-50 border-2 border-red-200 rounded-[24px] flex items-center justify-center text-red-500">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M5.5 19h13a2 2 0 001.73-3L13.73 5a2 2 0 00-3.46 0L3.77 16a2 2 0 001.73 3z"/>
            </svg>
        </div>

        <div class="space-y-2">
            <span class="inline-block px-3 py-1 bg-red-50 text-red-600 border border-red-200 text-[10px] font-extrabold rounded-full uppercase tracking-wider">
                Error 500
            </span>

            <h1 class="text-2xl sm:text-3xl font-black text-[#3650A2]">
                Terjadi Kesalahan Server
            </h1>

            <p class="text-xs sm:text-sm text-gray-500 font-medium leading-relaxed">
                Maaf, terjadi kendala pada sistem MyUniv.
                Silakan coba beberapa saat lagi atau hubungi administrator jika masalah berlanjut.
            </p>
        </div>

        <a href="{{ url('/') }}"
            class="inline-flex items-center justify-center w-full sm:w-auto px-8 py-3.5 bg-[#3650A2] hover:bg-[#2B4185] text-white text-xs font-extrabold rounded-2xl transition-all">
            Kembali ke Beranda
        </a>

    </div>

</body>
</html>
