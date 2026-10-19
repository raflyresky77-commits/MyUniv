@props([
    'id' => 'editModal',
    'title' => 'Edit Data',
    'formId' => 'editForm',
    'maxWidth' => 'max-w-xl',
    'closeFunction' => 'closeEditModal()',
    'method' => 'PUT',
])

{{-- Modal edit generik; isi form disesuaikan lewat slot pada tiap halaman. --}}
<div id="{{ $id }}" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm">
    <div class="w-full {{ $maxWidth }} max-h-[90vh] overflow-y-auto rounded-[28px] bg-white shadow-2xl">
        <div class="relative flex items-center justify-between overflow-hidden bg-[#3650A2] p-6 text-white">
            <div class="pointer-events-none absolute -right-10 -bottom-10 h-32 w-32 rounded-full bg-[#FF7A59]/20 blur-2xl"></div>
            <h3 class="relative z-10 text-lg font-black tracking-tight">{{ $title }}</h3>
            <button type="button" onclick="{{ $closeFunction }}" class="relative z-10 p-2 text-lg font-bold text-white/80 hover:text-white" aria-label="Tutup modal">&times;</button>
        </div>

        <form id="{{ $formId }}" method="POST" {{ $attributes->except(['class'])->merge(['class' => 'space-y-4 p-6']) }}>
            @csrf
            @if($method)
                @method($method)
            @endif
            {{ $slot }}
        </form>
    </div>
</div>
