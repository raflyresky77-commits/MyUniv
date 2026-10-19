
{{-- resources/views/components/student/student-sidebar.blade.php --}}
@props(['active' => 'dashboard'])

<style>
    /* ===== SIDEBAR ===== */
    #mobileSidebar {
        position: fixed;
        inset: 0 auto 0 0;
        z-index: 50;
        width: min(18rem, 86vw);
        height: 100vh;
        height: 100dvh;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: #fff;
        transform: translateX(-110%);
        visibility: hidden;
        pointer-events: none;
        transition:
            transform 300ms ease,
            visibility 300ms ease;
        will-change: transform;
    }

    #mobileSidebar.is-open {
        transform: translateX(0);
        visibility: visible;
        pointer-events: auto;
    }

    /* Sidebar selalu tampil di desktop. */
    @media (min-width: 768px) {
        #mobileSidebar,
        #mobileSidebar.is-open {
            width: 18rem;
            transform: translateX(0);
            visibility: visible;
            pointer-events: auto;
        }
    }

    /* ===== BACKDROP ===== */
    #sidebarBackdrop {
        display: none !important;
        position: fixed;
        inset: 0;
        z-index: 45;
        background: rgba(15, 23, 42, 0.45);
        opacity: 0;
        pointer-events: none;
        transition: opacity 200ms ease;
    }

    #sidebarBackdrop.is-visible {
        display: block !important;
        opacity: 1;
        pointer-events: auto;
    }

    /* ===== ISI MENU ===== */
    #sidebarMenuContent {
        flex: 1 1 auto;
        min-height: 0;
        overflow-x: hidden;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        overscroll-behavior: contain;
    }

    /* ===== FOOTER LOGOUT ===== */
    #sidebarLogoutFooter {
        flex: 0 0 auto;
        width: 100%;
        background: #fff;
        padding-bottom: max(1.25rem, env(safe-area-inset-bottom));
    }

    @media (prefers-reduced-motion: reduce) {
        #mobileSidebar,
        #sidebarBackdrop {
            transition: none;
        }
    }
</style>

{{-- Backdrop: satu elemen saja dengan ID ini di halaman --}}
<div
    id="sidebarBackdrop"
    aria-hidden="true"
    onclick="window.myUnivToggleStudentSidebar(true)"
></div>

<aside
    id="mobileSidebar"
    aria-label="Navigasi siswa"
    aria-hidden="true"
    class="bg-white border-r border-[#E2E8F0] shadow-2xl md:shadow-[4px_0_24px_rgba(54,80,162,0.05)]"
