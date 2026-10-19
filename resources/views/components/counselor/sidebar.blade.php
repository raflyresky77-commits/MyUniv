@props(['active' => 'dashboard'])

{{-- Backdrop transparan: tidak menggelapkan halaman saat sidebar mobile terbuka --}}
<div id="counselorSidebarBackdrop"
     class="fixed inset-0 z-40 hidden bg-transparent md:hidden"
     aria-hidden="true"
     onclick="closeCounselorSidebar()"></div>

<aside id="counselorSidebar"
       class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col justify-between overflow-y-auto border-r border-[#E2E8F0] bg-white shadow-2xl transition-transform duration-300 ease-in-out md:translate-x-0 md:shadow-[4px_0_24px_rgba(54,80,162,0.05)]">
    <div>
        <div class="flex items-center gap-3.5 border-b border-gray-100 px-6 py-6">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-[14px] border border-indigo-200/80 bg-indigo-50 p-1.5 shadow-sm transition-transform duration-300 hover:scale-105">
                <img src="{{ asset('images/icon.png') }}" alt="Logo MyUniv" class="h-full w-full object-contain">
            </div>
            <div>
                <span class="block text-lg font-black leading-none tracking-tight text-[#3650A2]">MyUniv</span>
                <span class="mt-1 block text-[10px] font-extrabold uppercase tracking-wider text-indigo-400">Panel Guru BK</span>
            </div>
            <button type="button" onclick="closeCounselorSidebar()" class="ml-auto rounded-lg p-2 text-gray-500 hover:bg-indigo-50 hover:text-[#3650A2] md:hidden" aria-label="Tutup menu">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 6l12 12M18 6L6 18" stroke-width="2.5" stroke-linecap="round"/></svg>
            </button>
        </div>

        <nav class="space-y-2 p-5" aria-label="Navigasi Guru BK">
            <div class="px-4 py-2 text-[10px] font-extrabold uppercase tracking-widest text-indigo-400">Menu Utama</div>

            <a href="{{ route('counselor.dashboard') }}" @class([
                'group relative flex items-center gap-3.5 overflow-hidden rounded-2xl px-4 py-4 text-sm transition-all duration-300',
                'bg-gradient-to-br from-[#2B4185] to-[#141F43] font-bold text-white shadow-lg shadow-indigo-900/25' => $active === 'dashboard',
                'font-semibold text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2]' => $active !== 'dashboard',
            ])>
                @if($active === 'dashboard')<span class="absolute bottom-0 left-0 top-0 w-2 bg-[#FF7A59]"></span>@endif
                <svg class="ml-1 h-5 w-5 shrink-0 {{ $active === 'dashboard' ? 'text-white' : 'text-gray-400 group-hover:text-[#3650A2]' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 12l2-2 7-7 7 7 2 2M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6m-6 0v-4a1 1 0 011-1h2a1 1 0 011 1v4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span>Beranda</span>
            </a>

            <a href="{{ route('counselor.exploration') }}" @class([
                'group flex items-center gap-3.5 rounded-2xl px-4 py-3.5 text-sm transition-all duration-200',
                'bg-gradient-to-br from-[#2B4185] to-[#141F43] font-bold text-white shadow-lg shadow-indigo-900/20' => $active === 'exploration',
                'font-semibold text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2]' => $active !== 'exploration',
            ])>
                <svg class="h-5 w-5 shrink-0 {{ $active === 'exploration' ? 'text-white' : 'text-gray-400 group-hover:text-[#3650A2]' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="11" cy="11" r="7" stroke-width="2"/><path d="m20 20-4-4" stroke-width="2" stroke-linecap="round"/></svg>
                <span>Eksplorasi</span>
            </a>

            <a href="{{ route('counselor.consultation') }}" @class([
                'group flex items-center gap-3.5 rounded-2xl px-4 py-3.5 text-sm transition-all duration-200',
                'bg-gradient-to-br from-[#2B4185] to-[#141F43] font-bold text-white shadow-lg shadow-indigo-900/20' => $active === 'consultation',
                'font-semibold text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2]' => $active !== 'consultation',
            ])>
                <svg class="h-5 w-5 shrink-0 {{ $active === 'consultation' ? 'text-white' : 'text-gray-400 group-hover:text-[#3650A2]' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span>Konsultasi BK</span>
            </a>

            <a href="{{ route('counselor.profile') }}" @class([
                'group flex items-center gap-3.5 rounded-2xl px-4 py-3.5 text-sm transition-all duration-200',
                'bg-gradient-to-br from-[#2B4185] to-[#141F43] font-bold text-white shadow-lg shadow-indigo-900/20' => $active === 'profile',
                'font-semibold text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2]' => $active !== 'profile',
            ])>
                <svg class="h-5 w-5 shrink-0 {{ $active === 'profile' ? 'text-white' : 'text-gray-400 group-hover:text-[#3650A2]' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span>Profil</span>
            </a>
        </nav>
    </div>

    <div class="space-y-3 border-t border-gray-100 bg-white p-5">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="group flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold text-red-600 transition-all duration-200 hover:bg-red-50">
                <svg class="h-5 w-5 text-red-500 transition-transform group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M17 16l4-4m0 0-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span>Keluar Sistem</span>
            </button>
        </form>
    </div>
</aside>
