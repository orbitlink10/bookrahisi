<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $accountSetup['business_name'] }} | Book Rahisi</title>
        <meta
            name="description"
            content="{{ $profileDetails['tagline'] }}"
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --ink: #111317;
                --muted: #6a7280;
                --line: #e3e6ed;
                --soft: #f6f7fb;
                --accent: #6956ff;
                --gold: #ffb400;
                --dark: #0f1012;
                --green: #79d13a;
                --gray: #c4c9d3;
            }

            * {
                box-sizing: border-box;
            }

            html {
                scroll-behavior: smooth;
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

            .shell {
                width: min(100%, 1820px);
                margin: 0 auto;
                padding: 0 42px 48px;
            }

            .topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 18px;
                padding: 22px 0 16px;
            }

            .brand {
                font-family: 'Outfit', sans-serif;
                font-size: 2rem;
                font-weight: 800;
                letter-spacing: -0.06em;
            }

            .search-shell {
                display: flex;
                align-items: center;
                gap: 18px;
                width: min(860px, 100%);
                padding: 12px 16px;
                border: 1px solid var(--line);
                border-radius: 999px;
                background: #fff;
                box-shadow: 0 12px 24px rgba(17, 19, 23, 0.06);
            }

            .search-item {
                flex: 1;
                min-width: 0;
                padding: 0 14px;
                color: var(--ink);
                font-size: 0.98rem;
            }

            .search-item + .search-item {
                border-left: 1px solid var(--line);
            }

            .search-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 54px;
                height: 54px;
                border-radius: 50%;
                background: var(--dark);
                color: #fff;
            }

            .search-button svg,
            .menu-button svg {
                width: 22px;
                height: 22px;
            }

            .menu-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                padding: 18px 24px;
                border: 1px solid var(--line);
                border-radius: 999px;
                background: #fff;
                font-size: 0.98rem;
                font-weight: 800;
            }

            .breadcrumb {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 14px;
                color: var(--muted);
                font-size: 0.98rem;
            }

            .hero-header {
                margin-top: 26px;
            }

            .hero-header h1 {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(3rem, 5vw, 4.7rem);
                line-height: 0.94;
                letter-spacing: -0.08em;
            }

            .hero-tagline {
                max-width: 860px;
                margin: 16px 0 0;
                color: var(--muted);
                font-size: 1.08rem;
                line-height: 1.8;
            }

            .hero-meta {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 14px;
                margin-top: 18px;
                color: var(--muted);
                font-size: 1.08rem;
            }

            .hero-meta strong {
                color: var(--ink);
            }

            .stars,
            .review-stars {
                display: inline-flex;
                gap: 6px;
                color: var(--gold);
            }

            .star-filled,
            .star-empty {
                font-size: 1.1rem;
                line-height: 1;
            }

            .star-empty {
                color: rgba(255, 180, 0, 0.35);
            }

            .directions-link {
                color: var(--accent);
                font-weight: 700;
            }

            .gallery-grid {
                display: grid;
                grid-template-columns: 2.1fr 1fr;
                gap: 18px;
                margin-top: 28px;
            }

            .gallery-primary,
            .gallery-secondary {
                border-radius: 24px;
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
            }

            .gallery-primary {
                min-height: 520px;
            }

            .gallery-stack {
                display: grid;
                gap: 18px;
            }

            .gallery-secondary {
                min-height: 250px;
            }

            .page-tabs {
                position: sticky;
                top: 0;
                z-index: 20;
                display: flex;
                gap: 32px;
                margin-top: 26px;
                padding: 16px 0;
                border-bottom: 1px solid var(--line);
                background: rgba(255, 255, 255, 0.96);
                backdrop-filter: blur(10px);
            }

            .page-tabs a {
                padding-bottom: 10px;
                border-bottom: 3px solid transparent;
                font-size: 0.98rem;
                font-weight: 800;
            }

            .page-tabs a:first-child,
            .page-tabs a:hover {
                border-color: var(--ink);
            }

            .content-grid {
                display: grid;
                grid-template-columns: minmax(0, 1.35fr) minmax(320px, 0.65fr);
                gap: 32px;
                margin-top: 28px;
            }

            .section {
                padding-bottom: 40px;
            }

            .section h2 {
                margin: 0 0 20px;
                font-family: 'Outfit', sans-serif;
                font-size: 2.2rem;
                letter-spacing: -0.05em;
            }

            .service-filters {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-bottom: 22px;
            }

            .filter-pill {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 14px 20px;
                border-radius: 999px;
                border: 1px solid var(--line);
                background: #fff;
                font-size: 0.94rem;
                font-weight: 800;
            }

            .filter-pill:first-child {
                background: var(--dark);
                color: #fff;
                border-color: var(--dark);
            }

            .service-list {
                display: grid;
                gap: 18px;
            }

            .service-card {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 18px;
                padding: 26px 28px;
                border: 1px solid var(--line);
                border-radius: 24px;
                background: #fff;
            }

            .service-info {
                min-width: 0;
            }

            .service-title {
                margin: 0 0 10px;
                font-size: 1.1rem;
                font-weight: 800;
            }

            .service-meta {
                display: grid;
                gap: 8px;
                color: var(--muted);
            }

            .service-price {
                color: var(--ink);
                font-size: 1rem;
                font-weight: 800;
            }

            .book-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 102px;
                padding: 14px 20px;
                border: 1px solid var(--line);
                border-radius: 999px;
                background: #fff;
                font-size: 0.98rem;
                font-weight: 800;
            }

            .team-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 24px;
            }

            .team-card {
                display: grid;
                gap: 10px;
                justify-items: start;
            }

            .team-avatar {
                width: 160px;
                height: 160px;
                border-radius: 50%;
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
            }

            .team-rating {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-top: -36px;
                margin-left: 10px;
                padding: 8px 12px;
                border: 1px solid #d7d4ff;
                border-radius: 999px;
                background: #fff;
                color: var(--ink);
                font-size: 0.94rem;
                font-weight: 800;
            }

            .team-name {
                font-size: 1.02rem;
                font-weight: 800;
            }

            .team-role {
                color: var(--muted);
            }

            .review-summary {
                display: grid;
                gap: 14px;
                margin-bottom: 26px;
            }

            .review-summary .stars {
                gap: 12px;
            }

            .review-summary .star-filled,
            .review-summary .star-empty {
                font-size: 2.35rem;
            }

            .review-score {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-size: 1.1rem;
                font-weight: 800;
            }

            .review-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 26px;
            }

            .review-card {
                display: grid;
                gap: 14px;
            }

            .review-head {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .review-avatar {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 88px;
                height: 88px;
                border-radius: 50%;
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
                color: #fff;
                font-size: 1.45rem;
                font-weight: 800;
            }

            .review-author {
                display: grid;
                gap: 4px;
            }

            .review-name {
                font-size: 1rem;
                font-weight: 800;
            }

            .review-date {
                color: var(--muted);
                font-size: 0.98rem;
            }

            .review-body {
                font-size: 1rem;
                line-height: 1.75;
            }

            .about-copy {
                margin: 0 0 28px;
                color: var(--muted);
                font-size: 1rem;
                line-height: 1.85;
            }

            .map-frame {
                overflow: hidden;
                border: 1px solid var(--line);
                border-radius: 24px;
                background: var(--soft);
            }

            .map-frame iframe {
                display: block;
                width: 100%;
                height: 470px;
                border: 0;
            }

            .address-row {
                margin: 20px 0 0;
                font-size: 1rem;
                line-height: 1.8;
            }

            .about-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 22px;
                margin-top: 32px;
            }

            .info-card,
            .video-card,
            .portfolio-card,
            .sidebar-card {
                border: 1px solid var(--line);
                border-radius: 28px;
                background: #fff;
            }

            .info-card,
            .video-card,
            .portfolio-card {
                padding: 26px 28px;
            }

            .info-card h3,
            .video-card h3,
            .portfolio-card h3 {
                margin: 0 0 18px;
                font-family: 'Outfit', sans-serif;
                font-size: 1.55rem;
                letter-spacing: -0.04em;
            }

            .video-frame {
                overflow: hidden;
                border: 1px solid var(--line);
                border-radius: 24px;
                background: var(--soft);
            }

            .video-frame iframe {
                display: block;
                width: 100%;
                aspect-ratio: 16 / 9;
                border: 0;
            }

            .video-copy {
                margin: 18px 0 0;
                color: var(--muted);
                font-size: 1rem;
                line-height: 1.75;
            }

            .opening-list,
            .additional-list {
                display: grid;
                gap: 14px;
            }

            .opening-row,
            .additional-row {
                display: grid;
                grid-template-columns: 20px minmax(0, 1fr) auto;
                gap: 12px;
                align-items: center;
            }

            .opening-dot {
                width: 18px;
                height: 18px;
                border-radius: 50%;
                background: var(--green);
            }

            .opening-row.is-closed .opening-dot {
                background: var(--gray);
            }

            .opening-row.is-closed .opening-day,
            .opening-row.is-closed .opening-hours {
                color: var(--muted);
            }

            .opening-day,
            .opening-hours,
            .additional-text {
                font-size: 1rem;
            }

            .opening-hours {
                font-weight: 700;
            }

            .additional-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                border: 1px solid var(--line);
                font-size: 0.78rem;
                font-weight: 800;
            }

            .portfolio-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 16px;
            }

            .portfolio-item {
                aspect-ratio: 0.9;
                border-radius: 20px;
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
            }

            .sidebar {
                position: sticky;
                top: 94px;
                align-self: start;
                display: grid;
                gap: 18px;
            }

            .sidebar-card {
                overflow: hidden;
            }

            .sidebar-main {
                padding: 28px;
            }

            .sidebar-main h3 {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 3rem;
                line-height: 0.94;
                letter-spacing: -0.06em;
            }

            .sidebar-rating {
                display: flex;
                align-items: center;
                gap: 8px;
                margin-top: 16px;
                font-size: 1rem;
                font-weight: 800;
            }

            .featured-pill {
                display: inline-flex;
                align-items: center;
                margin-top: 18px;
                padding: 12px 18px;
                border: 1px solid #d7d4ff;
                border-radius: 999px;
                background: #f4f2ff;
                color: var(--accent);
                font-size: 0.98rem;
                font-weight: 800;
            }

            .sidebar-book {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                margin-top: 22px;
                padding: 18px 24px;
                border-radius: 999px;
                background: var(--dark);
                color: #fff;
                font-size: 1rem;
                font-weight: 800;
            }

            .sidebar-block {
                padding: 24px 28px;
                border-top: 1px solid var(--line);
            }

            .sidebar-detail {
                display: grid;
                gap: 10px;
                margin-bottom: 18px;
            }

            .sidebar-detail:last-child {
                margin-bottom: 0;
            }

            .sidebar-label {
                color: var(--muted);
                font-size: 0.84rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .sidebar-text {
                font-size: 1rem;
                line-height: 1.7;
            }

            .membership-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
            }

            .buy-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 92px;
                padding: 12px 20px;
                border: 1px solid var(--line);
                border-radius: 999px;
                background: #fff;
                font-size: 0.96rem;
                font-weight: 800;
            }

            @media (max-width: 1260px) {
                .content-grid,
                .gallery-grid,
                .about-grid {
                    grid-template-columns: 1fr;
                }

                .team-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .sidebar {
                    position: static;
                }
            }

            @media (max-width: 980px) {
                .shell {
                    padding: 0 18px 36px;
                }

                .topbar {
                    flex-direction: column;
                    align-items: stretch;
                }

                .search-shell {
                    width: 100%;
                }
            }

            @media (max-width: 760px) {
                .search-shell {
                    flex-wrap: wrap;
                    border-radius: 28px;
                }

                .search-item {
                    width: 100%;
                    padding: 0;
                }

                .search-item + .search-item {
                    border-left: 0;
                    padding-top: 12px;
                    margin-top: 12px;
                    border-top: 1px solid var(--line);
                }

                .page-tabs {
                    gap: 18px;
                    overflow-x: auto;
                }

                .service-card,
                .membership-row {
                    flex-direction: column;
                    align-items: stretch;
                }

                .team-grid,
                .review-grid,
                .portfolio-grid {
                    grid-template-columns: 1fr;
                }

                .team-avatar {
                    width: 140px;
                    height: 140px;
                }

                .map-frame iframe {
                    height: 360px;
                }

                .video-frame iframe {
                    min-height: 240px;
                }
            }
        </style>
    </head>
    <body>
        <div class="shell">
            <header class="topbar">
                <a class="brand" href="{{ route('home') }}">bookrahisi</a>

                <div class="search-shell" aria-label="Search bar preview">
                    <div class="search-item">All treatments</div>
                    <div class="search-item">Current location</div>
                    <div class="search-item">Any time</div>
                    <span class="search-button" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="7"></circle>
                            <path d="m20 20-3.5-3.5"></path>
                        </svg>
                    </span>
                </div>

                <a class="menu-button" href="{{ route('home') }}">
                    Menu
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M4 7h16"></path>
                        <path d="M4 12h16"></path>
                        <path d="M4 17h16"></path>
                    </svg>
                </a>
            </header>

            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>&bull;</span>
                <span>{{ $accountSetup['business_category'] }}</span>
                <span>&bull;</span>
                <span>{{ $profileDetails['city'] }}</span>
                <span>&bull;</span>
                <span>{{ $profileDetails['neighborhood'] }}</span>
                <span>&bull;</span>
                <span>{{ $accountSetup['business_name'] }}</span>
            </nav>

            <section class="hero-header" id="photos">
                <h1>{{ $accountSetup['business_name'] }}</h1>
                <p class="hero-tagline">{{ $profileDetails['tagline'] }}</p>
                <div class="hero-meta">
                    <strong>{{ $rating }}</strong>
                    <span class="stars" aria-label="{{ $rating }} stars">
                        @for ($star = 1; $star <= 5; $star++)
                            <span class="star-filled">&#9733;</span>
                        @endfor
                    </span>
                    <a class="directions-link" href="#reviews">({{ $reviewCount }})</a>
                    <span>&bull;</span>
                    <span>{{ $openSummary }}</span>
                    <span>&bull;</span>
                    <span>{{ $location }}</span>
                    <a class="directions-link" href="{{ $directionsUrl }}" target="_blank" rel="noreferrer">Get directions</a>
                </div>
            </section>

            <section class="gallery-grid" aria-label="Business gallery">
                <div class="gallery-primary" style="background-image: url('{{ $galleryImages[0] }}');"></div>
                <div class="gallery-stack">
                    <div class="gallery-secondary" style="background-image: url('{{ $galleryImages[1] }}');"></div>
                    <div class="gallery-secondary" style="background-image: url('{{ $galleryImages[2] }}');"></div>
                </div>
            </section>

            <nav class="page-tabs" aria-label="Page sections">
                @foreach ($tabs as $tab)
                    <a href="#{{ strtolower(str_replace(' ', '-', $tab)) }}">{{ $tab }}</a>
                @endforeach
            </nav>

            <div class="content-grid">
                <div>
                    <section class="section" id="services">
                        <h2>Services</h2>
                        <div class="service-filters">
                            @foreach ($serviceFilters as $filter)
                                <span class="filter-pill">{{ $filter }}</span>
                            @endforeach
                        </div>

                        <div class="service-list">
                            @foreach ($services as $service)
                                <article class="service-card">
                                    <div class="service-info">
                                        <h3 class="service-title">{{ $service['name'] }}</h3>
                                        <div class="service-meta">
                                            <span>{{ $service['duration'] }}</span>
                                            <span class="service-price">{{ $service['price'] }}</span>
                                        </div>
                                    </div>

                                    <a class="book-button" href="{{ route('business.book', ['slug' => $businessSlug, 'service' => \Illuminate\Support\Str::slug($service['name'])]) }}">Book</a>
                                </article>
                            @endforeach
                        </div>
                    </section>

                    <section class="section" id="team">
                        <h2>Team</h2>
                        <div class="team-grid">
                            @foreach ($teamMembers as $member)
                                <article class="team-card">
                                    <div class="team-avatar" style="background-image: url('{{ $member['image'] }}');"></div>
                                    <span class="team-rating">&#9733; {{ $member['rating'] }}</span>
                                    <span class="team-name">{{ $member['name'] }}</span>
                                    <span class="team-role">{{ $member['role'] }}</span>
                                </article>
                            @endforeach
                        </div>
                    </section>

                    <section class="section" id="reviews">
                        <h2>Reviews</h2>

                        <div class="review-summary">
                            <span class="stars" aria-label="{{ $rating }} stars">
                                @for ($star = 1; $star <= 5; $star++)
                                    @if ($star <= (int) round((float) $rating))
                                        <span class="star-filled">&#9733;</span>
                                    @else
                                        <span class="star-empty">&#9733;</span>
                                    @endif
                                @endfor
                            </span>
                            <span class="review-score">{{ $rating }} <a class="directions-link" href="#reviews">({{ $reviewCount }})</a></span>
                        </div>

                        <div class="review-grid">
                            @foreach ($reviews as $review)
                                <article class="review-card">
                                    <div class="review-head">
                                        @if (! empty($review['avatar_image']))
                                            <span class="review-avatar" style="background-image: url('{{ $review['avatar_image'] }}');"></span>
                                        @else
                                            <span class="review-avatar" style="background-color: {{ $review['avatar_color'] ?? '#6956ff' }};">
                                                {{ $review['avatar_initials'] ?? 'BR' }}
                                            </span>
                                        @endif

                                        <div class="review-author">
                                            <span class="review-name">{{ $review['name'] }}</span>
                                            <span class="review-date">{{ $review['date'] }}</span>
                                        </div>
                                    </div>

                                    <div class="review-stars" aria-label="{{ $review['rating'] }} stars">
                                        @for ($star = 1; $star <= 5; $star++)
                                            @if ($star <= $review['rating'])
                                                <span class="star-filled">&#9733;</span>
                                            @else
                                                <span class="star-empty">&#9733;</span>
                                            @endif
                                        @endfor
                                    </div>

                                    <div class="review-body">{{ $review['body'] }}</div>
                                </article>
                            @endforeach
                        </div>
                    </section>

                    <section class="section" id="portfolio">
                        <h2>Portfolio</h2>
                        <div class="portfolio-card">
                            <h3>Recent work</h3>
                            <div class="portfolio-grid">
                                @foreach ($galleryImages as $portfolioImage)
                                    <div class="portfolio-item" style="background-image: url('{{ $portfolioImage }}');"></div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    @if ($youtubeEmbedUrl)
                        <section class="section" id="video">
                            <h2>Video</h2>
                            <div class="video-card">
                                <h3>Watch before you book</h3>
                                <div class="video-frame">
                                    <iframe
                                        src="{{ $youtubeEmbedUrl }}"
                                        title="YouTube video for {{ $accountSetup['business_name'] }}"
                                        loading="lazy"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                    ></iframe>
                                </div>
                                <p class="video-copy">
                                    Preview the space, experience, or recent work from {{ $accountSetup['business_name'] }} before sending a booking request.
                                    <a class="directions-link" href="{{ $profileDetails['youtube_url'] }}" target="_blank" rel="noreferrer">Watch on YouTube</a>
                                </p>
                            </div>
                        </section>
                    @endif

                    <section class="section" id="about">
                        <h2>{{ $aboutHeading }}</h2>
                        <p class="about-copy">{{ $profileDetails['about'] }}</p>

                        <div class="map-frame">
                            <iframe
                                src="{{ $mapEmbedUrl }}"
                                loading="lazy"
                                title="Map for {{ $accountSetup['business_name'] }}"
                            ></iframe>
                        </div>

                        <p class="address-row">
                            {{ $addressLine }}
                            <a class="directions-link" href="{{ $directionsUrl }}" target="_blank" rel="noreferrer">Get directions</a>
                        </p>

                        <div class="about-grid">
                            <section class="info-card">
                                <h3>Opening times</h3>
                                <div class="opening-list">
                                    @foreach ($weeklyHours as $hours)
                                        <div class="opening-row {{ $hours['is_open'] ? '' : 'is-closed' }}">
                                            <span class="opening-dot"></span>
                                            <span class="opening-day">{{ $hours['day'] }}</span>
                                            <span class="opening-hours">{{ $hours['hours'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </section>

                            <section class="info-card">
                                <h3>Additional information</h3>
                                <div class="additional-list">
                                    @foreach ($additionalInformation as $info)
                                        <div class="additional-row">
                                            <span class="additional-icon">&#10003;</span>
                                            <span class="additional-text">{{ $info }}</span>
                                            <span></span>
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                        </div>
                    </section>
                </div>

                <aside class="sidebar">
                    <div class="sidebar-card" id="booking-card">
                        <div class="sidebar-main">
                            <h3>{{ $accountSetup['business_name'] }}</h3>
                            <div class="sidebar-rating">
                                <span>{{ $rating }}</span>
                                <span class="stars">
                                    @for ($star = 1; $star <= 5; $star++)
                                        <span class="star-filled">&#9733;</span>
                                    @endfor
                                </span>
                                <a class="directions-link" href="#reviews">({{ $reviewCount }})</a>
                            </div>
                            <span class="featured-pill">Featured</span>
                            <a class="sidebar-book" href="{{ route('business.book', ['slug' => $businessSlug]) }}">Book now</a>
                        </div>

                        <div class="sidebar-block">
                            <div class="sidebar-detail">
                                <span class="sidebar-label">Business status</span>
                                <span class="sidebar-text">{{ $openSummary }}</span>
                            </div>
                            <div class="sidebar-detail">
                                <span class="sidebar-label">Location</span>
                                <span class="sidebar-text">
                                    {{ $addressLine }}
                                    <a class="directions-link" href="{{ $directionsUrl }}" target="_blank" rel="noreferrer">Get directions</a>
                                </span>
                            </div>
                        </div>

                        <div class="sidebar-block">
                            <div class="membership-row">
                                <div>
                                    <strong>Memberships</strong>
                                    <div class="sidebar-text" style="color: var(--muted);">Buy a bundle of appointments.</div>
                                </div>
                                <a class="buy-button" href="{{ route('business.book', ['slug' => $businessSlug]) }}">Buy</a>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </body>
</html>
