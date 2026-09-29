<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login - MyUniv</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >
    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >
</head>

<body class="min-h-screen bg-[#F4FAFF] font-['Plus_Jakarta_Sans']">

    <main class="min-h-screen flex items-center justify-center px-6 py-10">

        <div
            class="w-full max-w-[1100px] bg-white border border-[#C9D7EE] rounded-[16px] overflow-hidden shadow-sm"
        >

            <div class="grid grid-cols-1 lg:grid-cols-2">

                {{-- LEFT: LOGIN FORM --}}
                <section class="px-8 py-10 sm:px-12 lg:px-16 lg:py-14 flex flex-col justify-center">

                    {{-- Logo --}}
                    <div class="flex items-center gap-3 mb-10">
                        <div
                            class="w-12 h-12 rounded-[10px] border border-[#C9D7EE] flex items-center justify-center overflow-hidden bg-white p-1"
                        >
                            {{-- LOGO MYUNIV --}}
                            <img
                                src="{{ asset('images/eraserbg.png') }}"
                                alt="Logo MyUniv"
                                class="w-full h-full object-contain"
                            >
                        </div>

                        <span class="text-2xl font-bold text-[#2F3136]">
                            MyUniv
                        </span>
                    </div>

                    {{-- Heading --}}
                    <div class="mb-8">
                        <h1
                            class="text-[38px] leading-[48px] font-bold text-[#2F3136]"
                        >
                            Selamat Datang<br>
                            Kembali!
                        </h1>

                        <p class="mt-4 text-base leading-[26px] text-[#6E7178]">
                            Masuk untuk melanjutkan<br class="hidden sm:block">
                            perjalananmu bersama MyUniv.
                        </p>
                    </div>

                    {{-- Error umum --}}
                    @if ($errors->any())
                        <div
                            class="mb-5 rounded-[6px] border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600"
                        >
                            {{ $errors->first() }}
                        </div>
                    @endif

                    {{-- Login Form --}}
                    <form
                        action="{{ route('login.store') }}"
                        method="POST"
                        class="space-y-5"
                    >
                        @csrf

                        {{-- Email / Username --}}
                        <div>
                            <label
                                for="login"
                                class="block mb-2 text-sm font-semibold text-[#2F3136]"
                            >
                                Email / Username
                            </label>

                            <input
                                id="login"
                                name="login"
                                type="text"
                                value="{{ old('login') }}"
                                autocomplete="username"
                                placeholder=""
                                class="w-full h-10 rounded-[6px] border border-[#C9D7EE] bg-white px-3 text-sm text-[#2F3136] outline-none transition focus:border-[#3650A2] focus:ring-2 focus:ring-[#3650A2]/10"
                            >

                            @error('login')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label
                                for="password"
                                class="block mb-2 text-sm font-semibold text-[#2F3136]"
                            >
                                Password
                            </label>

                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                class="w-full h-10 rounded-[6px] border border-[#C9D7EE] bg-white px-3 text-sm text-[#2F3136] outline-none transition focus:border-[#3650A2] focus:ring-2 focus:ring-[#3650A2]/10"
                            >

                            @error('password')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Forgot Password --}}
                        <div class="flex justify-end -mt-2">
                            <a
                                href="#"
                                class="text-xs text-[#2F3136] underline hover:text-[#FF7A59]"
                            >
                                Lupa Password?
                            </a>
                        </div>

                        {{-- Primary Button --}}
                        <button
                            type="submit"
                            class="w-full h-10 rounded-[6px] bg-[#FF7A59] px-4 text-sm font-semibold text-[#F4FAFF] transition hover:bg-[#3650A2] focus:outline-none focus:ring-2 focus:ring-[#3650A2]/20"
                        >
                            Masuk
                        </button>
                    </form>

                    {{-- Register Link --}}
                    <p class="mt-6 text-center text-xs text-[#2F3136]">
                        Belum punya akun?
                        <a
                            href="#"
                            class="font-semibold underline hover:text-[#FF7A59]"
                        >
                            Daftar
                        </a>
                    </p>

                </section>


                {{-- RIGHT: MASCOT --}}
                <section
                    class="hidden lg:flex items-center justify-center bg-[#F4FAFF] px-10 py-12"
                >
                    <div class="text-center flex flex-col items-center">

                        {{-- Wrapper Maskot Lebih Proporsional & Bersih --}}
                        <div
                            class="relative w-[300px] h-[300px] flex items-center justify-center p-4 bg-white/60 rounded-2xl border border-[#C9D7EE]/50 shadow-sm backdrop-blur-sm"
                        >
                            <img
                                src="{{ asset('images/3d1.png') }}"
                                alt="Maskot Mauny"
                                class="w-full h-full object-contain drop-shadow-md"
                            >
                        </div>

                        <h3 class="mt-5 text-base font-bold text-[#2F3136]">
                            Mauny, Teman Setiamu
                        </h3>
                        <p class="mt-1 text-xs text-[#6E7178] max-w-[240px]">
                            Teman perjalananmu menuju masa depan dan kampus impian.
                        </p>

                    </div>
                </section>

            </div>
        </div>

    </main>

</body>
</html>
