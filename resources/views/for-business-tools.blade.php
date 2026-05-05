<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi For Professionals | Business Dashboard</title>
        <meta
            name="description"
            content="Manage your business dashboard, profile, and customer bookings on Book Rahisi."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --ink: #111317;
                --muted: #6a7280;
                --line: #e3e6ed;
                --soft: #f6f7fb;
                --panel: #ffffff;
                --accent: #6956ff;
                --accent-soft: #f1efff;
                --gold: #ffb400;
                --dark: #0f1012;
                --success-soft: #edf9ef;
                --success-ink: #197446;
                --warning-soft: #fff5de;
                --warning-ink: #b57608;
                --danger-soft: #fff0ee;
                --danger-ink: #c24b3a;
                --shadow: 0 18px 42px rgba(17, 19, 23, 0.06);
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
                width: min(980px, 100%);
                padding: 12px 16px;
                border: 1px solid var(--line);
                border-radius: 999px;
                background: #fff;
                box-shadow: var(--shadow);
            }

            .search-item {
                flex: 1;
                min-width: 0;
                padding: 0 14px;
                color: var(--ink);
                font-size: 0.98rem;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
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
                flex: 0 0 auto;
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
                flex: 0 0 auto;
            }

            .breadcrumb {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 14px;
                color: var(--muted);
                font-size: 0.98rem;
            }

            .eyebrow {
                display: inline-flex;
                align-items: center;
                padding: 12px 18px;
                border: 1px solid #d7d4ff;
                border-radius: 999px;
                background: var(--accent-soft);
                color: var(--accent);
                font-size: 0.92rem;
                font-weight: 800;
            }

            .hero-header {
                margin-top: 26px;
            }

            .hero-header h1 {
                margin: 20px 0 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(3rem, 5vw, 4.7rem);
                line-height: 0.94;
                letter-spacing: -0.08em;
            }

            .hero-tagline {
                max-width: 900px;
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

            .directions-link {
                color: var(--accent);
                font-weight: 700;
            }

            .success-banner {
                margin-top: 22px;
                padding: 16px 18px;
                border: 1px solid rgba(25, 116, 70, 0.14);
                border-radius: 24px;
                background: var(--success-soft);
                color: var(--success-ink);
                font-size: 0.96rem;
                font-weight: 700;
            }

            .hero-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 24px;
            }

            .button-dark,
            .button-light {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-height: 54px;
                padding: 0 22px;
                border-radius: 999px;
                font-size: 0.98rem;
                font-weight: 800;
            }

            .button-dark {
                background: var(--dark);
                color: #fff;
            }

            .button-light {
                border: 1px solid var(--line);
                background: #fff;
                color: var(--ink);
            }

            .overview-grid {
                display: grid;
                grid-template-columns: minmax(0, 1.4fr) minmax(320px, 0.82fr);
                gap: 24px;
                margin-top: 30px;
            }

            .overview-card,
            .snapshot-card,
            .stat-card,
            .panel {
                border: 1px solid var(--line);
                border-radius: 28px;
                background: var(--panel);
                box-shadow: var(--shadow);
            }

            .overview-card {
                padding: 30px 32px;
                background:
                    radial-gradient(circle at top right, rgba(105, 86, 255, 0.08), transparent 34%),
                    linear-gradient(180deg, #ffffff 0%, #fbfbff 100%);
            }

            .overview-card h2 {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.2rem, 3vw, 3.3rem);
                letter-spacing: -0.06em;
                line-height: 0.98;
            }

            .overview-copy {
                margin: 14px 0 0;
                max-width: 760px;
                color: var(--muted);
                font-size: 1rem;
                line-height: 1.75;
            }

            .hero-alert {
                margin-top: 20px;
                padding: 16px 18px;
                border-radius: 20px;
                background: var(--danger-soft);
                color: var(--danger-ink);
                font-size: 0.96rem;
                font-weight: 700;
            }

            .overview-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 22px;
            }

            .snapshot-card {
                display: grid;
                gap: 20px;
                padding: 28px;
            }

            .snapshot-card h3,
            .panel-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.7rem;
                letter-spacing: -0.05em;
            }

            .snapshot-copy,
            .panel-copy {
                margin: 10px 0 0;
                color: var(--muted);
                line-height: 1.7;
            }

            .snapshot-list,
            .profile-list,
            .booking-list {
                display: grid;
                gap: 14px;
            }

            .snapshot-row,
            .profile-row,
            .booking-row {
                padding: 18px 18px;
                border: 1px solid var(--line);
                border-radius: 22px;
                background: #fff;
            }

            .snapshot-label,
            .profile-title {
                font-size: 0.82rem;
                font-weight: 800;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: var(--muted);
            }

            .snapshot-value {
                margin-top: 8px;
                font-size: 1rem;
                font-weight: 800;
                line-height: 1.6;
            }

            .snapshot-value.is-muted,
            .profile-subtitle,
            .booking-meta,
            .booking-note {
                color: var(--muted);
                font-weight: 500;
                line-height: 1.65;
            }

            .stats-grid {
                display: grid;
                grid-template-columns: repeat(5, minmax(0, 1fr));
                gap: 18px;
                margin-top: 26px;
            }

            .stat-card {
                padding: 22px 22px 20px;
            }

            .stat-label {
                color: var(--muted);
                font-size: 0.84rem;
                font-weight: 700;
            }

            .stat-value {
                margin-top: 14px;
                font-family: 'Outfit', sans-serif;
                font-size: 2rem;
                font-weight: 800;
                letter-spacing: -0.05em;
                line-height: 1;
            }

            .stat-pill {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-top: 14px;
                padding: 10px 14px;
                border-radius: 999px;
                background: var(--soft);
                color: var(--ink);
                font-size: 0.9rem;
                font-weight: 800;
            }

            .stat-pill.is-success {
                background: var(--success-soft);
                color: var(--success-ink);
            }

            .stat-pill.is-warning {
                background: var(--warning-soft);
                color: var(--warning-ink);
            }

            .stat-pill.is-danger {
                background: var(--accent-soft);
                color: var(--accent);
            }

            .content-grid {
                display: grid;
                grid-template-columns: minmax(0, 1.2fr) minmax(320px, 0.8fr);
                gap: 24px;
                margin-top: 28px;
            }

            .panel {
                padding: 24px;
            }

            .panel-head {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                margin-bottom: 18px;
            }

            .booking-top {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 16px;
            }

            .booking-name {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.28rem;
                letter-spacing: -0.04em;
            }

            .booking-status {
                padding: 8px 12px;
                border-radius: 999px;
                background: var(--warning-soft);
                color: var(--warning-ink);
                font-size: 0.82rem;
                font-weight: 800;
                text-transform: capitalize;
                white-space: nowrap;
            }

            .empty-state {
                padding: 24px;
                border: 1px dashed var(--line);
                border-radius: 22px;
                background: var(--soft);
                color: var(--muted);
                line-height: 1.7;
            }

            @media (max-width: 1320px) {
                .stats-grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }
            }

            @media (max-width: 1260px) {
                .overview-grid,
                .content-grid {
                    grid-template-columns: 1fr;
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

                .hero-actions,
                .overview-actions,
                .panel-head,
                .booking-top {
                    flex-direction: column;
                    align-items: stretch;
                }

                .stats-grid {
                    grid-template-columns: 1fr;
                }

                .button-dark,
                .button-light,
                .menu-button {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        @php
            $profileLocation = $profileReady
                ? $profileDetails['address_line'].', '.$profileDetails['neighborhood'].', '.$profileDetails['city']
                : 'Profile details are not complete yet.';
            $profileHours = $profileReady
                ? $profileDetails['opening_time'].' - '.$profileDetails['closing_time']
                : 'Set your opening hours';
            $profileSummary = $profileReady
                ? $profileDetails['tagline']
                : 'Your dashboard is ready. Complete the public profile to start receiving bookings from customers.';
        @endphp

        <div class="shell">
            <header class="topbar">
                <a class="brand" href="{{ route('home') }}">bookrahisi</a>

                <div class="search-shell" aria-label="Dashboard overview bar">
                    <div class="search-item">Business dashboard</div>
                    <div class="search-item">{{ $accountSetup['business_name'] }}</div>
                    <div class="search-item">{{ $profileReady ? 'Profile live' : 'Setup needed' }}</div>
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
                <span>Business dashboard</span>
                <span>&bull;</span>
                <span>{{ $accountSetup['business_category'] }}</span>
                <span>&bull;</span>
                <span>{{ $accountSetup['business_name'] }}</span>
            </nav>

            @if (session('dashboard_success'))
                <div class="success-banner">{{ session('dashboard_success') }}</div>
            @endif

            <section class="hero-header">
                <span class="eyebrow">Business dashboard</span>
                <h1>{{ $accountSetup['business_name'] }}</h1>
                <p class="hero-tagline">{{ $profileSummary }}</p>
                <div class="hero-meta">
                    <strong>{{ $bookingCount }}</strong>
                    <span>Total booking requests</span>
                    <span>&bull;</span>
                    <strong>{{ $pendingBookingCount }}</strong>
                    <span>Pending responses</span>
                    <span>&bull;</span>
                    <span>{{ $profileReady ? 'Profile live for customers' : 'Profile draft' }}</span>
                    @if ($profileReady)
                        <span>&bull;</span>
                        <span>{{ $profileLocation }}</span>
                        <a class="directions-link" href="{{ route('business.show', ['slug' => $businessSlug]) }}">View public page</a>
                    @endif
                </div>

                <div class="hero-actions">
                    <a class="button-dark" href="{{ route('for-business.profile-details') }}">Update profile</a>
                    <a class="button-light" href="{{ route('for-business.settings') }}">Settings</a>
                    <a class="button-light" href="{{ route('for-business.bookings') }}">Customer bookings</a>
                    @if ($profileReady)
                        <a class="button-light" href="{{ route('business.show', ['slug' => $businessSlug]) }}">Preview customer page</a>
                    @endif
                </div>
            </section>

            <section class="overview-grid">
                <article class="overview-card">
                    <h2>Your dashboard is ready</h2>
                    <p class="overview-copy">
                        @if ($profileReady)
                            Customers can discover {{ $accountSetup['business_name'] }}, place bookings, and send appointment notes directly into your workspace.
                        @else
                            Finish the public profile first so customers can discover your business and start sending booking requests.
                        @endif
                    </p>

                    <div class="hero-alert">
                        @if ($bookingCount === 0)
                            No booking requests have been received yet. Share the public page once the profile is complete.
                        @elseif ($bookingCount === 1)
                            1 booking request is currently waiting for review. Open the bookings page to follow up.
                        @else
                            {{ $bookingCount }} booking requests are currently active in your workflow. Open the inbox to review them.
                        @endif
                    </div>

                    <div class="overview-actions">
                        <a class="button-dark" href="{{ route('for-business.bookings') }}">Open bookings</a>
                        <a class="button-light" href="{{ route('for-business.profile-details') }}">Edit profile</a>
                        <a class="button-light" href="{{ route('for-business.settings') }}">Settings</a>
                        @if ($profileReady)
                            <a class="button-light" href="{{ route('business.show', ['slug' => $businessSlug]) }}">View public page</a>
                        @endif
                    </div>
                </article>

                <aside class="snapshot-card">
                    <div>
                        <h3>Workspace snapshot</h3>
                        <p class="snapshot-copy">A quick view of what customers and staff will depend on once the business profile is live.</p>
                    </div>

                    <div class="snapshot-list">
                        <article class="snapshot-row">
                            <div class="snapshot-label">Profile status</div>
                            <div class="snapshot-value">{{ $profileReady ? 'Published for customers' : 'Setup needed before bookings' }}</div>
                        </article>
                        <article class="snapshot-row">
                            <div class="snapshot-label">Business hours</div>
                            <div class="snapshot-value {{ $profileReady ? '' : 'is-muted' }}">{{ $profileHours }}</div>
                        </article>
                        <article class="snapshot-row">
                            <div class="snapshot-label">Location</div>
                            <div class="snapshot-value {{ $profileReady ? '' : 'is-muted' }}">{{ $profileLocation }}</div>
                        </article>
                        <article class="snapshot-row">
                            <div class="snapshot-label">Owner account</div>
                            <div class="snapshot-value">{{ $accountSetup['first_name'] }} {{ $accountSetup['last_name'] }} / {{ $email }}</div>
                        </article>
                    </div>
                </aside>
            </section>

            <section class="stats-grid">
                <article class="stat-card">
                    <div class="stat-label">All bookings</div>
                    <div class="stat-value">{{ $bookingCount }}</div>
                    <div class="stat-pill">Workspace total</div>
                </article>
                <article class="stat-card">
                    <div class="stat-label">Pending bookings</div>
                    <div class="stat-value">{{ $pendingBookingCount }}</div>
                    <div class="stat-pill is-success">Needs response</div>
                </article>
                <article class="stat-card">
                    <div class="stat-label">Today's bookings</div>
                    <div class="stat-value">{{ $todayBookingCount }}</div>
                    <div class="stat-pill">Daily activity</div>
                </article>
                <article class="stat-card">
                    <div class="stat-label">Profile status</div>
                    <div class="stat-value">{{ $profileReady ? 'Live' : 'Draft' }}</div>
                    <div class="stat-pill {{ $profileReady ? 'is-success' : 'is-warning' }}">{{ $profileReady ? 'Published' : 'Setup needed' }}</div>
                </article>
                <article class="stat-card">
                    <div class="stat-label">Business category</div>
                    <div class="stat-value">{{ $accountSetup['business_category'] }}</div>
                    <div class="stat-pill is-danger">Owner workspace</div>
                </article>
            </section>

            <section class="content-grid">
                <section class="panel">
                    <div class="panel-head">
                        <div>
                            <h3 class="panel-title">Recent bookings</h3>
                            <p class="panel-copy">The latest booking activity is shown here so the owner can act quickly after login.</p>
                        </div>
                        <a class="button-light" href="{{ route('for-business.bookings') }}">Open full inbox</a>
                    </div>

                    @if ($recentBookings->isEmpty())
                        <div class="empty-state">
                            @if ($profileReady)
                                Your booking page is live. As soon as customers place bookings, they will appear here.
                            @else
                                Finish the profile setup to activate the public business page and start receiving bookings.
                            @endif
                        </div>
                    @else
                        <div class="booking-list">
                            @foreach ($recentBookings as $booking)
                                <article class="booking-row">
                                    <div class="booking-top">
                                        <div>
                                            <h4 class="booking-name">{{ $booking->customer_name }}</h4>
                                            <div class="booking-meta">
                                                {{ $booking->service_name }} with {{ $booking->staff_name }} on
                                                {{ $booking->appointment_date?->format('D, j M Y') ?? $booking->appointment_date }}
                                                at {{ $booking->appointment_time }}
                                            </div>
                                        </div>
                                        <span class="booking-status">{{ $booking->status }}</span>
                                    </div>
                                    <div class="booking-note">
                                        Contact: {{ $booking->customer_phone }}
                                        @if ($booking->customer_notes)
                                            <br>{{ $booking->customer_notes }}
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </section>

                <aside class="panel">
                    <div class="panel-head">
                        <div>
                            <h3 class="panel-title">Business profile</h3>
                            <p class="panel-copy">This is the current public-facing snapshot customers will use before they place a booking.</p>
                        </div>
                    </div>

                    <div class="profile-list">
                        <article class="profile-row">
                            <div class="profile-title">Profile status</div>
                            <div class="profile-subtitle">{{ $profileReady ? 'Published for customers' : 'Needs setup before customers can book' }}</div>
                        </article>
                        <article class="profile-row">
                            <div class="profile-title">Business hours</div>
                            <div class="profile-subtitle">{{ $profileHours }}</div>
                        </article>
                        <article class="profile-row">
                            <div class="profile-title">Location</div>
                            <div class="profile-subtitle">{{ $profileLocation }}</div>
                        </article>
                        <article class="profile-row">
                            <div class="profile-title">Tagline</div>
                            <div class="profile-subtitle">
                                {{ $profileReady ? $profileDetails['tagline'] : 'Add a clear business promise so customers know what makes your business worth booking.' }}
                            </div>
                        </article>
                        <article class="profile-row">
                            <div class="profile-title">Owner account</div>
                            <div class="profile-subtitle">{{ $accountSetup['first_name'] }} {{ $accountSetup['last_name'] }} / {{ $email }}</div>
                        </article>
                    </div>
                </aside>
            </section>
        </div>
    </body>
</html>
