@props([
    'active' => null,
])

@php
    // Route aktif otomatis berdasarkan halaman admin saat ini.
    $active = $active ?? (
        request()->routeIs('admin.dashboard') ? 'dashboard' :
        (request()->routeIs('admin.assessments.*') ? 'assessments' :
        (request()->routeIs('admin.universities.*') ? 'universities' :
        (request()->routeIs('admin.majors.*') ? 'majors' :
        (request()->routeIs('admin.users.*') ? 'users' : null))))
    );

    $linkBase = 'group flex items-center gap-3.5 rounded-2xl px-4 py-3.5 text-sm font-semibold transition-all duration-200';
    $linkIdle = 'text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2]';
    $linkActive = 'relative overflow-hidden bg-gradient-to-r from-[#3650A2] to-[#22346E] font-bold text-white shadow-lg shadow-indigo-200/60';
@endphp

{{-- Sidebar admin terpisah dari topbar agar mudah dipelihara. --}}
<div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 z-40 hidden bg-black/40 backdrop-blur-sm md:hidden"></div>

<aside id="mobileSidebar" class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col justify-between overflow-y-auto border-r border-[#E2E8F0] bg-white shadow-2xl transition-transform duration-300 ease-in-out md:translate-x-0 md:shadow-[4px_0_24px_rgba(54,80,162,0.03)]">
    <div>
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3.5 border-b border-gray-100 px-6 py-6">
            <img src="{{ asset('images/icon.png') }}" alt="MyUniv Logo" class="h-10 w-auto object-contain">
            <span>
                <span class="block text-lg font-black leading-none tracking-tight text-[#3650A2]">MyUniv</span>
                <span class="mt-1 block text-[10px] font-extrabold uppercase tracking-wider text-gray-400">Enterprise OS</span>
            </span>
        </a>

        <nav class="space-y-2 p-5" aria-label="Navigasi admin">
            <div class="px-4 py-2 text-[10px] font-extrabold uppercase tracking-widest text-gray-400">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}" class="{{ $linkBase }} {{ $active === 'dashboard' ? $linkActive : $linkIdle }}">
                @if($active === 'dashboard') <span class="absolute inset-y-0 left-0 w-1.5 bg-[#FF7A59]"></span> @endif
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2-2h-2a2 2 0 01-2-2v-2z"/></svg>
                <span>Dashboard Utama</span>
            </a>

            <a href="{{ route('admin.assessments.index') }}" class="{{ $linkBase }} {{ $active === 'assessments' ? $linkActive : $linkIdle }}">
                @if($active === 'assessments') <span class="absolute inset-y-0 left-0 w-1.5 bg-[#FF7A59]"></span> @endif
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M12 12h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                <span>Bank Soal Asesmen</span>
            </a>

            <a href="{{ route('admin.universities.index') }}" class="{{ $linkBase }} {{ $active === 'universities' ? $linkActive : $linkIdle }}">
                @if($active === 'universities') <span class="absolute inset-y-0 left-0 w-1.5 bg-[#FF7A59]"></span> @endif
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5"/></svg>
                <span>Data Universitas</span>
            </a>

            <a href="{{ route('admin.majors.index') }}" class="{{ $linkBase }} {{ $active === 'majors' ? $linkActive : $linkIdle }}">
                @if($active === 'majors') <span class="absolute inset-y-0 left-0 w-1.5 bg-[#FF7A59]"></span> @endif
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zM12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                <span>Program Studi &amp; Jurusan</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="{{ $linkBase }} {{ $active === 'users' ? $linkActive : $linkIdle }}">
                @if($active === 'users') <span class="absolute inset-y-0 left-0 w-1.5 bg-[#FF7A59]"></span> @endif
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span>Manajemen Pengguna</span>
            </a>
        </nav>
    </div>

    <div class="border-t border-gray-100 bg-white p-5">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="group flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold text-red-600 transition hover:bg-red-50/80">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 transition group-hover:text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar Sistem
            </button>
        </form>
    </div>
</aside>

<script>
    // Kontrol sidebar mobile; aman dipanggil dari topbar.
    function toggleSidebar() {
        const sidebar = document.getElementById('mobileSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        if (!sidebar || !backdrop) return;

        sidebar.classList.toggle('-translate-x-full');
        backdrop.classList.toggle('hidden');
    }
</script>
