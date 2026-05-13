<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi For Professionals | POS</title>
        <meta
            name="description"
            content="Run appointments, checkout, inventory, commissions, M-Pesa reconciliation, and reports for your spa or barber shop."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --navy: #142945;
                --navy-deep: #0d1c30;
                --navy-soft: rgba(255, 255, 255, 0.08);
                --page: #edf4f7;
                --panel: rgba(255, 255, 255, 0.92);
                --panel-strong: #ffffff;
                --line: #d6e2eb;
                --ink: #17304d;
                --muted: #607792;
                --copper: #c77734;
                --copper-soft: #f8ebdd;
                --teal: #178f8f;
                --teal-soft: #e4f7f4;
                --success: #18834d;
                --success-soft: #e9f8ef;
                --warning: #b36c00;
                --warning-soft: #fff4dc;
                --danger: #c24b3a;
                --danger-soft: #fff0ee;
                --shadow: 0 24px 52px rgba(17, 43, 72, 0.12);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                background:
                    radial-gradient(circle at top right, rgba(199, 119, 52, 0.12), transparent 28%),
                    radial-gradient(circle at left 20%, rgba(23, 143, 143, 0.12), transparent 32%),
                    linear-gradient(180deg, #f7fbfd 0%, var(--page) 100%);
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

            button {
                cursor: pointer;
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
                background: linear-gradient(180deg, #f5dfc8 0%, #d5a06d 100%);
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
                width: min(100%, 1500px);
                margin: 0 auto;
            }

            .topbar {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 22px;
                margin-bottom: 20px;
            }

            .eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 10px 16px;
                border-radius: 999px;
                background: rgba(23, 143, 143, 0.12);
                color: var(--teal);
                font-size: 0.88rem;
                font-weight: 800;
            }

            h1 {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.4rem, 4vw, 3.8rem);
                letter-spacing: -0.06em;
                line-height: 0.98;
            }

            .subtitle {
                max-width: 860px;
                margin: 14px 0 0;
                color: var(--muted);
                font-size: 1rem;
                line-height: 1.8;
            }

            .toolbar {
                display: flex;
                flex-wrap: wrap;
                justify-content: flex-end;
                gap: 10px;
            }

            .button-dark,
            .button-light,
            .button-accent,
            .button-outline,
            .button-small {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border: 0;
                border-radius: 16px;
                font-weight: 800;
                transition: transform 150ms ease, box-shadow 150ms ease, background-color 150ms ease;
            }

            .button-dark,
            .button-light,
            .button-accent,
            .button-outline {
                padding: 14px 20px;
                font-size: 0.96rem;
            }

            .button-small {
                padding: 10px 14px;
                font-size: 0.84rem;
                border-radius: 12px;
            }

            .button-dark {
                background: var(--navy);
                color: #fff;
                box-shadow: 0 16px 30px rgba(20, 41, 69, 0.16);
            }

            .button-accent {
                background: linear-gradient(135deg, var(--copper) 0%, #e3a766 100%);
                color: #fff;
                box-shadow: 0 16px 30px rgba(199, 119, 52, 0.2);
            }

            .button-light {
                background: rgba(255, 255, 255, 0.88);
                color: var(--ink);
                border: 1px solid var(--line);
            }

            .button-outline {
                background: transparent;
                color: #fff;
                border: 1px solid rgba(255, 255, 255, 0.26);
            }

            .button-small {
                background: #f3f8fb;
                color: var(--ink);
                border: 1px solid var(--line);
            }

            .button-dark:hover,
            .button-light:hover,
            .button-accent:hover,
            .button-outline:hover,
            .button-small:hover {
                transform: translateY(-1px);
            }

            .hero-card {
                display: grid;
                grid-template-columns: minmax(0, 1.15fr) minmax(320px, 0.85fr);
                gap: 24px;
                margin-bottom: 22px;
                padding: 28px 30px;
                border-radius: 30px;
                background:
                    radial-gradient(circle at top right, rgba(255, 255, 255, 0.16), transparent 28%),
                    linear-gradient(135deg, #11446f 0%, #157a7a 48%, #c77734 100%);
                color: #fff;
                box-shadow: var(--shadow);
            }

            .hero-card h2 {
                margin: 14px 0 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.2rem, 4vw, 3.2rem);
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
                align-content: space-between;
                gap: 18px;
                padding: 22px;
                border-radius: 24px;
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.16);
                backdrop-filter: blur(12px);
            }

            .hero-side-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .hero-stat {
                padding: 14px;
                border-radius: 18px;
                background: rgba(255, 255, 255, 0.1);
            }

            .hero-stat-label {
                color: rgba(255, 255, 255, 0.72);
                font-size: 0.8rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .hero-stat-value {
                margin-top: 8px;
                font-family: 'Outfit', sans-serif;
                font-size: 1.45rem;
                font-weight: 800;
                letter-spacing: -0.05em;
            }

            .flash {
                margin-bottom: 16px;
                padding: 16px 18px;
                border-radius: 18px;
                border: 1px solid transparent;
                line-height: 1.7;
            }

            .flash-success {
                background: var(--success-soft);
                border-color: rgba(24, 131, 77, 0.12);
                color: var(--success);
            }

            .flash-error {
                background: var(--danger-soft);
                border-color: rgba(194, 75, 58, 0.14);
                color: var(--danger);
            }

            .stats-grid {
                display: grid;
                grid-template-columns: repeat(6, minmax(0, 1fr));
                gap: 16px;
                margin-bottom: 20px;
            }

            .stat-card,
            .panel {
                padding: 22px;
                border-radius: 24px;
                background: var(--panel);
                border: 1px solid rgba(20, 41, 69, 0.08);
                box-shadow: var(--shadow);
                backdrop-filter: blur(16px);
            }

            .stat-label {
                color: var(--muted);
                font-size: 0.85rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .stat-value {
                margin-top: 12px;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(1.5rem, 2vw, 2.4rem);
                font-weight: 800;
                letter-spacing: -0.06em;
            }

            .stat-meta {
                margin-top: 12px;
                color: var(--muted);
                font-size: 0.88rem;
                line-height: 1.6;
            }

            .subnav {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-bottom: 22px;
            }

            .subnav-link {
                padding: 12px 16px;
                border-radius: 999px;
                border: 1px solid var(--line);
                background: rgba(255, 255, 255, 0.84);
                color: var(--muted);
                font-size: 0.88rem;
                font-weight: 800;
                transition: border-color 150ms ease, color 150ms ease, background-color 150ms ease;
            }

            .subnav-link.is-active,
            .subnav-link:hover {
                background: var(--navy);
                border-color: var(--navy);
                color: #fff;
            }

            .content-section {
                display: none;
            }

            .content-section.is-active {
                display: block;
            }

            .section-head {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 18px;
                margin-bottom: 18px;
            }

            .section-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.8rem;
                letter-spacing: -0.05em;
            }

            .section-copy {
                margin: 8px 0 0;
                color: var(--muted);
                line-height: 1.75;
            }

            .dashboard-grid,
            .split-grid,
            .wide-grid,
            .dual-grid,
            .form-layout {
                display: grid;
                gap: 20px;
            }

            .dashboard-grid {
                grid-template-columns: 1.2fr 0.8fr;
            }

            .wide-grid {
                grid-template-columns: minmax(0, 1.15fr) minmax(320px, 0.85fr);
            }

            .dual-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .split-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .form-layout {
                grid-template-columns: minmax(0, 1.1fr) minmax(320px, 0.9fr);
            }

            .panel-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 1.35rem;
                letter-spacing: -0.04em;
            }

            .panel-copy {
                margin: 8px 0 0;
                color: var(--muted);
                line-height: 1.72;
            }

            .trend-list,
            .metric-list,
            .card-list,
            .tag-list,
            .permission-list {
                display: grid;
                gap: 12px;
            }

            .trend-row,
            .metric-row,
            .activity-row,
            .entity-row,
            .expense-row,
            .calendar-item,
            .role-card,
            .resource-card,
            .branch-card {
                padding: 16px;
                border-radius: 20px;
                background: #f8fbfd;
                border: 1px solid rgba(20, 41, 69, 0.08);
            }

            .trend-top,
            .metric-top,
            .entity-top,
            .expense-top {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 16px;
            }

            .bar-track {
                height: 10px;
                margin-top: 12px;
                border-radius: 999px;
                background: #dde9f0;
                overflow: hidden;
            }

            .bar-fill {
                height: 100%;
                border-radius: 999px;
                background: linear-gradient(90deg, var(--teal) 0%, var(--copper) 100%);
            }

            .metric-kicker {
                color: var(--muted);
                font-size: 0.8rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .metric-value {
                margin-top: 10px;
                font-family: 'Outfit', sans-serif;
                font-size: 1.6rem;
                font-weight: 800;
                letter-spacing: -0.05em;
            }

            .badge,
            .pill {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 7px 12px;
                border-radius: 999px;
                font-size: 0.8rem;
                font-weight: 800;
                white-space: nowrap;
            }

            .badge-teal,
            .pill-teal {
                background: var(--teal-soft);
                color: var(--teal);
            }

            .badge-copper,
            .pill-copper {
                background: var(--copper-soft);
                color: var(--copper);
            }

            .badge-success,
            .pill-success {
                background: var(--success-soft);
                color: var(--success);
            }

            .badge-warning,
            .pill-warning {
                background: var(--warning-soft);
                color: var(--warning);
            }

            .badge-danger,
            .pill-danger {
                background: var(--danger-soft);
                color: var(--danger);
            }

            .summary-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 14px;
            }

            .summary-card {
                padding: 16px;
                border-radius: 20px;
                background: #f7fbfe;
                border: 1px solid rgba(20, 41, 69, 0.08);
            }

            .summary-label {
                color: var(--muted);
                font-size: 0.8rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .summary-value {
                margin-top: 10px;
                font-weight: 800;
                line-height: 1.55;
            }

            .form-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 14px;
            }

            .field,
            .wide-field {
                display: grid;
                gap: 8px;
            }

            .wide-field {
                grid-column: 1 / -1;
            }

            .field label,
            .wide-field label {
                font-size: 0.88rem;
                font-weight: 800;
                color: var(--ink);
            }

            .field input,
            .field select,
            .field textarea,
            .wide-field input,
            .wide-field select,
            .wide-field textarea {
                width: 100%;
                padding: 13px 14px;
                border: 1px solid var(--line);
                border-radius: 16px;
                background: #fff;
                color: var(--ink);
            }

            .field textarea,
            .wide-field textarea {
                min-height: 112px;
                resize: vertical;
            }

            .field-check {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 12px 14px;
                border-radius: 16px;
                background: #f8fbfd;
                border: 1px solid var(--line);
            }

            .field-help {
                color: var(--muted);
                font-size: 0.8rem;
                line-height: 1.55;
            }

            .table-wrap {
                overflow-x: auto;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 14px 12px;
                border-bottom: 1px solid rgba(20, 41, 69, 0.08);
                text-align: left;
                vertical-align: top;
            }

            th {
                color: var(--muted);
                font-size: 0.8rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .table-meta {
                color: var(--muted);
                font-size: 0.86rem;
                line-height: 1.6;
            }

            .empty-state {
                padding: 18px;
                border-radius: 20px;
                background: #f8fbfd;
                border: 1px dashed rgba(20, 41, 69, 0.18);
                color: var(--muted);
                line-height: 1.8;
            }

            .item-row-list {
                display: grid;
                gap: 12px;
            }

            .checkout-item {
                padding: 14px;
                border-radius: 18px;
                background: #f7fbfd;
                border: 1px solid rgba(20, 41, 69, 0.08);
            }

            .checkout-grid {
                display: grid;
                grid-template-columns: 1.4fr 1fr 0.85fr 0.85fr auto;
                gap: 10px;
                align-items: end;
            }

            .payment-grid {
                display: grid;
                grid-template-columns: 1fr 0.75fr 0.85fr 1fr 1fr 1fr auto;
                gap: 10px;
                align-items: end;
            }

            .row-actions {
                display: flex;
                justify-content: flex-end;
            }

            .calendar-grid {
                display: grid;
                grid-template-columns: repeat(7, minmax(0, 1fr));
                gap: 12px;
            }

            .calendar-column {
                display: grid;
                gap: 10px;
                align-content: start;
                min-height: 220px;
                padding: 14px;
                border-radius: 22px;
                background: #f7fbfd;
                border: 1px solid rgba(20, 41, 69, 0.08);
            }

            .calendar-day {
                display: grid;
                gap: 4px;
                padding-bottom: 10px;
                border-bottom: 1px solid rgba(20, 41, 69, 0.08);
            }

            .calendar-day strong {
                font-family: 'Outfit', sans-serif;
                font-size: 1.05rem;
                letter-spacing: -0.03em;
            }

            .customer-grid,
            .branch-grid,
            .resource-grid,
            .role-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 14px;
            }

            .customer-card {
                padding: 18px;
                border-radius: 22px;
                background: #f8fbfd;
                border: 1px solid rgba(20, 41, 69, 0.08);
            }

            .customer-meta {
                margin-top: 10px;
                color: var(--muted);
                line-height: 1.7;
            }

            .kicker {
                color: var(--muted);
                font-size: 0.78rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            @media (max-width: 1320px) {
                .stats-grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }

                .dashboard-grid,
                .wide-grid,
                .dual-grid,
                .split-grid,
                .form-layout {
                    grid-template-columns: 1fr;
                }

                .calendar-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 1180px) {
                .console-app {
                    grid-template-columns: 1fr;
                }

                .console-sidebar {
                    position: static;
                    min-height: auto;
                }

                .hero-card,
                .topbar {
                    grid-template-columns: 1fr;
                    display: grid;
                }

                .toolbar {
                    justify-content: flex-start;
                }
            }

            @media (max-width: 900px) {
                .workspace {
                    padding: 18px 16px 28px;
                }

                .stats-grid,
                .summary-grid,
                .form-grid,
                .customer-grid,
                .branch-grid,
                .resource-grid,
                .role-grid,
                .hero-side-grid,
                .calendar-grid {
                    grid-template-columns: 1fr;
                }

                .checkout-grid,
                .payment-grid {
                    grid-template-columns: 1fr;
                }

                .button-dark,
                .button-light,
                .button-accent,
                .button-outline {
                    width: 100%;
                }

                .hero-actions,
                .toolbar {
                    display: grid;
                }
            }
            @include('partials.auth-console-overrides')
        </style>
    </head>
    <body>
        @php
            $formatKes = static fn ($value): string => 'KES '.number_format((float) $value, 2);
            $activeTab = in_array($activeTab, ['overview', 'checkout', 'appointments', 'customers', 'services', 'inventory', 'staff', 'reports', 'settings'], true)
                ? $activeTab
                : 'overview';
            $tabs = [
                'overview' => 'Overview',
                'checkout' => 'Checkout',
                'appointments' => 'Appointments',
                'customers' => 'Customers',
                'services' => 'Services',
                'inventory' => 'Inventory',
                'staff' => 'Staff',
                'reports' => 'Reports',
                'settings' => 'Settings',
            ];
            $trendMax = max(1, (float) collect($report['salesTrend'])->max('total'));
            $publicPageHref = $profileReady
                ? route('business.show', ['slug' => $businessSlug])
                : route('for-business.profile-details');
            $receiptHref = $lastReceipt
                ? route('for-business.pos.receipt', ['sale' => $lastReceipt])
                : null;
            $serviceItemRows = old('service_items', [['service_id' => '', 'staff_id' => '', 'quantity' => 1, 'discount_amount' => 0, 'deduct_products' => false]]);
            $productItemRows = old('product_items', [['product_id' => '', 'staff_id' => '', 'quantity' => 1, 'discount_amount' => 0]]);
            $packageItemRows = old('package_items', [['name' => '', 'staff_id' => '', 'quantity' => 1, 'unit_price' => 0, 'discount_amount' => 0]]);
            $paymentRows = old('payments', [['payment_method' => 'Cash', 'amount' => 0, 'status' => 'Paid', 'reference' => '', 'paid_at' => now()->format('Y-m-d\TH:i'), 'notes' => '', 'mpesa_code' => '', 'phone_number' => '', 'till_or_paybill' => '']]);
            $closing = $report['dailyClosingSummary'];
        @endphp

        <div class="console-app">
            @include('partials.business-console-sidebar', ['profileReady' => $profileReady])

            <main class="workspace">
                <div class="workspace-shell">
                    <div class="topbar">
                        <div>
                            <span class="eyebrow">Point of sale workspace</span>
                            <h1>POS</h1>
                            <p class="subtitle">
                                Manage a complete spa or barber shop operation from one place: customer profiles, live appointments, checkout, M-Pesa follow-up, inventory, staff commissions, loyalty, expenses, and business reporting.
                            </p>
                        </div>

                        <div class="toolbar">
                            <a class="button-light" href="{{ route('for-business.tools') }}">Back to dashboard</a>
                            <a class="button-light" href="{{ route('for-business.bookings') }}">Marketplace bookings</a>
                            <a class="button-dark" href="{{ $publicPageHref }}">Public page</a>
                            @if ($receiptHref)
                                <a class="button-accent" href="{{ $receiptHref }}" target="_blank" rel="noreferrer">Print latest receipt</a>
                            @endif
                        </div>
                    </div>

                    @if (session('pos_success'))
                        <div class="flash flash-success">{{ session('pos_success') }}</div>
                    @endif

                    @if (session('pos_error'))
                        <div class="flash flash-error">{{ session('pos_error') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="flash flash-error">
                            <strong>There are validation errors in the POS form.</strong>
                            <div style="margin-top: 8px;">
                                {{ $errors->first() }}
                            </div>
                        </div>
                    @endif

                    <section class="hero-card">
                        <div>
                            <span class="eyebrow" style="background: rgba(255, 255, 255, 0.12); color: #fff;">Manage your listed business from one place</span>
                            <h2>Turn the business console into your front desk, stock room, and cash wrap.</h2>
                            <p class="hero-copy">
                                This POS now runs far beyond booking summaries. Use it to sell services, retail products, and packages, prevent scheduling conflicts, calculate VAT and commissions, track M-Pesa collections, reward loyal customers, and close the day with operational and financial visibility.
                            </p>
                            <div class="hero-actions">
                                <a class="button-accent" href="{{ route('for-business.pos', ['tab' => 'checkout']) }}">Open checkout</a>
                                <a class="button-outline" href="{{ route('for-business.pos', ['tab' => 'appointments']) }}">Open appointment calendar</a>
                                <a class="button-outline" href="{{ route('for-business.pos', ['tab' => 'reports']) }}">View reports</a>
                            </div>
                        </div>

                        <div class="hero-side">
                            <div>
                                <div class="kicker" style="color: rgba(255, 255, 255, 0.7);">Workspace status</div>
                                <div style="margin-top: 10px; font-family: 'Outfit', sans-serif; font-size: 2rem; font-weight: 800; letter-spacing: -0.05em;">
                                    {{ $listingStatus }} / {{ $currentRole }}
                                </div>
                            </div>

                            <div class="hero-side-grid">
                                <div class="hero-stat">
                                    <div class="hero-stat-label">Daily sales</div>
                                    <div class="hero-stat-value">{{ $formatKes($report['dailySales']) }}</div>
                                </div>
                                <div class="hero-stat">
                                    <div class="hero-stat-label">Monthly sales</div>
                                    <div class="hero-stat-value">{{ $formatKes($report['monthlySales']) }}</div>
                                </div>
                                <div class="hero-stat">
                                    <div class="hero-stat-label">Appointments today</div>
                                    <div class="hero-stat-value">{{ $todayBookingCount }}</div>
                                </div>
                                <div class="hero-stat">
                                    <div class="hero-stat-label">Low-stock alerts</div>
                                    <div class="hero-stat-value">{{ $report['lowStockProducts']->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="stats-grid">
                        <article class="stat-card">
                            <div class="stat-label">Daily sales</div>
                            <div class="stat-value">{{ $formatKes($report['dailySales']) }}</div>
                            <div class="stat-meta">Live gross sales captured today across services, products, and packages.</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Monthly sales</div>
                            <div class="stat-value">{{ $formatKes($report['monthlySales']) }}</div>
                            <div class="stat-meta">Current month revenue before expenses and product costs.</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Open appointments</div>
                            <div class="stat-value">{{ $pendingBookingCount }}</div>
                            <div class="stat-meta">Pending or not yet completed bookings that still need attention.</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Customer retention</div>
                            <div class="stat-value">{{ number_format($report['customerRetention'], 1) }}%</div>
                            <div class="stat-meta">Share of active customers who have returned for more than one sale.</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Expenses this month</div>
                            <div class="stat-value">{{ $formatKes($report['expensesTotal']) }}</div>
                            <div class="stat-meta">Operational costs already recorded in the POS expense ledger.</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Estimated profit</div>
                            <div class="stat-value">{{ $formatKes($report['estimatedProfit']) }}</div>
                            <div class="stat-meta">Sales less logged expenses and product cost of goods sold.</div>
                        </article>
                    </section>

                    <nav class="subnav" aria-label="POS module navigation">
                        @foreach ($tabs as $tabId => $tabLabel)
                            <a class="subnav-link {{ $activeTab === $tabId ? 'is-active' : '' }}" href="{{ route('for-business.pos', ['tab' => $tabId]) }}">
                                {{ $tabLabel }}
                            </a>
                        @endforeach
                    </nav>

                    <section class="content-section {{ $activeTab === 'overview' ? 'is-active' : '' }}">
                        <div class="section-head">
                            <div>
                                <h3 class="section-title">Business management overview</h3>
                                <p class="section-copy">Business management overview now means live trading visibility, not just navigation. Track sales momentum, closing totals, payment mix, stock pressure, M-Pesa activity, and the services or products driving the most revenue.</p>
                            </div>
                        </div>

                        <div class="dashboard-grid">
                            <section class="panel">
                                <h4 class="panel-title">Daily sales trend</h4>
                                <p class="panel-copy">Last seven days of closed receipts in KES.</p>

                                @if (collect($report['salesTrend'])->isEmpty())
                                    <div class="empty-state">No sales are recorded yet. Once checkout activity starts, this trend will show daily trading volume.</div>
                                @else
                                    <div class="trend-list">
                                        @foreach ($report['salesTrend'] as $point)
                                            <article class="trend-row">
                                                <div class="trend-top">
                                                    <div>
                                                        <strong>{{ $point['day'] }}</strong>
                                                        <div class="table-meta">{{ $point['date'] }}</div>
                                                    </div>
                                                    <div class="badge badge-teal">{{ $formatKes($point['total']) }}</div>
                                                </div>
                                                <div class="bar-track">
                                                    <div class="bar-fill" style="width: {{ min(100, ($point['total'] / $trendMax) * 100) }}%;"></div>
                                                </div>
                                            </article>
                                        @endforeach
                                    </div>
                                @endif
                            </section>

                            <aside class="panel">
                                <h4 class="panel-title">Daily closing summary</h4>
                                <p class="panel-copy">Quick close numbers for today’s trade.</p>

                                <div class="summary-grid">
                                    <div class="summary-card">
                                        <div class="summary-label">Receipts today</div>
                                        <div class="summary-value">{{ (int) ($closing->receipts_count ?? 0) }}</div>
                                    </div>
                                    <div class="summary-card">
                                        <div class="summary-label">Gross total</div>
                                        <div class="summary-value">{{ $formatKes($closing->gross_total ?? 0) }}</div>
                                    </div>
                                    <div class="summary-card">
                                        <div class="summary-label">Collected</div>
                                        <div class="summary-value">{{ $formatKes($closing->collected_total ?? 0) }}</div>
                                    </div>
                                    <div class="summary-card">
                                        <div class="summary-label">Outstanding</div>
                                        <div class="summary-value">{{ $formatKes($closing->outstanding_total ?? 0) }}</div>
                                    </div>
                                </div>

                                <div style="margin-top: 18px;">
                                    <div class="kicker">Payment mix</div>
                                    <div class="metric-list" style="margin-top: 12px;">
                                        @forelse ($report['paymentBreakdown'] as $row)
                                            <article class="metric-row">
                                                <div class="metric-top">
                                                    <strong>{{ $row->payment_method }}</strong>
                                                    <span class="badge badge-copper">{{ $formatKes($row->paid_total) }}</span>
                                                </div>
                                                <div class="table-meta">Submitted {{ $formatKes($row->total) }}</div>
                                            </article>
                                        @empty
                                            <div class="empty-state">Payment mix will appear here after the first sale is recorded.</div>
                                        @endforelse
                                    </div>
                                </div>
                            </aside>
                        </div>

                        <div class="wide-grid" style="margin-top: 20px;">
                            <section class="panel">
                                <h4 class="panel-title">Best sellers</h4>
                                <p class="panel-copy">Top lines by revenue so you can see what is carrying the floor.</p>

                                <div class="dual-grid" style="margin-top: 16px;">
                                    <div>
                                        <div class="kicker">Best-selling services</div>
                                        <div class="metric-list" style="margin-top: 12px;">
                                            @forelse ($report['bestSellingServices'] as $service)
                                                <article class="metric-row">
                                                    <div class="metric-top">
                                                        <strong>{{ $service->description }}</strong>
                                                        <span class="badge badge-teal">{{ $formatKes($service->revenue) }}</span>
                                                    </div>
                                                    <div class="table-meta">{{ number_format((float) $service->quantity_sold, 2) }} sold</div>
                                                </article>
                                            @empty
                                                <div class="empty-state">No service sales recorded yet.</div>
                                            @endforelse
                                        </div>
                                    </div>

                                    <div>
                                        <div class="kicker">Best-selling products</div>
                                        <div class="metric-list" style="margin-top: 12px;">
                                            @forelse ($report['bestSellingProducts'] as $product)
                                                <article class="metric-row">
                                                    <div class="metric-top">
                                                        <strong>{{ $product->description }}</strong>
                                                        <span class="badge badge-copper">{{ $formatKes($product->revenue) }}</span>
                                                    </div>
                                                    <div class="table-meta">{{ number_format((float) $product->quantity_sold, 2) }} sold</div>
                                                </article>
                                            @empty
                                                <div class="empty-state">No retail sales recorded yet.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <aside class="panel">
                                <h4 class="panel-title">M-Pesa reconciliation</h4>
                                <p class="panel-copy">Latest M-Pesa-linked receipts with code, status, and till or Paybill trace.</p>

                                <div class="metric-list" style="margin-top: 16px;">
                                    @forelse ($report['mpesaReconciliation'] as $payment)
                                        <article class="metric-row">
                                            <div class="metric-top">
                                                <div>
                                                    <strong>{{ $payment->sale?->receipt_number ?? 'Receipt' }}</strong>
                                                    <div class="table-meta">
                                                        {{ $payment->mpesaTransaction?->mpesa_code ?? 'Pending code' }} / {{ $payment->mpesaTransaction?->till_or_paybill ?? 'Till missing' }}
                                                    </div>
                                                </div>
                                                <span class="badge {{ $payment->status === 'Paid' ? 'badge-success' : ($payment->status === 'Pending' ? 'badge-warning' : 'badge-danger') }}">
                                                    {{ $payment->status }}
                                                </span>
                                            </div>
                                            <div class="table-meta">{{ $formatKes($payment->amount) }} from {{ $payment->mpesaTransaction?->phone_number ?? 'No phone recorded' }}</div>
                                        </article>
                                    @empty
                                        <div class="empty-state">No M-Pesa transactions have been logged yet.</div>
                                    @endforelse
                                </div>
                            </aside>
                        </div>

                        <div class="wide-grid" style="margin-top: 20px;">
                            <section class="panel">
                                <h4 class="panel-title">Appointment and retention pulse</h4>
                                <p class="panel-copy">Understand operational load and repeat-customer strength.</p>

                                <div class="dual-grid" style="margin-top: 16px;">
                                    <div>
                                        <div class="kicker">Appointment status</div>
                                        <div class="metric-list" style="margin-top: 12px;">
                                            @forelse ($report['appointmentStatus'] as $status)
                                                <article class="metric-row">
                                                    <div class="metric-top">
                                                        <strong>{{ $status->status }}</strong>
                                                        <span class="badge badge-teal">{{ $status->total }}</span>
                                                    </div>
                                                </article>
                                            @empty
                                                <div class="empty-state">No POS appointments are on the books yet.</div>
                                            @endforelse
                                        </div>
                                    </div>

                                    <div>
                                        <div class="kicker">Customer loyalty picture</div>
                                        <div class="summary-grid" style="margin-top: 12px;">
                                            <div class="summary-card">
                                                <div class="summary-label">Retention</div>
                                                <div class="summary-value">{{ number_format($report['customerRetention'], 1) }}%</div>
                                            </div>
                                            <div class="summary-card">
                                                <div class="summary-label">Memberships</div>
                                                <div class="summary-value">{{ $report['memberships']->count() }}</div>
                                            </div>
                                            <div class="summary-card">
                                                <div class="summary-label">Recent customers</div>
                                                <div class="summary-value">{{ $report['recentCustomers']->count() }}</div>
                                            </div>
                                            <div class="summary-card">
                                                <div class="summary-label">Low-stock products</div>
                                                <div class="summary-value">{{ $report['lowStockProducts']->count() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <aside class="panel">
                                <h4 class="panel-title">Low-stock products</h4>
                                <p class="panel-copy">Products at or below the reorder line.</p>

                                <div class="metric-list" style="margin-top: 16px;">
                                    @forelse ($report['lowStockProducts'] as $product)
                                        <article class="metric-row">
                                            <div class="metric-top">
                                                <strong>{{ $product->name }}</strong>
                                                <span class="badge badge-warning">{{ number_format((float) $product->current_stock, 2) }} left</span>
                                            </div>
                                            <div class="table-meta">Reorder level: {{ number_format((float) $product->reorder_level, 2) }} / Shelf: {{ $product->shelf_location ?: 'Not set' }}</div>
                                        </article>
                                    @empty
                                        <div class="empty-state">Stock levels are healthy right now.</div>
                                    @endforelse
                                </div>
                            </aside>
                        </div>
                    </section>

                    <section class="content-section {{ $activeTab === 'checkout' ? 'is-active' : '' }}">
                        <div class="section-head">
                            <div>
                                <h3 class="section-title">POS checkout screen</h3>
                                <p class="section-copy">Capture service billing, product sales, packages, split payments, VAT, discounts, M-Pesa details, and printable receipts in one transaction flow.</p>
                            </div>
                        </div>

                        <div class="form-layout">
                            <section class="panel">
                                <form method="post" action="{{ route('for-business.pos.sales.store') }}">
                                    @csrf

                                    <div class="form-grid">
                                        <div class="field">
                                            <label for="sale_branch_id">Branch</label>
                                            <select id="sale_branch_id" name="branch_id">
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}" @selected(old('branch_id') == $branch->id)>{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="sale_transaction_date">Transaction date</label>
                                            <input id="sale_transaction_date" type="datetime-local" name="transaction_date" value="{{ old('transaction_date', now()->format('Y-m-d\TH:i')) }}">
                                        </div>
                                        <div class="field">
                                            <label for="sale_customer_id">Customer</label>
                                            <select id="sale_customer_id" name="customer_id">
                                                <option value="">Walk-in / none selected</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>{{ $customer->full_name }} / {{ $customer->phone_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="sale_staff_id">Staff serving</label>
                                            <select id="sale_staff_id" name="staff_id">
                                                <option value="">Unassigned</option>
                                                @foreach ($staffMembers as $staff)
                                                    <option value="{{ $staff->id }}" @selected(old('staff_id') == $staff->id)>{{ $staff->full_name }} / {{ $staff->role }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="sale_appointment_id">Linked appointment</label>
                                            <select id="sale_appointment_id" name="appointment_id">
                                                <option value="">Walk-in sale</option>
                                                @foreach ($report['recentAppointments'] as $appointment)
                                                    <option value="{{ $appointment->id }}" @selected(old('appointment_id') == $appointment->id)>{{ $appointment->appointment_number }} / {{ $appointment->customer->full_name ?? 'Customer' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="sale_channel">Sales channel</label>
                                            <select id="sale_channel" name="sales_channel">
                                                @foreach ($options['salesChannels'] as $channel)
                                                    <option value="{{ $channel }}" @selected(old('sales_channel', 'Walk-in') === $channel)>{{ $channel }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="sale_discount_amount">Sale discount</label>
                                            <input id="sale_discount_amount" type="number" step="0.01" min="0" name="discount_amount" value="{{ old('discount_amount', 0) }}">
                                        </div>
                                        <div class="field">
                                            <label for="sale_loyalty_redeem">Loyalty points to redeem</label>
                                            <input id="sale_loyalty_redeem" type="number" min="0" name="loyalty_points_to_redeem" value="{{ old('loyalty_points_to_redeem', 0) }}">
                                        </div>
                                        <div class="wide-field">
                                            <label for="sale_notes">Sale notes</label>
                                            <textarea id="sale_notes" name="notes" placeholder="Split settlement explanation, package note, follow-up note...">{{ old('notes') }}</textarea>
                                        </div>
                                    </div>

                                    <div style="margin-top: 22px;">
                                        <div class="section-head" style="margin-bottom: 12px;">
                                            <div>
                                                <h4 class="panel-title">Service lines</h4>
                                                <p class="panel-copy">Choose services, assign staff, and decide whether required product stock should be deducted.</p>
                                            </div>
                                            <button class="button-small" type="button" data-add-row="service">Add service</button>
                                        </div>

                                        <div class="item-row-list" id="service-item-list">
                                            @foreach ($serviceItemRows as $index => $row)
                                                <div class="checkout-item">
                                                    <div class="checkout-grid">
                                                        <div class="field">
                                                            <label>Service</label>
                                                            <select name="service_items[{{ $index }}][service_id]">
                                                                <option value="">Select service</option>
                                                                @foreach ($services as $service)
                                                                    <option value="{{ $service->id }}" @selected(($row['service_id'] ?? null) == $service->id)>{{ $service->name }} / {{ $formatKes($service->price) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="field">
                                                            <label>Staff</label>
                                                            <select name="service_items[{{ $index }}][staff_id]">
                                                                <option value="">Default staff</option>
                                                                @foreach ($staffMembers as $staff)
                                                                    <option value="{{ $staff->id }}" @selected(($row['staff_id'] ?? null) == $staff->id)>{{ $staff->full_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="field">
                                                            <label>Qty</label>
                                                            <input type="number" step="1" min="1" name="service_items[{{ $index }}][quantity]" value="{{ $row['quantity'] ?? 1 }}">
                                                        </div>
                                                        <div class="field">
                                                            <label>Discount</label>
                                                            <input type="number" step="0.01" min="0" name="service_items[{{ $index }}][discount_amount]" value="{{ $row['discount_amount'] ?? 0 }}">
                                                        </div>
                                                        <div class="field-check">
                                                            <input type="checkbox" name="service_items[{{ $index }}][deduct_products]" value="1" @checked((bool) ($row['deduct_products'] ?? false))>
                                                            <span>Deduct required products</span>
                                                        </div>
                                                        <div class="row-actions">
                                                            <button class="button-small" type="button" data-remove-row>Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div style="margin-top: 22px;">
                                        <div class="section-head" style="margin-bottom: 12px;">
                                            <div>
                                                <h4 class="panel-title">Product lines</h4>
                                                <p class="panel-copy">Retail items automatically deduct stock and can feed product commissions if enabled.</p>
                                            </div>
                                            <button class="button-small" type="button" data-add-row="product">Add product</button>
                                        </div>

                                        <div class="item-row-list" id="product-item-list">
                                            @foreach ($productItemRows as $index => $row)
                                                <div class="checkout-item">
                                                    <div class="checkout-grid">
                                                        <div class="field">
                                                            <label>Product</label>
                                                            <select name="product_items[{{ $index }}][product_id]">
                                                                <option value="">Select product</option>
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}" @selected(($row['product_id'] ?? null) == $product->id)>{{ $product->name }} / {{ $formatKes($product->selling_price) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="field">
                                                            <label>Staff</label>
                                                            <select name="product_items[{{ $index }}][staff_id]">
                                                                <option value="">Default staff</option>
                                                                @foreach ($staffMembers as $staff)
                                                                    <option value="{{ $staff->id }}" @selected(($row['staff_id'] ?? null) == $staff->id)>{{ $staff->full_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="field">
                                                            <label>Qty</label>
                                                            <input type="number" step="0.01" min="0.01" name="product_items[{{ $index }}][quantity]" value="{{ $row['quantity'] ?? 1 }}">
                                                        </div>
                                                        <div class="field">
                                                            <label>Discount</label>
                                                            <input type="number" step="0.01" min="0" name="product_items[{{ $index }}][discount_amount]" value="{{ $row['discount_amount'] ?? 0 }}">
                                                        </div>
                                                        <div></div>
                                                        <div class="row-actions">
                                                            <button class="button-small" type="button" data-remove-row>Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div style="margin-top: 22px;">
                                        <div class="section-head" style="margin-bottom: 12px;">
                                            <div>
                                                <h4 class="panel-title">Package lines</h4>
                                                <p class="panel-copy">Use this for bundled offerings or manual custom packages.</p>
                                            </div>
                                            <button class="button-small" type="button" data-add-row="package">Add package</button>
                                        </div>

                                        <div class="item-row-list" id="package-item-list">
                                            @foreach ($packageItemRows as $index => $row)
                                                <div class="checkout-item">
                                                    <div class="checkout-grid" style="grid-template-columns: 1.4fr 1fr 0.8fr 0.9fr 0.9fr auto;">
                                                        <div class="field">
                                                            <label>Package name</label>
                                                            <input type="text" name="package_items[{{ $index }}][name]" value="{{ $row['name'] ?? '' }}" placeholder="Weekend grooming package">
                                                        </div>
                                                        <div class="field">
                                                            <label>Staff</label>
                                                            <select name="package_items[{{ $index }}][staff_id]">
                                                                <option value="">Default staff</option>
                                                                @foreach ($staffMembers as $staff)
                                                                    <option value="{{ $staff->id }}" @selected(($row['staff_id'] ?? null) == $staff->id)>{{ $staff->full_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="field">
                                                            <label>Qty</label>
                                                            <input type="number" step="1" min="1" name="package_items[{{ $index }}][quantity]" value="{{ $row['quantity'] ?? 1 }}">
                                                        </div>
                                                        <div class="field">
                                                            <label>Unit price</label>
                                                            <input type="number" step="0.01" min="0" name="package_items[{{ $index }}][unit_price]" value="{{ $row['unit_price'] ?? 0 }}">
                                                        </div>
                                                        <div class="field">
                                                            <label>Discount</label>
                                                            <input type="number" step="0.01" min="0" name="package_items[{{ $index }}][discount_amount]" value="{{ $row['discount_amount'] ?? 0 }}">
                                                        </div>
                                                        <div class="row-actions">
                                                            <button class="button-small" type="button" data-remove-row>Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div style="margin-top: 24px;">
                                        <div class="section-head" style="margin-bottom: 12px;">
                                            <div>
                                                <h4 class="panel-title">Payments</h4>
                                                <p class="panel-copy">Record cash, card, M-Pesa, bank transfer, or split settlement rows. Sale totals are calculated server-side.</p>
                                            </div>
                                            <button class="button-small" type="button" data-add-row="payment">Add payment</button>
                                        </div>

                                        <div class="item-row-list" id="payment-item-list">
                                            @foreach ($paymentRows as $index => $row)
                                                <div class="checkout-item">
                                                    <div class="payment-grid">
                                                        <div class="field">
                                                            <label>Method</label>
                                                            <select name="payments[{{ $index }}][payment_method]">
                                                                @foreach ($options['paymentMethods'] as $method)
                                                                    <option value="{{ $method }}" @selected(($row['payment_method'] ?? 'Cash') === $method)>{{ $method }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="field">
                                                            <label>Amount</label>
                                                            <input type="number" step="0.01" min="0.01" name="payments[{{ $index }}][amount]" value="{{ $row['amount'] ?? 0 }}">
                                                        </div>
                                                        <div class="field">
                                                            <label>Status</label>
                                                            <select name="payments[{{ $index }}][status]">
                                                                @foreach ($options['paymentStatuses'] as $status)
                                                                    <option value="{{ $status }}" @selected(($row['status'] ?? 'Paid') === $status)>{{ $status }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="field">
                                                            <label>Reference / code</label>
                                                            <input type="text" name="payments[{{ $index }}][reference]" value="{{ $row['reference'] ?? '' }}" placeholder="Card slip or bank ref">
                                                        </div>
                                                        <div class="field">
                                                            <label>M-Pesa phone</label>
                                                            <input type="text" name="payments[{{ $index }}][phone_number]" value="{{ $row['phone_number'] ?? '' }}" placeholder="+2547...">
                                                        </div>
                                                        <div class="field">
                                                            <label>Till / Paybill</label>
                                                            <input type="text" name="payments[{{ $index }}][till_or_paybill]" value="{{ $row['till_or_paybill'] ?? '' }}" placeholder="Till or Paybill">
                                                        </div>
                                                        <div class="row-actions">
                                                            <button class="button-small" type="button" data-remove-row>Remove</button>
                                                        </div>
                                                    </div>

                                                    <div class="payment-grid" style="grid-template-columns: 1fr 1fr 2fr;">
                                                        <div class="field">
                                                            <label>M-Pesa code</label>
                                                            <input type="text" name="payments[{{ $index }}][mpesa_code]" value="{{ $row['mpesa_code'] ?? '' }}" placeholder="SE2K7H98TQ">
                                                        </div>
                                                        <div class="field">
                                                            <label>Paid at</label>
                                                            <input type="datetime-local" name="payments[{{ $index }}][paid_at]" value="{{ $row['paid_at'] ?? now()->format('Y-m-d\TH:i') }}">
                                                        </div>
                                                        <div class="field">
                                                            <label>Notes</label>
                                                            <input type="text" name="payments[{{ $index }}][notes]" value="{{ $row['notes'] ?? '' }}" placeholder="Split with cash or customer will clear later">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div style="margin-top: 20px; display: flex; flex-wrap: wrap; gap: 10px;">
                                        <button class="button-accent" type="submit">Record sale and generate receipt</button>
                                        <span class="pill pill-teal">VAT, staff commission, loyalty points, M-Pesa records, and stock deduction are applied automatically.</span>
                                    </div>
                                </form>
                            </section>

                            <aside class="panel">
                                <h4 class="panel-title">Recent receipts</h4>
                                <p class="panel-copy">Latest sales recorded in the POS.</p>

                                <div class="metric-list" style="margin-top: 16px;">
                                    @forelse ($report['recentSales'] as $sale)
                                        <article class="metric-row">
                                            <div class="metric-top">
                                                <div>
                                                    <strong>{{ $sale->receipt_number }}</strong>
                                                    <div class="table-meta">{{ $sale->customer?->full_name ?? 'Walk-in customer' }} / {{ $sale->transaction_date?->format('j M Y, g:i a') }}</div>
                                                </div>
                                                <span class="badge {{ (float) $sale->balance_amount > 0 ? 'badge-warning' : 'badge-success' }}">
                                                    {{ (float) $sale->balance_amount > 0 ? 'Balance open' : 'Closed' }}
                                                </span>
                                            </div>
                                            <div class="table-meta">Total {{ $formatKes($sale->total_amount) }} / Paid {{ $formatKes($sale->amount_paid) }} / {{ $sale->payment_method }}</div>
                                            <div style="margin-top: 10px;">
                                                <a class="button-small" href="{{ route('for-business.pos.receipt', ['sale' => $sale]) }}" target="_blank" rel="noreferrer">Print receipt</a>
                                            </div>
                                        </article>
                                    @empty
                                        <div class="empty-state">No sales have been recorded yet.</div>
                                    @endforelse
                                </div>
                            </aside>
                        </div>
                    </section>

                    <section class="content-section {{ $activeTab === 'appointments' ? 'is-active' : '' }}">
                        <div class="section-head">
                            <div>
                                <h3 class="section-title">Appointment calendar</h3>
                                <p class="section-copy">Create internal appointments with customer, service, staff, room or chair assignment, and automatic conflict detection for overlapping slots.</p>
                            </div>
                        </div>

                        <div class="form-layout">
                            <section class="panel">
                                <form method="post" action="{{ route('for-business.pos.appointments.store') }}">
                                    @csrf

                                    <div class="form-grid">
                                        <div class="field">
                                            <label for="appointment_branch_id">Branch</label>
                                            <select id="appointment_branch_id" name="branch_id">
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="appointment_customer_id">Customer</label>
                                            <select id="appointment_customer_id" name="customer_id">
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>{{ $customer->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="appointment_service_id">Service</label>
                                            <select id="appointment_service_id" name="service_id">
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>{{ $service->name }} / {{ $service->duration_minutes }} min</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="appointment_staff_id">Staff assigned</label>
                                            <select id="appointment_staff_id" name="staff_id">
                                                @foreach ($staffMembers as $staff)
                                                    <option value="{{ $staff->id }}" @selected(old('staff_id') == $staff->id)>{{ $staff->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="appointment_date">Booking date</label>
                                            <input id="appointment_date" type="date" name="booking_date" value="{{ old('booking_date', now()->toDateString()) }}">
                                        </div>
                                        <div class="field">
                                            <label for="appointment_time">Start time</label>
                                            <input id="appointment_time" type="time" name="start_time" value="{{ old('start_time', '09:00') }}">
                                        </div>
                                        <div class="field">
                                            <label for="appointment_duration">Duration (minutes)</label>
                                            <input id="appointment_duration" type="number" min="5" max="720" name="duration_minutes" value="{{ old('duration_minutes') }}" placeholder="Leave blank to use service duration">
                                        </div>
                                        <div class="field">
                                            <label for="appointment_resource_id">Room or chair</label>
                                            <select id="appointment_resource_id" name="room_chair_id">
                                                <option value="">No resource</option>
                                                @foreach ($resources as $resource)
                                                    <option value="{{ $resource->id }}" @selected(old('room_chair_id') == $resource->id)>{{ $resource->name }} / {{ $resource->resource_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="appointment_status">Status</label>
                                            <select id="appointment_status" name="status">
                                                @foreach ($options['bookingStatuses'] as $status)
                                                    <option value="{{ $status }}" @selected(old('status', 'Confirmed') === $status)>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field-check">
                                            <input type="checkbox" name="reminder_sent" value="1" @checked(old('reminder_sent'))>
                                            <span>Reminder already sent by SMS or WhatsApp</span>
                                        </div>
                                        <div class="wide-field">
                                            <label for="appointment_notes">Notes</label>
                                            <textarea id="appointment_notes" name="notes" placeholder="Room prep note, patch test note, arrival preference...">{{ old('notes') }}</textarea>
                                        </div>
                                    </div>

                                    <div style="margin-top: 20px;">
                                        <button class="button-accent" type="submit">Create appointment</button>
                                    </div>
                                </form>
                            </section>

                            <aside class="panel">
                                <h4 class="panel-title">Weekly calendar</h4>
                                <p class="panel-copy">Appointments scheduled over the next seven days.</p>

                                <div class="calendar-grid" style="margin-top: 16px;">
                                    @for ($offset = 0; $offset < 7; $offset++)
                                        @php
                                            $day = now()->addDays($offset);
                                            $dayKey = $day->format('Y-m-d');
                                            $dayAppointments = $appointmentsCalendar[$dayKey] ?? collect();
                                        @endphp
                                        <div class="calendar-column">
                                            <div class="calendar-day">
                                                <strong>{{ $day->format('D') }}</strong>
                                                <div class="table-meta">{{ $day->format('j M') }}</div>
                                            </div>

                                            @forelse ($dayAppointments as $appointment)
                                                <article class="calendar-item">
                                                    <div class="metric-top">
                                                        <strong>{{ $appointment->start_time }}</strong>
                                                        <span class="badge {{ $appointment->status === 'Confirmed' ? 'badge-success' : ($appointment->status === 'Pending' ? 'badge-warning' : 'badge-copper') }}">
                                                            {{ $appointment->status }}
                                                        </span>
                                                    </div>
                                                    <div class="table-meta">
                                                        {{ $appointment->customer->full_name ?? 'Customer' }}<br>
                                                        {{ $appointment->service->name ?? 'Service' }} / {{ $appointment->staff->full_name ?? 'Staff' }}<br>
                                                        {{ $appointment->roomChair->name ?? 'No chair/room' }}
                                                    </div>
                                                </article>
                                            @empty
                                                <div class="empty-state">No appointments.</div>
                                            @endforelse
                                        </div>
                                    @endfor
                                </div>

                                <div style="margin-top: 18px;">
                                    <div class="kicker">Latest bookings</div>
                                    <div class="metric-list" style="margin-top: 12px;">
                                        @forelse ($report['recentAppointments'] as $appointment)
                                            <article class="metric-row">
                                                <div class="metric-top">
                                                    <div>
                                                        <strong>{{ $appointment->appointment_number }}</strong>
                                                        <div class="table-meta">{{ $appointment->customer->full_name ?? 'Customer' }} / {{ $appointment->booking_date?->format('j M') }} {{ $appointment->start_time }}</div>
                                                    </div>
                                                    <span class="badge badge-teal">{{ $appointment->staff->full_name ?? 'Staff' }}</span>
                                                </div>
                                            </article>
                                        @empty
                                            <div class="empty-state">The calendar will populate here after bookings are created.</div>
                                        @endforelse
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </section>

                    <section class="content-section {{ $activeTab === 'customers' ? 'is-active' : '' }}">
                        <div class="section-head">
                            <div>
                                <h3 class="section-title">Customer profile page</h3>
                                <p class="section-copy">Capture the deeper client context a spa and barber shop actually needs: preferences, allergies, skin or hair profile, referral source, and loyalty readiness.</p>
                            </div>
                        </div>

                        <div class="form-layout">
                            <section class="panel">
                                <form method="post" action="{{ route('for-business.pos.customers.store') }}">
                                    @csrf

                                    <div class="form-grid">
                                        <div class="field">
                                            <label for="customer_branch_id">Branch</label>
                                            <select id="customer_branch_id" name="branch_id">
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="customer_name">Full name</label>
                                            <input id="customer_name" type="text" name="full_name" value="{{ old('full_name') }}">
                                        </div>
                                        <div class="field">
                                            <label for="customer_phone">Phone number</label>
                                            <input id="customer_phone" type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder="+2547...">
                                        </div>
                                        <div class="field">
                                            <label for="customer_email">Email</label>
                                            <input id="customer_email" type="email" name="email" value="{{ old('email') }}">
                                        </div>
                                        <div class="field">
                                            <label for="customer_gender">Gender</label>
                                            <select id="customer_gender" name="gender">
                                                <option value="">Not set</option>
                                                @foreach ($options['customerGenders'] as $gender)
                                                    <option value="{{ $gender }}" @selected(old('gender') === $gender)>{{ $gender }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="customer_dob">Date of birth</label>
                                            <input id="customer_dob" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
                                        </div>
                                        <div class="field">
                                            <label for="customer_type">Customer type</label>
                                            <select id="customer_type" name="customer_type">
                                                @foreach ($options['customerTypes'] as $type)
                                                    <option value="{{ $type }}" @selected(old('customer_type', 'Regular') === $type)>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="preferred_staff_id">Preferred staff</label>
                                            <select id="preferred_staff_id" name="preferred_staff_id">
                                                <option value="">No preference</option>
                                                @foreach ($staffMembers as $staff)
                                                    <option value="{{ $staff->id }}" @selected(old('preferred_staff_id') == $staff->id)>{{ $staff->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="customer_skin_type">Skin type</label>
                                            <input id="customer_skin_type" type="text" name="skin_type" value="{{ old('skin_type') }}">
                                        </div>
                                        <div class="field">
                                            <label for="customer_hair_type">Hair type</label>
                                            <input id="customer_hair_type" type="text" name="hair_type" value="{{ old('hair_type') }}">
                                        </div>
                                        <div class="field">
                                            <label for="customer_pressure">Preferred massage pressure</label>
                                            <input id="customer_pressure" type="text" name="preferred_massage_pressure" value="{{ old('preferred_massage_pressure') }}">
                                        </div>
                                        <div class="field">
                                            <label for="customer_referral">Referral source</label>
                                            <input id="customer_referral" type="text" name="referral_source" value="{{ old('referral_source') }}" placeholder="Instagram, walk-by, referral...">
                                        </div>
                                        <div class="field">
                                            <label for="customer_loyalty">Opening loyalty points</label>
                                            <input id="customer_loyalty" type="number" min="0" name="loyalty_points" value="{{ old('loyalty_points', 0) }}">
                                        </div>
                                        <div class="field">
                                            <label for="customer_last_visit">Last visit date</label>
                                            <input id="customer_last_visit" type="date" name="last_visit_date" value="{{ old('last_visit_date') }}">
                                        </div>
                                        <div class="wide-field">
                                            <label for="customer_notes">Visit notes</label>
                                            <textarea id="customer_notes" name="visit_notes">{{ old('visit_notes') }}</textarea>
                                        </div>
                                        <div class="wide-field">
                                            <label for="customer_allergies">Allergies</label>
                                            <textarea id="customer_allergies" name="allergies">{{ old('allergies') }}</textarea>
                                        </div>
                                        <div class="field-check">
                                            <input type="checkbox" name="sms_reminder_ready" value="1" @checked(old('sms_reminder_ready', true))>
                                            <span>SMS reminder-ready</span>
                                        </div>
                                        <div class="field-check">
                                            <input type="checkbox" name="whatsapp_reminder_ready" value="1" @checked(old('whatsapp_reminder_ready', true))>
                                            <span>WhatsApp reminder-ready</span>
                                        </div>
                                    </div>

                                    <div style="margin-top: 20px;">
                                        <button class="button-accent" type="submit">Save customer profile</button>
                                    </div>
                                </form>
                            </section>

                            <aside class="panel">
                                <h4 class="panel-title">Customer list</h4>
                                <p class="panel-copy">Recent customer records with loyalty and preference context.</p>

                                <div class="customer-grid" style="margin-top: 16px;">
                                    @forelse ($customers as $customer)
                                        <article class="customer-card">
                                            <div class="metric-top">
                                                <div>
                                                    <strong>{{ $customer->full_name }}</strong>
                                                    <div class="table-meta">{{ $customer->customer_code }} / {{ $customer->phone_number }}</div>
                                                </div>
                                                <span class="badge {{ $customer->customer_type === 'VIP' ? 'badge-copper' : 'badge-teal' }}">{{ $customer->customer_type }}</span>
                                            </div>
                                            <div class="customer-meta">
                                                {{ $customer->email ?: 'No email' }}<br>
                                                Loyalty: {{ $customer->loyalty_points }} pts / Membership: {{ $customer->membership?->membership_type ?? 'Silver' }}<br>
                                                Preferred staff: {{ $customer->preferredStaff?->full_name ?? 'Not set' }}<br>
                                                Reminder ready: {{ $customer->sms_reminder_ready ? 'SMS' : 'No SMS' }} / {{ $customer->whatsapp_reminder_ready ? 'WhatsApp' : 'No WhatsApp' }}
                                            </div>
                                        </article>
                                    @empty
                                        <div class="empty-state">No POS customers yet. Add your first profile to start tracking loyalty and tailored notes.</div>
                                    @endforelse
                                </div>
                            </aside>
                        </div>
                    </section>

                    <section class="content-section {{ $activeTab === 'services' ? 'is-active' : '' }}">
                        <div class="section-head">
                            <div>
                                <h3 class="section-title">Service management page</h3>
                                <p class="section-copy">Build the treatment and barbering menu with pricing, duration, VAT rules, commission defaults, target gender, and product consumption.</p>
                            </div>
                        </div>

                        <div class="form-layout">
                            <section class="panel">
                                <form method="post" action="{{ route('for-business.pos.services.store') }}">
                                    @csrf

                                    <div class="form-grid">
                                        <div class="field">
                                            <label for="service_branch_id">Branch</label>
                                            <select id="service_branch_id" name="branch_id">
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="service_name">Service name</label>
                                            <input id="service_name" type="text" name="name" value="{{ old('name') }}">
                                        </div>
                                        <div class="field">
                                            <label for="service_category">Category</label>
                                            <select id="service_category" name="category">
                                                @foreach ($options['serviceCategories'] as $category)
                                                    <option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="service_price">Price</label>
                                            <input id="service_price" type="number" step="0.01" min="0" name="price" value="{{ old('price') }}">
                                        </div>
                                        <div class="field">
                                            <label for="service_duration">Duration (minutes)</label>
                                            <input id="service_duration" type="number" min="5" max="720" name="duration_minutes" value="{{ old('duration_minutes') }}">
                                        </div>
                                        <div class="field">
                                            <label for="service_gender">Gender type</label>
                                            <select id="service_gender" name="gender_type">
                                                @foreach ($options['serviceGenderTypes'] as $gender)
                                                    <option value="{{ $gender }}" @selected(old('gender_type', 'Unisex') === $gender)>{{ $gender }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="service_commission_type">Commission type</label>
                                            <select id="service_commission_type" name="commission_type">
                                                <option value="">Use staff default</option>
                                                @foreach ($options['commissionTypes'] as $type)
                                                    <option value="{{ $type }}" @selected(old('commission_type') === $type)>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="service_commission_rate">Commission rate</label>
                                            <input id="service_commission_rate" type="number" step="0.01" min="0" name="commission_rate" value="{{ old('commission_rate') }}">
                                        </div>
                                        <div class="field">
                                            <label for="service_vat_rate">VAT rate</label>
                                            <input id="service_vat_rate" type="number" step="0.01" min="0" max="100" name="vat_rate" value="{{ old('vat_rate', 16) }}">
                                        </div>
                                        <div class="field">
                                            <label for="service_required_product_id">Required product</label>
                                            <select id="service_required_product_id" name="required_product_id">
                                                <option value="">No linked product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" @selected(old('required_product_id') == $product->id)>{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="service_required_quantity">Required quantity</label>
                                            <input id="service_required_quantity" type="number" step="0.01" min="0.01" name="required_product_quantity" value="{{ old('required_product_quantity') }}">
                                        </div>
                                        <div class="field-check">
                                            <input type="checkbox" name="vat_applicable" value="1" @checked(old('vat_applicable', true))>
                                            <span>VAT applicable</span>
                                        </div>
                                        <div class="field-check">
                                            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true))>
                                            <span>Active service</span>
                                        </div>
                                        <div class="wide-field">
                                            <label for="service_description">Description</label>
                                            <textarea id="service_description" name="description">{{ old('description') }}</textarea>
                                        </div>
                                    </div>

                                    <div style="margin-top: 20px;">
                                        <button class="button-accent" type="submit">Save service</button>
                                    </div>
                                </form>
                            </section>

                            <aside class="panel">
                                <h4 class="panel-title">Current services</h4>
                                <p class="panel-copy">Live treatment and grooming menu loaded into POS and booking forms.</p>

                                <div class="table-wrap" style="margin-top: 16px;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Service</th>
                                                <th>Price</th>
                                                <th>Duration</th>
                                                <th>Commission</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($services as $service)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $service->name }}</strong>
                                                        <div class="table-meta">{{ $service->category }} / {{ $service->gender_type }}</div>
                                                    </td>
                                                    <td>{{ $formatKes($service->price) }}</td>
                                                    <td>{{ $service->duration_minutes }} min</td>
                                                    <td>{{ $service->commission_type ? $service->commission_type.' '.$service->commission_rate : 'Staff default' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">No services created yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </aside>
                        </div>
                    </section>

                    <section class="content-section {{ $activeTab === 'inventory' ? 'is-active' : '' }}">
                        <div class="section-head">
                            <div>
                                <h3 class="section-title">Product inventory page</h3>
                                <p class="section-copy">Manage retail and consumable stock with buying price, selling price, VAT, reorder levels, expiry dates, and shelf location.</p>
                            </div>
                        </div>

                        <div class="form-layout">
                            <section class="panel">
                                <form method="post" action="{{ route('for-business.pos.products.store') }}">
                                    @csrf

                                    <div class="form-grid">
                                        <div class="field">
                                            <label for="product_branch_id">Branch</label>
                                            <select id="product_branch_id" name="branch_id">
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="product_name">Product name</label>
                                            <input id="product_name" type="text" name="name" value="{{ old('name') }}">
                                        </div>
                                        <div class="field">
                                            <label for="product_barcode">Barcode</label>
                                            <input id="product_barcode" type="text" name="barcode" value="{{ old('barcode') }}">
                                        </div>
                                        <div class="field">
                                            <label for="product_category">Category</label>
                                            <select id="product_category" name="category">
                                                @foreach ($options['productCategories'] as $category)
                                                    <option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="product_supplier">Supplier</label>
                                            <input id="product_supplier" type="text" name="supplier" value="{{ old('supplier') }}">
                                        </div>
                                        <div class="field">
                                            <label for="product_buying_price">Buying price</label>
                                            <input id="product_buying_price" type="number" step="0.01" min="0" name="buying_price" value="{{ old('buying_price') }}">
                                        </div>
                                        <div class="field">
                                            <label for="product_selling_price">Selling price</label>
                                            <input id="product_selling_price" type="number" step="0.01" min="0" name="selling_price" value="{{ old('selling_price') }}">
                                        </div>
                                        <div class="field">
                                            <label for="product_stock">Current stock</label>
                                            <input id="product_stock" type="number" step="0.01" min="0" name="current_stock" value="{{ old('current_stock', 0) }}">
                                        </div>
                                        <div class="field">
                                            <label for="product_reorder_level">Reorder level</label>
                                            <input id="product_reorder_level" type="number" step="0.01" min="0" name="reorder_level" value="{{ old('reorder_level', 0) }}">
                                        </div>
                                        <div class="field">
                                            <label for="product_expiry_date">Expiry date</label>
                                            <input id="product_expiry_date" type="date" name="expiry_date" value="{{ old('expiry_date') }}">
                                        </div>
                                        <div class="field">
                                            <label for="product_vat_rate">VAT rate</label>
                                            <input id="product_vat_rate" type="number" step="0.01" min="0" max="100" name="vat_rate" value="{{ old('vat_rate', 16) }}">
                                        </div>
                                        <div class="field">
                                            <label for="product_shelf">Shelf location</label>
                                            <input id="product_shelf" type="text" name="shelf_location" value="{{ old('shelf_location') }}">
                                        </div>
                                        <div class="field">
                                            <label for="product_commission_type">Product commission type</label>
                                            <select id="product_commission_type" name="commission_type">
                                                <option value="">No product commission</option>
                                                @foreach ($options['commissionTypes'] as $type)
                                                    <option value="{{ $type }}" @selected(old('commission_type') === $type)>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="product_commission_rate">Product commission rate</label>
                                            <input id="product_commission_rate" type="number" step="0.01" min="0" name="commission_rate" value="{{ old('commission_rate') }}">
                                        </div>
                                        <div class="field-check">
                                            <input type="checkbox" name="commission_enabled" value="1" @checked(old('commission_enabled'))>
                                            <span>Enable staff commission on this product</span>
                                        </div>
                                        <div class="field-check">
                                            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true))>
                                            <span>Active product</span>
                                        </div>
                                    </div>

                                    <div style="margin-top: 20px;">
                                        <button class="button-accent" type="submit">Save product</button>
                                    </div>
                                </form>
                            </section>

                            <aside class="panel">
                                <h4 class="panel-title">Inventory and stock alerts</h4>
                                <p class="panel-copy">Every product sold at checkout deducts stock automatically. Services can also consume mapped products when enabled during sale entry.</p>

                                <div class="metric-list" style="margin-top: 16px;">
                                    @forelse ($products as $product)
                                        <article class="metric-row">
                                            <div class="metric-top">
                                                <div>
                                                    <strong>{{ $product->name }}</strong>
                                                    <div class="table-meta">{{ $product->category }} / {{ $product->product_code }}</div>
                                                </div>
                                                <span class="badge {{ (float) $product->current_stock <= (float) $product->reorder_level ? 'badge-warning' : 'badge-success' }}">
                                                    {{ number_format((float) $product->current_stock, 2) }} in stock
                                                </span>
                                            </div>
                                            <div class="table-meta">Sell {{ $formatKes($product->selling_price) }} / Buy {{ $formatKes($product->buying_price) }} / Shelf {{ $product->shelf_location ?: 'Not set' }}</div>
                                        </article>
                                    @empty
                                        <div class="empty-state">No inventory items have been loaded into POS yet.</div>
                                    @endforelse
                                </div>
                            </aside>
                        </div>
                    </section>

                    <section class="content-section {{ $activeTab === 'staff' ? 'is-active' : '' }}">
                        <div class="section-head">
                            <div>
                                <h3 class="section-title">Staff commission page</h3>
                                <p class="section-copy">Add operational staff and monitor what they are selling, completing, and earning from commission rules.</p>
                            </div>
                        </div>

                        <div class="form-layout">
                            <section class="panel">
                                <form method="post" action="{{ route('for-business.pos.staff.store') }}">
                                    @csrf

                                    <div class="form-grid">
                                        <div class="field">
                                            <label for="staff_branch_id">Branch</label>
                                            <select id="staff_branch_id" name="branch_id">
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="staff_full_name">Full name</label>
                                            <input id="staff_full_name" type="text" name="full_name" value="{{ old('full_name') }}">
                                        </div>
                                        <div class="field">
                                            <label for="staff_role">Role</label>
                                            <select id="staff_role" name="role">
                                                @foreach ($options['staffRoles'] as $role)
                                                    <option value="{{ $role }}" @selected(old('role') === $role)>{{ $role }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="staff_phone_number">Phone number</label>
                                            <input id="staff_phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder="+2547...">
                                        </div>
                                        <div class="field">
                                            <label for="staff_email">Email</label>
                                            <input id="staff_email" type="email" name="email" value="{{ old('email') }}">
                                        </div>
                                        <div class="field">
                                            <label for="staff_commission_type">Commission type</label>
                                            <select id="staff_commission_type" name="commission_type">
                                                <option value="">No default commission</option>
                                                @foreach ($options['commissionTypes'] as $type)
                                                    <option value="{{ $type }}" @selected(old('commission_type') === $type)>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="staff_commission_rate">Commission rate</label>
                                            <input id="staff_commission_rate" type="number" step="0.01" min="0" name="commission_rate" value="{{ old('commission_rate') }}">
                                        </div>
                                        <div class="field">
                                            <label for="staff_status">Status</label>
                                            <select id="staff_status" name="status">
                                                @foreach ($options['statuses'] as $status)
                                                    <option value="{{ $status }}" @selected(old('status', 'Active') === $status)>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="wide-field">
                                            <label for="staff_shift_schedule">Shift schedule</label>
                                            <input id="staff_shift_schedule" type="text" name="shift_schedule" value="{{ old('shift_schedule') }}" placeholder="Mon-Sat / 9:00 am - 7:00 pm">
                                        </div>
                                        <div class="field-check">
                                            <input type="checkbox" name="can_receive_product_commission" value="1" @checked(old('can_receive_product_commission'))>
                                            <span>Can receive commission on products</span>
                                        </div>
                                    </div>

                                    <div style="margin-top: 20px;">
                                        <button class="button-accent" type="submit">Save staff member</button>
                                    </div>
                                </form>
                            </section>

                            <aside class="panel">
                                <h4 class="panel-title">Staff performance and commission</h4>
                                <p class="panel-copy">Sales volume, completed appointments, and commission totals by team member.</p>

                                <div class="metric-list" style="margin-top: 16px;">
                                    @forelse ($report['staffPerformance'] as $staff)
                                        <article class="metric-row">
                                            <div class="metric-top">
                                                <div>
                                                    <strong>{{ $staff->full_name }}</strong>
                                                    <div class="table-meta">{{ $staff->role }} / {{ $staff->status }}</div>
                                                </div>
                                                <span class="badge badge-teal">{{ $formatKes($staff->commission_total ?? 0) }}</span>
                                            </div>
                                            <div class="table-meta">
                                                Sales {{ $formatKes($staff->sales_total ?? 0) }} / Completed appointments {{ $staff->completed_appointments_count ?? 0 }}
                                            </div>
                                        </article>
                                    @empty
                                        <div class="empty-state">No staff records yet.</div>
                                    @endforelse
                                </div>

                                <div style="margin-top: 18px;">
                                    <div class="kicker">Latest commission entries</div>
                                    <div class="metric-list" style="margin-top: 12px;">
                                        @forelse ($report['staffCommissions'] as $commission)
                                            <article class="metric-row">
                                                <div class="metric-top">
                                                    <strong>{{ $commission->staff?->full_name ?? 'Staff' }}</strong>
                                                    <span class="badge badge-copper">{{ $formatKes($commission->commission_amount) }}</span>
                                                </div>
                                                <div class="table-meta">{{ $commission->source_type }} / {{ $commission->commission_date?->format('j M Y') }}</div>
                                            </article>
                                        @empty
                                            <div class="empty-state">Commission rows will appear once sales are processed.</div>
                                        @endforelse
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </section>

                    <section class="content-section {{ $activeTab === 'reports' ? 'is-active' : '' }}">
                        <div class="section-head">
                            <div>
                                <h3 class="section-title">Reports page</h3>
                                <p class="section-copy">Monitor sales, commissions, customer retention, appointment status, M-Pesa reconciliation, expenses, and the business profit picture from one reporting surface.</p>
                            </div>
                        </div>

                        <div class="split-grid">
                            <article class="panel">
                                <div class="metric-kicker">Daily sales</div>
                                <div class="metric-value">{{ $formatKes($report['dailySales']) }}</div>
                            </article>
                            <article class="panel">
                                <div class="metric-kicker">Monthly sales</div>
                                <div class="metric-value">{{ $formatKes($report['monthlySales']) }}</div>
                            </article>
                            <article class="panel">
                                <div class="metric-kicker">Profit summary</div>
                                <div class="metric-value">{{ $formatKes($report['estimatedProfit']) }}</div>
                            </article>
                        </div>

                        <div class="wide-grid" style="margin-top: 20px;">
                            <section class="panel">
                                <h4 class="panel-title">Recorded expenses</h4>
                                <p class="panel-copy">Capture rent, salaries, supplies, utilities, marketing, transport, and maintenance against the month.</p>

                                <form method="post" action="{{ route('for-business.pos.expenses.store') }}" style="margin-top: 16px;">
                                    @csrf

                                    <div class="form-grid">
                                        <div class="field">
                                            <label for="expense_branch_id">Branch</label>
                                            <select id="expense_branch_id" name="branch_id">
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="expense_category">Expense category</label>
                                            <select id="expense_category" name="expense_category">
                                                @foreach ($options['expenseCategories'] as $category)
                                                    <option value="{{ $category }}" @selected(old('expense_category') === $category)>{{ $category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="expense_amount">Amount</label>
                                            <input id="expense_amount" type="number" step="0.01" min="0" name="amount" value="{{ old('amount') }}">
                                        </div>
                                        <div class="field">
                                            <label for="expense_vendor">Vendor</label>
                                            <input id="expense_vendor" type="text" name="vendor" value="{{ old('vendor') }}">
                                        </div>
                                        <div class="field">
                                            <label for="expense_payment_method">Payment method</label>
                                            <select id="expense_payment_method" name="payment_method">
                                                @foreach ($options['paymentMethods'] as $method)
                                                    <option value="{{ $method }}" @selected(old('payment_method', 'Cash') === $method)>{{ $method }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="expense_date">Expense date</label>
                                            <input id="expense_date" type="date" name="expense_date" value="{{ old('expense_date', now()->toDateString()) }}">
                                        </div>
                                        <div class="wide-field">
                                            <label for="expense_notes">Notes</label>
                                            <textarea id="expense_notes" name="notes">{{ old('notes') }}</textarea>
                                        </div>
                                    </div>

                                    <div style="margin-top: 20px;">
                                        <button class="button-accent" type="submit">Save expense</button>
                                    </div>
                                </form>
                            </section>

                            <aside class="panel">
                                <h4 class="panel-title">Expense feed</h4>
                                <p class="panel-copy">Latest operational costs already logged into reports.</p>

                                <div class="metric-list" style="margin-top: 16px;">
                                    @forelse ($report['recentExpenses'] as $expense)
                                        <article class="expense-row">
                                            <div class="expense-top">
                                                <div>
                                                    <strong>{{ $expense->expense_category }}</strong>
                                                    <div class="table-meta">{{ $expense->vendor ?: 'No vendor' }} / {{ $expense->expense_date?->format('j M Y') }}</div>
                                                </div>
                                                <span class="badge badge-danger">{{ $formatKes($expense->amount) }}</span>
                                            </div>
                                            <div class="table-meta">{{ $expense->payment_method }} / {{ $expense->notes ?: 'No notes' }}</div>
                                        </article>
                                    @empty
                                        <div class="empty-state">No expenses logged yet.</div>
                                    @endforelse
                                </div>
                            </aside>
                        </div>
                    </section>

                    <section class="content-section {{ $activeTab === 'settings' ? 'is-active' : '' }}">
                        <div class="section-head">
                            <div>
                                <h3 class="section-title">Settings page</h3>
                                <p class="section-copy">Maintain branches, rooms or chairs, and the role-permission map the module is ready to support as the business grows into a multi-branch setup.</p>
                            </div>
                        </div>

                        <div class="wide-grid">
                            <section class="panel">
                                <h4 class="panel-title">Rooms, chairs, and resources</h4>
                                <p class="panel-copy">Create schedulable spaces for conflict-aware appointment booking.</p>

                                <form method="post" action="{{ route('for-business.pos.resources.store') }}" style="margin-top: 16px;">
                                    @csrf

                                    <div class="form-grid">
                                        <div class="field">
                                            <label for="resource_branch_id">Branch</label>
                                            <select id="resource_branch_id" name="branch_id">
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="resource_name">Name</label>
                                            <input id="resource_name" type="text" name="name" value="{{ old('name') }}" placeholder="Chair 2 or Treatment Room A">
                                        </div>
                                        <div class="field">
                                            <label for="resource_type">Resource type</label>
                                            <select id="resource_type" name="resource_type">
                                                @foreach ($options['resourceTypes'] as $type)
                                                    <option value="{{ $type }}" @selected(old('resource_type', 'Chair') === $type)>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="field">
                                            <label for="resource_status">Status</label>
                                            <select id="resource_status" name="status">
                                                @foreach ($options['statuses'] as $status)
                                                    <option value="{{ $status }}" @selected(old('status', 'Active') === $status)>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="wide-field">
                                            <label for="resource_notes">Notes</label>
                                            <textarea id="resource_notes" name="notes">{{ old('notes') }}</textarea>
                                        </div>
                                    </div>

                                    <div style="margin-top: 20px;">
                                        <button class="button-accent" type="submit">Save resource</button>
                                    </div>
                                </form>

                                <div class="resource-grid" style="margin-top: 20px;">
                                    @forelse ($resources as $resource)
                                        <article class="resource-card">
                                            <div class="metric-top">
                                                <div>
                                                    <strong>{{ $resource->name }}</strong>
                                                    <div class="table-meta">{{ $resource->resource_code }} / {{ $resource->resource_type }}</div>
                                                </div>
                                                <span class="badge badge-teal">{{ $resource->status }}</span>
                                            </div>
                                            <div class="table-meta">{{ $resource->notes ?: 'No notes' }}</div>
                                        </article>
                                    @empty
                                        <div class="empty-state">No rooms or chairs have been configured yet.</div>
                                    @endforelse
                                </div>
                            </section>

                            <aside class="panel">
                                <h4 class="panel-title">Branches and permissions</h4>
                                <p class="panel-copy">Primary branch data today, multi-branch ready structure tomorrow.</p>

                                <div class="branch-grid" style="margin-top: 16px;">
                                    @foreach ($branches as $branch)
                                        <article class="branch-card">
                                            <div class="metric-top">
                                                <div>
                                                    <strong>{{ $branch->name }}</strong>
                                                    <div class="table-meta">{{ $branch->branch_code }} / {{ $branch->city ?: 'City pending' }}</div>
                                                </div>
                                                <span class="badge {{ $branch->is_primary ? 'badge-copper' : 'badge-teal' }}">{{ $branch->is_primary ? 'Primary' : 'Branch' }}</span>
                                            </div>
                                            <div class="table-meta">{{ $branch->address_line ?: 'Address pending' }}<br>{{ $branch->phone ?: 'No phone' }} / {{ $branch->email ?: 'No email' }}</div>
                                        </article>
                                    @endforeach
                                </div>

                                <div style="margin-top: 20px;">
                                    <div class="kicker">Role permissions</div>
                                    <div class="role-grid" style="margin-top: 12px;">
                                        @foreach ($options['permissionMatrix'] as $role => $permissions)
                                            <article class="role-card">
                                                <strong>{{ $role }}</strong>
                                                <div class="permission-list" style="margin-top: 10px;">
                                                    @foreach ($permissions as $permission)
                                                        <span class="pill pill-teal">{{ $permission }}</span>
                                                    @endforeach
                                                </div>
                                            </article>
                                        @endforeach
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </section>
                </div>
            </main>
        </div>

        <template id="service-row-template">
            <div class="checkout-item">
                <div class="checkout-grid">
                    <div class="field">
                        <label>Service</label>
                        <select name="service_items[__INDEX__][service_id]">
                            <option value="">Select service</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} / {{ $formatKes($service->price) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Staff</label>
                        <select name="service_items[__INDEX__][staff_id]">
                            <option value="">Default staff</option>
                            @foreach ($staffMembers as $staff)
                                <option value="{{ $staff->id }}">{{ $staff->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Qty</label>
                        <input type="number" step="1" min="1" name="service_items[__INDEX__][quantity]" value="1">
                    </div>
                    <div class="field">
                        <label>Discount</label>
                        <input type="number" step="0.01" min="0" name="service_items[__INDEX__][discount_amount]" value="0">
                    </div>
                    <div class="field-check">
                        <input type="checkbox" name="service_items[__INDEX__][deduct_products]" value="1">
                        <span>Deduct required products</span>
                    </div>
                    <div class="row-actions">
                        <button class="button-small" type="button" data-remove-row>Remove</button>
                    </div>
                </div>
            </div>
        </template>

        <template id="product-row-template">
            <div class="checkout-item">
                <div class="checkout-grid">
                    <div class="field">
                        <label>Product</label>
                        <select name="product_items[__INDEX__][product_id]">
                            <option value="">Select product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} / {{ $formatKes($product->selling_price) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Staff</label>
                        <select name="product_items[__INDEX__][staff_id]">
                            <option value="">Default staff</option>
                            @foreach ($staffMembers as $staff)
                                <option value="{{ $staff->id }}">{{ $staff->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Qty</label>
                        <input type="number" step="0.01" min="0.01" name="product_items[__INDEX__][quantity]" value="1">
                    </div>
                    <div class="field">
                        <label>Discount</label>
                        <input type="number" step="0.01" min="0" name="product_items[__INDEX__][discount_amount]" value="0">
                    </div>
                    <div></div>
                    <div class="row-actions">
                        <button class="button-small" type="button" data-remove-row>Remove</button>
                    </div>
                </div>
            </div>
        </template>

        <template id="package-row-template">
            <div class="checkout-item">
                <div class="checkout-grid" style="grid-template-columns: 1.4fr 1fr 0.8fr 0.9fr 0.9fr auto;">
                    <div class="field">
                        <label>Package name</label>
                        <input type="text" name="package_items[__INDEX__][name]" placeholder="Weekend grooming package">
                    </div>
                    <div class="field">
                        <label>Staff</label>
                        <select name="package_items[__INDEX__][staff_id]">
                            <option value="">Default staff</option>
                            @foreach ($staffMembers as $staff)
                                <option value="{{ $staff->id }}">{{ $staff->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Qty</label>
                        <input type="number" step="1" min="1" name="package_items[__INDEX__][quantity]" value="1">
                    </div>
                    <div class="field">
                        <label>Unit price</label>
                        <input type="number" step="0.01" min="0" name="package_items[__INDEX__][unit_price]" value="0">
                    </div>
                    <div class="field">
                        <label>Discount</label>
                        <input type="number" step="0.01" min="0" name="package_items[__INDEX__][discount_amount]" value="0">
                    </div>
                    <div class="row-actions">
                        <button class="button-small" type="button" data-remove-row>Remove</button>
                    </div>
                </div>
            </div>
        </template>

        <template id="payment-row-template">
            <div class="checkout-item">
                <div class="payment-grid">
                    <div class="field">
                        <label>Method</label>
                        <select name="payments[__INDEX__][payment_method]">
                            @foreach ($options['paymentMethods'] as $method)
                                <option value="{{ $method }}">{{ $method }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Amount</label>
                        <input type="number" step="0.01" min="0.01" name="payments[__INDEX__][amount]" value="0">
                    </div>
                    <div class="field">
                        <label>Status</label>
                        <select name="payments[__INDEX__][status]">
                            @foreach ($options['paymentStatuses'] as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Reference / code</label>
                        <input type="text" name="payments[__INDEX__][reference]" placeholder="Card slip or bank ref">
                    </div>
                    <div class="field">
                        <label>M-Pesa phone</label>
                        <input type="text" name="payments[__INDEX__][phone_number]" placeholder="+2547...">
                    </div>
                    <div class="field">
                        <label>Till / Paybill</label>
                        <input type="text" name="payments[__INDEX__][till_or_paybill]" placeholder="Till or Paybill">
                    </div>
                    <div class="row-actions">
                        <button class="button-small" type="button" data-remove-row>Remove</button>
                    </div>
                </div>
                <div class="payment-grid" style="grid-template-columns: 1fr 1fr 2fr;">
                    <div class="field">
                        <label>M-Pesa code</label>
                        <input type="text" name="payments[__INDEX__][mpesa_code]" placeholder="SE2K7H98TQ">
                    </div>
                    <div class="field">
                        <label>Paid at</label>
                        <input type="datetime-local" name="payments[__INDEX__][paid_at]" value="{{ now()->format('Y-m-d\TH:i') }}">
                    </div>
                    <div class="field">
                        <label>Notes</label>
                        <input type="text" name="payments[__INDEX__][notes]" placeholder="Split with cash or customer will clear later">
                    </div>
                </div>
            </div>
        </template>

        <script>
            (() => {
                const definitions = {
                    service: { listId: 'service-item-list', templateId: 'service-row-template', groupName: 'service_items' },
                    product: { listId: 'product-item-list', templateId: 'product-row-template', groupName: 'product_items' },
                    package: { listId: 'package-item-list', templateId: 'package-row-template', groupName: 'package_items' },
                    payment: { listId: 'payment-item-list', templateId: 'payment-row-template', groupName: 'payments' },
                };

                const nextIndex = (container, groupName) => {
                    const fields = container.querySelectorAll(`[name^="${groupName}["]`);
                    return fields.length === 0 ? 0 : fields.length;
                };

                document.querySelectorAll('[data-add-row]').forEach((button) => {
                    button.addEventListener('click', () => {
                        const key = button.getAttribute('data-add-row');
                        const definition = definitions[key];

                        if (!definition) {
                            return;
                        }

                        const container = document.getElementById(definition.listId);
                        const template = document.getElementById(definition.templateId);
                        const index = nextIndex(container, definition.groupName);
                        const html = template.innerHTML.replaceAll('__INDEX__', String(index));
                        container.insertAdjacentHTML('beforeend', html);
                    });
                });

                document.addEventListener('click', (event) => {
                    const trigger = event.target.closest('[data-remove-row]');

                    if (!trigger) {
                        return;
                    }

                    const row = trigger.closest('.checkout-item');
                    const parent = row?.parentElement;

                    if (!row || !parent) {
                        return;
                    }

                    if (parent.children.length === 1) {
                        return;
                    }

                    row.remove();
                });
            })();
        </script>
    </body>
</html>
