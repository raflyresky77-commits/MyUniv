    {{-- ========== HERO (Mauny mengintip) · aset: public/images/mauny/ ========== --}}
<style>
    /* Hero MyUniv: card tetap menjadi struktur utama, Mauny menjadi bagian dari komposisi. */
    @keyframes heroRise {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes heroFloat {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50%      { transform: translateY(-9px) rotate(1deg); }
    }
    .hero-rise {
        animation: heroRise .65s ease-out both;
        animation-delay: var(--d, 0s);
    }

    .hero-hybrid-card {
        position: relative;
        isolation: isolate;
        background: rgba(255,255,255,.82);
        border: 1px solid #C9D7EE;
        border-radius: 28px;
        box-shadow: 0 18px 48px rgba(54,80,162,.07);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
    }

    .hero-hybrid-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.08fr) minmax(0, .92fr);
        align-items: center;
        min-height: 470px;
    }

    .hero-hybrid-copy {
        min-width: 0;
        padding: 48px 0 48px 54px;
        position: relative;
        z-index: 2;
    }

    .hero-hybrid-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        max-width: 100%;
        padding: 9px 14px;
        color: #3650A2;
        background: #F4FAFF;
        border: 1px solid #C9D7EE;
        border-radius: 999px;
        font-size: 12px;
        line-height: 1.35;
        font-weight: 700;
    }

    .hero-hybrid-eyebrow-dot {
        width: 8px;
        height: 8px;
        flex: 0 0 8px;
        border-radius: 50%;
        background: #FF7A59;
        box-shadow: 0 0 0 4px rgba(255,122,89,.12);
    }

    .hero-hybrid-title {
        max-width: 620px;
        margin-top: 23px;
        color: #3650A2;
        font-size: clamp(2.55rem, 4vw, 3.55rem);
        line-height: 1.13;
        letter-spacing: -.045em;
        font-weight: 800;
        text-wrap: balance;
    }

    .hero-hybrid-highlight {
        color: #FF7A59;
        font-style: italic;
        text-decoration: underline wavy rgba(255,122,89,.85);
        text-decoration-thickness: 3px;
        text-underline-offset: 8px;
        -webkit-box-decoration-break: clone;
        box-decoration-break: clone;
    }

    .hero-hybrid-description {
        max-width: 485px;
        margin-top: 17px;
        color: #6E7178;
        font-size: 15px;
        line-height: 1.75;
    }

    .hero-hybrid-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        margin-top: 27px;
    }

    .hero-hybrid-actions a {
        min-height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 12px 21px;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 700;
        transition: transform .2s ease, background-color .2s ease, border-color .2s ease, box-shadow .2s ease;
    }

    .hero-hybrid-primary {
        color: #fff;
        background: #FF7A59;
        box-shadow: 0 8px 18px rgba(255,122,89,.19);
    }

    .hero-hybrid-primary:hover {
        color: #fff;
        background: #e96d4d;
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(255,122,89,.24);
    }

    .hero-hybrid-secondary {
        color: #3650A2;
        background: rgba(255,255,255,.78);
        border: 1px solid rgba(54,80,162,.25);
    }

    .hero-hybrid-secondary:hover {
        background: #F4FAFF;
        border-color: #3650A2;
        transform: translateY(-2px);
    }

    .hero-hybrid-note {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 19px;
        color: #6E7178;
        font-size: 12px;
        font-weight: 500;
    }

    .hero-hybrid-art {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        align-self: stretch;
        min-width: 0;
        min-height: 430px;
        isolation: isolate;
    }

    .hero-hybrid-halo {
        position: absolute;
        z-index: -1;
        width: min(96%, 440px);
        aspect-ratio: 1;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,255,255,.98) 0%, rgba(244,250,255,.83) 42%, rgba(255,235,230,.35) 62%, rgba(255,255,255,0) 74%);
    }

    .hero-hybrid-mascot {
        position: relative;
        z-index: 1;
        display: block;
        width: min(112%, 510px);
        max-height: 470px;
        height: auto;
        object-fit: contain;
        transform: translate(10px, 15px);
        filter: drop-shadow(0 18px 22px rgba(54,80,162,.12));
        animation: heroFloat 5s ease-in-out infinite;
    }

    /* Aksen dekoratif kecil sebagai pengganti balon percakapan. */
    .hero-hybrid-doodle {
        position: absolute;
        z-index: 2;
        display: grid;
        place-items: center;
        pointer-events: none;
        user-select: none;
        line-height: 1;
        filter: drop-shadow(0 4px 7px rgba(54,80,162,.10));
        animation: heroFloat 5.5s ease-in-out infinite;
    }

    .hero-hybrid-doodle-star {
        top: 17%;
        right: 8%;
        color: #FF7A59;
        font-size: 30px;
    }

    .hero-hybrid-doodle-heart {
        bottom: 22%;
        left: 7%;
        color: #F4A8C2;
        font-size: 25px;
        animation-delay: .8s;
    }

    .hero-hybrid-doodle-orbit {
        top: 25%;
        left: 7%;
        width: 48px;
        height: 48px;
        border: 1px dashed rgba(94,115,200,.38);
        border-radius: 50%;
        animation: heroFloat 6s ease-in-out infinite reverse;
    }

    .hero-hybrid-doodle-orbit::after {
        content: '';
        position: absolute;
        top: 2px;
        right: 3px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #FFB49F;
        box-shadow: 0 0 0 4px rgba(255,122,89,.10);
    }

    .hero-hybrid-spark {
        position: absolute;
        z-index: 2;
        color: #FF7A59;
        font-size: 25px;
        pointer-events: none;
        animation: heroFloat 5.5s ease-in-out infinite;
    }

    .hero-hybrid-spark-one { top: 24%; left: 3%; }
    .hero-hybrid-spark-two { right: 5%; bottom: 17%; color: #5E73C8; font-size: 30px; animation-delay: 1s; }

    @media (max-width: 1023px) {
        #beranda.hero-hybrid-section {
            padding-top: 126px;
            padding-bottom: 58px;
        }

        .hero-hybrid-grid {
            grid-template-columns: minmax(0, 1fr);
            min-height: 0;
        }

        .hero-hybrid-copy {
            padding: 42px 42px 0;
            text-align: center;
        }

        .hero-hybrid-title,
        .hero-hybrid-description {
            margin-left: auto;
            margin-right: auto;
        }

        .hero-hybrid-actions,
        .hero-hybrid-note {
            justify-content: center;
        }

        .hero-hybrid-art {
            min-height: 350px;
            max-width: 560px;
            width: 100%;
            margin: -3px auto 0;
        }

        .hero-hybrid-mascot {
            width: min(88%, 420px);
            max-height: 390px;
            transform: translateY(8px);
        }

        .hero-hybrid-doodle-star { top: 14%; right: 10%; font-size: 27px; }
        .hero-hybrid-doodle-heart { bottom: 18%; left: 9%; font-size: 22px; }
        .hero-hybrid-doodle-orbit { top: 22%; left: 9%; width: 40px; height: 40px; }
    }

    @media (max-width: 640px) {
        #beranda.hero-hybrid-section {
            padding: 104px 0 38px !important;
        }

        .hero-hybrid-container {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }

        .hero-hybrid-card {
            border-radius: 22px;
            box-shadow: 0 12px 34px rgba(54,80,162,.065);
        }

        .hero-hybrid-copy {
            padding: 28px 20px 0;
        }

        .hero-hybrid-eyebrow {
            padding: 7px 11px;
            gap: 8px;
            font-size: 10px;
        }

        #beranda .hero-hybrid-title {
            margin-top: 18px !important;
            font-size: clamp(2rem, 8vw, 2.55rem) !important;
            line-height: 1.16 !important;
            letter-spacing: -.045em !important;
        }

        .hero-hybrid-highlight {
            text-decoration-thickness: 2px;
            text-underline-offset: 5px;
        }

        .hero-hybrid-description {
            margin-top: 13px;
            font-size: 13px;
            line-height: 1.65;
        }

        .hero-hybrid-actions {
            width: 100%;
            gap: 9px;
            margin-top: 21px;
        }

        .hero-hybrid-actions a {
            min-height: 45px;
            padding: 10px 14px;
            font-size: 12px;
        }

        .hero-hybrid-note {
            margin-top: 14px;
            font-size: 11px;
        }

        .hero-hybrid-art {
            min-height: 260px;
            margin-top: 0;
        }

        .hero-hybrid-mascot {
            width: min(86%, 315px);
            max-height: 285px;
            transform: translateY(8px);
        }

        .hero-hybrid-halo {
            width: 88%;
        }

        .hero-hybrid-doodle-star { top: 13%; right: 8%; font-size: 22px; }
        .hero-hybrid-doodle-heart { bottom: 14%; left: 6%; font-size: 19px; }
        .hero-hybrid-doodle-orbit { top: 20%; left: 5%; width: 32px; height: 32px; }

        .hero-hybrid-spark-one { top: 27%; left: 4%; font-size: 18px; }
        .hero-hybrid-spark-two { right: 4%; bottom: 12%; font-size: 21px; }
    }

    @media (max-width: 380px) {
        .hero-hybrid-copy { padding-left: 16px; padding-right: 16px; }
        #beranda .hero-hybrid-title { font-size: clamp(1.85rem, 8vw, 2.15rem) !important; }
        .hero-hybrid-actions { flex-direction: column; }
        .hero-hybrid-actions a { width: 100%; }
        .hero-hybrid-doodle-orbit { width: 27px; height: 27px; }
        .hero-hybrid-art { min-height: 235px; }
    }

    @media (prefers-reduced-motion: reduce) {
        .hero-rise,
        .hero-hybrid-mascot,
        .hero-hybrid-doodle,
        .hero-hybrid-spark {
            animation: none !important;
        }
    }
