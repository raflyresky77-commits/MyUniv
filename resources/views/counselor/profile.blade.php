<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Dashboard Guru BK - MyUniv</title>

    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F4F7FE; }
        .bg-gradient-myuniv { background: linear-gradient(135deg, #3650A2 0%, #1E2D62 100%); }
        .bg-gradient-strong { background: linear-gradient(135deg, #2B4185 0%, #141F43 100%); }

        .glass-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(235, 242, 255, 0.85) 100%);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid rgba(54, 80, 162, 0.15);
            box-shadow: 0 20px 45px -12px rgba(30, 45, 98, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.9);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .glass-card:hover {
            transform: translateY(-2px);
            border-color: #FF7A59;
            box-shadow: 0 25px 50px -12px rgba(255, 122, 89, 0.15);
        }
    </style>
</head>
<body class="bg-[#F4F7FE] min-h-screen min-w-0 text-gray-800 flex antialiased">

    @include('components.global-loading')

    {{-- Komponen navigasi bersama Guru BK --}}
    <x-counselor.sidebar active="profile" />

    <!-- Main Content Area -->
    <div class="flex-1 min-w-0 flex flex-col min-h-screen lg:ml-72">
        {{-- Komponen topbar bersama Guru BK --}}
        <x-counselor.topbar title="Profil" subtitle="Panel Guru BK" />

        <!-- Page Body Content -->
        <main class="w-full min-w-0 max-w-7xl mx-auto flex-1 space-y-6 sm:space-y-8 p-4 sm:p-6 lg:p-10">

            <!-- Hero Banner dengan Foto Kampus -->
            <div class="relative min-w-0 rounded-[24px] sm:rounded-[40px] overflow-hidden px-5 sm:px-8 lg:px-12 py-8 sm:py-12 lg:py-16 shadow-lg border border-indigo-100 flex flex-col justify-center">
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset('images/banner-gurubk3.png') }}" alt="Background Kampus" class="w-full h-full object-cover object-center filter scale-105">
                </div>
                <div class="absolute inset-0 z-5 bg-gradient-to-r from-[#141F43]/75 via-[#1E2D62]/80 to-[#3650A2]/75 backdrop-blur-[1px]"></div>

                <div class="space-y-4 relative z-20 max-w-2xl text-white">
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-[#FF7A59] text-white text-xs font-extrabold rounded-full shadow-md uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Pengaturan Akun
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight text-white drop-shadow-sm">Profil Guru BK</h2>
                    <p class="text-gray-200 text-sm sm:text-base leading-relaxed font-medium drop-shadow">
                        Informasi akun dan pengaturan profil profesional {{ $user->name ?? 'Guru BK' }}.
                    </p>
                </div>
            </div>

            <!-- Kartu Detail Profil -->
            <div class="glass-card w-full min-w-0 max-w-3xl p-4 sm:p-6 lg:p-8 rounded-[24px] sm:rounded-[32px] space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-5 pb-6 border-b border-gray-200/80">
                <div class="w-20 h-20 rounded-2xl bg-gradient-strong text-white flex items-center justify-center font-black text-2xl shadow-lg shadow-indigo-900/20">
                    {{ strtoupper(substr($user->name ?? 'G', 0, 2)) }}
                </div>

                <div>
                    <h3 class="text-xl font-extrabold text-gray-900 tracking-tight">
                        {{ $user->name ?? 'Guru BK' }}
                    </h3>
                    <p class="text-xs font-semibold text-indigo-600 mt-0.5">
                        Guru Bimbingan Konseling (BK)
                    </p>
                </div>
            </div>

            <div class="space-y-4 text-sm">
                <div class="flex flex-col sm:flex-row sm:justify-between py-3 border-b border-gray-100 gap-1">
                    <span class="text-gray-400 font-bold uppercase tracking-wider text-xs">Email Akun</span>
                    <span class="min-w-0 max-w-full break-all font-semibold text-gray-800">{{ $user->email ?? '-' }}</span>
                </div>

                <div class="flex flex-col sm:flex-row sm:justify-between py-3 border-b border-gray-100 gap-1">
                    <span class="text-gray-400 font-bold uppercase tracking-wider text-xs">Peran / Role Sistem</span>
                    <span class="font-extrabold text-[#3650A2] px-3 py-1 bg-indigo-50 rounded-xl w-fit">Counselor</span>
                </div>

                <div class="flex flex-col sm:flex-row sm:justify-between py-3 border-b border-gray-100 gap-1">
                    <span class="text-gray-400 font-bold uppercase tracking-wider text-xs">NIP</span>
                    <span class="font-semibold text-gray-800">{{ $teacher->nip ?? 'Belum diisi' }}</span>
                </div>

                <div class="flex flex-col sm:flex-row sm:justify-between py-3 border-b border-gray-100 gap-1">
                    <span class="text-gray-400 font-bold uppercase tracking-wider text-xs">Nomor Telepon</span>
                    <span class="font-semibold text-gray-800">{{ $teacher->phone ?? 'Belum diisi' }}</span>
                </div>

                <div class="flex flex-col sm:flex-row sm:justify-between py-3 border-b border-gray-100 gap-1">
                    <span class="text-gray-400 font-bold uppercase tracking-wider text-xs">Institusi</span>
                    <span class="font-extrabold text-gray-800">SMK Budi Bakti Ciwidey</span>
                </div>
            </div>
        </div>
        </main>
    </div>
</body>
</html>
