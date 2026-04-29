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
                --navy: #17345d;
                --navy-deep: #112744;
                --navy-soft: rgba(255, 255, 255, 0.08);
                --line: #d6e2f0;
                --page: #eef5fb;
                --panel: #ffffff;
                --ink: #17304d;
                --muted: #607792;
                --accent: #1aa0e2;
                --accent-deep: #14898b;
                --accent-soft: #e7f6ff;
                --success-soft: #eaf8ef;
                --success-ink: #147d46;
                --warning-soft: #fff4dc;
                --warning-ink: #b36c00;
                --danger-soft: #fff0ee;
                --danger-ink: #c24b3a;
                --shadow: 0 24px 44px rgba(28, 66, 104, 0.12);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                background: linear-gradient(180deg, #f6fbff 0%, var(--page) 100%);
                color: var(--ink);
                font-family: 'Manrope', sans-serif;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            .console-app {
                display: grid;
                grid-template-columns: 320px minmax(0, 1fr);
                min-height: 100vh;
            }

            .console-sidebar {
                position: sticky;
                top: 0;
                display: grid;
                align-content: start;
                gap: 28px;
                min-height: 100vh;
                padding: 24px 20px;
                background: linear-gradient(180deg, var(--navy) 0%, var(--navy-deep) 100%);
                color: #fff;
            }

            .sidebar-brand {
                display: flex;
                align-items: center;
                gap: 14px;
            }

            .brand-avatar {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 58px;
                height: 58px;
                border-radius: 18px;
                background: linear-gradient(180deg, #d9ecff 0%, #a8d1ff 100%);
                color: var(--navy);
                font-family: 'Outfit', sans-serif;
                font-size: 1.35rem;
                font-weight: 800;
                letter-spacing: -0.05em;
            }

            .brand-copy {
                display: grid;
                gap: 4px;
            }

            .brand-title {
                font-family: 'Outfit', sans-serif;
                font-size: 2rem;
                font-weight: 800;
                letter-spacing: -0.06em;
            }

            .brand-subtitle {
                color: rgba(255, 255, 255, 0.74);
                font-size: 0.96rem;
                font-weight: 700;
            }

            .sidebar-nav {
                display: grid;
                gap: 10px;
            }

            .sidebar-link {
                display: flex;
                align-items: center;
                gap: 16px;
                padding: 14px 16px;
                border: 1px solid transparent;
                border-radius: 18px;
                color: rgba(255, 255, 255, 0.82);
                font-size: 0.98rem;
                font-weight: 800;
                transition: background-color 160ms ease, border-color 160ms ease, color 160ms ease;
            }

            .sidebar-link:hover,
            .sidebar-link.is-active {
                border-color: rgba(255, 255, 255, 0.18);
                background: rgba(255, 255, 255, 0.12);
                color: #fff;
            }

            .sidebar-link-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 38px;
                height: 38px;
                border-radius: 12px;
                border: 1px solid rgba(255, 255, 255, 0.16);
                background: var(--navy-soft);
                font-size: 0.86rem;
                font-weight: 800;
            }

            .workspace {
                padding: 26px 28px 36px;
            }

            .workspace-shell {
                width: min(100%, 1420px);
                margin: 0 auto;
            }

            .topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 18px;
                margin-bottom: 22px;
            }

            .eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 10px 16px;
                border-radius: 999px;
                background: #def2ff;
                color: var(--accent);
                font-size: 0.88rem;
                font-weight: 800;
            }

            h1 {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.3rem, 4vw, 3.7rem);
                letter-spacing: -0.06em;
                line-height: 1;
            }

            .subtitle {
                margin: 14px 0 0;
                color: var(--muted);
                font-size: 1rem;
                line-height: 1.75;
            }

            .toolbar {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .button-dark,
            .button-light {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 14px 20px;
                border-radius: 16px;
                font-size: 0.96rem;
                font-weight: 800;
            }

            .button-dark {
                background: var(--navy);
                color: #fff;
                box-shadow: 0 14px 30px rgba(23, 52, 93, 0.16);
            }

            .button-light {
                border: 1px solid var(--line);
                background: rgba(255, 255, 255, 0.9);
                color: var(--ink);
            }

            .success-banner {
                margin-bottom: 18px;
                padding: 14px 16px;
                border: 1px solid rgba(20, 125, 70, 0.14);
                border-radius: 18px;
                background: var(--success-soft);
                color: var(--success-ink);
                font-size: 0.94rem;
                font-weight: 700;
            }

            .hero-card {
                display: grid;
                grid-template-columns: minmax(0, 1.2fr) auto;
                gap: 24px;
                align-items: center;
                margin-bottom: 22px;
                padding: 28px 30px;
                border-radius: 26px;
                background: linear-gradient(135deg, var(--accent) 0%, var(--accent-deep) 100%);
                color: #fff;
                box-shadow: var(--shadow);
            }

            .hero-card h2 {
                margin: 14px 0 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.4rem, 4vw, 3.4rem);
                letter-spacing: -0.06em;
                line-height: 0.98;
            }

            .hero-copy {
                margin: 14px 0 0;
                max-width: 760px;
                color: rgba(255, 255, 255, 0.94);
                font-size: 1rem;
                line-height: 1.7;
            }

            .hero-alert {
                margin-top: 18px;
                padding: 14px 16px;
                border-radius: 16px;
                background: rgba(255, 244, 246, 0.96);
                color: #bf3f2f;
                font-size: 0.96rem;
                font-weight: 800;
            }

            .hero-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 20px;
            }

            .hero-actions .button-dark,
            .hero-actions .button-light {
                border-radius: 16px;
                background: rgba(255, 255, 255, 0.95);
                color: var(--ink);
                box-shadow: none;
            }

            .hero-side {
                display: grid;
                justify-items: end;
                gap: 16px;
                min-width: 220px;
                text-align: right;
            }

            .hero-tag {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 12px 16px;
                border-radius: 16px;
                background: rgba(255, 255, 255, 0.88);
                color: var(--accent);
                font-size: 0.92rem;
                font-weight: 800;
            }

            .hero-amount {
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.5rem, 5vw, 4rem);
                font-weight: 800;
                letter-spacing: -0.06em;
                line-height: 0.95;
            }

            .hero-caption {
                color: rgba(255, 255, 255, 0.92);
                font-size: 0.96rem;
                font-weight: 700;
            }

            .stats-grid {
                display: grid;
                grid-template-columns: repeat(5, minmax(0, 1fr));
                gap: 16px;
                margin-bottom: 22px;
            }

            .stat-card,
            .panel {
                border: 1px solid var(--line);
                border-radius: 24px;
                background: rgba(255, 255, 255, 0.94);
                box-shadow: var(--shadow);
            }

            .stat-card {
                padding: 20px 20px 18px;
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
                border-radius: 16px;
                background: #e8f4ff;
                color: #0f69ad;
                font-size: 0.9rem;
                font-weight: 800;
            }

            .stat-pill.is-success {
                background: #e7f7ea;
                color: var(--success-ink);
            }

            .stat-pill.is-warning {
                background: var(--warning-soft);
                color: var(--warning-ink);
            }

            .stat-pill.is-danger {
                background: var(--danger-soft);
                color: var(--danger-ink);
            }

            .content-grid {
                display: grid;
                grid-template-columns: minmax(0, 1.2fr) minmax(320px, 0.8fr);
                gap: 18px;
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

            .panel-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.7rem;
                letter-spacing: -0.05em;
            }

            .panel-copy {
                margin: 10px 0 0;
                color: var(--muted);
                line-height: 1.7;
            }

            .booking-list,
            .profile-list {
                display: grid;
                gap: 14px;
            }

            .booking-row,
            .profile-row {
                padding: 18px 18px;
                border: 1px solid var(--line);
                border-radius: 20px;
                background: #fff;
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

            .booking-meta,
            .booking-note,
            .profile-subtitle {
                margin-top: 8px;
                color: var(--muted);
                line-height: 1.65;
            }

            .booking-status {
                padding: 8px 12px;
                border-radius: 14px;
                background: var(--warning-soft);
                color: var(--warning-ink);
                font-size: 0.82rem;
                font-weight: 800;
                text-transform: capitalize;
                white-space: nowrap;
            }

            .profile-title {
                font-size: 1rem;
                font-weight: 800;
            }

            .empty-state {
                padding: 24px;
                border: 1px dashed var(--line);
                border-radius: 20px;
                background: #fafdff;
                color: var(--muted);
                line-height: 1.7;
            }

            @media (max-width: 1320px) {
                .stats-grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }
            }

            @media (max-width: 1120px) {
                .console-app {
                    grid-template-columns: 1fr;
                }

                .console-sidebar {
                    position: static;
                    min-height: 0;
                }

                .content-grid,
                .hero-card {
                    grid-template-columns: 1fr;
                }

                .hero-side {
                    justify-items: start;
                    text-align: left;
                }
            }

            @media (max-width: 760px) {
                .workspace {
                    padding: 18px 16px 28px;
                }

                .topbar,
                .toolbar,
                .hero-actions,
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
                .hero-actions .button-dark,
                .hero-actions .button-light {
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
        @endphp

        <div class="console-app">
            @include('partials.business-console-sidebar')

            <main class="workspace">
                <div class="workspace-shell">
                    <div class="topbar">
                        <div>
                            <span class="eyebrow">Live business snapshot</span>
                            <h1>Business dashboard</h1>
                            <p class="subtitle">Your dashboard is ready. Manage your profile, review customer demand, and keep the business workspace current from one place.</p>
                        </div>

                        <div class="toolbar">
                            <a class="button-dark" href="{{ route('for-business.profile-details') }}">Update profile</a>
                            <a class="button-light" href="{{ route('for-business.bookings') }}">Customer bookings</a>
                            @if ($profileReady)
                                <a class="button-light" href="{{ route('business.show', ['slug' => $businessSlug]) }}">View public page</a>
                            @endif
                        </div>
                    </div>

                    @if (session('dashboard_success'))
                        <div class="success-banner">{{ session('dashboard_success') }}</div>
                    @endif

                    <section class="hero-card">
                        <div>
                            <span class="eyebrow" style="background: rgba(255, 255, 255, 0.16); color: #fff;">Workspace overview</span>
                            <h2>Your dashboard is ready</h2>
                            <p class="hero-copy">
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
                            <div class="hero-actions">
                                <a class="button-dark" href="{{ route('for-business.bookings') }}">Open bookings</a>
                                <a class="button-light" href="{{ route('for-business.profile-details') }}">Edit profile</a>
                                @if ($profileReady)
                                    <a class="button-light" href="{{ route('business.show', ['slug' => $businessSlug]) }}">Preview customer page</a>
                                @endif
                            </div>
                        </div>

                        <div class="hero-side">
                            <span class="hero-tag">Today</span>
                            <div class="hero-amount">{{ $bookingCount }}</div>
                            <div class="hero-caption">Total booking requests</div>
                        </div>
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
            </main>
        </div>
    </body>
</html>
