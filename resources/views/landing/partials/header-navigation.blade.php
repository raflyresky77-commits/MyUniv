    <!-- Header Navigation -->
    <header class="fixed top-0 left-0 right-0 z-50 px-4 sm:px-8 py-3">
        <nav class="max-w-7xl mx-auto backdrop-blur-md bg-white/80 border border-white/60 shadow-sm rounded-2xl px-5 sm:px-6 py-3 flex items-center justify-between transition-all duration-300">
            <!-- Brand Logo -->
            <a href="#beranda" class="group flex items-center gap-3">
                <div class="relative w-10 h-10 bg-gradient-to-tr from-indigoPrimary to-indigo-600 rounded-xl flex items-center justify-center text-white shadow-md shadow-indigoPrimary/20 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 ease-out">
                    <i class="fa-solid fa-graduation-cap text-lg group-hover:animate-bounce"></i>
                    <span class="absolute -top-1 -right-1 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-coralOrange opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-coralOrange"></span>
                    </span>
                </div>
                <span class="font-extrabold text-2xl tracking-tight text-indigoPrimary group-hover:text-coralOrange transition-colors">
                    MyUniv<span class="text-coralOrange">.</span>
                </span>
            </a>

            <!-- Navigation Links -->
            <div class="hidden lg:flex items-center gap-6 xl:gap-8 font-semibold text-gray-600 text-sm">
                <a href="#beranda" class="hover:text-indigoPrimary transition-colors">Beranda</a>
                <a href="#tentang" class="hover:text-indigoPrimary transition-colors">Tentang</a>
                <a href="#fitur" class="hover:text-indigoPrimary transition-colors">Fitur</a>
                <a href="#kuis" class="hover:text-indigoPrimary transition-colors">Tes Cepat</a>
                <a href="#alur" class="hover:text-indigoPrimary transition-colors">Alur</a>
                <a href="#rekomendasi" class="hover:text-indigoPrimary transition-colors">Rekomendasi</a>
                <a href="#faq" class="hover:text-indigoPrimary transition-colors">FAQ</a>
            </div>

        <!-- Action CTA & Mobile Toggle -->
            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ route('login') }}" class="text-indigoPrimary hover:bg-indigoPrimary/10 border border-indigoPrimary/30 px-3.5 sm:px-4 py-2 rounded-xl font-bold transition-all text-xs sm:text-sm">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="bg-coralOrange hover:bg-orange-600 text-white px-4 sm:px-5 py-2 rounded-xl font-bold shadow-md shadow-coralOrange/25 hover:shadow-lg transition-all transform hover:-translate-y-0.5 text-xs sm:text-sm">
                    Daftar
                </a>
                <button id="mobileMenuToggle" type="button" aria-controls="mobileMenu" aria-expanded="false" aria-label="Buka menu navigasi" onclick="toggleMobileMenu()" class="lg:hidden text-indigoPrimary text-2xl ml-2 focus:outline-none">
                    <i class="fa-solid fa-bars" id="menuIcon"></i>
                </button>
            </div>
        </nav>

        <!-- Mobile Navigation Menu -->
        <div id="mobileMenu" class="hidden lg:hidden max-w-7xl mx-auto mt-2 bg-white/95 backdrop-blur-md border border-gray-100 rounded-2xl p-5 shadow-xl space-y-3 font-semibold text-gray-700">
            <a href="#beranda" onclick="toggleMobileMenu()" class="block py-2 hover:text-indigoPrimary border-b border-gray-100">Beranda</a>
            <a href="#tentang" onclick="toggleMobileMenu()" class="block py-2 hover:text-indigoPrimary border-b border-gray-100">Tentang</a>
            <a href="#fitur" onclick="toggleMobileMenu()" class="block py-2 hover:text-indigoPrimary border-b border-gray-100">Fitur</a>
            <a href="#kuis" onclick="toggleMobileMenu()" class="block py-2 hover:text-indigoPrimary border-b border-gray-100">Tes Cepat</a>
            <a href="#alur" onclick="toggleMobileMenu()" class="block py-2 hover:text-indigoPrimary border-b border-gray-100">Alur</a>
            <a href="#rekomendasi" onclick="toggleMobileMenu()" class="block py-2 hover:text-indigoPrimary border-b border-gray-100">Rekomendasi</a>
            <a href="#faq" onclick="toggleMobileMenu()" class="block py-2 hover:text-indigoPrimary">FAQ</a>
            <div class="grid grid-cols-2 gap-3 pt-3">
                <a href="{{ route('login') }}" class="block text-center border border-indigoPrimary/30 text-indigoPrimary px-3 py-2 rounded-xl font-bold text-sm">Masuk</a>
                <a href="{{ route('register') }}" class="block text-center bg-coralOrange text-white px-3 py-2 rounded-xl font-bold text-sm">Daftar</a>
            </div>
        </div>
    </header>
