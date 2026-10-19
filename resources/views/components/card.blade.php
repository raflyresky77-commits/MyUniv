{{-- COMPONENT CARD MYUNIV — tambah variant strong sesuai desain halaman Asesmen --}}
@props([
    'variant' => 'default',
])

@php
    $variantClasses = [
        'default' => 'bg-white border border-[#E2E8F0] rounded-2xl shadow-sm',
        'expressive' => 'bg-white border border-[#E2E8F0] rounded-3xl shadow-sm overflow-hidden',
        'interactive' => 'bg-white border border-[#E2E8F0] rounded-2xl shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg',
        'gradient' => 'bg-gradient-to-br from-[#3650A2] to-[#22346E] text-white rounded-2xl shadow-lg',
        'strong' => 'bg-white/95 backdrop-blur-xl border border-[rgba(54,80,162,0.12)] rounded-[36px] shadow-[0_20px_45px_-12px_rgba(30,45,98,0.12),0_0_0_1px_rgba(54,80,162,0.04)] transition-all duration-300 hover:-translate-y-1.5 hover:border-[rgba(54,80,162,0.4)] hover:shadow-[0_28px_55px_-15px_rgba(54,80,162,0.2)]',
        'strong-highlight' => 'bg-white/95 backdrop-blur-xl border-2 border-[#3650A2]/30 rounded-[36px] shadow-xl shadow-indigo-900/10 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_28px_55px_-15px_rgba(54,80,162,0.22)] overflow-hidden',
    ];

    $selectedClass = $variantClasses[$variant] ?? $variantClasses['default'];
@endphp

<div {{ $attributes->merge(['class' => $selectedClass . ' p-5']) }}>
    {{ $slot }}
</div>
