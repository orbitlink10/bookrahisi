<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi Salon POS | Dashboard</title>
        <meta
            name="description"
            content="Manage appointments, POS sales, stock, customers, and team activity from the Book Rahisi salon dashboard."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --ink: #17151f;
                --muted: #74717e;
                --line: #e8e5ee;
                --page: #fbf9fe;
                --panel: #ffffff;
                --purple: #7c3fd3;
                --purple-dark: #6630bd;
                --pink: #e74c8a;
                --green: #25a864;
                --blue: #367bd9;
                --amber: #f0a21a;
                --shadow: 0 18px 44px rgba(40, 34, 56, 0.08);
                --soft-shadow: 0 10px 26px rgba(40, 34, 56, 0.06);
                --mobile-accent: var(--purple);
                --mobile-accent-soft: #f1e9ff;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                background:
                    radial-gradient(circle at 72% 0%, rgba(124, 63, 211, 0.06), transparent 28%),
                    linear-gradient(180deg, #ffffff 0%, var(--page) 100%);
                color: var(--ink);
                font-family: 'Manrope', sans-serif;
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

            .console-app {
                display: grid;
                grid-template-columns: 290px minmax(0, 1fr);
                min-height: 100vh;
            }

            .console-sidebar {
                position: sticky;
                top: 0;
                display: grid;
                align-content: start;
                gap: 28px;
                min-height: 100vh;
                padding: 26px 20px;
                border-right: 1px solid var(--line);
                background: rgba(255, 255, 255, 0.86);
                color: var(--ink);
                backdrop-filter: blur(18px);
            }

            .sidebar-brand {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                text-align: left;
            }

            .brand-avatar {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 44px;
                height: 44px;
                border-radius: 12px;
                background: linear-gradient(135deg, var(--purple) 0%, var(--pink) 100%);
                color: #fff;
                font-family: 'Outfit', sans-serif;
                font-size: 1rem;
                font-weight: 800;
            }

            .brand-title {
                font-family: 'Outfit', sans-serif;
                font-size: 1.6rem;
                font-weight: 800;
                letter-spacing: 0;
                line-height: 1;
            }

            .brand-subtitle {
                margin-top: 4px;
                color: var(--pink);
                font-size: 0.95rem;
                font-weight: 800;
            }

            .sidebar-section-label,
            .sidebar-link-meta,
            .sidebar-support {
                display: none;
            }

            .sidebar-nav {
                display: grid;
                gap: 10px;
            }

            .sidebar-link {
                display: flex;
                align-items: center;
                gap: 14px;
                min-height: 52px;
                padding: 12px 16px;
                border-radius: 8px;
                color: #575465;
                font-size: 1rem;
                font-weight: 800;
                transition: background-color 160ms ease, color 160ms ease, box-shadow 160ms ease;
            }

            .sidebar-link:hover,
            .sidebar-link.is-active {
                background: linear-gradient(135deg, var(--purple) 0%, var(--purple-dark) 100%);
                color: #fff;
                box-shadow: 0 14px 28px rgba(124, 63, 211, 0.24);
            }

            .sidebar-link-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 24px;
                height: 24px;
                border: 0;
                border-radius: 0;
                background: transparent;
                font-size: 0.78rem;
                font-weight: 900;
                letter-spacing: 0;
            }

            .workspace {
                min-width: 0;
                padding: 24px 24px 30px;
            }

            .dashboard-shell {
                width: min(100%, 1590px);
                margin: 0 auto;
            }

            .dashboard-topbar,
            .dashboard-heading,
            .utility-actions,
            .profile-chip,
            .date-pill,
            .panel-head,
            .calendar-controls,
            .staff-head,
            .metric-card,
            .metric-icon,
            .quick-tile,
            .chart-head {
                display: flex;
                align-items: center;
            }

            .dashboard-topbar {
                justify-content: space-between;
                gap: 18px;
                margin-bottom: 22px;
            }

            .menu-button,
            .icon-button,
            .panel-button,
            .quick-tile {
                border: 1px solid var(--line);
                background: #fff;
                color: var(--ink);
                cursor: pointer;
            }

            .menu-button,
            .icon-button {
                justify-content: center;
                width: 46px;
                height: 46px;
                border-radius: 14px;
                box-shadow: var(--soft-shadow);
            }

            .search-box {
                flex: 0 1 380px;
                display: flex;
                align-items: center;
                gap: 10px;
                min-height: 46px;
                padding: 0 14px;
                border: 1px solid var(--line);
                border-radius: 14px;
                background: rgba(255, 255, 255, 0.92);
                box-shadow: var(--soft-shadow);
            }

            .search-box input {
                width: 100%;
                border: 0;
                outline: 0;
                background: transparent;
                color: var(--ink);
                font-size: 0.9rem;
                font-weight: 700;
            }

            .shortcut {
                padding: 5px 10px;
                border: 1px solid var(--line);
                border-radius: 8px;
                color: var(--muted);
                font-size: 0.78rem;
                font-weight: 800;
                white-space: nowrap;
            }

            .utility-actions {
                gap: 14px;
            }

            .bell-dot {
                position: relative;
            }

            .bell-dot::after {
                position: absolute;
                top: -5px;
                right: -3px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 20px;
                height: 20px;
                border-radius: 999px;
                background: #ff405d;
                color: #fff;
                content: "{{ $pendingBookingCount }}";
                font-size: 0.68rem;
                font-weight: 900;
            }

            .profile-chip {
                gap: 12px;
            }

            .profile-photo {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 54px;
                height: 54px;
                border-radius: 999px;
                background: linear-gradient(135deg, #f7c68f 0%, #a855f7 100%);
                color: #fff;
                font-family: 'Outfit', sans-serif;
                font-size: 1.15rem;
                font-weight: 800;
                box-shadow: var(--soft-shadow);
            }

            .profile-name {
                font-weight: 900;
            }

            .profile-role,
            .heading-copy,
            .metric-copy,
            .metric-foot,
            .staff-role,
            .chart-axis,
            .quick-label {
                color: var(--muted);
            }

            .profile-role {
                margin-top: 3px;
                font-size: 0.82rem;
                font-weight: 700;
            }

            .dashboard-heading {
                justify-content: space-between;
                gap: 18px;
                margin-bottom: 18px;
            }

            h1 {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(1.8rem, 2.4vw, 2.35rem);
                line-height: 1;
                letter-spacing: 0;
            }

            .heading-copy {
                margin: 8px 0 0;
                font-size: 1rem;
                font-weight: 700;
            }

            .date-pill,
            .panel-button {
                gap: 10px;
                min-height: 46px;
                padding: 0 16px;
                border: 1px solid var(--line);
                border-radius: 10px;
                background: #fff;
                font-size: 0.9rem;
                font-weight: 900;
                box-shadow: var(--soft-shadow);
                white-space: nowrap;
            }

            .success-banner,
            .warning-banner {
                margin-bottom: 18px;
                padding: 14px 16px;
                border-radius: 12px;
                font-size: 0.95rem;
                font-weight: 800;
            }

            .success-banner {
                border: 1px solid rgba(37, 168, 100, 0.18);
                background: #edfbf3;
                color: #147d46;
            }

            .warning-banner {
                border: 1px solid rgba(240, 162, 26, 0.18);
                background: #fff7e7;
                color: #9b650d;
            }

            .metrics-grid {
                display: grid;
                grid-template-columns: repeat(5, minmax(0, 1fr));
                gap: 16px;
                margin-bottom: 18px;
            }

            .metric-card,
            .panel {
                border: 1px solid var(--line);
                border-radius: 8px;
                background: rgba(255, 255, 255, 0.94);
                box-shadow: var(--shadow);
            }

            .metric-card {
                gap: 12px;
                min-height: 128px;
                padding: 16px;
            }

            .metric-icon {
                justify-content: center;
                flex: 0 0 50px;
                width: 50px;
                height: 50px;
                border-radius: 12px;
                font-weight: 900;
            }

            .metric-icon.is-purple { background: #f1e9ff; color: var(--purple); }
            .metric-icon.is-green { background: #eaf9f0; color: var(--green); }
            .metric-icon.is-amber { background: #fff5df; color: var(--amber); }
            .metric-icon.is-pink { background: #ffeaf3; color: var(--pink); }
            .metric-icon.is-blue { background: #eaf2ff; color: var(--blue); }

            .metric-copy {
                font-size: 0.84rem;
                font-weight: 800;
            }

            .metric-value {
                margin-top: 6px;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(1.2rem, 1.15vw, 1.55rem);
                font-weight: 800;
                line-height: 1;
                white-space: nowrap;
            }

            .metric-foot {
                display: inline-block;
                margin-top: 9px;
                font-size: 0.76rem;
                font-weight: 900;
            }

            .metric-foot.is-good {
                color: var(--green);
            }

            .metric-foot.is-alert {
                color: var(--pink);
            }

            .dashboard-grid {
                display: grid;
                grid-template-columns: minmax(0, 1.45fr) minmax(360px, 0.9fr);
                gap: 18px;
                align-items: start;
            }

            .side-stack {
                display: grid;
                gap: 18px;
            }

            .panel {
                padding: 18px;
                overflow: hidden;
            }

            .panel-head,
            .chart-head {
                justify-content: space-between;
                gap: 14px;
                margin-bottom: 16px;
            }

            .panel-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.25rem;
                font-weight: 800;
                letter-spacing: 0;
            }

            .calendar-controls {
                gap: 10px;
                flex-wrap: wrap;
            }

            .panel-button {
                min-height: 38px;
                padding: 0 14px;
                border-radius: 8px;
                box-shadow: none;
            }

            .calendar-wrap {
                overflow-x: auto;
            }

            .calendar {
                display: grid;
                grid-template-columns: 88px repeat({{ max($dashboardStaff->count(), 1) }}, minmax(160px, 1fr));
                min-width: 820px;
                border-top: 1px solid var(--line);
            }

            .calendar-corner,
            .staff-head {
                min-height: 66px;
                padding: 12px 14px;
                border-bottom: 1px solid var(--line);
            }

            .staff-head {
                gap: 10px;
                justify-content: center;
                text-align: left;
            }

            .staff-avatar,
            .mini-avatar {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 999px;
                color: #fff;
                font-family: 'Outfit', sans-serif;
                font-weight: 800;
            }

            .staff-avatar {
                width: 34px;
                height: 34px;
                font-size: 0.86rem;
            }

            .mini-avatar {
                width: 28px;
                height: 28px;
                font-size: 0.75rem;
            }

            .tone-rose { background: linear-gradient(135deg, #ff8a99, #9b5de5); }
            .tone-green { background: linear-gradient(135deg, #42d392, #1aa06d); }
            .tone-blue { background: linear-gradient(135deg, #60a5fa, #2563eb); }
            .tone-amber { background: linear-gradient(135deg, #fbbf24, #f97316); }

            .staff-name {
                font-size: 0.86rem;
                font-weight: 900;
                line-height: 1.15;
            }

            .staff-role {
                margin-top: 3px;
                font-size: 0.72rem;
                font-weight: 700;
            }

            .time-column {
                display: grid;
                grid-template-rows: repeat(9, 74px);
                border-right: 1px solid var(--line);
            }

            .time-cell {
                padding-top: 12px;
                color: #5f5a69;
                font-size: 0.78rem;
                font-weight: 800;
                border-bottom: 1px solid var(--line);
            }

            .staff-column {
                position: relative;
                min-height: 666px;
                border-right: 1px solid var(--line);
                background-image: repeating-linear-gradient(to bottom, transparent 0, transparent 73px, var(--line) 74px);
            }

            .staff-column:last-child {
                border-right: 0;
            }

            .appointment-block {
                position: absolute;
                right: 10px;
                left: 10px;
                min-height: 58px;
                padding: 10px 12px;
                border: 1px solid rgba(124, 63, 211, 0.08);
                border-radius: 8px;
                font-size: 0.78rem;
                line-height: 1.35;
                box-shadow: 0 10px 18px rgba(38, 32, 51, 0.07);
            }

            .appointment-block.is-purple { background: #f0e7fb; }
            .appointment-block.is-mint { background: #e7f7ee; }
            .appointment-block.is-sky { background: #e7f2fe; }
            .appointment-block.is-rose { background: #fde8f1; }
            .appointment-block.is-sand { background: #fff5df; }

            .appointment-name {
                font-weight: 900;
            }

            .appointment-service,
            .appointment-time {
                margin-top: 2px;
                font-weight: 800;
                color: #3f3a48;
            }

            .calendar-footer {
                padding-top: 12px;
                text-align: center;
            }

            .text-link {
                color: var(--purple);
                font-weight: 900;
            }

            .sales-total {
                margin: 0 0 6px;
                font-family: 'Outfit', sans-serif;
                font-size: 1.55rem;
                font-weight: 800;
            }

            .chart {
                position: relative;
                height: 226px;
                margin-top: 18px;
                padding: 0 0 24px 44px;
                background-image: repeating-linear-gradient(to top, transparent 0, transparent 43px, var(--line) 44px);
            }

            .chart svg {
                width: 100%;
                height: 100%;
                overflow: visible;
            }

            .chart-axis {
                position: absolute;
                left: 0;
                font-size: 0.78rem;
                font-weight: 800;
            }

            .axis-100 { top: 0; }
            .axis-80 { top: 42px; }
            .axis-60 { top: 86px; }
            .axis-40 { top: 130px; }
            .axis-20 { top: 174px; }
            .axis-0 { bottom: 24px; }

            .chart-days {
                display: grid;
                grid-template-columns: repeat(7, 1fr);
                gap: 4px;
                margin: 4px 0 0 44px;
                color: var(--muted);
                font-size: 0.78rem;
                font-weight: 900;
                text-align: center;
            }

            .quick-grid {
                display: grid;
                grid-template-columns: repeat(5, minmax(0, 1fr));
                gap: 14px;
            }

            .quick-tile {
                display: grid;
                justify-items: center;
                gap: 10px;
                min-height: 98px;
                padding: 10px 8px;
                border-radius: 8px;
            }

            .quick-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 56px;
                height: 56px;
                border-radius: 12px;
                font-weight: 900;
            }

            .quick-label {
                font-size: 0.76rem;
                font-weight: 900;
                text-align: center;
                line-height: 1.25;
            }

            .empty-state {
                margin: 24px 10px;
                padding: 18px;
                border: 1px dashed var(--line);
                border-radius: 8px;
                color: var(--muted);
                font-weight: 800;
                line-height: 1.6;
            }

            @media (max-width: 1360px) {
                .dashboard-grid {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 980px) {
                .metrics-grid {
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
            }

            @media (max-width: 780px) {
                .workspace {
                    padding: 18px 14px 116px;
                }

                .dashboard-topbar,
                .dashboard-heading,
                .utility-actions,
                .profile-chip,
                .panel-head,
                .chart-head {
                    align-items: stretch;
                    flex-direction: column;
                }

                .search-box,
                .date-pill {
                    width: 100%;
                }

                .metrics-grid,
                .quick-grid {
                    grid-template-columns: 1fr;
                }

                .metric-card {
                    min-height: 112px;
                }
            }

            @include('partials.mobile-console-nav-styles')
        </style>
    </head>
    <body>
        @php
            $ownerName = trim(($accountSetup['first_name'] ?? '').' '.($accountSetup['last_name'] ?? ''));
            $ownerFirstName = $accountSetup['first_name'] ?? 'Owner';
            $profileSummary = $profileReady
                ? $profileDetails['tagline']
                : 'Complete your public profile to start receiving customer bookings.';
            $formattedTodaySales = 'KES '.number_format($todaySalesTotal);
            $formattedWeekSales = 'KES '.number_format($weekSalesTotal);
            $chartPoints = '0,160 62,132 124,120 186,72 248,144 310,42 372,96 434,66 496,12';
        @endphp

        <div class="console-app">
            @include('partials.business-console-sidebar', ['profileReady' => $profileReady])

            <main class="workspace">
                <div class="dashboard-shell">
                    <header class="dashboard-topbar">
                        <button class="menu-button" type="button" aria-label="Open dashboard menu">☰</button>

                        <div class="utility-actions">
                            <label class="search-box" aria-label="Search dashboard">
                                <span aria-hidden="true">⌕</span>
                                <input type="search" placeholder="Search anything...">
                                <span class="shortcut">Ctrl + K</span>
                            </label>

                            <button class="icon-button bell-dot" type="button" aria-label="Notifications">⌂</button>

                            <div class="profile-chip">
                                <div class="profile-photo">{{ strtoupper(substr($ownerFirstName, 0, 1)) }}</div>
                                <div>
                                    <div class="profile-name">{{ $ownerName !== '' ? $ownerName : 'Business Owner' }}</div>
                                    <div class="profile-role">Owner</div>
                                </div>
                                <span aria-hidden="true">⌄</span>
                            </div>
                        </div>
                    </header>

                    <section class="dashboard-heading">
                        <div>
                            <h1>Welcome back, {{ $ownerFirstName }}</h1>
                            <p class="heading-copy">Here's what's happening at {{ $accountSetup['business_name'] }} today.</p>
                        </div>

                        <div class="date-pill">
                            <span>{{ now()->format('M j, Y') }}</span>
                            <span aria-hidden="true">▣</span>
                        </div>
                    </section>

                    @if (session('dashboard_success'))
                        <div class="success-banner">{{ session('dashboard_success') }}</div>
                    @endif

                    @if (session('dashboard_warning'))
                        <div class="warning-banner">{{ session('dashboard_warning') }}</div>
                    @endif

                    <section class="metrics-grid" aria-label="Business metrics">
                        <article class="metric-card">
                            <div class="metric-icon is-purple">CA</div>
                            <div>
                                <div class="metric-copy">Today's Appointments</div>
                                <div class="metric-value">{{ $todayBookingCount }}</div>
                                <span class="metric-foot is-good">+20% from yesterday ↑</span>
                            </div>
                        </article>

                        <article class="metric-card">
                            <div class="metric-icon is-green">KES</div>
                            <div>
                                <div class="metric-copy">Today's Sales</div>
                                <div class="metric-value">{{ $formattedTodaySales }}</div>
                                <span class="metric-foot is-good">+32% from yesterday ↑</span>
                            </div>
                        </article>

                        <article class="metric-card">
                            <div class="metric-icon is-amber">CU</div>
                            <div>
                                <div class="metric-copy">Total Customers</div>
                                <div class="metric-value">{{ number_format($customerCount) }}</div>
                                <span class="metric-foot is-good">+18% from last month ↑</span>
                            </div>
                        </article>

                        <article class="metric-card">
                            <div class="metric-icon is-pink">BX</div>
                            <div>
                                <div class="metric-copy">Low Stock Items</div>
                                <div class="metric-value">{{ $lowStockItemCount }}</div>
                                <a class="metric-foot is-alert" href="{{ route('for-business.pos', ['tab' => 'inventory']) }}">View items</a>
                            </div>
                        </article>

                        <article class="metric-card">
                            <div class="metric-icon is-blue">ST</div>
                            <div>
                                <div class="metric-copy">Employees</div>
                                <div class="metric-value">{{ $employeeCount }}</div>
                                <span class="metric-foot">2 on leave today</span>
                            </div>
                        </article>
                    </section>

                    <section class="dashboard-grid">
                        <section class="panel">
                            <div class="panel-head">
                                <h2 class="panel-title">Appointments</h2>
                                <div class="calendar-controls">
                                    <a class="panel-button" href="{{ route('for-business.pos', ['tab' => 'appointments']) }}">Today</a>
                                    <button class="panel-button" type="button" aria-label="Previous day">‹</button>
                                    <button class="panel-button" type="button" aria-label="Next day">›</button>
                                    <strong>{{ now()->format('M j, Y') }}</strong>
                                    <button class="panel-button" type="button">Day ⌄</button>
                                </div>
                            </div>

                            <div class="calendar-wrap">
                                <div class="calendar">
                                    <div class="calendar-corner"></div>
                                    @foreach ($dashboardStaff as $staff)
                                        <div class="staff-head">
                                            <span class="staff-avatar tone-{{ $staff['tone'] }}">{{ strtoupper(substr($staff['avatar'], 0, 1)) }}</span>
                                            <span>
                                                <span class="staff-name">{{ $staff['name'] }}</span>
                                                <span class="staff-role">{{ $staff['role'] }}</span>
                                            </span>
                                        </div>
                                    @endforeach

                                    <div class="time-column">
                                        @foreach (['09:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM', '05:00 PM'] as $time)
                                            <div class="time-cell">{{ $time }}</div>
                                        @endforeach
                                    </div>

                                    @foreach ($dashboardStaff as $staffIndex => $staff)
                                        <div class="staff-column">
                                            @foreach ($dashboardAppointments->where('staff_index', $staffIndex) as $appointment)
                                                <article
                                                    class="appointment-block is-{{ $appointment['tone'] }}"
                                                    style="top: {{ $appointment['top'] }}px; height: {{ $appointment['height'] }}px;"
                                                >
                                                    <div class="appointment-name">{{ $appointment['customer'] }}</div>
                                                    <div class="appointment-service">{{ $appointment['service'] }}</div>
                                                    <div class="appointment-time">{{ $appointment['time'] }}</div>
                                                </article>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>

                                @if ($dashboardAppointments->isEmpty())
                                    <div class="empty-state">{{ $profileSummary }}</div>
                                @endif
                            </div>

                            <div class="calendar-footer">
                                <a class="text-link" href="{{ route('for-business.pos', ['tab' => 'appointments']) }}">View all appointments</a>
                            </div>
                        </section>

                        <aside class="side-stack">
                            <section class="panel">
                                <div class="chart-head">
                                    <div>
                                        <h2 class="panel-title">Sales Overview</h2>
                                        <p class="sales-total">{{ $formattedWeekSales }}</p>
                                        <span class="metric-foot is-good">+28% from last week ↑</span>
                                    </div>
                                    <button class="panel-button" type="button">This Week ⌄</button>
                                </div>

                                <div class="chart" aria-label="Weekly sales chart">
                                    <span class="chart-axis axis-100">100k</span>
                                    <span class="chart-axis axis-80">80k</span>
                                    <span class="chart-axis axis-60">60k</span>
                                    <span class="chart-axis axis-40">40k</span>
                                    <span class="chart-axis axis-20">20k</span>
                                    <span class="chart-axis axis-0">0</span>
                                    <svg viewBox="0 0 496 180" role="img" aria-label="Sales trend">
                                        <defs>
                                            <linearGradient id="salesFill" x1="0" x2="0" y1="0" y2="1">
                                                <stop offset="0%" stop-color="#7c3fd3" stop-opacity="0.22" />
                                                <stop offset="100%" stop-color="#7c3fd3" stop-opacity="0.02" />
                                            </linearGradient>
                                        </defs>
                                        <polygon points="0,180 {{ $chartPoints }} 496,180" fill="url(#salesFill)" />
                                        <polyline points="{{ $chartPoints }}" fill="none" stroke="#7c3fd3" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="chart-days">
                                    <span>Mon</span>
                                    <span>Tue</span>
                                    <span>Wed</span>
                                    <span>Thu</span>
                                    <span>Fri</span>
                                    <span>Sat</span>
                                    <span>Sun</span>
                                </div>
                            </section>

                            <section class="panel">
                                <div class="panel-head">
                                    <h2 class="panel-title">Quick Actions</h2>
                                </div>

                                <div class="quick-grid">
                                    <a class="quick-tile" href="{{ route('for-business.pos', ['tab' => 'appointments']) }}">
                                        <span class="quick-icon metric-icon is-purple">CA</span>
                                        <span class="quick-label">New Appointment</span>
                                    </a>
                                    <a class="quick-tile" href="{{ route('for-business.pos', ['tab' => 'customers']) }}">
                                        <span class="quick-icon metric-icon is-green">CU</span>
                                        <span class="quick-label">Walk-in Customer</span>
                                    </a>
                                    <a class="quick-tile" href="{{ route('for-business.pos', ['tab' => 'checkout']) }}">
                                        <span class="quick-icon metric-icon is-blue">PAY</span>
                                        <span class="quick-label">Process Payment</span>
                                    </a>
                                    <a class="quick-tile" href="{{ route('for-business.pos', ['tab' => 'inventory']) }}">
                                        <span class="quick-icon metric-icon is-amber">BX</span>
                                        <span class="quick-label">Add Product</span>
                                    </a>
                                    <a class="quick-tile" href="{{ route('for-business.bookings') }}">
                                        <span class="quick-icon metric-icon is-pink">SMS</span>
                                        <span class="quick-label">Send SMS</span>
                                    </a>
                                </div>
                            </section>
                        </aside>
                    </section>
                </div>
            </main>
        </div>
    </body>
</html>
