{{-- Sidebar bersama untuk halaman admin MyUniv. --}}
@props([
    'menus' => [],
    'active' => '',
    'title' => 'MyUniv',
    'logo' => null,
])

{{-- Sidebar memenuhi tinggi viewport dan tetap responsif di perangkat mobile. --}}
<aside
    id="mobileSidebar"
    {{ $attributes->merge([
        'class' => 'fixed inset-y-0 left-0 z-50 flex h-screen h-dvh w-72 flex-col border-r border-[#E2E8F0] bg-white shadow-2xl transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 md:shadow-[4px_0_24px_rgba(54,80,162,0.03)]'
    ]) }}
>
    {{-- Area menu dapat digulir tanpa menggeser footer logout. --}}
    <div class="min-h-0 flex-1 overflow-y-auto overscroll-contain">

        {{-- Identitas aplikasi dan logo. --}}
        <div class="flex items-center gap-3.5 border-b border-gray-100 px-6 py-6">
            @if ($logo)
                <img
                    src="{{ asset($logo) }}"
                    alt="{{ $title }} Logo"
                    class="h-10 w-auto object-contain"
                >
            @endif

            <div>
                <span class="block text-lg font-black leading-none tracking-tight text-[#3650A2]">
                    {{ $title }}
                </span>

                <span class="mt-1 block text-[10px] font-extrabold uppercase tracking-wider text-gray-400">
                    Enterprise OS
                </span>
            </div>
        </div>

        {{-- Daftar navigasi admin. --}}
        <nav class="space-y-2 p-5" aria-label="Navigasi admin">
            <div class="px-4 py-2 text-[10px] font-extrabold uppercase tracking-widest text-gray-400">
                Menu Utama
            </div>

            @foreach ($menus as $menu)
                @php
                    $isActive = ($menu['key'] ?? '') === $active;
                @endphp

                <a
                    href="{{ $menu['url'] ?? '#' }}"
                    @class([
                        'group relative flex items-center gap-3.5 overflow-hidden rounded-2xl px-4 py-3.5 text-sm transition-all duration-300',
                        'bg-gradient-to-r from-[#3650A2] to-[#22346E] font-bold text-white shadow-lg shadow-indigo-200/60' => $isActive,
                        'font-semibold text-gray-600 hover:bg-[#F0F5FF] hover:text-[#3650A2]' => !$isActive,
                    ])
                    @if ($isActive)
                        aria-current="page"
                    @endif
                >
                    {{-- Aksen untuk menu yang sedang aktif. --}}
                    @if ($isActive)
                        <span class="absolute bottom-0 left-0 top-0 w-2 bg-[#FF7A59]"></span>
                    @endif

                    {{-- Ikon navigasi menu. --}}
                    @if (!empty($menu['icon']))
                        <span class="ml-1 shrink-0">
                            {!! $menu['icon'] !!}
                        </span>
                    @endif

                    <span>{{ $menu['label'] ?? 'Menu' }}</span>
                </a>
            @endforeach
        </nav>
    </div>

    {{-- Footer terpisah dari area scroll agar logout tetap terlihat. --}}
    <footer class="relative z-20 mt-auto shrink-0 border-t border-gray-100 bg-white p-4 pb-[max(1rem,env(safe-area-inset-bottom))]">

        {{-- Slot menerima form logout dari halaman dashboard. --}}
        <div class="w-full">
            {{ $slot }}
        </div>
    </footer>
</aside>
