@props([
    'module' => 'Modul Admin',
    'pageTitle' => 'Dashboard',
    'adminName' => 'Administrator Utama',
    'adminEmail' => 'admin@myuniv.test',
    'initials' => null,
])

@php
    // Inisial otomatis jika tidak diberikan dari halaman pemanggil.
    $initials = $initials ?: collect(preg_split('/\s+/', trim($adminName)))
        ->filter()
        ->take(2)
        ->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))
        ->implode('');
@endphp

{{-- Topbar admin; label modul dan judul halaman dapat berbeda di tiap halaman. --}}
<header {{ $attributes->merge(['class' => 'fixed left-0 right-0 top-0 z-40 flex items-center justify-between border-b border-[#E2E8F0] bg-white/90 px-4 py-4 shadow-sm backdrop-blur-md sm:px-6 sm:py-5 md:left-72 lg:px-10']) }}>
    <div class="flex min-w-0 items-center gap-3">
        <button type="button" onclick="toggleSidebar()" class="relative z-50 rounded-xl bg-gray-100 p-2.5 text-gray-700 transition hover:bg-indigo-50 hover:text-[#3650A2] focus:outline-none md:hidden" aria-label="Buka/tutup navigasi">
            <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>

        <div class="min-w-0">
            <span class="inline-flex max-w-full rounded-xl border border-indigo-100/50 bg-indigo-50 px-3 py-1.5 text-[10px] font-extrabold tracking-wide text-[#3650A2] sm:text-xs">{{ $module }}</span>
            <div class="mt-1 hidden items-center gap-2 sm:flex">
                <span class="text-gray-300">/</span>
                <h1 class="truncate text-sm font-black tracking-tight text-gray-800">{{ $pageTitle }}</h1>
            </div>
        </div>
    </div>

    <div class="ml-3 flex shrink-0 items-center gap-2.5 sm:gap-4">
        <div class="hidden text-right sm:block">
            <div class="text-sm font-extrabold leading-tight text-gray-900">{{ $adminName }}</div>
            <div class="text-xs font-semibold text-gray-400">{{ $adminEmail }}</div>
        </div>
        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-[#3650A2] to-[#22346E] text-xs font-extrabold text-white shadow-md shadow-indigo-200/50 sm:h-10 sm:w-10" aria-label="Inisial {{ $initials }}">
            {{ $initials }}
        </div>
    </div>
</header>
