
{{-- Topbar reusable untuk halaman siswa MyUniv --}}
@props([
    'title' => 'Dashboard',
    'subtitle' => 'MyUniv',
    'username' => null,
    'initials' => null,
    'progressId' => null,
    'progressBarId' => null,
])

@php
    $displayName = $username ?: (auth()->user()->name ?? 'Pengguna');
    $displayInitials = $initials ?: strtoupper(substr($displayName, 0, 2));
@endphp

<header class="fixed top-0 right-0 left-0 md:left-72 z-40 min-h-[65px] bg-white/95 backdrop-blur-md border-b border-[#E2E8F0] px-4 sm:px-6 lg:px-10 py-4 flex justify-between items-center shadow-sm">
    <div class="flex items-center gap-3 min-w-0">
        <button
            type="button"
            onclick="if (typeof window.myUnivToggleStudentSidebar === 'function') { window.myUnivToggleStudentSidebar(); } else if (typeof window.toggleSidebar === 'function') { window.toggleSidebar(); }"
            aria-label="Buka atau tutup sidebar"
            aria-controls="mobileSidebar"
            aria-expanded="false"
            class="md:hidden p-2 rounded-xl text-gray-700 bg-gray-100 hover:bg-indigo-50 hover:text-[#3650A2] transition shrink-0"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <span class="text-xs sm:text-sm font-bold text-gray-700 truncate">
            {{ $subtitle }} /
            <span class="text-[#3650A2]">{{ $title }}</span>
        </span>
    </div>

    <div class="flex items-center gap-3 sm:gap-4 shrink-0">
        @if ($progressId)
            <div class="hidden lg:flex flex-col items-end">
                <span class="text-[11px] font-extrabold text-gray-500" id="{{ $progressId }}">
                    Terjawab: 0 / 18 Soal
                </span>
                <div class="w-32 h-2 bg-gray-200 rounded-full overflow-hidden mt-1">
                    <div id="{{ $progressBarId }}" class="h-full bg-[#FF7A59] w-0 transition-all duration-300"></div>
                </div>
            </div>
        @endif

        <div class="flex items-center gap-3 pl-3 border-l border-gray-200">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-extrabold text-gray-900 leading-tight">{{ $displayName }}</div>
                <div class="text-xs font-semibold text-indigo-500">Siswa</div>
            </div>

            <div
                class="w-10 h-10 rounded-xl bg-[#3650A2] text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-900/20"
                aria-label="Inisial {{ $displayName }}"
            >
                {{ $displayInitials }}
            </div>
        </div>
    </div>
</header>
