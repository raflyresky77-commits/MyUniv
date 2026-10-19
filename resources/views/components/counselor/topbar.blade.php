@props([
    'title' => 'Beranda',
    'subtitle' => 'Panel Guru BK',
])

<header class="sticky top-0 z-40 flex w-full shrink-0 items-center justify-between border-b border-[#E2E8F0] bg-white/90 px-4 py-4 shadow-sm backdrop-blur-md sm:px-6 md:px-10 md:py-5">
    <div class="flex min-w-0 items-center gap-3">
        <button
            type="button"
            onclick="toggleCounselorSidebar()"
            class="rounded-xl bg-gray-100 p-2 text-gray-700 transition hover:bg-indigo-50 hover:text-[#3650A2] focus:outline-none focus:ring-2 focus:ring-indigo-200 md:hidden"
            aria-label="Buka atau tutup menu"
            aria-controls="counselorSidebar"
            aria-expanded="false"
            id="counselorSidebarToggle"
        >
            <svg id="counselorMenuIcon" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M4 6h16M4 12h16M4 18h16" stroke-width="2.5" stroke-linecap="round"/>
            </svg>
        </button>

        <div class="flex min-w-0 items-center gap-2 sm:gap-3">
            <span class="inline-flex shrink-0 rounded-full bg-indigo-50 px-3 py-1 text-[10px] font-bold tracking-wide text-[#3650A2] sm:text-xs">
                {{ $subtitle }}
            </span>

            <span aria-hidden="true" class="hidden text-gray-300 sm:inline">/</span>

            <h1 class="truncate text-sm font-extrabold tracking-tight text-gray-800">
                {{ $title }}
            </h1>
        </div>
    </div>

    <div class="ml-3 flex shrink-0 items-center gap-3">
        <div class="hidden text-right sm:block">
            <div class="text-sm font-extrabold leading-tight text-gray-900">
                {{ Auth::user()->name ?? 'Guru BK' }}
            </div>
            <div class="text-xs font-semibold text-indigo-500">Guru BK</div>
        </div>

        <div
            class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[#2B4185] to-[#141F43] text-xs font-extrabold text-white shadow-md shadow-indigo-900/20 transition-transform hover:scale-105"
            aria-label="Avatar Guru BK"
        >
            {{ collect(preg_split('/\s+/', trim(Auth::user()->name ?? 'Guru BK')))->filter()->take(2)->map(fn ($part) => mb_substr($part, 0, 1))->implode('') }}
        </div>
    </div>
</header>

<script>
    (function () {
        const sidebarId = 'counselorSidebar';
        const backdropId = 'counselorSidebarBackdrop';
        const toggleId = 'counselorSidebarToggle';

        window.toggleCounselorSidebar = function () {
            const sidebar = document.getElementById(sidebarId);
            if (!sidebar) return;

            const isOpen = !sidebar.classList.contains('-translate-x-full');

            isOpen
                ? window.closeCounselorSidebar()
                : window.openCounselorSidebar();
        };

        window.openCounselorSidebar = function () {
            const sidebar = document.getElementById(sidebarId);
            const backdrop = document.getElementById(backdropId);
            const toggle = document.getElementById(toggleId);

            if (!sidebar || !backdrop) return;

            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');

            if (toggle) toggle.setAttribute('aria-expanded', 'true');
        };

        window.closeCounselorSidebar = function () {
            const sidebar = document.getElementById(sidebarId);
            const backdrop = document.getElementById(backdropId);
            const toggle = document.getElementById(toggleId);

            if (sidebar && window.innerWidth < 768) {
                sidebar.classList.add('-translate-x-full');
            }

            if (backdrop) backdrop.classList.add('hidden');
            if (toggle) toggle.setAttribute('aria-expanded', 'false');
        };

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                window.closeCounselorSidebar();
            }
        });

        window.addEventListener('resize', function () {
            const sidebar = document.getElementById(sidebarId);
            const backdrop = document.getElementById(backdropId);
            const toggle = document.getElementById(toggleId);

            if (window.innerWidth >= 768) {
                if (sidebar) sidebar.classList.remove('-translate-x-full');
                if (backdrop) backdrop.classList.add('hidden');
                if (toggle) toggle.setAttribute('aria-expanded', 'false');
            } else {
                if (sidebar) sidebar.classList.add('-translate-x-full');
            }
        });
    })();
</script>
