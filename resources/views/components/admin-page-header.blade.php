@props([
    'label' => null,
    'title',
    'description' => null,
    'buttonText' => null,
    'buttonOnclick' => null,
    'buttonHref' => null,
])

{{-- Header banner admin; tombol aksi bisa membuka form atau menuju route. --}}
<section {{ $attributes->merge(['class' => 'relative flex flex-col items-start justify-between gap-6 overflow-hidden rounded-[28px] bg-gradient-to-br from-[#3650A2] to-[#22346E] p-6 text-white shadow-xl shadow-indigo-900/10 sm:p-8 lg:flex-row lg:items-center lg:p-10']) }}>
    <div class="pointer-events-none absolute -right-16 -top-16 h-64 w-64 rounded-full bg-[#FF7A59]/20 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-16 -left-16 h-64 w-64 rounded-full bg-indigo-400/20 blur-3xl"></div>

    <div class="relative z-10 max-w-2xl">
        @if($label)
            <span class="mb-4 inline-flex items-center gap-2 rounded-full bg-[#FF7A59] px-3.5 py-1 text-xs font-extrabold text-white shadow-md shadow-orange-500/20">
                <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-white"></span>
                {{ $label }}
            </span>
        @endif

        <h1 class="mb-2 text-2xl font-black tracking-tight sm:text-3xl lg:text-4xl">{{ $title }}</h1>

        @if($description)
            <p class="text-sm font-medium leading-relaxed text-indigo-100">{{ $description }}</p>
        @endif
    </div>

    @if($buttonText || isset($action))
        <div class="relative z-10 shrink-0">
            @isset($action)
                {{ $action }}
            @elseif($buttonHref)
                <a href="{{ $buttonHref }}" class="inline-flex items-center justify-center gap-2.5 rounded-2xl bg-[#FF7A59] px-5 py-3.5 text-xs font-extrabold text-white shadow-lg shadow-orange-500/30 transition hover:bg-[#e06848] sm:px-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ $buttonText }}
                </a>
            @elseif($buttonOnclick)
                <button type="button" onclick="{{ $buttonOnclick }}" class="inline-flex items-center justify-center gap-2.5 rounded-2xl bg-[#FF7A59] px-5 py-3.5 text-xs font-extrabold text-white shadow-lg shadow-orange-500/30 transition hover:bg-[#e06848] sm:px-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ $buttonText }}
                </button>
            @endif
        </div>
    @endif
</section>
