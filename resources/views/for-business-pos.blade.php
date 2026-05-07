<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi For Professionals | POS</title>
        <meta
            name="description"
            content="Review POS readiness, payment status, and recent paid activity for your business."
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
                max-width: 720px;
                color: rgba(255, 255, 255, 0.88);
                line-height: 1.8;
            }

            .hero-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 22px;
            }

            .hero-side {
                display: grid;
                justify-items: end;
                gap: 10px;
                min-width: 220px;
                text-align: right;
            }

            .hero-tag {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 9px 14px;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.16);
                color: #fff;
                font-size: 0.84rem;
                font-weight: 800;
            }

            .hero-amount {
                font-family: 'Outfit', sans-serif;
                font-size: clamp(3rem, 5vw, 4.8rem);
                font-weight: 800;
                letter-spacing: -0.08em;
                line-height: 0.9;
            }

            .hero-caption {
                font-size: 0.9rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                color: rgba(255, 255, 255, 0.78);
            }

            .hero-side-copy {
                max-width: 260px;
                font-size: 0.94rem;
                line-height: 1.7;
                color: rgba(255, 255, 255, 0.82);
            }

            .stats-grid {
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 16px;
                margin-bottom: 22px;
            }

            .stat-card,
            .panel {
                padding: 22px;
                border-radius: 24px;
                background: var(--panel);
                border: 1px solid rgba(23, 52, 93, 0.08);
                box-shadow: var(--shadow);
            }

            .stat-label {
                color: var(--muted);
                font-size: 0.92rem;
                font-weight: 700;
            }

            .stat-value {
                margin-top: 14px;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(1.8rem, 3vw, 2.6rem);
                font-weight: 800;
                letter-spacing: -0.06em;
            }

            .stat-pill {
                display: inline-flex;
                align-items: center;
                margin-top: 16px;
                padding: 8px 12px;
                border-radius: 999px;
                background: #ebf6ff;
                color: var(--accent);
                font-size: 0.82rem;
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

            .dashboard-grid {
                display: grid;
                grid-template-columns: minmax(0, 1.25fr) minmax(320px, 0.75fr);
                gap: 22px;
            }

            .panel-head {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 16px;
                margin-bottom: 20px;
            }

            .panel-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.5rem;
                letter-spacing: -0.04em;
            }

            .panel-copy {
                margin: 8px 0 0;
                color: var(--muted);
                line-height: 1.7;
            }

            .summary-list {
                display: grid;
                gap: 14px;
            }

            .summary-row {
                display: grid;
                gap: 6px;
                padding: 14px 16px;
                border-radius: 18px;
                background: #f7fbff;
                border: 1px solid rgba(23, 52, 93, 0.08);
            }

            .summary-label {
                color: var(--muted);
                font-size: 0.82rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .summary-value {
                font-weight: 700;
                line-height: 1.7;
            }

            .activity-list {
                display: grid;
                gap: 14px;
            }

            .activity-row {
                padding: 18px;
                border-radius: 20px;
                background: #f7fbff;
                border: 1px solid rgba(23, 52, 93, 0.08);
            }

            .activity-top {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 16px;
            }

            .activity-name {
                margin: 0;
                font-size: 1rem;
                font-weight: 800;
            }

            .activity-meta {
                margin-top: 8px;
                color: var(--muted);
                line-height: 1.7;
            }

            .activity-pill {
                display: inline-flex;
                align-items: center;
                padding: 7px 12px;
                border-radius: 999px;
                background: var(--success-soft);
                color: var(--success-ink);
                font-size: 0.82rem;
                font-weight: 800;
                text-transform: capitalize;
            }

            .empty-state {
                padding: 18px;
                border-radius: 20px;
                background: #f7fbff;
                border: 1px dashed rgba(23, 52, 93, 0.18);
                color: var(--muted);
                line-height: 1.8;
            }

            @media (max-width: 1180px) {
                .console-app {
                    grid-template-columns: 1fr;
                }

                .console-sidebar {
                    position: static;
                    min-height: auto;
                }

                .stats-grid,
                .dashboard-grid {
                    grid-template-columns: 1fr 1fr;
                }
            }

            @media (max-width: 800px) {
                .workspace {
                    padding: 18px 16px 26px;
                }

                .topbar,
                .hero-card,
                .dashboard-grid,
                .stats-grid {
                    grid-template-columns: 1fr;
                }

                .topbar,
                .hero-card {
                    display: grid;
                }

                .hero-side {
                    justify-items: start;
                    text-align: left;
                }

                .button-dark,
                .button-light {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        @php
            $posSummary = $profileReady
                ? 'Businesses listed on Book Rahisi can use this POS workspace to manage bookings, payment follow-up, daily appointments, and listing updates from one system.'
                : 'Finish the public profile first so your Book Rahisi listing can start receiving bookings and become the place you manage the business day to day.';
            $workspaceState = $profileReady ? 'Book Rahisi listing connected' : 'Complete listing to unlock management';
            $publicPageHref = $profileReady
                ? route('business.show', ['slug' => $businessSlug])
                : route('for-business.profile-details');
        @endphp

        <div class="console-app">
            @include('partials.business-console-sidebar', ['profileReady' => $profileReady])

            <main class="workspace">
                <div class="workspace-shell">
                    <div class="topbar">
                        <div>
                            <span class="eyebrow">Point of sale</span>
                            <h1>POS</h1>
                            <p class="subtitle">
                                {{ $posSummary }}
                            </p>
                        </div>

                        <div class="toolbar">
                            <a class="button-light" href="{{ route('for-business.tools') }}">Back to dashboard</a>
                            <a class="button-light" href="{{ route('for-business.bookings') }}">Open bookings</a>
                            <a class="button-dark" href="{{ $publicPageHref }}">
                                {{ $profileReady ? 'Preview public page' : 'Complete profile' }}
                            </a>
                        </div>
                    </div>

                    <section class="hero-card">
                        <div>
                            <span class="eyebrow" style="background: rgba(255, 255, 255, 0.16); color: #fff;">POS workspace</span>
                            <h2>Manage your listed business from one place</h2>
                            <p class="hero-copy">
                                Once a business is listed on Book Rahisi, the owner can keep using this system to run the day-to-day operation: monitor bookings, follow up on payments, keep the public listing accurate, and stay on top of customer activity without leaving the workspace.
                            </p>
                            <div class="hero-actions">
                                <a class="button-dark" href="{{ route('for-business.bookings') }}">Review bookings</a>
                                <a class="button-light" href="{{ route('for-business.settings') }}">Open settings</a>
                                <a class="button-light" href="{{ route('for-business.profile-details') }}">Update profile</a>
                            </div>
                        </div>

                        <div class="hero-side">
                            <span class="hero-tag">{{ $workspaceState }}</span>
                            <div class="hero-amount">{{ $bookingCount }}</div>
                            <div class="hero-caption">Bookings managed</div>
                            <div class="hero-side-copy">
                                {{ $pendingBookingCount }} booking{{ $pendingBookingCount === 1 ? '' : 's' }} waiting for action, {{ $pendingPaymentCount }} payment{{ $pendingPaymentCount === 1 ? '' : 's' }} still pending, and {{ $todayBookingCount }} appointment{{ $todayBookingCount === 1 ? '' : 's' }} scheduled for today.
                            </div>
                        </div>
                    </section>

                    <section class="stats-grid">
                        <article class="stat-card">
                            <div class="stat-label">Total bookings</div>
                            <div class="stat-value">{{ $bookingCount }}</div>
                            <div class="stat-pill">Workspace volume</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Pending bookings</div>
                            <div class="stat-value">{{ $pendingBookingCount }}</div>
                            <div class="stat-pill is-warning">Needs response</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Pending payments</div>
                            <div class="stat-value">{{ $pendingPaymentCount }}</div>
                            <div class="stat-pill is-warning">Needs follow-up</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Listing status</div>
                            <div class="stat-value">{{ $listingStatus }}</div>
                            <div class="stat-pill {{ $profileReady ? 'is-success' : 'is-warning' }}">{{ $profileReady ? 'Ready to manage' : 'Profile incomplete' }}</div>
                        </article>
                    </section>

                    <section class="dashboard-grid">
                        <section class="panel">
                            <div class="panel-head">
                                <div>
                                    <h3 class="panel-title">Business management overview</h3>
                                    <p class="panel-copy">This POS area now acts as a business-management entry point for merchants listed on Book Rahisi, connecting the existing booking, profile, settings, and customer-facing flows.</p>
                                </div>
                            </div>

                            <div class="summary-list">
                                <article class="summary-row">
                                    <div class="summary-label">Business listing</div>
                                    <div class="summary-value">{{ $accountSetup['business_name'] }} is currently {{ strtolower($listingStatus) }} on Book Rahisi.</div>
                                </article>
                                <article class="summary-row">
                                    <div class="summary-label">Owner account</div>
                                    <div class="summary-value">{{ $accountSetup['first_name'] }} {{ $accountSetup['last_name'] }} / {{ $email }}</div>
                                </article>
                                <article class="summary-row">
                                    <div class="summary-label">Customer activity</div>
                                    <div class="summary-value">{{ $bookingCount }} total booking{{ $bookingCount === 1 ? '' : 's' }}, {{ $todayBookingCount }} scheduled for today, and {{ $pendingBookingCount }} still waiting for review.</div>
                                </article>
                                <article class="summary-row">
                                    <div class="summary-label">Payment follow-up</div>
                                    <div class="summary-value">{{ $paidBookingCount }} paid booking{{ $paidBookingCount === 1 ? '' : 's' }} recorded and {{ $pendingPaymentCount }} payment{{ $pendingPaymentCount === 1 ? '' : 's' }} still open.</div>
                                </article>
                                <article class="summary-row">
                                    <div class="summary-label">Management tools</div>
                                    <div class="summary-value">Use Bookings for service flow, Settings for operational controls, and Profile to keep the public listing accurate for customers.</div>
                                </article>
                                <article class="summary-row">
                                    <div class="summary-label">Next move</div>
                                    <div class="summary-value">
                                        @if ($profileReady)
                                            Use this workspace as the owner hub for running the listed business and jump into the linked tools whenever bookings, profile details, or payments need attention.
                                        @else
                                            Complete the public profile first so the listing can start receiving customer bookings and become a complete management workspace.
                                        @endif
                                    </div>
                                </article>
                            </div>

                            <div class="hero-actions" style="margin-top: 18px;">
                                <a class="button-dark" href="{{ route('for-business.bookings') }}">Customer bookings</a>
                                <a class="button-light" href="{{ route('for-business.settings') }}">Settings</a>
                                <a class="button-light" href="{{ route('for-business.profile-details') }}">Profile editor</a>
                                <a class="button-light" href="{{ $publicPageHref }}">{{ $profileReady ? 'Public listing' : 'Complete listing' }}</a>
                            </div>
                        </section>

                        <aside class="panel">
                            <div class="panel-head">
                                <div>
                                    <h3 class="panel-title">Recent paid activity</h3>
                                    <p class="panel-copy">Paid appointments still matter here, but they now sit inside a wider management view for businesses running on Book Rahisi.</p>
                                </div>
                            </div>

                            @if ($recentPaidBookings->isEmpty())
                                <div class="empty-state">
                                    No paid bookings are recorded yet. As the listed business receives bookings and payments are updated, this POS workspace will reflect that activity while the rest of the management tools remain available.
                                </div>
                            @else
                                <div class="activity-list">
                                    @foreach ($recentPaidBookings as $booking)
                                        <article class="activity-row">
                                            <div class="activity-top">
                                                <div>
                                                    <h4 class="activity-name">{{ $booking->customer_name }}</h4>
                                                    <div class="activity-meta">
                                                        {{ $booking->service_name }} with {{ $booking->staff_name }} on
                                                        {{ $booking->appointment_date?->format('D, j M Y') ?? $booking->appointment_date }}
                                                        at {{ $booking->appointment_time }}
                                                    </div>
                                                </div>
                                                <span class="activity-pill">{{ $booking->payment_status }}</span>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @endif
                        </aside>
                    </section>
                </div>
            </main>
        </div>
    </body>
</html>
