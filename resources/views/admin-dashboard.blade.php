<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi Admin | Marketplace Console</title>
        <meta
            name="description"
            content="Marketplace owner console for Book Rahisi."
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

            html {
                scroll-behavior: smooth;
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

            button,
            input,
            select,
            textarea {
                font: inherit;
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

            .sidebar-link:hover {
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
                width: min(100%, 1460px);
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
                max-width: 860px;
            }

            .toolbar {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .button-dark,
            .button-light,
            .button-inline {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 14px 20px;
                border-radius: 16px;
                font-size: 0.96rem;
                font-weight: 800;
            }

            .button-dark,
            .button-inline {
                border: 0;
                background: var(--navy);
                color: #fff;
                cursor: pointer;
                box-shadow: 0 14px 30px rgba(23, 52, 93, 0.16);
            }

            .button-light {
                border: 1px solid var(--line);
                background: rgba(255, 255, 255, 0.9);
                color: var(--ink);
            }

            .button-inline {
                min-width: 0;
                padding: 12px 16px;
                border-radius: 14px;
                font-size: 0.88rem;
                box-shadow: none;
            }

            .success-banner,
            .error-banner {
                margin-bottom: 18px;
                padding: 14px 16px;
                border-radius: 18px;
                font-size: 0.94rem;
                font-weight: 700;
            }

            .success-banner {
                border: 1px solid rgba(20, 125, 70, 0.14);
                background: var(--success-soft);
                color: var(--success-ink);
            }

            .error-banner {
                border: 1px solid rgba(194, 75, 58, 0.18);
                background: var(--danger-soft);
                color: var(--danger-ink);
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

            .panel-stack {
                display: grid;
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

            .entity-list {
                display: grid;
                gap: 14px;
            }

            .entity-row {
                padding: 18px;
                border: 1px solid var(--line);
                border-radius: 20px;
                background: #fff;
            }

            .entity-head {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 16px;
            }

            .entity-name {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.28rem;
                letter-spacing: -0.04em;
            }

            .entity-meta,
            .entity-extra {
                margin-top: 8px;
                color: var(--muted);
                line-height: 1.65;
            }

            .entity-link {
                color: var(--accent);
                font-weight: 800;
            }

            .status-chip {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 8px 12px;
                border-radius: 14px;
                background: #e8f4ff;
                color: #0f69ad;
                font-size: 0.82rem;
                font-weight: 800;
                white-space: nowrap;
                text-transform: capitalize;
            }

            .status-chip.is-success {
                background: var(--success-soft);
                color: var(--success-ink);
            }

            .status-chip.is-warning {
                background: var(--warning-soft);
                color: var(--warning-ink);
            }

            .status-chip.is-danger {
                background: var(--danger-soft);
                color: var(--danger-ink);
            }

            .inline-form {
                display: grid;
                gap: 12px;
                margin-top: 16px;
            }

            .inline-form-row {
                display: grid;
                grid-template-columns: minmax(0, 180px) minmax(0, 1fr) auto;
                gap: 10px;
            }

            .field-select,
            .field-input {
                width: 100%;
                min-height: 48px;
                padding: 0 14px;
                border: 1px solid var(--line);
                border-radius: 14px;
                outline: none;
                background: #fff;
                color: var(--ink);
                font-size: 0.92rem;
            }

            .field-select:focus,
            .field-input:focus {
                border-color: var(--accent);
                box-shadow: 0 0 0 4px rgba(26, 160, 226, 0.08);
            }

            .reports-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 14px;
            }

            .report-card {
                padding: 18px;
                border: 1px solid var(--line);
                border-radius: 20px;
                background: #fff;
            }

            .report-title {
                font-size: 0.9rem;
                font-weight: 800;
                color: var(--muted);
            }

            .report-value {
                margin-top: 10px;
                font-family: 'Outfit', sans-serif;
                font-size: 1.9rem;
                font-weight: 800;
                letter-spacing: -0.05em;
            }

            .report-list {
                display: grid;
                gap: 12px;
                margin-top: 18px;
            }

            .report-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                padding: 14px 16px;
                border: 1px solid var(--line);
                border-radius: 18px;
                background: #fff;
            }

            .empty-state {
                padding: 24px;
                border: 1px dashed var(--line);
                border-radius: 20px;
                background: #fafdff;
                color: var(--muted);
                line-height: 1.7;
            }

            @media (max-width: 1360px) {
                .stats-grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }

                .reports-grid {
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
                .entity-head {
                    flex-direction: column;
                    align-items: stretch;
                }

                .stats-grid,
                .reports-grid,
                .inline-form-row {
                    grid-template-columns: 1fr;
                }

                .button-dark,
                .button-light,
                .hero-actions .button-dark,
                .hero-actions .button-light,
                .button-inline {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <div class="console-app">
            <aside class="console-sidebar">
                <div class="sidebar-brand">
                    <div class="brand-avatar">BR</div>
                    <div class="brand-copy">
                        <div class="brand-title">Book Rahisi</div>
                        <div class="brand-subtitle">Marketplace Admin</div>
                    </div>
                </div>

                <nav class="sidebar-nav" aria-label="Admin console navigation">
                    <a class="sidebar-link" href="#overview">
                        <span class="sidebar-link-icon">HM</span>
                        <span>Home</span>
                    </a>
                    <a class="sidebar-link" href="#businesses">
                        <span class="sidebar-link-icon">BS</span>
                        <span>Businesses</span>
                    </a>
                    <a class="sidebar-link" href="#users">
                        <span class="sidebar-link-icon">US</span>
                        <span>Users</span>
                    </a>
                    <a class="sidebar-link" href="#bookings">
                        <span class="sidebar-link-icon">BK</span>
                        <span>Bookings</span>
                    </a>
                    <a class="sidebar-link" href="#payments">
                        <span class="sidebar-link-icon">PY</span>
                        <span>Payments</span>
                    </a>
                    <a class="sidebar-link" href="#reports">
                        <span class="sidebar-link-icon">RP</span>
                        <span>Reports</span>
                    </a>
                </nav>
            </aside>

            <main class="workspace">
                <div class="workspace-shell">
                    <div class="topbar" id="overview">
                        <div>
                            <span class="eyebrow">Marketplace control center</span>
                            <h1>Admin dashboard</h1>
                            <p class="subtitle">
                                Approve businesses, manage platform users, monitor bookings, control payments, and review marketplace performance from one owner-only console.
                            </p>
                        </div>

                        <div class="toolbar">
                            <a class="button-light" href="{{ route('home') }}">View marketplace</a>
                            <form action="{{ route('admin.sign-out') }}" method="post">
                                @csrf
                                <button class="button-dark" type="submit">Sign out</button>
                            </form>
                        </div>
                    </div>

                    @if (session('admin_success'))
                        <div class="success-banner">{{ session('admin_success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="error-banner">One or more admin actions could not be completed. Review the submitted values and try again.</div>
                    @endif

                    <section class="hero-card">
                        <div>
                            <span class="eyebrow" style="background: rgba(255, 255, 255, 0.16); color: #fff;">Marketplace snapshot</span>
                            <h2>Welcome back</h2>
                            <p class="hero-copy">Track business approvals, user activity, booking volume, and payment state across the full Book Rahisi marketplace from a single console.</p>
                            <div class="hero-alert">
                                @if ($pendingBusinesses > 0)
                                    {{ $pendingBusinesses }} business applications are waiting for approval. Review them in the Businesses section below.
                                @else
                                    No businesses are currently waiting for approval. The marketplace queue is clear.
                                @endif
                            </div>
                            <div class="hero-actions">
                                <a class="button-dark" href="#businesses">Approve businesses</a>
                                <a class="button-light" href="#payments">Control payments</a>
                                <a class="button-light" href="#reports">Open reports</a>
                            </div>
                        </div>

                        <div class="hero-side">
                            <span class="hero-tag">Admin online</span>
                            <div class="hero-amount">{{ $totalBookings }}</div>
                            <div class="hero-caption">Marketplace bookings tracked</div>
                        </div>
                    </section>

                    <section class="stats-grid">
                        <article class="stat-card">
                            <div class="stat-label">Total businesses</div>
                            <div class="stat-value">{{ $totalBusinesses }}</div>
                            <div class="stat-pill">Marketplace listings</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Pending approvals</div>
                            <div class="stat-value">{{ $pendingBusinesses }}</div>
                            <div class="stat-pill is-warning">Needs review</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Platform users</div>
                            <div class="stat-value">{{ $totalUsers }}</div>
                            <div class="stat-pill is-success">Accounts tracked</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Bookings</div>
                            <div class="stat-value">{{ $totalBookings }}</div>
                            <div class="stat-pill">Marketplace flow</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Paid bookings</div>
                            <div class="stat-value">{{ $paidBookings }}</div>
                            <div class="stat-pill is-danger">Payments controlled</div>
                        </article>
                    </section>

                    <div class="panel-stack">
                        <section class="panel" id="businesses">
                            <div class="panel-head">
                                <div>
                                    <h2 class="panel-title">Businesses</h2>
                                    <p class="panel-copy">Approve or reject marketplace businesses, review booking volume, and capture approval notes for each listing.</p>
                                </div>
                            </div>

                            @if ($businesses->isEmpty())
                                <div class="empty-state">No businesses have been created yet.</div>
                            @else
                                <div class="entity-list">
                                    @foreach ($businesses as $business)
                                        <article class="entity-row">
                                            <div class="entity-head">
                                                <div>
                                                    <h3 class="entity-name">{{ $business->business_name }}</h3>
                                                    <div class="entity-meta">
                                                        {{ $business->business_category }} / {{ $business->owner_email }} / {{ $business->bookings_count }} bookings
                                                    </div>
                                                    @if ($business->approval_notes)
                                                        <div class="entity-extra">Notes: {{ $business->approval_notes }}</div>
                                                    @endif
                                                </div>
                                                <span class="status-chip {{ $business->approval_status === 'approved' ? 'is-success' : ($business->approval_status === 'rejected' ? 'is-danger' : 'is-warning') }}">
                                                    {{ $business->approval_status }}
                                                </span>
                                            </div>

                                            <form class="inline-form" action="{{ route('admin.businesses.approval', ['business' => $business]) }}" method="post">
                                                @csrf
                                                <div class="inline-form-row">
                                                    <select class="field-select" name="approval_status">
                                                        @foreach (['pending', 'approved', 'rejected'] as $status)
                                                            <option value="{{ $status }}" {{ $business->approval_status === $status ? 'selected' : '' }}>
                                                                {{ ucfirst($status) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input class="field-input" type="text" name="approval_notes" value="{{ $business->approval_notes }}" placeholder="Add approval or rejection notes">
                                                    <button class="button-inline" type="submit">Save</button>
                                                </div>
                                            </form>
                                        </article>
                                    @endforeach
                                </div>
                            @endif
                        </section>

                        <section class="panel" id="users">
                            <div class="panel-head">
                                <div>
                                    <h2 class="panel-title">Users</h2>
                                    <p class="panel-copy">Manage marketplace users, distinguish admins from standard users, and suspend access when needed.</p>
                                </div>
                            </div>

                            @if ($users->isEmpty())
                                <div class="empty-state">No users exist yet.</div>
                            @else
                                <div class="entity-list">
                                    @foreach ($users as $user)
                                        <article class="entity-row">
                                            <div class="entity-head">
                                                <div>
                                                    <h3 class="entity-name">{{ $user->name }}</h3>
                                                    <div class="entity-meta">
                                                        {{ $user->email }} / {{ $user->is_admin ? 'Admin' : 'Marketplace user' }}
                                                    </div>
                                                </div>
                                                <span class="status-chip {{ $user->account_status === 'active' ? 'is-success' : 'is-danger' }}">
                                                    {{ $user->account_status }}
                                                </span>
                                            </div>

                                            <form class="inline-form" action="{{ route('admin.users.status', ['user' => $user]) }}" method="post">
                                                @csrf
                                                <div class="inline-form-row">
                                                    <select class="field-select" name="account_status">
                                                        @foreach (['active', 'suspended'] as $status)
                                                            <option value="{{ $status }}" {{ $user->account_status === $status ? 'selected' : '' }}>
                                                                {{ ucfirst($status) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input class="field-input" type="text" value="{{ $user->is_admin ? 'Platform owner access enabled' : 'Standard account' }}" readonly>
                                                    <button class="button-inline" type="submit">Save</button>
                                                </div>
                                            </form>
                                        </article>
                                    @endforeach
                                </div>
                            @endif
                        </section>

                        <section class="panel" id="bookings">
                            <div class="panel-head">
                                <div>
                                    <h2 class="panel-title">Bookings</h2>
                                    <p class="panel-copy">Monitor live booking activity across the marketplace and move requests through the right operational status.</p>
                                </div>
                            </div>

                            @if ($bookings->isEmpty())
                                <div class="empty-state">No bookings have been captured yet.</div>
                            @else
                                <div class="entity-list">
                                    @foreach ($bookings as $booking)
                                        <article class="entity-row">
                                            <div class="entity-head">
                                                <div>
                                                    <h3 class="entity-name">{{ $booking->customer_name }}</h3>
                                                    <div class="entity-meta">
                                                        {{ $booking->service_name }} / {{ $booking->business?->business_name ?? 'Business unavailable' }} / {{ $booking->appointment_date?->format('D, j M Y') ?? $booking->appointment_date }} at {{ $booking->appointment_time }}
                                                    </div>
                                                    <div class="entity-extra">
                                                        Phone: {{ $booking->customer_phone }}
                                                        @if ($booking->customer_email)
                                                            / Email: {{ $booking->customer_email }}
                                                        @endif
                                                        @if ($booking->customer_notes)
                                                            / Notes: {{ $booking->customer_notes }}
                                                        @endif
                                                        @if ($booking->customer_image_path)
                                                            / <a class="entity-link" href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($booking->customer_image_path) }}" target="_blank" rel="noopener noreferrer">Reference image</a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <span class="status-chip {{ $booking->status === 'completed' ? 'is-success' : ($booking->status === 'cancelled' ? 'is-danger' : 'is-warning') }}">
                                                    {{ $booking->status }}
                                                </span>
                                            </div>

                                            <form class="inline-form" action="{{ route('admin.bookings.status', ['booking' => $booking]) }}" method="post">
                                                @csrf
                                                <div class="inline-form-row">
                                                    <select class="field-select" name="status">
                                                        @foreach (['pending', 'confirmed', 'completed', 'cancelled'] as $status)
                                                            <option value="{{ $status }}" {{ $booking->status === $status ? 'selected' : '' }}>
                                                                {{ ucfirst($status) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input class="field-input" type="text" value="{{ $booking->business?->owner_email ?? 'No business owner email' }}" readonly>
                                                    <button class="button-inline" type="submit">Update</button>
                                                </div>
                                            </form>
                                        </article>
                                    @endforeach
                                </div>
                            @endif
                        </section>

                        <section class="panel" id="payments">
                            <div class="panel-head">
                                <div>
                                    <h2 class="panel-title">Payments</h2>
                                    <p class="panel-copy">Control marketplace payment state at the booking level and review which requests are pending, paid, refunded, or failed.</p>
                                </div>
                            </div>

                            @if ($payments->isEmpty())
                                <div class="empty-state">No payment records are available because bookings have not been captured yet.</div>
                            @else
                                <div class="entity-list">
                                    @foreach ($payments as $booking)
                                        <article class="entity-row">
                                            <div class="entity-head">
                                                <div>
                                                    <h3 class="entity-name">{{ $booking->customer_name }}</h3>
                                                    <div class="entity-meta">
                                                        {{ $booking->service_name }} / {{ $booking->business?->business_name ?? 'Business unavailable' }} / Booking status: {{ $booking->status }}
                                                    </div>
                                                    <div class="entity-extra">
                                                        Payment recorded:
                                                        {{ $booking->paid_at ? $booking->paid_at->format('j M Y, g:i a') : 'Not yet marked as paid' }}
                                                    </div>
                                                </div>
                                                <span class="status-chip {{ $booking->payment_status === 'paid' ? 'is-success' : ($booking->payment_status === 'refunded' || $booking->payment_status === 'failed' ? 'is-danger' : 'is-warning') }}">
                                                    {{ $booking->payment_status }}
                                                </span>
                                            </div>

                                            <form class="inline-form" action="{{ route('admin.bookings.payment', ['booking' => $booking]) }}" method="post">
                                                @csrf
                                                <div class="inline-form-row">
                                                    <select class="field-select" name="payment_status">
                                                        @foreach (['pending', 'paid', 'refunded', 'failed'] as $status)
                                                            <option value="{{ $status }}" {{ $booking->payment_status === $status ? 'selected' : '' }}>
                                                                {{ ucfirst($status) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input class="field-input" type="text" value="{{ $booking->customer_phone }}" readonly>
                                                    <button class="button-inline" type="submit">Update</button>
                                                </div>
                                            </form>
                                        </article>
                                    @endforeach
                                </div>
                            @endif
                        </section>

                        <section class="panel" id="reports">
                            <div class="panel-head">
                                <div>
                                    <h2 class="panel-title">Reports</h2>
                                    <p class="panel-copy">View marketplace totals, status distribution, and the businesses generating the most booking activity.</p>
                                </div>
                            </div>

                            <div class="reports-grid">
                                <article class="report-card">
                                    <div class="report-title">Businesses</div>
                                    <div class="report-value">{{ $approvedBusinesses }}/{{ $totalBusinesses }}</div>
                                    <div class="entity-extra">Approved vs total listings</div>
                                </article>
                                <article class="report-card">
                                    <div class="report-title">Users</div>
                                    <div class="report-value">{{ $activeUsers }}/{{ $totalUsers }}</div>
                                    <div class="entity-extra">Active vs total accounts</div>
                                </article>
                                <article class="report-card">
                                    <div class="report-title">Bookings</div>
                                    <div class="report-value">{{ $confirmedBookings + $completedBookings }}/{{ $totalBookings }}</div>
                                    <div class="entity-extra">Confirmed or completed bookings</div>
                                </article>
                                <article class="report-card">
                                    <div class="report-title">Payments</div>
                                    <div class="report-value">{{ $paidBookings }}/{{ $totalBookings }}</div>
                                    <div class="entity-extra">Paid bookings across the marketplace</div>
                                </article>
                                <article class="report-card">
                                    <div class="report-title">Suspended users</div>
                                    <div class="report-value">{{ $suspendedUsers }}</div>
                                    <div class="entity-extra">Accounts currently disabled</div>
                                </article>
                                <article class="report-card">
                                    <div class="report-title">Rejected businesses</div>
                                    <div class="report-value">{{ $rejectedBusinesses }}</div>
                                    <div class="entity-extra">Applications rejected by admin</div>
                                </article>
                            </div>

                            <div class="report-list">
                                @forelse ($topBusinesses as $business)
                                    <div class="report-row">
                                        <span>{{ $business->business_name }}</span>
                                        <span>{{ $business->bookings_count }} bookings</span>
                                    </div>
                                @empty
                                    <div class="empty-state">No business booking activity is available for reporting yet.</div>
                                @endforelse
                            </div>
                        </section>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
