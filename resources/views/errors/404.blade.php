<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - MyUniv</title>
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

        <div class="w-20 h-20 mx-auto bg-orange-50 border-2 border-orange-200 rounded-[24px] flex items-center justify-center text-[#FF7A59]">
            <span class="text-3xl font-black">?</span>
        </div>

        <div class="space-y-2">
            <span class="inline-block px-3 py-1 bg-orange-50 text-orange-600 border border-orange-200 text-[10px] font-extrabold rounded-full uppercase tracking-wider">
                Error 404
            </span>

            <h1 class="text-2xl sm:text-3xl font-black text-[#3650A2]">
                Halaman Tidak Ditemukan
            </h1>

            <p class="text-xs sm:text-sm text-gray-500 font-medium leading-relaxed">
                Maaf, halaman yang kamu cari tidak tersedia atau mungkin sudah dipindahkan.
                Silakan kembali ke halaman utama MyUniv.
            </p>
        </div>

        <a href="{{ url('/') }}"
            class="inline-flex items-center justify-center w-full sm:w-auto px-8 py-3.5 bg-[#3650A2] hover:bg-[#2B4185] text-white text-xs font-extrabold rounded-2xl transition-all">
            Kembali ke Beranda
        </a>

    </div>

</body>
</html>
