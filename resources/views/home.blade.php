<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi | Beauty, Wellness &amp; Fitness Booking</title>
        <meta
            name="description"
            content="Book Rahisi helps customers find salons, spas, barbershops, and fitness classes across Kenya with fast online booking."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --accent: #d44d44;
                --accent-dark: #ba3f36;
                --accent-soft: #ffdbe4;
                --accent-soft-deep: #ffcdd8;
                --ink: #15181d;
                --muted: #6b7280;
                --line: #e5e7eb;
                --surface: #ffffff;
                --star: #f4b73f;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: 'Manrope', sans-serif;
                color: var(--ink);
                background: #fff;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            button,
            input,
            select {
                font: inherit;
            }

            .page-shell {
                width: min(100% - 32px, 1840px);
                margin: 0 auto;
            }

            .promo-band {
                position: relative;
                overflow: hidden;
                padding: 18px 0;
                background: linear-gradient(90deg, var(--accent-soft) 0%, #ffd1df 50%, var(--accent-soft) 100%);
                text-align: center;
                color: #8f4350;
                font-size: 0.96rem;
                font-weight: 700;
            }

            .promo-band::before,
            .promo-band::after {
                content: '';
                position: absolute;
                inset: 0 auto 0 10%;
                width: 240px;
                background:
                    radial-gradient(circle at 18% 50%, rgba(255, 255, 255, 0.65) 0 5px, transparent 6px),
                    radial-gradient(circle at 48% 24%, rgba(255, 150, 177, 0.45) 0 7px, transparent 8px),
                    radial-gradient(circle at 80% 70%, rgba(154, 197, 255, 0.38) 0 6px, transparent 7px);
                pointer-events: none;
            }

            .promo-band::after {
                inset: 0 10% 0 auto;
            }

            .promo-band a {
                margin-left: 10px;
                color: var(--accent);
            }

            .site-header {
                position: sticky;
                top: 0;
                z-index: 20;
                background: rgba(255, 255, 255, 0.96);
                border-bottom: 1px solid rgba(17, 24, 39, 0.06);
                backdrop-filter: blur(14px);
            }

            .top-nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 24px;
                min-height: 76px;
            }

            .brand {
                font-family: 'Outfit', sans-serif;
                font-size: 2.2rem;
                font-weight: 800;
                letter-spacing: -0.08em;
                color: var(--accent);
                text-transform: lowercase;
            }

            .nav-links {
                display: flex;
                align-items: center;
                gap: 18px;
            }

            .nav-link {
                padding: 12px 14px;
                font-size: 0.96rem;
                font-weight: 700;
            }

            .nav-link-primary {
                min-width: 188px;
                padding: 16px 26px;
                border-radius: 8px;
                background: var(--accent);
                color: #fff;
                text-align: center;
                box-shadow: 0 12px 24px rgba(212, 77, 68, 0.18);
            }

            .hero-stage {
                padding-top: 8px;
            }

            .hero-surface {
                position: relative;
                min-height: 585px;
                background-image:
                    linear-gradient(90deg, rgba(32, 26, 27, 0.22) 0%, rgba(32, 26, 27, 0.14) 35%, rgba(32, 26, 27, 0.08) 100%),
                    url('{{ $hero['image'] }}');
                background-position: center;
                background-size: cover;
                overflow: hidden;
            }

            .hero-inner {
                position: relative;
                z-index: 1;
                padding: 72px 0 78px;
            }

            .hero-title {
                margin: 0 0 16px;
                max-width: 11ch;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(3.5rem, 7vw, 5.8rem);
                line-height: 0.94;
                letter-spacing: -0.07em;
                color: #fff;
            }

            .hero-copy {
                margin: 0 0 34px;
                max-width: 720px;
                color: rgba(255, 255, 255, 0.94);
                font-size: 1.04rem;
                line-height: 1.7;
            }

            .search-bar {
                display: grid;
                grid-template-columns: minmax(0, 1.15fr) minmax(0, 1.2fr) minmax(0, 0.7fr) 170px;
                max-width: 1080px;
                overflow: hidden;
                border-radius: 14px;
                background: #fff;
                box-shadow: 0 18px 42px rgba(17, 24, 39, 0.22);
            }

            .search-segment {
                display: flex;
                align-items: center;
                gap: 16px;
                min-height: 74px;
                padding: 0 24px;
                border-right: 1px solid var(--line);
            }

            .search-icon {
                flex: 0 0 22px;
                width: 22px;
                height: 22px;
                color: #545f6b;
            }

            .search-input,
            .search-select {
                width: 100%;
                border: 0;
                outline: none;
                color: var(--ink);
                font-size: 1rem;
                background: transparent;
            }

            .search-input::placeholder {
                color: #8b94a1;
            }

            .search-button {
                border: 0;
                background: var(--accent);
                color: #fff;
                font-size: 1rem;
                font-weight: 800;
                cursor: pointer;
                transition: background 180ms ease;
            }

            .search-button:hover {
                background: var(--accent-dark);
            }

            .service-pills {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 22px;
            }

            .service-pill {
                padding: 13px 24px;
                border-radius: 999px;
                border: 1px solid rgba(255, 255, 255, 0.72);
                background: rgba(255, 255, 255, 0.06);
                color: #fff;
                font-weight: 700;
                backdrop-filter: blur(8px);
            }

            .section {
                padding: 30px 0 0;
            }

            .section-head {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                margin-bottom: 14px;
            }

            .section-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.65rem;
                line-height: 1.1;
                letter-spacing: -0.05em;
            }

            .section-link {
                color: var(--accent);
                font-size: 0.92rem;
                font-weight: 800;
            }

            .business-grid {
                display: grid;
                grid-template-columns: repeat(5, minmax(0, 1fr));
                gap: 16px;
            }

            .business-card,
            .deal-card {
                display: block;
                background: #fff;
                border: 1px solid #eef0f3;
                box-shadow: 0 8px 24px rgba(17, 24, 39, 0.05);
            }

            .business-card:hover,
            .deal-card:hover {
                transform: translateY(-2px);
                transition: transform 180ms ease;
            }

            .business-image,
            .deal-image {
                background-image: var(--card-image);
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
            }

            .business-image {
                aspect-ratio: 1 / 0.78;
            }

            .business-body {
                padding: 12px 12px 14px;
            }

            .business-name {
                display: block;
                margin-bottom: 4px;
                font-size: 0.96rem;
                font-weight: 800;
                letter-spacing: -0.03em;
            }

            .business-meta {
                color: var(--muted);
                font-size: 0.84rem;
                line-height: 1.5;
            }

            .business-rating {
                display: flex;
                align-items: center;
                gap: 6px;
                margin-top: 8px;
                font-size: 0.82rem;
            }

            .stars {
                color: var(--star);
                letter-spacing: 0.12em;
            }

            .daily-deals-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 18px;
            }

            .deal-image {
                position: relative;
                height: 236px;
            }

            .deal-badge {
                position: absolute;
                top: 12px;
                right: 12px;
                padding: 8px 11px;
                border-radius: 999px;
                background: rgba(17, 24, 39, 0.88);
                color: #fff;
                font-size: 0.72rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.04em;
            }

            .deal-body {
                padding: 13px 4px 2px;
            }

            .deal-title {
                display: block;
                margin-bottom: 6px;
                font-size: 1rem;
                font-weight: 800;
                letter-spacing: -0.03em;
            }

            .deal-location {
                color: var(--muted);
                font-size: 0.84rem;
                line-height: 1.55;
            }

            .cities-section {
                padding: 32px 0 76px;
            }

            .business-cta {
                padding-bottom: 46px;
            }

            .business-cta-card {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 24px;
                padding: 28px 32px;
                border: 1px solid #f2d3d0;
                background: linear-gradient(90deg, #fff5f3 0%, #fff 100%);
                box-shadow: 0 14px 36px rgba(212, 77, 68, 0.08);
            }

            .business-cta-copy h2 {
                margin: 0 0 10px;
                font-family: 'Outfit', sans-serif;
                font-size: 2rem;
                line-height: 1;
                letter-spacing: -0.05em;
            }

            .business-cta-copy p {
                margin: 0;
                max-width: 700px;
                color: var(--muted);
                line-height: 1.7;
            }

            .business-cta-button {
                flex: 0 0 auto;
                padding: 16px 24px;
                background: var(--accent);
                color: #fff;
                font-weight: 800;
                border-radius: 10px;
                box-shadow: 0 12px 24px rgba(212, 77, 68, 0.16);
            }

            .city-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 0 26px;
            }

            .city-link {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 14px;
                padding: 16px 0;
                border-bottom: 1px solid var(--line);
                font-size: 0.95rem;
                font-weight: 700;
            }

            .city-link span:last-child {
                color: #8f98a5;
            }

            .site-footer {
                border-top: 1px solid var(--line);
                padding: 28px 0 40px;
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

            @media (max-width: 1260px) {
                .business-grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }

                .daily-deals-grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }

                .city-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 980px) {
                .nav-links {
                    gap: 8px;
                }

                .nav-link {
                    padding-inline: 10px;
                }

                .search-bar {
                    grid-template-columns: 1fr;
                    max-width: 640px;
                }

                .search-segment {
                    border-right: 0;
                    border-bottom: 1px solid var(--line);
                }

                .business-grid,
                .daily-deals-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 760px) {
                .page-shell {
                    width: min(100% - 20px, 1840px);
                }

                .promo-band {
                    padding-inline: 16px;
                    font-size: 0.9rem;
                }

                .top-nav {
                    flex-direction: column;
                    align-items: stretch;
                    padding: 14px 0 16px;
                }

                .nav-links {
                    flex-wrap: wrap;
                    justify-content: space-between;
                }

                .brand {
                    font-size: 1.9rem;
                }

                .hero-surface {
                    min-height: 640px;
                }

                .hero-inner {
                    padding: 52px 0 54px;
                }

                .hero-title {
                    max-width: none;
                }

                .hero-copy {
                    font-size: 0.98rem;
                }

                .service-pills {
                    gap: 10px;
                }

                .service-pill {
                    width: calc(50% - 5px);
                    text-align: center;
                    padding-inline: 14px;
                }

                .business-grid,
                .daily-deals-grid,
                .city-grid,
                .footer-row {
                    grid-template-columns: 1fr;
                    flex-direction: column;
                    align-items: flex-start;
                }

                .business-cta-card {
                    flex-direction: column;
                    align-items: flex-start;
                    padding: 24px 20px;
                }
            }

            @media (max-width: 540px) {
                .nav-links {
                    display: grid;
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    width: 100%;
                }

                .nav-link,
                .nav-link-primary {
                    width: 100%;
                    text-align: center;
                }

                .service-pill {
                    width: 100%;
                }

                .business-grid,
                .daily-deals-grid,
                .city-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        <div class="promo-band">
            New on Book Rahisi: discover businesses with live availability and M-Pesa deposit options.
            <a href="#daily-deals">Explore deals &rarr;</a>
        </div>

        <header class="site-header">
            <div class="page-shell top-nav">
                <a class="brand" href="{{ route('home') }}">bookrahisi</a>

                <nav class="nav-links" aria-label="Primary navigation">
                    <a class="nav-link nav-link-primary" href="{{ route('for-business') }}">For Business</a>
                    <a class="nav-link" href="#daily-deals">Daily Deals</a>
                    <a class="nav-link" href="#nearby">Professionals</a>
                    <a class="nav-link" href="#daily-deals">Gallery</a>
                    <a class="nav-link" href="{{ route('for-business.sign-in') }}">Login</a>
                </nav>
            </div>
        </header>

        <main>
            <section class="hero-stage">
                <div class="hero-surface">
                    <div class="page-shell hero-inner">
                        <h1 class="hero-title">{{ $hero['title'] }}</h1>
                        <p class="hero-copy">{{ $hero['subtitle'] }}</p>

                        <form class="search-bar" action="#" method="get" aria-label="Search services">
                            <div class="search-segment">
                                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="11" cy="11" r="7"></circle>
                                    <path d="m20 20-3.5-3.5"></path>
                                </svg>
                                <input class="search-input" type="text" name="location" placeholder="Business Name or Location">
                            </div>

                            <div class="search-segment">
                                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="11" cy="11" r="7"></circle>
                                    <path d="m20 20-3.5-3.5"></path>
                                </svg>
                                <input class="search-input" type="text" name="service" placeholder="Search Services and Classes">
                            </div>

                            <div class="search-segment">
                                <select class="search-select" name="time" aria-label="Select time">
                                    <option>Anytime</option>
                                    <option>Open now</option>
                                    <option>Today</option>
                                    <option>This weekend</option>
                                </select>
                            </div>

                            <button class="search-button" type="submit">Search</button>
                        </form>

                        <div class="service-pills" aria-label="Popular services">
                            @foreach ($servicePills as $pill)
                                <span class="service-pill">{{ $pill }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <section class="section page-shell" id="nearby">
                <div class="section-head">
                    <h2 class="section-title">Popular near you</h2>
                    <a class="section-link" href="#cities">Browse all cities</a>
                </div>

                <div class="business-grid">
                    @foreach ($trendingBusinesses as $business)
                        <article class="business-card" style="--card-image: url('{{ $business['image'] }}');">
                            <div class="business-image"></div>
                            <div class="business-body">
                                <strong class="business-name">{{ $business['name'] }}</strong>
                                <div class="business-meta">
                                    {{ $business['location'] }} &middot; {{ $business['distance'] }}
                                </div>
                                <div class="business-rating">
                                    <span class="stars">★★★★★</span>
                                    <span>{{ $business['rating'] }} ({{ $business['reviews'] }})</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="section page-shell" id="daily-deals">
                <div class="section-head">
                    <h2 class="section-title">Daily Deals</h2>
                    <a class="section-link" href="#gallery">See all</a>
                </div>

                <div class="daily-deals-grid">
                    @foreach ($dailyDeals as $deal)
                        <article class="deal-card" style="--card-image: url('{{ $deal['image'] }}');">
                            <div class="deal-image">
                                <span class="deal-badge">{{ $deal['badge'] }}</span>
                            </div>
                            <div class="deal-body">
                                <strong class="deal-title">{{ $deal['title'] }}</strong>
                                <div class="deal-location">
                                    {{ $deal['location'] }} &middot; {{ $deal['distance'] }}
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="cities-section page-shell" id="cities">
                <div class="section-head">
                    <h2 class="section-title">Find a Service in a City Near You</h2>
                </div>

                <div class="city-grid">
                    @foreach ($cityColumns as $column)
                        <div>
                            @foreach ($column as $city)
                                <a class="city-link" href="#">
                                    <span>{{ $city }}</span>
                                    <span>&#8250;</span>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="business-cta page-shell" id="for-business">
                <article class="business-cta-card">
                    <div class="business-cta-copy">
                        <h2>Grow your salon, spa, or studio with Book Rahisi.</h2>
                        <p>
                            Create your profile, publish services, manage staff availability, and receive online bookings with instant customer confirmations.
                        </p>
                    </div>
                    <a class="business-cta-button" href="{{ route('for-business') }}">List your business</a>
                </article>
            </section>
        </main>

        <footer class="site-footer" id="login">
            <div class="page-shell footer-row">
                <div>Book Rahisi connects customers with salons, spas, barbershops, and fitness studios across Kenya.</div>
                <div class="footer-links">
                    <a href="{{ route('for-business') }}">For Business</a>
                    <a href="#daily-deals">Deals</a>
                    <a href="#cities">Cities</a>
                </div>
            </div>
        </footer>
    </body>
</html>
