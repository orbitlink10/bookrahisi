<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi For Business | Booking Software For Salons &amp; Spas</title>
        <meta
            name="description"
            content="Book Rahisi gives salons, spas, barbershops, and fitness businesses a clean booking system with staff scheduling, reminders, and marketplace discovery."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --ink: #121316;
                --muted: #69707d;
                --line: #dedfe3;
                --surface: #ffffff;
                --surface-soft: #f5f5f7;
                --pill: #f8f8f9;
                --dark: #111214;
                --shadow: 0 16px 40px rgba(18, 19, 22, 0.08);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                background: #fff;
                color: var(--ink);
                font-family: 'Manrope', sans-serif;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            .page-shell {
                width: min(100% - 48px, 1820px);
                margin: 0 auto;
            }

            .site-header {
                position: sticky;
                top: 0;
                z-index: 20;
                background: rgba(255, 255, 255, 0.96);
                border-bottom: 1px solid rgba(18, 19, 22, 0.06);
                backdrop-filter: blur(14px);
            }

            .nav-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 24px;
                min-height: 88px;
            }

            .brand {
                font-family: 'Outfit', sans-serif;
                font-size: 2.05rem;
                font-weight: 800;
                letter-spacing: -0.08em;
                text-transform: lowercase;
            }

            .nav-links,
            .nav-actions {
                display: flex;
                align-items: center;
                gap: 22px;
            }

            .nav-link {
                font-size: 0.98rem;
                font-weight: 700;
            }

            .pill-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                min-height: 72px;
                padding: 0 34px;
                border: 1px solid var(--line);
                border-radius: 999px;
                background: var(--surface);
                font-size: 0.98rem;
                font-weight: 800;
            }

            .pill-button-dark {
                border-color: transparent;
                background: var(--dark);
                color: #fff;
            }

            .hero {
                padding: 102px 0 88px;
                text-align: center;
            }

            .hero-title {
                margin: 0 auto;
                max-width: 15ch;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(3.2rem, 7.2vw, 6rem);
                line-height: 0.95;
                letter-spacing: -0.08em;
            }

            .hero-copy {
                margin: 28px auto 40px;
                max-width: 840px;
                color: var(--muted);
                font-size: clamp(1.08rem, 2vw, 1.28rem);
                line-height: 1.75;
            }

            .hero-actions {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 24px;
                flex-wrap: wrap;
            }

            .hero-actions .pill-button {
                min-height: 76px;
                min-width: 258px;
                font-size: 1rem;
            }

            .section {
                padding: 26px 0 54px;
            }

            .business-gallery-section {
                padding: 6px 0 54px;
            }

            .business-gallery-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 24px;
            }

            .business-gallery-card {
                position: relative;
                overflow: hidden;
                aspect-ratio: 1.08 / 1;
                border-radius: 28px;
                background-image:
                    linear-gradient(180deg, rgba(18, 19, 22, 0.05) 0%, rgba(18, 19, 22, 0.12) 46%, rgba(18, 19, 22, 0.72) 100%),
                    var(--card-image);
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
                box-shadow: var(--shadow);
            }

            .business-gallery-card-title {
                position: absolute;
                left: 32px;
                right: 110px;
                bottom: 28px;
                margin: 0;
                color: #fff;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2rem, 2.8vw, 2.8rem);
                line-height: 0.98;
                letter-spacing: -0.06em;
            }

            .business-gallery-arrow {
                position: absolute;
                right: 32px;
                bottom: 26px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 60px;
                height: 60px;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.88);
                color: var(--dark);
                font-size: 2rem;
                line-height: 1;
                box-shadow: 0 10px 22px rgba(17, 18, 20, 0.16);
            }

            .section-head {
                display: flex;
                align-items: end;
                justify-content: space-between;
                gap: 20px;
                margin-bottom: 24px;
            }

            .section-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2rem, 4vw, 3.1rem);
                line-height: 1;
                letter-spacing: -0.06em;
            }

            .section-copy {
                max-width: 720px;
                color: var(--muted);
                line-height: 1.8;
            }

            .types-grid,
            .plans-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 20px;
            }

            .feature-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 18px;
            }

            .card,
            .feature-item {
                border: 1px solid var(--line);
                background: var(--surface);
                box-shadow: var(--shadow);
            }

            .card {
                padding: 28px;
            }

            .card h3,
            .feature-item strong,
            .plan-price {
                font-family: 'Outfit', sans-serif;
            }

            .card h3 {
                margin: 0 0 12px;
                font-size: 1.75rem;
                line-height: 1;
                letter-spacing: -0.05em;
            }

            .card p {
                margin: 0;
                color: var(--muted);
                line-height: 1.8;
            }

            .feature-item {
                padding: 24px;
                background: var(--surface-soft);
            }

            .feature-item strong {
                display: block;
                margin-bottom: 10px;
                font-size: 1.35rem;
                line-height: 1.05;
                letter-spacing: -0.04em;
            }

            .feature-item span {
                color: var(--muted);
                line-height: 1.75;
            }

            .plans-grid .card {
                padding: 30px;
            }

            .plan-label {
                display: inline-block;
                margin-bottom: 16px;
                padding: 10px 16px;
                border-radius: 999px;
                background: var(--pill);
                font-size: 0.86rem;
                font-weight: 800;
            }

            .plan-price {
                margin: 0 0 12px;
                font-size: 2.35rem;
                line-height: 1;
                letter-spacing: -0.06em;
            }

            .footer {
                padding: 34px 0 44px;
                border-top: 1px solid var(--line);
                color: var(--muted);
                font-size: 0.92rem;
            }

            .footer-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 18px;
            }

            .footer-links {
                display: flex;
                align-items: center;
                gap: 18px;
            }

            @media (max-width: 1120px) {
                .nav-row {
                    flex-wrap: wrap;
                    justify-content: center;
                    padding: 16px 0;
                }

                .business-gallery-grid,
                .feature-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 840px) {
                .page-shell {
                    width: min(100% - 24px, 1820px);
                }

                .nav-links,
                .nav-actions,
                .types-grid,
                .plans-grid,
                .feature-grid,
                .footer-row {
                    grid-template-columns: 1fr;
                    flex-direction: column;
                    align-items: stretch;
                }

                .business-gallery-grid {
                    grid-template-columns: 1fr;
                }

                .nav-links,
                .nav-actions {
                    width: 100%;
                    gap: 12px;
                }

                .nav-link,
                .pill-button {
                    text-align: center;
                }

                .hero {
                    padding: 68px 0 60px;
                }

                .section-head {
                    align-items: start;
                    flex-direction: column;
                }

                .hero-actions {
                    gap: 14px;
                }

                .hero-actions .pill-button {
                    width: 100%;
                    min-width: 0;
                }

                .business-gallery-card-title {
                    left: 22px;
                    right: 88px;
                    bottom: 22px;
                }

                .business-gallery-arrow {
                    right: 22px;
                    bottom: 20px;
                    width: 52px;
                    height: 52px;
                }
            }
        </style>
    </head>
    <body>
        <header class="site-header">
            <div class="page-shell nav-row">
                <a class="brand" href="{{ route('home') }}">bookrahisi</a>

                <nav class="nav-links" aria-label="Business navigation">
                    <a class="nav-link" href="#business-types">Business types</a>
                    <a class="nav-link" href="#features">Features</a>
                    <a class="nav-link" href="#pricing">Pricing</a>
                </nav>

                <div class="nav-actions">
                    <a class="pill-button" href="{{ route('home') }}">Marketplace</a>
                    <a class="pill-button pill-button-dark" href="{{ route('for-business.sign-in') }}">Sign up</a>
                    <a class="pill-button" href="#menu">Menu</a>
                </div>
            </div>
        </header>

        <main>
            <section class="hero page-shell">
                <h1 class="hero-title">The #1 software for Salons and Spas</h1>
                <p class="hero-copy">
                    Simple, flexible and powerful booking software for your business. Book Rahisi helps beauty,
                    wellness and fitness teams manage appointments, collect payments, and grow through marketplace discovery.
                </p>

                <div class="hero-actions">
                    <a class="pill-button pill-button-dark" href="{{ route('for-business.sign-in') }}">Get started now</a>
                    <a class="pill-button" href="#features">Watch an overview</a>
                </div>
            </section>

            <section class="business-gallery-section page-shell" id="business-types" aria-label="Business types">
                <div class="business-gallery-grid">
                    @foreach ($businessTypeGallery as $type)
                        <article class="business-gallery-card" style="--card-image: url('{{ $type['image'] }}');">
                            <h2 class="business-gallery-card-title">{{ $type['title'] }}</h2>
                            @if ($type['show_arrow'])
                                <span class="business-gallery-arrow" aria-hidden="true">&rarr;</span>
                            @endif
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="section page-shell">
                <div class="section-head">
                    <h2 class="section-title">Built for service-led businesses.</h2>
                    <div class="section-copy">
                        Start with a public profile, then run staff, services, bookings, reminders, payments, and reporting from one place.
                    </div>
                </div>

                <div class="types-grid">
                    @foreach ($businessTypes as $type)
                        <article class="card">
                            <h3>{{ $type['title'] }}</h3>
                            <p>{{ $type['description'] }}</p>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="section page-shell" id="features">
                <div class="section-head">
                    <h2 class="section-title">The core tools businesses need.</h2>
                    <div class="section-copy">
                        The product direction is straightforward: cleaner operations for owners and a smoother booking experience for customers.
                    </div>
                </div>

                <div class="feature-grid">
                    @foreach ($features as $feature)
                        <article class="feature-item">
                            <strong>{{ $feature }}</strong>
                            <span>Designed for Kenyan beauty, wellness, and fitness businesses that need less admin and better visibility.</span>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="section page-shell" id="pricing">
                <div class="section-head">
                    <h2 class="section-title">Pricing that can scale with the marketplace.</h2>
                    <div class="section-copy">
                        Start with free discovery or move into a fuller operating plan with payments, calendars, staff management, and analytics.
                    </div>
                </div>

                <div class="plans-grid">
                    @foreach ($plans as $plan)
                        <article class="card">
                            <span class="plan-label">{{ $plan['name'] }}</span>
                            <div class="plan-price">{{ $plan['price'] }}</div>
                            <p>{{ $plan['description'] }}</p>
                        </article>
                    @endforeach
                </div>
            </section>
        </main>

        <footer class="footer" id="signup">
            <div class="page-shell footer-row">
                <div>Book Rahisi for Business helps salons, spas, barbershops, and studios move bookings online.</div>
                <div class="footer-links">
                    <a href="{{ route('home') }}">Marketplace</a>
                    <a href="#features">Features</a>
                    <a href="#pricing">Pricing</a>
                </div>
            </div>
        </footer>
    </body>
</html>
