<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eksplorasi Perguruan Tinggi - Panel Guru BK | MyUniv</title>

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
        .card-glass:hover {
            box-shadow: 0 25px 50px -12px rgba(54, 80, 162, 0.18);
            border-color: rgba(255, 122, 89, 0.3);
        }
    </style>
</head>
<body class="bg-[#F4F7FE] text-gray-800 antialiased selection:bg-[#FF7A59] selection:text-white">

    @include('components.global-loading')

    {{-- Navigasi khusus Guru BK; konten Explore tetap sama dengan halaman siswa --}}
    <x-counselor.sidebar active="exploration" />

    {{-- Topbar menyesuaikan posisi sidebar desktop --}}
    <x-counselor.topbar
        title="Eksplorasi"
        subtitle="Perguruan Tinggi & Jurusan"
        :offset-sidebar="true"
    />

    <!-- Main Content Area: konten bersama Student dan Counselor -->
    <div class="min-h-screen min-w-0 flex flex-col pt-8 md:ml-72">
        @include('shared.exploration-content')
    </div>

</body>
</html>
