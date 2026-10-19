@props(['variant' => 'shortcut', 'href' => null, 'click' => null, 'title' => null, 'description' => null, 'icon' => null, 'class' => ''])
@php
    $base = 'group relative transition-all duration-300';
    $variants = [
        'shortcut' => 'card-shortcut-gradient rounded-2xl p-5 flex flex-col justify-between space-y-4',
        'recommendation' => 'rounded-[24px] overflow-hidden flex flex-col justify-between bg-white border border-indigo-100 shadow-sm hover:shadow-md',
        'article' => 'card-shortcut-gradient rounded-2xl p-4 space-y-2.5 cursor-pointer hover:border-[#FF7A59]/40',
        'assessment' => 'card-expressive rounded-[28px] p-6',
    ];
    $classes = $base.' '.($variants[$variant] ?? $variants['shortcut']).' '.$class;
@endphp
@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)<span class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-[#3650A2] mb-3 group-hover:bg-[#3650A2] group-hover:text-white transition-all">{!! $icon !!}</span>@endif
        @if($title)<h3 class="text-xs font-extrabold text-gray-900 group-hover:text-[#3650A2] transition">{{ $title }}</h3>@endif
        @if($description)<p class="text-[11px] text-gray-600 mt-0.5 leading-relaxed">{{ $description }}</p>@endif
        {{ $slot }}
    </a>
@else
    <div @if($click) onclick="{{ $click }}" role="button" tabindex="0" @endif {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)<span class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-[#3650A2] mb-3">{!! $icon !!}</span>@endif
        @if($title)<h3 class="text-xs font-extrabold text-gray-900">{{ $title }}</h3>@endif
        @if($description)<p class="text-[11px] text-gray-600 mt-0.5 leading-relaxed">{{ $description }}</p>@endif
        {{ $slot }}
    </div>
@endif