</style>

<!-- Hero Section -->
<section id="beranda" class="hero-hybrid-section relative pt-36 pb-16 md:pt-40 md:pb-20" style="overflow-x: clip;">
    <!-- Glow asli dipertahankan agar background tetap terasa hidup. -->
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-tr from-indigoPrimary/20 via-coralOrange/15 to-pink-400/10 rounded-full blur-3xl -z-10 animate-bg-glow pointer-events-none"></div>

    <div class="hero-hybrid-container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="hero-hybrid-card">
            <div class="hero-hybrid-grid">
                <!-- Konten utama: satu pesan singkat, satu deskripsi, dua CTA. -->
                <div class="hero-hybrid-copy">
                    <div class="hero-rise hero-hybrid-eyebrow" style="--d:.05s">
                        <span class="hero-hybrid-eyebrow-dot" aria-hidden="true"></span>
                        <span>Teman perjalanan kuliahmu</span>
                        <span class="text-coralOrange" aria-hidden="true">✦</span>
                    </div>

                    <h1 class="hero-rise hero-hybrid-title" style="--d:.15s">
                        Temukan jurusan yang sesuai dengan
                        <span class="hero-hybrid-highlight">minat &amp; bakatmu.</span>
                    </h1>

                    <p class="hero-rise hero-hybrid-description" style="--d:.25s">
                        Kenali potensimu dan rencanakan pendidikan selanjutnya bersama MyUniv.
                    </p>

                    <div class="hero-rise hero-hybrid-actions" style="--d:.35s">
                        <a href="#kuis" class="hero-hybrid-primary">
                            Mulai Tes Gratis
                            <i class="fa-solid fa-arrow-right text-sm" aria-hidden="true"></i>
                        </a>
                        <a href="#alur" class="hero-hybrid-secondary">
                            Pelajari Alur
                        </a>
                    </div>

                    <div class="hero-rise hero-hybrid-note" style="--d:.45s">
                        <i class="fa-solid fa-circle-check text-green-500" aria-hidden="true"></i>
                        <span>Tes awal gratis untuk mengenali potensimu</span>
                    </div>
                </div>

                <!-- Mauny menyatu dengan card tanpa panel atau frame gambar tambahan. -->
                <div class="hero-hybrid-art" aria-label="Ilustrasi Mauny, maskot MyUniv">
                    <div class="hero-hybrid-halo" aria-hidden="true"></div>
                    <span class="hero-hybrid-spark hero-hybrid-spark-one" aria-hidden="true">✦</span>
                    <span class="hero-hybrid-spark hero-hybrid-spark-two" aria-hidden="true">✧</span>

                    <!-- Aksen kecil mengelilingi Mauny; tanpa balon teks agar headline tetap menjadi fokus. -->
                    <span class="hero-hybrid-doodle hero-hybrid-doodle-star" aria-hidden="true">✦</span>
                    <span class="hero-hybrid-doodle hero-hybrid-doodle-heart" aria-hidden="true">♥</span>
                    <span class="hero-hybrid-doodle hero-hybrid-doodle-orbit" aria-hidden="true"></span>

                    <img src="{{ asset('images/MascotUtama.jpg') }}"
                        onerror="this.onerror=null; this.src='https://placehold.co/500x500/F4FAFF/3650A2?text=Mauny+Mascot'"
                        alt="Mauny, naga pemandu MyUniv"
                        width="500" height="500"
                        class="hero-hybrid-mascot"
                        fetchpriority="high"
                        decoding="async">
                </div>
            </div>
        </div>
    </div>
</section>
