    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        indigoPrimary: '#3650A2',
                        coralOrange: '#FF7A59',
                        softSky: '#F4FAFF',
                        brand: {
                            indigo: '#3650A2',
                            coral: '#FF7A59',
                            bgLight: '#F4F7FF',
                            cardBg: '#FFFFFF',
                            pillBg: '#FFEBE6',
                            textGray: '#6B7280',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- FontAwesome & Lucide Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Google Fonts (Plus Jakarta Sans & Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Custom Style & Clip Paths -->
    <style>
        .arrow-card-outer {
            clip-path: polygon(0 0, 82% 0, 100% 50%, 82% 100%, 0 100%);
        }
        .arrow-card-inner {
            clip-path: polygon(0 0, 81.5% 0, 99.2% 50%, 81.5% 100%, 0 100%);
        }
        .clip-arrow-card {
            clip-path: polygon(0% 0%, 92% 0%, 100% 50%, 92% 100%, 0% 100%);
        }
        @media (max-width: 640px) {
            .arrow-card-outer, .arrow-card-inner, .clip-arrow-card {
                clip-path: none;
                border-radius: 1rem;
            }
        }
        .wavy-underline {
            text-decoration: underline;
            text-decoration-style: wavy;
            text-decoration-color: #FF7A59;
            text-underline-offset: 6px;
        }
        @keyframes floatMascot {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-12px) rotate(2deg); }
        }
        .animate-float-mascot {
            animation: floatMascot 4s ease-in-out infinite;
        }
        @keyframes bgGlow {
            0%, 100% { opacity: 0.6; transform: scale(1); }
            50% { opacity: 0.9; transform: scale(1.1); }
        }
        .animate-bg-glow {
            animation: bgGlow 7s ease-in-out infinite;
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            50% { transform: translateY(-15px) translateX(10px); }
        }
        .animate-float-slow {
            animation: floatSlow 6s ease-in-out infinite;
        }
        .step-chevron-card {
            clip-path: polygon(0% 0%, 100% 0%, 100% 85%, 50% 100%, 0% 85%);
            background: #FFFFFF;
            border: 1px solid #C9D7EE;
            transition: all 0.3s ease;
        }
        .step-chevron-card:hover {
            border-color: #FF7A59;
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(54, 80, 162, 0.1);
        }

        /* Responsive refinements for MyUniv landing page */
        html {
            scroll-padding-top: 6rem;
        }

        img,
        iframe {
            max-width: 100%;
        }

        #campusSlider {
            max-width: 100%;
            overscroll-behavior-x: contain;
            -webkit-overflow-scrolling: touch;
        }

        #campusSlider > div {
            flex: 0 0 310px;
            min-width: 310px;
        }

        @media (max-width: 1023px) {
            #rekomendasi .grid.lg\:grid-cols-12 {
                grid-template-columns: minmax(0, 1fr);
            }

            #rekomendasi .lg\:col-span-4,
            #rekomendasi .lg\:col-span-8 {
                min-width: 0;
                width: 100%;
            }

            #campusSlider > div {
                flex-basis: min(78vw, 310px);
                min-width: min(78vw, 310px);
            }
        }

        @media (max-width: 640px) {
            header.fixed {
                padding-left: 8px;
                padding-right: 8px;
            }

            header nav {
                padding: 8px 10px;
                gap: 6px;
                border-radius: 16px;
            }

            header nav > a:first-child {
                gap: 8px;
                min-width: 0;
                flex-shrink: 1;
            }

            header nav > a:first-child > div {
                width: 34px;
                height: 34px;
                flex-shrink: 0;
            }

            header nav > a:first-child > span {
                font-size: 20px;
                white-space: nowrap;
            }

            header nav > div:last-child {
                gap: 4px;
                flex-shrink: 0;
            }

            header nav > div:last-child a {
                padding: 7px 9px;
                font-size: 11px;
                white-space: nowrap;
            }

            header nav > div:last-child button {
                font-size: 19px;
                margin-left: 1px;
                padding: 2px;
            }

            #mobileMenu {
                margin-left: 0;
                margin-right: 0;
                padding: 12px 16px;
            }

            #fitur .arrow-card-inner {
                padding: 1.25rem !important;
            }

            .step-chevron-card {
                clip-path: none;
                border-radius: 16px;
            }

            #rekomendasi {
                padding-top: 3rem;
                padding-bottom: 3rem;
            }

            #rekomendasi h2 {
                overflow-wrap: break-word;
            }

            #campusSlider {
                gap: 12px;
                padding-left: 4px;
                padding-right: 4px;
                margin-left: -4px;
                margin-right: -4px;
            }

            #campusSlider > div {
                flex-basis: min(84vw, 300px);
                min-width: min(84vw, 300px);
            }

            #campusSlider img {
                display: block;
            }

            #faq h2 {
                font-size: clamp(1.35rem, 6vw, 1.875rem);
                line-height: 1.3;
            }

            footer .grid {
                gap: 2rem;
            }

            #chatbotContainer {
                width: min(88vw, 360px);
                right: 0;
                max-height: min(75vh, 600px);
            }

            #chatMessages {
                height: min(18rem, 38vh);
            }

            .animate-float-mascot,
            .animate-float-slow,
            .animate-bg-glow {
                animation-duration: 8s;
            }
        }

        @media (max-width: 360px) {
            header nav > div:last-child a {
                padding: 6px 7px;
                font-size: 10px;
            }

            header nav > a:first-child > span {
                font-size: 18px;
            }

            #campusSlider > div {
                flex-basis: 82vw;
                min-width: 82vw;
            }

            #kuis .rounded-3xl {
                padding: 1rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }



        /* FINAL FIX: Navbar responsif untuk tablet dan mobile */
        @media (max-width: 1023px) {
            header.fixed {
                left: 0;
                right: 0;
                width: 100%;
                padding: 8px 12px;
                box-sizing: border-box;
            }

            header.fixed > nav {
                display: flex;
                width: 100%;
                max-width: none;
                margin: 0;
                padding: 8px 12px;
                gap: 8px;
                box-sizing: border-box;
            }

            /* Link navigasi desktop memang diganti dengan hamburger */
            header.fixed > nav > div:nth-child(2) {
                display: none !important;
            }

            /* Logo tetap di kiri dan tidak mendorong navbar melebar */
            header.fixed > nav > a:first-child {
                display: flex;
                align-items: center;
                flex: 0 1 auto;
                min-width: 0;
                gap: 8px;
            }

            header.fixed > nav > a:first-child > div {
                width: 34px;
                height: 34px;
                flex: 0 0 34px;
            }

            header.fixed > nav > a:first-child > span {
                font-size: 20px;
                white-space: nowrap;
            }

            /* Tombol Masuk/Daftar desktop disembunyikan di baris navbar mobile */
            header.fixed > nav > div:last-child > a {
                display: none !important;
            }

            header.fixed > nav > div:last-child {
                display: flex;
                align-items: center;
                flex: 0 0 auto;
                margin-left: auto;
                gap: 0;
            }

            header.fixed > nav > div:last-child > button {
                display: inline-flex !important;
                align-items: center;
                justify-content: center;
                flex: 0 0 40px;
                width: 40px;
                height: 40px;
                margin: 0;
                padding: 0;
                line-height: 1;
                font-size: 22px;
            }

            /* Dropdown memakai lebar container, bukan lebar desktop max-w-7xl */
            #mobileMenu {
                display: block;
                width: 100%;
                max-width: none;
                margin: 8px 0 0;
                padding: 12px 16px;
                box-sizing: border-box;
            }

            #mobileMenu.hidden {
                display: none !important;
            }
        }

        @media (max-width: 640px) {
            header.fixed {
                padding: 8px;
            }

            header.fixed > nav {
                padding: 7px 10px;
                border-radius: 16px;
            }
        }

        @media (max-width: 360px) {
            header.fixed {
                padding-left: 6px;
                padding-right: 6px;
            }

            header.fixed > nav {
                padding-left: 8px;
                padding-right: 8px;
            }

            header.fixed > nav > a:first-child > span {
                font-size: 18px;
            }
        }


        /* HARD FIX: paksa seluruh layout utama menjadi satu kolom pada layar ponsel */
        @media screen and (max-width: 767px) {
            html, body {
                width: 100%;
                max-width: 100%;
                overflow-x: hidden;
            }

            body {
                min-width: 0;
            }

            header.fixed {
                width: 100%;
                left: 0;
                right: 0;
                padding: 8px 10px;
                box-sizing: border-box;
            }

            header.fixed > nav {
                width: 100%;
                max-width: 100%;
                min-width: 0;
                margin: 0;
                padding: 7px 10px;
                gap: 8px;
                box-sizing: border-box;
            }

            /* Cegah elemen nav desktop membuat lebar layout membesar */
            header.fixed > nav > div:nth-child(2) {
                display: none !important;
            }

            header.fixed > nav > a:first-child {
                min-width: 0;
                max-width: calc(100% - 48px);
                flex: 0 1 auto;
            }

            header.fixed > nav > a:first-child > span {
                font-size: 19px;
            }

            header.fixed > nav > div:last-child {
                flex: 0 0 40px;
                width: 40px;
                margin-left: auto;
            }

            header.fixed > nav > div:last-child > a {
                display: none !important;
            }

            header.fixed > nav > div:last-child > button {
                display: inline-flex !important;
                width: 40px;
                min-width: 40px;
                height: 40px;
                margin: 0;
                padding: 0;
            }

            #mobileMenu {
                width: 100%;
                max-width: 100%;
                margin: 8px 0 0;
                box-sizing: border-box;
            }

            #mobileMenu.hidden {
                display: none !important;
            }

            /* Semua container besar mencegah lebar minimum desktop */
            main, section, footer,
            section > .max-w-7xl,
            footer > .max-w-7xl {
                min-width: 0;
                max-width: 100%;
            }

            img, video, iframe {
                max-width: 100%;
            }
        }

        @media screen and (max-width: 390px) {
            header.fixed {
                padding-left: 8px;
                padding-right: 8px;
            }
        }

    </style>
</head>
