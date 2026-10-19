
{{--
    COMPONENT NAVBAR MYUNIV
    Fungsi: Menampilkan bar navigasi bagian atas halaman.
    Judul dan informasi pengguna bisa disesuaikan
    dari halaman yang memanggil komponen ini.
--}}

{{--
    PROPS:
    title    = judul halaman.
    subtitle = label kecil di samping judul.
    username = nama yang ditampilkan di navbar.
    email    = email pengguna.
    initials = inisial untuk avatar.
--}}
@props([
    'title' => 'Dashboard',
    'subtitle' => 'MyUniv',
    'username' => 'Pengguna',
    'email' => '',
    'initials' => 'MU',
])

<header class="bg-white/90 backdrop-blur-md border-b border-[#E2E8F0]
                px-6 lg:px-10 py-5 flex justify-between items-center
                sticky top-0 z-30 shadow-sm w-full">

    {{-- Bagian kiri: tombol menu mobile dan judul halaman --}}
    <div class="flex items-center gap-3 min-w-0">

        {{--
            Tombol menu mobile.
            Event toggleSidebar() harus tersedia pada halaman
            yang menggunakan navbar ini.
        --}}
        <button
            type="button"
            onclick="if (typeof toggleSidebar === 'function') toggleSidebar()"
            aria-label="Buka atau tutup sidebar"
            class="md:hidden p-2.5 rounded-xl text-gray-700
                bg-gray-100 hover:bg-indigo-50
                hover:text-[#3650A2] transition"
        >
            {{-- Ikon hamburger --}}
            <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2.5"
                    d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        {{-- Label kecil di sebelah judul --}}
        <span class="text-xs font-extrabold px-3 py-1.5
                bg-indigo-50 text-[#3650A2] rounded-xl
                tracking-wide border border-indigo-100/50
                hidden sm:inline">
            {{ $subtitle }}
        </span>

        {{-- Judul halaman --}}
        <h1 class="text-sm font-black text-gray-800 tracking-tight
                truncate">
            {{ $title }}
        </h1>
    </div>

    {{-- Bagian kanan: identitas pengguna --}}
    <div class="flex items-center gap-3 ml-4">

        {{-- Nama dan email pengguna --}}
        <div class="text-right hidden sm:block">
            <div class="text-sm font-extrabold text-gray-900">
                {{ $username }}
            </div>

            @if ($email !== '')
                <div class="text-xs font-semibold text-gray-400">
                    {{ $email }}
                </div>
            @endif
        </div>

        {{-- Avatar dengan inisial pengguna --}}
        <div class="w-10 h-10 shrink-0 rounded-xl
                    bg-gradient-to-br from-[#3650A2] to-[#22346E]
                    text-white flex items-center justify-center
                    font-extrabold text-xs shadow-md">
            {{ $initials }}
        </div>
    </div>

</header>
