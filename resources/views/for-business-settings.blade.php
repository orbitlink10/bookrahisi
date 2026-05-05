<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi For Professionals | Settings</title>
        <meta
            name="description"
            content="Control business setup, scheduling, sales visibility, clients, billing details, and team settings from the Book Rahisi dashboard."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --navy: #17345d;
                --navy-deep: #112744;
                --navy-soft: rgba(255, 255, 255, 0.08);
                --page: #f6f7fb;
                --panel: #ffffff;
                --ink: #13161c;
                --muted: #697282;
                --line: #e2e6ef;
                --accent: #6956ff;
                --accent-soft: #f1efff;
                --success-soft: #edf9ef;
                --success-ink: #197446;
                --warning-soft: #fff5de;
                --warning-ink: #b57608;
                --neutral-soft: #eef1f6;
                --neutral-ink: #4e5868;
                --shadow: 0 20px 44px rgba(17, 19, 23, 0.08);
            }

            * {
                box-sizing: border-box;
            }

            html {
                scroll-behavior: smooth;
            }

            body {
                margin: 0;
                min-height: 100vh;
                background: linear-gradient(180deg, #fbfcff 0%, var(--page) 100%);
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
                padding: 26px 28px 42px;
            }

            .workspace-shell {
                width: min(100%, 1480px);
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
                background: #e5f1ff;
                color: #2379c7;
                font-size: 0.88rem;
                font-weight: 800;
            }

            h1 {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.5rem, 4vw, 4rem);
                letter-spacing: -0.06em;
                line-height: 0.98;
            }

            .subtitle {
                margin: 14px 0 0;
                max-width: 880px;
                color: var(--muted);
                font-size: 1rem;
                line-height: 1.75;
            }

            .toolbar,
            .hero-actions,
            .section-tabs,
            .card-actions,
            .support-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .button-dark,
            .button-light {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-height: 52px;
                padding: 0 20px;
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
                background: rgba(255, 255, 255, 0.92);
                color: var(--ink);
            }

            .hero-card {
                display: grid;
                grid-template-columns: minmax(0, 1.2fr) minmax(240px, 0.55fr);
                gap: 24px;
                align-items: center;
                margin-bottom: 22px;
                padding: 30px;
                border-radius: 28px;
                background: linear-gradient(135deg, var(--accent) 0%, #4a79ff 100%);
                color: #fff;
                box-shadow: var(--shadow);
            }

            .hero-card h2 {
                margin: 14px 0 0;
                max-width: 13ch;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.5rem, 4vw, 3.8rem);
                letter-spacing: -0.06em;
                line-height: 0.96;
            }

            .hero-copy {
                margin: 14px 0 0;
                max-width: 760px;
                color: rgba(255, 255, 255, 0.94);
                font-size: 1rem;
                line-height: 1.75;
            }

            .hero-side {
                display: grid;
                gap: 16px;
                justify-items: end;
                text-align: right;
            }

            .hero-tag,
            .status-pill,
            .support-pill {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 10px 14px;
                border-radius: 999px;
                font-size: 0.86rem;
                font-weight: 800;
            }

            .hero-tag {
                background: rgba(255, 255, 255, 0.9);
                color: var(--accent);
            }

            .hero-amount {
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.8rem, 5vw, 4.4rem);
                font-weight: 800;
                letter-spacing: -0.06em;
                line-height: 0.92;
            }

            .hero-caption,
            .hero-side-copy {
                color: rgba(255, 255, 255, 0.92);
                font-size: 0.96rem;
                line-height: 1.7;
            }

            .section-tabs {
                margin-bottom: 24px;
            }

            .tab-link {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-height: 48px;
                padding: 0 18px;
                border: 1px solid var(--line);
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.86);
                color: var(--ink);
                font-size: 0.96rem;
                font-weight: 800;
            }

            .tab-link.is-active {
                border-color: transparent;
                background: var(--ink);
                color: #fff;
            }

            .section {
                margin-top: 28px;
            }

            .section-head {
                display: flex;
                align-items: flex-end;
                justify-content: space-between;
                gap: 18px;
                margin-bottom: 18px;
            }

            .section-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 2rem;
                letter-spacing: -0.05em;
            }

            .section-copy {
                margin: 10px 0 0;
                max-width: 760px;
                color: var(--muted);
                line-height: 1.7;
            }

            .settings-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 18px;
            }

            .settings-card,
            .support-card {
                border: 1px solid var(--line);
                border-radius: 26px;
                background: rgba(255, 255, 255, 0.94);
                box-shadow: var(--shadow);
            }

            .settings-card {
                display: grid;
                gap: 18px;
                padding: 24px;
            }

            .card-top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
            }

            .card-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 54px;
                height: 54px;
                border-radius: 18px;
                background: var(--accent-soft);
                color: var(--accent);
            }

            .card-icon svg {
                width: 26px;
                height: 26px;
            }

            .status-pill.is-success,
            .support-pill.is-success {
                background: var(--success-soft);
                color: var(--success-ink);
            }

            .status-pill.is-warning,
            .support-pill.is-warning {
                background: var(--warning-soft);
                color: var(--warning-ink);
            }

            .status-pill.is-neutral,
            .support-pill.is-neutral {
                background: var(--neutral-soft);
                color: var(--neutral-ink);
            }

            .card-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.8rem;
                letter-spacing: -0.05em;
            }

            .card-copy {
                margin: 10px 0 0;
                color: var(--muted);
                line-height: 1.72;
            }

            .facts-list {
                display: grid;
                gap: 12px;
            }

            .fact-row {
                display: grid;
                gap: 6px;
                padding: 14px 16px;
                border: 1px solid var(--line);
                border-radius: 18px;
                background: #fff;
            }

            .fact-label {
                color: var(--muted);
                font-size: 0.76rem;
                font-weight: 800;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            .fact-value {
                font-size: 0.96rem;
                font-weight: 700;
                line-height: 1.6;
            }

            .support-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
            }

            .support-grid.is-single {
                grid-template-columns: 1fr;
            }

            .support-card {
                padding: 24px;
            }

            .support-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.6rem;
                letter-spacing: -0.05em;
            }

            .support-copy {
                margin: 12px 0 0;
                color: var(--muted);
                line-height: 1.72;
            }

            .support-meta {
                display: grid;
                gap: 10px;
                margin-top: 18px;
            }

            .support-meta-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                padding: 12px 0;
                border-top: 1px solid var(--line);
                font-size: 0.94rem;
            }

            .support-meta-row:first-child {
                border-top: 0;
                padding-top: 0;
            }

            .support-meta-label {
                color: var(--muted);
                font-weight: 700;
            }

            .support-meta-value {
                font-weight: 800;
                text-align: right;
            }

            .support-actions {
                margin-top: 20px;
            }

            @media (max-width: 1360px) {
                .settings-grid {
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

                .hero-card,
                .support-grid,
                .support-grid.is-single,
                .section-head {
                    grid-template-columns: 1fr;
                }

                .hero-side {
                    justify-items: start;
                    text-align: left;
                }

                .section-head {
                    display: grid;
                }
            }

            @media (max-width: 760px) {
                .workspace {
                    padding: 18px 16px 30px;
                }

                .topbar,
                .toolbar,
                .hero-actions,
                .card-actions,
                .support-actions,
                .support-meta-row {
                    flex-direction: column;
                    align-items: stretch;
                }

                .settings-grid,
                .support-grid {
                    grid-template-columns: 1fr;
                }

                .button-dark,
                .button-light,
                .tab-link {
                    width: 100%;
                }

                .card-top {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .support-meta-value {
                    text-align: left;
                }
            }
        </style>
    </head>
    <body>
        @php
            $profileTagline = $profileDetails['tagline'] ?? 'Complete the public profile so customers can discover, trust, and book your business.';
            $teamLead = $teamPreview[0]['name'] ?? 'Team preview';
        @endphp

        <div class="console-app">
            @include('partials.business-console-sidebar', ['profileReady' => $profileReady])

            <main class="workspace">
                <div class="workspace-shell">
                    <div class="topbar">
                        <div>
                            <span class="eyebrow">Dashboard controls</span>
                            <h1>Settings</h1>
                            <p class="subtitle">
                                Control the business setup, scheduling, sales visibility, clients, billing context, and team-facing details for {{ $accountSetup['business_name'] }} from one dashboard screen.
                            </p>
                        </div>

                        <div class="toolbar">
                            <a class="button-light" href="{{ route('for-business.tools') }}">Back to dashboard</a>
                            <a class="button-dark" href="{{ $profileReady ? $publicPageHref : route('for-business.profile-details') }}">
                                {{ $profileReady ? 'Preview public page' : 'Complete public profile' }}
                            </a>
                        </div>
                    </div>

                    <section class="hero-card">
                        <div>
                            <span class="eyebrow" style="background: rgba(255, 255, 255, 0.16); color: #fff;">Settings workspace</span>
                            <h2>One place to control the business dashboard</h2>
                            <p class="hero-copy">
                                This settings area mirrors the control structure you referenced: business setup, scheduling, sales, clients, billing details, and team each have their own card with live workspace context and direct actions back into the existing Book Rahisi flows.
                            </p>
                            <div class="hero-actions">
                                <a class="button-light" href="{{ route('for-business.profile-details') }}">Update profile</a>
                                <a class="button-light" href="{{ route('for-business.bookings') }}">Open bookings</a>
                                <a class="button-light" href="{{ route('for-business.account-setup') }}">Owner setup</a>
                            </div>
                        </div>

                        <div class="hero-side">
                            <span class="hero-tag">{{ $profileReady ? 'Profile live' : 'Profile draft' }}</span>
                            <div class="hero-amount">{{ count($settingsCards) }}</div>
                            <div class="hero-caption">Core settings areas</div>
                            <div class="hero-side-copy">
                                {{ $pendingBookingCount }} pending {{ $pendingBookingCount === 1 ? 'response' : 'responses' }},
                                {{ $todayBookingCount }} scheduled today, and {{ $paidBookingCount }} paid {{ $paidBookingCount === 1 ? 'booking' : 'bookings' }} currently tracked.
                            </div>
                        </div>
                    </section>

                    <nav class="section-tabs" aria-label="Settings section navigation">
                        <a class="tab-link is-active" href="#settings">Settings</a>
                        <a class="tab-link" href="#online-presence">Online presence</a>
                        <a class="tab-link" href="#marketing">Marketing</a>
                        <a class="tab-link" href="#other">Other</a>
                    </nav>

                    <section class="section" id="settings">
                        <div class="section-head">
                            <div>
                                <h2 class="section-title">Settings</h2>
                                <p class="section-copy">Each card gives the business owner a focused control point plus the closest available action in the current product.</p>
                            </div>
                        </div>

                        <div class="settings-grid">
                            @foreach ($settingsCards as $card)
                                <article class="settings-card">
                                    <div class="card-top">
                                        <span class="card-icon" aria-hidden="true">
                                            @switch($card['icon'])
                                                @case('business')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M4 10h16"></path>
                                                        <path d="M6 10V7.5A1.5 1.5 0 0 1 7.5 6h9A1.5 1.5 0 0 1 18 7.5V10"></path>
                                                        <path d="M6 10v8a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-8"></path>
                                                        <path d="M9 14h6"></path>
                                                    </svg>
                                                    @break
                                                @case('calendar')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                                        <rect x="4" y="5" width="16" height="15" rx="2"></rect>
                                                        <path d="M16 3v4"></path>
                                                        <path d="M8 3v4"></path>
                                                        <path d="M4 10h16"></path>
                                                    </svg>
                                                    @break
                                                @case('sales')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M6 7h12"></path>
                                                        <path d="M8 12h8"></path>
                                                        <path d="M10 17h4"></path>
                                                        <path d="M7 4h10l2 3v10a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V7z"></path>
                                                    </svg>
                                                    @break
                                                @case('clients')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M16 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="9.5" cy="7" r="4"></circle>
                                                        <path d="M20 8v6"></path>
                                                        <path d="M23 11h-6"></path>
                                                    </svg>
                                                    @break
                                                @case('billing')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M6 3h12"></path>
                                                        <path d="M8 7h8"></path>
                                                        <path d="M6 11h12"></path>
                                                        <path d="M7 21h10a2 2 0 0 0 2-2V5H5v14a2 2 0 0 0 2 2Z"></path>
                                                    </svg>
                                                    @break
                                                @case('team')
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="9" cy="7" r="4"></circle>
                                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                    </svg>
                                                    @break
                                            @endswitch
                                        </span>
                                        <span class="status-pill is-{{ $card['tone'] }}">{{ $card['status'] }}</span>
                                    </div>

                                    <div>
                                        <h3 class="card-title">{{ $card['title'] }}</h3>
                                        <p class="card-copy">{{ $card['description'] }}</p>
                                    </div>

                                    <div class="facts-list">
                                        @foreach ($card['facts'] as $fact)
                                            <div class="fact-row">
                                                <span class="fact-label">{{ $fact['label'] }}</span>
                                                <span class="fact-value">{{ $fact['value'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="card-actions">
                                        <a class="button-dark" href="{{ $card['primary_action']['href'] }}">{{ $card['primary_action']['label'] }}</a>
                                        @if (! empty($card['secondary_action']))
                                            <a class="button-light" href="{{ $card['secondary_action']['href'] }}">{{ $card['secondary_action']['label'] }}</a>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>

                    <section class="section" id="online-presence">
                        <div class="section-head">
                            <div>
                                <h2 class="section-title">Online presence</h2>
                                <p class="section-copy">Keep the customer-facing pages aligned with your real location, hours, and booking flow.</p>
                            </div>
                        </div>

                        <div class="support-grid">
                            <article class="support-card">
                                <span class="support-pill is-{{ $profileReady ? 'success' : 'warning' }}">{{ $profileReady ? 'Public page live' : 'Profile draft' }}</span>
                                <h3 class="support-title" style="margin-top: 16px;">Public profile</h3>
                                <p class="support-copy">{{ $profileTagline }}</p>

                                <div class="support-meta">
                                    <div class="support-meta-row">
                                        <span class="support-meta-label">Business</span>
                                        <span class="support-meta-value">{{ $accountSetup['business_name'] }}</span>
                                    </div>
                                    <div class="support-meta-row">
                                        <span class="support-meta-label">Hours</span>
                                        <span class="support-meta-value">{{ $profileHours }}</span>
                                    </div>
                                    <div class="support-meta-row">
                                        <span class="support-meta-label">Workspace status</span>
                                        <span class="support-meta-value">{{ $workspaceStatus }}</span>
                                    </div>
                                </div>

                                <div class="support-actions">
                                    <a class="button-dark" href="{{ route('for-business.profile-details') }}">Edit public profile</a>
                                    <a class="button-light" href="{{ $publicPageHref }}">{{ $profileReady ? 'Preview customer page' : 'Finish setup' }}</a>
                                </div>
                            </article>

                            <article class="support-card">
                                <span class="support-pill is-{{ $profileReady ? 'success' : 'neutral' }}">{{ $profileReady ? 'Booking page active' : 'Waiting on profile' }}</span>
                                <h3 class="support-title" style="margin-top: 16px;">Booking page</h3>
                                <p class="support-copy">Use the live booking flow to validate how customers will choose services, staff, dates, and times before they submit requests.</p>

                                <div class="support-meta">
                                    <div class="support-meta-row">
                                        <span class="support-meta-label">Today</span>
                                        <span class="support-meta-value">{{ $todayBookingCount }} booking{{ $todayBookingCount === 1 ? '' : 's' }}</span>
                                    </div>
                                    <div class="support-meta-row">
                                        <span class="support-meta-label">Pending responses</span>
                                        <span class="support-meta-value">{{ $pendingBookingCount }}</span>
                                    </div>
                                    <div class="support-meta-row">
                                        <span class="support-meta-label">Client reach</span>
                                        <span class="support-meta-value">{{ $profileReady ? 'Customers can request appointments' : 'Complete profile first' }}</span>
                                    </div>
                                </div>

                                <div class="support-actions">
                                    <a class="button-dark" href="{{ $bookingPageHref }}">{{ $profileReady ? 'Open booking page' : 'Complete profile' }}</a>
                                    <a class="button-light" href="{{ route('for-business.bookings') }}">Review bookings</a>
                                </div>
                            </article>
                        </div>
                    </section>

                    <section class="section" id="marketing">
                        <div class="section-head">
                            <div>
                                <h2 class="section-title">Marketing</h2>
                                <p class="section-copy">Use the current profile and booking activity to support marketplace discovery and repeat demand.</p>
                            </div>
                        </div>

                        <div class="support-grid is-single">
                            <article class="support-card">
                                <span class="support-pill is-{{ $profileReady ? 'success' : 'neutral' }}">{{ $profileReady ? 'Ready to share' : 'Build profile first' }}</span>
                                <h3 class="support-title" style="margin-top: 16px;">Marketplace visibility</h3>
                                <p class="support-copy">The strongest marketing lever in the current workspace is a complete public profile plus a booking page that accurately reflects your business hours and positioning.</p>

                                <div class="support-meta">
                                    <div class="support-meta-row">
                                        <span class="support-meta-label">Profile message</span>
                                        <span class="support-meta-value">{{ $profileTagline }}</span>
                                    </div>
                                    <div class="support-meta-row">
                                        <span class="support-meta-label">Bookings received</span>
                                        <span class="support-meta-value">{{ $bookingCount }}</span>
                                    </div>
                                    <div class="support-meta-row">
                                        <span class="support-meta-label">Lead team preview</span>
                                        <span class="support-meta-value">{{ $teamLead }}</span>
                                    </div>
                                </div>

                                <div class="support-actions">
                                    <a class="button-dark" href="{{ $publicPageHref }}">{{ $profileReady ? 'Open public page' : 'Finish profile' }}</a>
                                    <a class="button-light" href="{{ route('for-business.profile-details') }}">Refine positioning</a>
                                </div>
                            </article>
                        </div>
                    </section>

                    <section class="section" id="other">
                        <div class="section-head">
                            <div>
                                <h2 class="section-title">Other</h2>
                                <p class="section-copy">Owner access, workspace identity, and operational context that support the rest of the dashboard.</p>
                            </div>
                        </div>

                        <div class="support-grid is-single">
                            <article class="support-card">
                                <span class="support-pill is-{{ $profileReady ? 'success' : 'neutral' }}">{{ $workspaceStatus }}</span>
                                <h3 class="support-title" style="margin-top: 16px;">Owner workspace</h3>
                                <p class="support-copy">Keep the primary account and business information current so every other dashboard surface stays aligned.</p>

                                <div class="support-meta">
                                    <div class="support-meta-row">
                                        <span class="support-meta-label">Owner</span>
                                        <span class="support-meta-value">{{ $accountSetup['first_name'] }} {{ $accountSetup['last_name'] }}</span>
                                    </div>
                                    <div class="support-meta-row">
                                        <span class="support-meta-label">Email</span>
                                        <span class="support-meta-value">{{ $email }}</span>
                                    </div>
                                    <div class="support-meta-row">
                                        <span class="support-meta-label">Phone</span>
                                        <span class="support-meta-value">{{ $accountSetup['phone'] }}</span>
                                    </div>
                                </div>

                                <div class="support-actions">
                                    <a class="button-dark" href="{{ route('for-business.account-setup') }}">Review owner setup</a>
                                    <a class="button-light" href="{{ route('for-business.tools') }}">Return to dashboard</a>
                                </div>
                            </article>
                        </div>
                    </section>
                </div>
            </main>
        </div>
    </body>
</html>
