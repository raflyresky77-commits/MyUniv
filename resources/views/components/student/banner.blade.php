@props([
    'eyebrow' => 'Informasi MyUniv',
    'title' => 'Temukan Potensi dan Masa Depanmu',
    'description' => '',
])

<section class="bg-gradient-strong rounded-[32px] p-8 sm:p-10 text-white relative overflow-hidden shadow-xl shadow-indigo-950/15">
    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
    <div class="absolute right-20 top-0 w-32 h-32 bg-[#FF7A59]/20 rounded-full blur-xl pointer-events-none"></div>

    <div class="relative z-10 max-w-2xl space-y-3">
        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-bold text-indigo-100">
            <svg class="w-3.5 h-3.5 text-[#FF7A59]" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.788 0l7-3a1 1 0 000-1.84l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.17 1 1 0 01.01-1.98c.35.035.7.093 1.05.17V16.5a1 1 0 001 1h8a1 1 0 001-1v-4.148c.35-.077.7-.135 1.05-.17a1 1 0 01.01 1.98 8.969 8.969 0 01-1.05.17v-4.102l1.69-.723a1 1 0 000-1.84l-7-3a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84z"/></svg>
            {{ $eyebrow }}
        </span>

        <h1 class="text-2xl sm:text-4xl font-black tracking-tight leading-tight">{{ $title }}</h1>

        @if (filled($description))
            <p class="text-xs sm:text-sm text-indigo-100 font-medium leading-relaxed">{{ $description }}</p>
        @endif

        {{ $slot }}
    </div>
</section>
