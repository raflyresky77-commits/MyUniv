@props(['eyebrow' => 'Akses Cepat', 'title' => 'Eksplorasi Fitur', 'hint' => 'Pilih menu navigasi di bawah'])
<section {{ $attributes->merge(['class' => 'section-shortcut-bg rounded-[32px] p-5 sm:p-6 space-y-4 shadow-sm']) }}>
    <div class="flex items-center justify-between px-1 gap-3"><div><span class="text-[9px] font-black text-[#FF7A59] uppercase tracking-widest block">{{ $eyebrow }}</span><h2 class="text-base font-black text-[#3650A2]">{{ $title }}</h2></div><span class="text-[11px] font-semibold text-gray-500 hidden sm:inline">{{ $hint }}</span></div>
    {{ $slot }}
</section>
