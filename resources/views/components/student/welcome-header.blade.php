@props(['name' => 'Siswa', 'description' => 'Temukan potensi dan arah pilihan perguruan tinggi terbaikmu bersama MyUniv.', 'background' => 'images/header.png', 'eyebrow' => 'Selamat Datang'])
<section class="relative rounded-[28px] overflow-hidden px-6 sm:px-10 py-8 sm:py-10 shadow-md border border-indigo-100 flex flex-col justify-center isolate">
    <div class="absolute inset-0 -z-20"><img src="{{ asset($background) }}" alt="" class="w-full h-full object-cover object-center" loading="lazy"></div>
    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-[#141F43]/80 via-[#1E2D62]/85 to-[#3650A2]/80"></div>
    <div class="space-y-2.5 relative z-10 max-w-xl text-white">
        <span class="px-3 py-1 bg-[#FF7A59] text-white rounded-full text-[10px] font-extrabold tracking-wider uppercase shadow-sm inline-block">{{ $eyebrow }}</span>
        <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">Halo, {{ $name }}! 👋</h1>
        <p class="text-gray-200 text-xs sm:text-sm font-medium leading-relaxed">{{ $description }}</p>
    </div>
</section>
