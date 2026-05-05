<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi For Professionals | Customer Bookings</title>
        <meta
            name="description"
            content="Review customer bookings for your business."
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
                grid-template-columns: repeat(4, minmax(0, 1fr));
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

            .booking-list {
                display: grid;
                gap: 14px;
            }

            .booking-row {
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
            .booking-note {
                margin-top: 8px;
                color: var(--muted);
                line-height: 1.65;
            }

            .booking-link {
                color: var(--accent);
                font-weight: 800;
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
                    grid-template-columns: repeat(2, minmax(0, 1fr));
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
            $profileReady = true;
            $pendingBookings = $bookings->where('status', 'pending')->count();
            $todayBookings = $bookings->filter(static fn ($booking) => optional($booking->appointment_date)->isToday())->count();
        @endphp

        <div class="console-app">
            @include('partials.business-console-sidebar', ['profileReady' => $profileReady])

            <main class="workspace">
                <div class="workspace-shell">
                    <div class="topbar">
                        <div>
                            <span class="eyebrow">Live bookings console</span>
                            <h1>Customer bookings</h1>
                            <p class="subtitle">Review incoming booking requests, reach out to customers quickly, and keep the front desk organized from one consistent owner workspace.</p>
                        </div>

                        <div class="toolbar">
                            <a class="button-light" href="{{ route('for-business.tools') }}">Back to dashboard</a>
                            <a class="button-dark" href="{{ route('business.show', ['slug' => $businessSlug]) }}">View public page</a>
                        </div>
                    </div>

                    <section class="hero-card">
                        <div>
                            <span class="eyebrow" style="background: rgba(255, 255, 255, 0.16); color: #fff;">Booking command center</span>
                            <h2>Customer bookings</h2>
                            <p class="hero-copy">Every new booking request appears here with the chosen service, assigned staff member, appointment slot, customer phone number, and any additional notes.</p>
                            <div class="hero-alert">
                                @if ($bookings->isEmpty())
                                    No bookings have been received yet. Keep the public page live and start sharing the booking link with customers.
                                @elseif ($pendingBookings === 1)
                                    1 pending booking request needs owner attention right now.
                                @else
                                    {{ $pendingBookings }} pending booking requests are currently waiting for review.
                                @endif
                            </div>
                            <div class="hero-actions">
                                <a class="button-dark" href="{{ route('for-business.tools') }}">Home</a>
                                <a class="button-light" href="{{ route('business.show', ['slug' => $businessSlug]) }}">Public page</a>
                                <a class="button-light" href="{{ route('business.book', ['slug' => $businessSlug]) }}">Open booking page</a>
                            </div>
                        </div>

                        <div class="hero-side">
                            <span class="hero-tag">Today</span>
                            <div class="hero-amount">{{ $bookings->count() }}</div>
                            <div class="hero-caption">Requests in workspace</div>
                        </div>
                    </section>

                    <section class="stats-grid">
                        <article class="stat-card">
                            <div class="stat-label">Total bookings</div>
                            <div class="stat-value">{{ $bookings->count() }}</div>
                            <div class="stat-pill">All requests</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Pending requests</div>
                            <div class="stat-value">{{ $pendingBookings }}</div>
                            <div class="stat-pill is-warning">Needs follow-up</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Today's bookings</div>
                            <div class="stat-value">{{ $todayBookings }}</div>
                            <div class="stat-pill is-success">Today's schedule</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Owner email</div>
                            <div class="stat-value" style="font-size: 1.35rem; line-height: 1.2;">{{ $email }}</div>
                            <div class="stat-pill is-danger">Active owner</div>
                        </article>
                    </section>

                    <section class="panel">
                        <div class="panel-head">
                            <div>
                                <h3 class="panel-title">Customer bookings</h3>
                                <p class="panel-copy">The newest request stays at the top so the owner can react immediately after opening the page.</p>
                            </div>
                            <a class="button-light" href="{{ route('for-business.tools') }}">Back to dashboard</a>
                        </div>

                        @if ($bookings->isEmpty())
                            <div class="empty-state">
                                Your public booking page is live. As soon as a customer books an appointment, it will appear here with the selected service, preferred time, notes, and contact details.
                            </div>
                        @else
                            <div class="booking-list">
                                @foreach ($bookings as $booking)
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
                                            Phone number: {{ $booking->customer_phone }}
                                            @if ($booking->customer_email)
                                                <br>Email: {{ $booking->customer_email }}
                                            @endif
                                            @if ($booking->customer_notes)
                                                <br>{{ $booking->customer_notes }}
                                            @endif
                                            @if ($booking->customer_image_path)
                                                <br>
                                                <a class="booking-link" href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($booking->customer_image_path) }}" target="_blank" rel="noopener noreferrer">View uploaded reference image</a>
                                            @endif
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @endif
                    </section>
                </div>
            </main>
        </div>
    </body>
</html>
