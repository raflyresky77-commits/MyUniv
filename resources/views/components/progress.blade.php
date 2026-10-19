
{{--
    COMPONENT PROGRESS MYUNIV

    Fungsi:
    Menampilkan progress dalam bentuk bar persentase.

    Props:
    - value : nilai progress, dari 0 sampai 100.
    - label : keterangan progress.
    - detail: informasi tambahan, misalnya "2 dari 3 tes".

    Catatan:
    Komponen ini hanya menampilkan progress.
    Perhitungan progress tetap dilakukan oleh halaman/controller.
--}}

@props([
    'value' => 0,
    'label' => 'Progress',
    'detail' => '',
])

@php
    // Pastikan nilai berupa angka dan berada di antara 0–100.
    $progress = max(0, min(100, (float) $value));
@endphp

<div {{ $attributes->merge(['class' => 'w-full']) }}>

    {{-- Label dan persentase di bagian atas --}}
    <div class="flex justify-between items-center gap-3 mb-2">
        <span class="text-sm font-bold text-gray-700">
            {{ $label }}
        </span>

        <span class="text-sm font-extrabold text-[#3650A2]">
            {{ rtrim(rtrim(number_format($progress, 2, '.', ''), '0'), '.') }}%
        </span>
    </div>

    {{-- Detail tambahan, jika diberikan --}}
    @if ($detail !== '')
        <p class="text-xs text-gray-500 mb-2">
            {{ $detail }}
        </p>
    @endif

    {{--
        Track adalah latar bar.
        role dan aria-valuenow membantu aksesibilitas.
    --}}
    <div
        class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden"
        role="progressbar"
        aria-label="{{ $label }}"
        aria-valuemin="0"
        aria-valuemax="100"
        aria-valuenow="{{ $progress }}"
    >
        {{-- Lebar bar mengikuti nilai progress --}}
        <div
            class="h-full rounded-full bg-gradient-to-r
            from-[#3650A2] to-[#FF7A59]
            transition-all duration-500 ease-out"
            style="width: {{ $progress }}%"
        ></div>
    </div>

</div>
