{{-- Component input search reusable untuk halaman MyUniv --}}
@props([
    'id' => 'searchInput', // ID input untuk diakses JavaScript bila diperlukan
    'name' => 'search', // Nama field jika dipakai dalam form
    'value' => '', // Nilai awal input
    'placeholder' => 'Cari data...', // Petunjuk pencarian
    'onkeyup' => null, // Fungsi live search opsional
    'wrapperClass' => 'relative w-full sm:w-80', // Gaya pembungkus input
    'inputClass' => 'w-full pl-11 pr-4 py-2.5 bg-[#F8FBFF] border border-[#E2E8F0] rounded-xl text-xs font-semibold focus:outline-none focus:border-[#3650A2] transition', // Gaya input
])

{{-- Pembungkus input dan ikon pencarian --}}
<div class="{{ $wrapperClass }}">
    {{-- Ikon kaca pembesar di sebelah kiri input --}}
    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </span>

    {{-- Input dapat memakai live search atau form GET sesuai halaman --}}
    <input
        type="text"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        @if($onkeyup) onkeyup="{{ $onkeyup }}" @endif
        class="{{ $inputClass }}"
    >
</div>
