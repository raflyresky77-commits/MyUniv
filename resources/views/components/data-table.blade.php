@props([
    'tableClass' => '',
    'wrapperClass' => '',
])

{{-- Wrapper tabel netral: header, kolom, baris, dan aksi tetap ditulis di halaman pemanggil. --}}
<div {{ $attributes->merge(['class' => 'w-full overflow-hidden rounded-2xl border border-[#E2E8F0] bg-white ' . $wrapperClass]) }}>
    <div class="w-full overflow-x-auto">
        <table class="w-full min-w-max border-collapse text-left text-sm {{ $tableClass }}">
            {{ $slot }}
        </table>
    </div>
</div>
