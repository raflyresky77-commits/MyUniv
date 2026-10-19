{{-- Panel reusable untuk halaman asesmen. Class tambahan tetap dikontrol dari halaman pemanggil. --}}
@props(['variant' => 'default'])
@php
    $variants = [
        'default' => 'bg-white border border-[#E2E8F0] shadow-sm',
        'glass' => 'bg-gradient-to-br from-white/95 to-[#F0F5FF]/90 backdrop-blur-xl border-2 border-[rgba(54,80,162,0.12)] shadow-[0_20px_40px_-15px_rgba(54,80,162,0.08)]',
        'instruction' => 'bg-gradient-to-r from-indigo-900 to-[#2B4185] text-white shadow-md',
        'questionnaire' => 'bg-white border border-[#E2E8F0] shadow-sm',
    ];
@endphp
<div {{ $attributes->class($variants[$variant] ?? $variants['default']) }}>
    {{ $slot }}
</div>