>
    {{-- LOGO --}}
    <div class="px-6 py-6 border-b border-gray-100 flex items-center gap-3.5 shrink-0">
        <div class="w-11 h-11 flex items-center justify-center bg-indigo-50 rounded-[14px] border border-indigo-200/80 p-1.5 shrink-0 shadow-sm">
            <img
                src="{{ asset('images/icon.png') }}"
                alt="Logo MyUniv"
                class="w-full h-full object-contain"
            >
        </div>

        <div>
            <span class="text-lg font-black text-[#3650A2] tracking-tight leading-none block">
                MyUniv
            </span>
            <span class="text-[10px] font-extrabold text-indigo-400 uppercase tracking-wider mt-1 block">
                Sistem Peminatan
            </span>
        </div>
    </div>

    {{-- NAVIGASI --}}
    <div id="sidebarMenuContent">
        <nav class="p-5 space-y-2">
            <div class="px-4 py-2 text-[10px] font-extrabold text-indigo-400 uppercase tracking-widest">
                Menu Utama
            </div>

            @php
                $menus = [
                    [
                        'label' => 'Beranda',
                        'route' => 'student.dashboard',
                        'key' => 'dashboard',
                        'icon' => 'home',
                    ],
                    [
                        'label' => 'Asesmen',
                        'route' => 'student.assessment.index',
                        'key' => 'assessment',
                        'icon' => 'clipboard',
                    ],
                    [
                        'label' => 'Eksplorasi',
                        'route' => 'student.exploration.index',
                        'key' => 'exploration',
                        'icon' => 'search',
                    ],
                    [
                        'label' => 'Education Planning',
                        'route' => 'student.planning.index',
                        'key' => 'planning',
                        'icon' => 'calendar',
                    ],
                    [
                        'label' => 'Konsultasi BK',
                        'route' => 'student.consultation.index',
                        'key' => 'consultation',
                        'icon' => 'chat',
                    ],
                    [
                        'label' => 'Profil',
                        'route' => 'student.profile.index',
                        'key' => 'profile',
                        'icon' => 'user',
                    ],
                ];
            @endphp

            @foreach ($menus as $menu)
                @php
                    $isActive = ($active ?? 'dashboard') === $menu['key'];
                @endphp

                <a
                    href="{{ route($menu['route']) }}"
                    @class([
                        'flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-sm transition-all duration-200 relative overflow-hidden group',
                        'bg-gradient-to-r from-[#2B4185] to-[#141F43] text-white font-bold shadow-lg shadow-indigo-900/25' => $isActive,
                        'text-gray-600 hover:bg-[#EEF3FF] hover:text-[#3650A2] font-semibold' => !$isActive,
                    ])
                >
                    @if ($isActive)
                        <span class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#FF7A59]"></span>
                    @endif

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 shrink-0 {{ $isActive ? 'ml-1 text-white' : 'text-gray-400 group-hover:text-[#3650A2]' }}"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        @switch($menu['icon'])
                            @case('home')
                                <path d="m3 10 9-7 9 7"/>
                                <path d="M5 9v11h14V9"/>
                                <path d="M9 20v-6h6v6"/>
                                @break

                            @case('clipboard')
                                <rect x="5" y="4" width="14" height="17" rx="2"/>
                                <path d="M9 4.5V3h6v1.5"/>
                                <path d="m9 12 2 2 4-4"/>
                                <path d="M9 17h6"/>
                                @break

                            @case('search')
                                <circle cx="10.8" cy="10.8" r="6.8"/>
                                <path d="m16 16 4.5 4.5"/>
                                @break

                            @case('calendar')
                                <rect x="3" y="5" width="18" height="16" rx="2"/>
                                <path d="M16 3v4M8 3v4M3 10h18"/>
                                <path d="m9 15 2 2 4-4"/>
                                @break

                            @case('chat')
                                <path d="M21 11.5a8.5 8.5 0 0 1-8.5 8.5 9 9 0 0 1-4-.9L3 21l1.9-5.5a9 9 0 0 1-.9-4A8.5 8.5 0 0 1 12.5 3H13a8.5 8.5 0 0 1 8 8v.5Z"/>
                                <path d="M8 12h.01M12 12h.01M16 12h.01"/>
                                @break

                            @case('user')
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 21v-2a8 8 0 0 1 16 0v2"/>
                                @break
                        @endswitch
                    </svg>

                    <span>{{ $menu['label'] }}</span>
                </a>
            @endforeach
        </nav>
    </div>

    {{-- LOGOUT --}}
    <div
        id="sidebarLogoutFooter"
        class="shrink-0 p-5 border-t border-gray-100 bg-white"
    >
        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button
                type="submit"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-red-600 hover:bg-red-50 font-bold text-sm transition-all group"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 shrink-0 text-red-500 group-hover:scale-110 transition-transform"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <path d="M10 17l5-5-5-5"/>
                    <path d="M15 12H3"/>
                    <path d="M12 3h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"/>
                </svg>

                <span>Keluar (Logout)</span>
            </button>
        </form>
    </div>
</aside>

<script>
    (function () {
        function setStudentSidebarOpen(open) {
            const sidebar = document.getElementById('mobileSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');

            if (!sidebar) return;

            // Di desktop, sidebar tetap tampil dan overlay harus mati.
            if (window.innerWidth >= 768) {
                open = false;
            }

            sidebar.classList.toggle('is-open', open);
            sidebar.setAttribute('aria-hidden', String(!open));

            if (backdrop) {
                backdrop.classList.toggle('is-visible', open);
                backdrop.setAttribute('aria-hidden', String(!open));

                // Set display secara eksplisit supaya overlay tidak tertinggal.
                backdrop.style.setProperty(
                    'display',
                    open ? 'block' : 'none',
                    'important'
                );

                backdrop.style.pointerEvents = open ? 'auto' : 'none';
                backdrop.style.opacity = open ? '1' : '0';
            }

            document.body.classList.toggle('overflow-hidden', open);
        }

        // true = tutup, false = buka; tanpa argumen = toggle.
        window.myUnivToggleStudentSidebar = function (forceClose) {
            const sidebar = document.getElementById('mobileSidebar');

            if (!sidebar) return;

            if (typeof forceClose === 'boolean') {
                setStudentSidebarOpen(!forceClose);
                return;
            }

            const isOpen = sidebar.classList.contains('is-open');
            setStudentSidebarOpen(!isOpen);
        };

        // Kompatibilitas untuk tombol hamburger versi lama.
        window.toggleSidebar = function () {
            window.myUnivToggleStudentSidebar();
        };

        // Kondisi awal: tertutup di mobile.
        function initializeStudentSidebar() {
            setStudentSidebarOpen(false);
        }

        if (document.readyState === 'loading') {
            document.addEventListener(
                'DOMContentLoaded',
                initializeStudentSidebar,
                { once: true }
            );
        } else {
            initializeStudentSidebar();
        }

        // Escape untuk menutup sidebar.
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                setStudentSidebarOpen(false);
            }
        });

        // Saat berpindah ke desktop, tutup overlay.
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768) {
                setStudentSidebarOpen(false);
            }
        });
    })();
</script>
