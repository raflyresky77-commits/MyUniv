@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
    'block' => false,
])

@php
    // Variant lama dipertahankan agar pemanggilan tombol yang sudah ada tetap kompatibel.
    $baseClasses = 'group relative inline-flex items-center justify-center gap-2 overflow-hidden rounded-xl font-bold transition-all duration-300 ease-out focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 active:scale-[0.98]';

    $variants = [
        'primary' => 'bg-[#3650A2] text-white shadow-sm hover:-translate-y-0.5 hover:bg-[#2B4185] hover:shadow-lg focus-visible:ring-indigo-500',
        'gradient' => 'bg-gradient-to-r from-[#3650A2] via-[#405FC0] to-indigo-800 text-white shadow-md shadow-indigo-900/15 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-indigo-900/20 focus-visible:ring-indigo-500',
        'outline' => 'border border-[#3650A2]/25 bg-white text-[#3650A2] hover:-translate-y-0.5 hover:border-[#3650A2] hover:bg-[#EEF3FF] hover:shadow-md focus-visible:ring-indigo-500',
        'soft' => 'bg-[#EEF3FF] text-[#3650A2] hover:-translate-y-0.5 hover:bg-indigo-100 hover:shadow-sm focus-visible:ring-indigo-500',
        'coral' => 'bg-[#FF7A59] text-white shadow-sm hover:-translate-y-0.5 hover:bg-orange-600 hover:shadow-lg focus-visible:ring-orange-400',
        'coral-gradient' => 'bg-gradient-to-r from-[#FF7A59] via-[#FF8969] to-orange-500 text-white shadow-md shadow-orange-900/15 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-orange-900/20 focus-visible:ring-orange-400',
        'secondary' => 'bg-gray-100 text-gray-700 hover:-translate-y-0.5 hover:bg-gray-200 hover:shadow-sm focus-visible:ring-gray-400',
        'danger' => 'bg-red-600 text-white shadow-sm hover:-translate-y-0.5 hover:bg-red-700 hover:shadow-lg focus-visible:ring-red-500',
        // Variant tambahan
        'premium' => 'border border-white/20 bg-gradient-to-r from-[#263B83] via-[#3650A2] to-[#526ED0] text-white shadow-lg shadow-[#3650A2]/25 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#3650A2]/30 focus-visible:ring-indigo-500',
        'glow' => 'bg-[#3650A2] text-white shadow-lg shadow-[#3650A2]/25 hover:-translate-y-0.5 hover:bg-[#2B4185] hover:shadow-xl hover:shadow-[#3650A2]/40 focus-visible:ring-indigo-500',
        'glass' => 'border border-white/70 bg-white/75 text-[#3650A2] shadow-sm backdrop-blur-md hover:-translate-y-0.5 hover:bg-white hover:shadow-md focus-visible:ring-indigo-500',
        'gradient-coral' => 'bg-gradient-to-r from-[#3650A2] via-[#526ED0] to-[#FF7A59] text-white shadow-md shadow-[#3650A2]/20 hover:-translate-y-0.5 hover:shadow-xl focus-visible:ring-indigo-500',
    ];

    $sizes = [
        'sm' => 'px-3.5 py-2 text-xs min-h-8',
        'md' => 'px-5 py-3 text-sm min-h-11',
        'lg' => 'px-6 py-3.5 text-sm min-h-12',
    ];

    $classes = $baseClasses
        . ' ' . ($variants[$variant] ?? $variants['primary'])
        . ' ' . ($sizes[$size] ?? $sizes['md'])
        . ($block ? ' w-full' : '');
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button
        type="{{ $type }}"
        @disabled($attributes->has('disabled'))
        {{ $attributes->merge(['class' => $classes])->except(['disabled']) }}
    >{{ $slot }}</button>
@endif
