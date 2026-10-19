
{{--
    COMPONENT ALERT MYUNIV

    Fungsi:
    Menampilkan pesan status kepada pengguna.

    Variant:
    - success : proses berhasil.
    - error   : terjadi kesalahan.
    - warning : pengguna perlu berhati-hati.
    - info    : informasi umum.

    Komponen ini menampilkan pesan di dalam halaman,
    bukan popup SweetAlert2.
--}}

@props([
    'type' => 'info',
    'title' => '',
])

@php
    // Warna dan ikon visual berdasarkan jenis pesan.
    $alertStyles = [
        'success' => [
            'container' => 'bg-emerald-50 border-emerald-200 text-emerald-800',
            'icon' => '✓',
        ],
        'error' => [
            'container' => 'bg-red-50 border-red-200 text-red-800',
            'icon' => '!',
        ],
        'warning' => [
            'container' => 'bg-amber-50 border-amber-200 text-amber-800',
            'icon' => '!',
        ],
        'info' => [
            'container' => 'bg-blue-50 border-blue-200 text-blue-800',
            'icon' => 'i',
        ],
    ];

    // Gunakan gaya info jika jenis yang diberikan tidak tersedia.
    $style = $alertStyles[$type] ?? $alertStyles['info'];
@endphp

{{-- role="alert" membantu teknologi pembaca layar mengenali pesan. --}}
<div
    role="alert"
    {{ $attributes->merge([
        'class' => 'flex items-start gap-3 p-4 border rounded-2xl '
            . $style['container']
    ]) }}
>
    {{-- Ikon status --}}
    <span
        aria-hidden="true"
        class="flex items-center justify-center w-6 h-6
            rounded-full border border-current text-xs
            font-black shrink-0"
    >
        {{ $style['icon'] }}
    </span>

    <div class="min-w-0">
        {{-- Judul opsional --}}
        @if ($title !== '')
            <p class="font-bold text-sm">
                {{ $title }}
            </p>
        @endif

        {{-- Isi pesan dikirim melalui slot --}}
        <div class="text-sm">
            {{ $slot }}
        </div>
    </div>
</div>
