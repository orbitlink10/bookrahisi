<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book {{ $accountSetup['business_name'] }} | Book Rahisi</title>
        <meta
            name="description"
            content="Choose a service, time, and staff member to book at {{ $accountSetup['business_name'] }}."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            :root {
                --ink: #111317;
                --muted: #69707d;
                --line: #dde1e8;
                --soft: #f5f7fb;
                --dark: #0f1012;
                --accent: #6956ff;
                --success: #107c41;
                --success-soft: #eef9f2;
                --danger: #c62828;
                --danger-soft: #fff2f1;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                background: #f8f9fc;
                color: var(--ink);
                font-family: 'Manrope', sans-serif;
            }

            a {
                color: inherit;
                text-decoration: none;
            }

            button,
            input,
            textarea {
                font: inherit;
            }

            .shell {
                width: min(100%, 1440px);
                margin: 0 auto;
                padding: 30px 24px 42px;
            }

            .topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                margin-bottom: 24px;
            }

            .topbar a {
                font-weight: 800;
            }

            .back-link {
                color: var(--muted);
            }

            .page-title {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(2.2rem, 4vw, 3.6rem);
                letter-spacing: -0.06em;
                line-height: 1;
            }

            .subtitle {
                margin: 10px 0 0;
                color: var(--muted);
                line-height: 1.75;
            }

            .layout {
                display: grid;
                grid-template-columns: minmax(0, 1.15fr) 360px;
                gap: 26px;
                margin-top: 24px;
            }

            .panel,
            .summary-card {
                border: 1px solid var(--line);
                border-radius: 28px;
                background: #fff;
                box-shadow: 0 12px 36px rgba(17, 19, 23, 0.04);
            }

            .booking-panel {
                padding: 28px;
            }

            .summary-card {
                position: sticky;
                top: 24px;
                align-self: start;
                overflow: hidden;
            }

            .summary-head,
            .summary-block {
                padding: 26px 28px;
            }

            .summary-block {
                border-top: 1px solid var(--line);
            }

            .summary-head h2 {
                margin: 0;
                font-family: 'Outfit', sans-serif;
                font-size: 2.6rem;
                line-height: 0.94;
                letter-spacing: -0.05em;
            }

            .summary-subtitle {
                margin: 12px 0 0;
                color: var(--muted);
                line-height: 1.7;
            }

            .section {
                padding-bottom: 28px;
            }

            .section:last-child {
                padding-bottom: 0;
            }

            .section h3 {
                margin: 0 0 16px;
                font-family: 'Outfit', sans-serif;
                font-size: 1.55rem;
                letter-spacing: -0.04em;
            }

            .service-list {
                display: grid;
                gap: 14px;
            }

            .service-option {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                padding: 18px 20px;
                border: 1px solid var(--line);
                border-radius: 20px;
                background: #fff;
            }

            .service-option.is-active {
                border-color: var(--dark);
                box-shadow: inset 0 0 0 1px var(--dark);
            }

            .service-name {
                font-size: 1rem;
                font-weight: 800;
            }

            .service-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 8px;
                color: var(--muted);
                font-size: 0.94rem;
            }

            .select-link {
                color: var(--accent);
                font-size: 0.94rem;
                font-weight: 800;
            }

            .choice-grid,
            .time-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
                gap: 12px;
            }

            .choice-card input,
            .time-card input {
                position: absolute;
                opacity: 0;
                pointer-events: none;
            }

            .choice-label,
            .time-label {
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 82px;
                padding: 14px 16px;
                border: 1px solid var(--line);
                border-radius: 20px;
                background: #fff;
                text-align: center;
                cursor: pointer;
                transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
            }

            .choice-card input:checked + .choice-label,
            .time-card input:checked + .time-label {
                border-color: var(--dark);
                box-shadow: inset 0 0 0 1px var(--dark);
                background: var(--soft);
            }

            .choice-stack {
                display: grid;
                gap: 4px;
            }

            .choice-day {
                font-size: 0.85rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                color: var(--muted);
            }

            .choice-date {
                font-size: 1rem;
                font-weight: 800;
            }

            .staff-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
                gap: 14px;
            }

            .staff-card {
                display: flex;
                align-items: center;
                gap: 14px;
                padding: 16px 18px;
                border: 1px solid var(--line);
                border-radius: 20px;
                background: #fff;
            }

            .staff-card.is-active {
                border-color: var(--dark);
                box-shadow: inset 0 0 0 1px var(--dark);
            }

            .staff-avatar {
                width: 58px;
                height: 58px;
                border-radius: 50%;
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
                flex: none;
            }

            .staff-details {
                display: grid;
                gap: 4px;
            }

            .staff-name {
                font-size: 0.98rem;
                font-weight: 800;
            }

            .staff-role {
                color: var(--muted);
                font-size: 0.92rem;
            }

            .staff-rating {
                color: var(--accent);
                font-size: 0.88rem;
                font-weight: 800;
            }

            .field-grid {
                display: grid;
                gap: 16px;
            }

            .field-label {
                display: grid;
                gap: 10px;
                font-size: 0.92rem;
                font-weight: 800;
            }

            .field-input,
            .field-textarea {
                width: 100%;
                border: 1px solid var(--line);
                border-radius: 18px;
                background: #fff;
                color: var(--ink);
                outline: none;
            }

            .field-input {
                min-height: 60px;
                padding: 0 18px;
            }

            .field-textarea {
                min-height: 140px;
                padding: 16px 18px;
                resize: vertical;
            }

            .field-error-state {
                border-color: var(--danger);
                background: var(--danger-soft);
            }

            .field-error {
                color: var(--danger);
                font-size: 0.88rem;
                font-weight: 700;
            }

            .error-summary,
            .success-banner {
                margin-bottom: 18px;
                padding: 14px 16px;
                border-radius: 18px;
                font-size: 0.94rem;
                font-weight: 700;
            }

            .error-summary {
                border: 1px solid rgba(198, 40, 40, 0.18);
                background: var(--danger-soft);
                color: var(--danger);
            }

            .success-banner {
                border: 1px solid rgba(16, 124, 65, 0.16);
                background: var(--success-soft);
                color: var(--success);
            }

            .submit-row {
                display: flex;
                flex-wrap: wrap;
                gap: 14px;
                margin-top: 22px;
            }

            .button-dark,
            .button-light {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 220px;
                padding: 18px 24px;
                border-radius: 999px;
                font-size: 0.96rem;
                font-weight: 800;
            }

            .button-dark {
                border: 0;
                background: var(--dark);
                color: #fff;
                cursor: pointer;
            }

            .button-light {
                border: 1px solid var(--line);
                background: #fff;
                color: var(--ink);
            }

            .summary-line {
                display: grid;
                gap: 6px;
                margin-bottom: 18px;
            }

            .summary-line:last-child {
                margin-bottom: 0;
            }

            .summary-label {
                color: var(--muted);
                font-size: 0.8rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .summary-value {
                font-size: 1rem;
                font-weight: 800;
            }

            .summary-helper {
                color: var(--muted);
                line-height: 1.7;
            }

            @media (max-width: 1080px) {
                .layout {
                    grid-template-columns: 1fr;
                }

                .summary-card {
                    position: static;
                }
            }

            @media (max-width: 760px) {
                .shell {
                    padding: 24px 16px 36px;
                }

                .topbar,
                .submit-row {
                    flex-direction: column;
                    align-items: stretch;
                }

                .service-option {
                    flex-direction: column;
                    align-items: stretch;
                }

                .button-dark,
                .button-light {
                    width: 100%;
                    min-width: 0;
                }
            }
        </style>
    </head>
    <body>
        @php
            $selectedServiceSlug = old('service', $selectedService['slug']);
            $selectedStaffSlug = old('staff', $selectedStaff['slug']);
            $selectedDate = old('appointment_date', $bookingDates[0]['value']);
            $selectedTime = old('appointment_time', $timeSlots[0]);
        @endphp

        <div class="shell">
            <div class="topbar">
                <a class="back-link" href="{{ route('business.show', ['slug' => $businessSlug]) }}">Back to business page</a>
                <a href="{{ route('home') }}">bookrahisi</a>
            </div>

            <h1 class="page-title">Book your appointment</h1>
            <p class="subtitle">
                Choose a service, date, time, and team member for {{ $accountSetup['business_name'] }}.
                {{ $addressLine }}.
            </p>

            <div class="layout">
                <section class="panel booking-panel">
                    @if (session('booking_success'))
                        <div class="success-banner">{{ session('booking_success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="error-summary">Complete the highlighted booking details before continuing.</div>
                    @endif

                    <form action="{{ route('business.book.submit', ['slug' => $businessSlug]) }}" method="post">
                        @csrf
                        <input type="hidden" name="service" value="{{ $selectedServiceSlug }}">
                        <input type="hidden" name="staff" value="{{ $selectedStaffSlug }}">

                        <section class="section">
                            <h3>Choose a service</h3>
                            <div class="service-list">
                                @foreach ($services as $service)
                                    @php
                                        $serviceSlug = \Illuminate\Support\Str::slug($service['name']);
                                    @endphp
                                    <a
                                        class="service-option {{ $selectedServiceSlug === $serviceSlug ? 'is-active' : '' }}"
                                        href="{{ route('business.book', ['slug' => $businessSlug, 'service' => $serviceSlug, 'staff' => $selectedStaffSlug]) }}"
                                    >
                                        <div>
                                            <div class="service-name">{{ $service['name'] }}</div>
                                            <div class="service-meta">
                                                <span>{{ $service['duration'] }}</span>
                                                <span>{{ $service['price'] }}</span>
                                            </div>
                                        </div>
                                        <span class="select-link">{{ $selectedServiceSlug === $serviceSlug ? 'Selected' : 'Select' }}</span>
                                    </a>
                                @endforeach
                            </div>
                            @error('service')
                                <div class="field-error" style="margin-top: 10px;">{{ $message }}</div>
                            @enderror
                        </section>

                        <section class="section">
                            <h3>Choose a date</h3>
                            <div class="choice-grid">
                                @foreach ($bookingDates as $bookingDate)
                                    <label class="choice-card">
                                        <input type="radio" name="appointment_date" value="{{ $bookingDate['value'] }}" {{ $selectedDate === $bookingDate['value'] ? 'checked' : '' }}>
                                        <span class="choice-label">
                                            <span class="choice-stack">
                                                <span class="choice-day">{{ $bookingDate['label'] }}</span>
                                                <span class="choice-date">{{ $bookingDate['display'] }}</span>
                                            </span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            @error('appointment_date')
                                <div class="field-error" style="margin-top: 10px;">{{ $message }}</div>
                            @enderror
                        </section>

                        <section class="section">
                            <h3>Choose a time</h3>
                            <div class="time-grid">
                                @foreach ($timeSlots as $timeSlot)
                                    <label class="time-card">
                                        <input type="radio" name="appointment_time" value="{{ $timeSlot }}" {{ $selectedTime === $timeSlot ? 'checked' : '' }}>
                                        <span class="time-label">{{ $timeSlot }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('appointment_time')
                                <div class="field-error" style="margin-top: 10px;">{{ $message }}</div>
                            @enderror
                        </section>

                        <section class="section">
                            <h3>Choose a professional</h3>
                            <div class="staff-grid">
                                @foreach ($staffMembers as $staffMember)
                                    <a
                                        class="staff-card {{ $selectedStaffSlug === $staffMember['slug'] ? 'is-active' : '' }}"
                                        href="{{ route('business.book', ['slug' => $businessSlug, 'service' => $selectedServiceSlug, 'staff' => $staffMember['slug']]) }}"
                                    >
                                        <span class="staff-avatar" style="background-image: url('{{ $staffMember['image'] }}');"></span>
                                        <span class="staff-details">
                                            <span class="staff-name">{{ $staffMember['name'] }}</span>
                                            <span class="staff-role">{{ $staffMember['role'] }}</span>
                                            <span class="staff-rating">&#9733; {{ $staffMember['rating'] }}</span>
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                            @error('staff')
                                <div class="field-error" style="margin-top: 10px;">{{ $message }}</div>
                            @enderror
                        </section>

                        <section class="section">
                            <h3>Your details</h3>
                            <div class="field-grid">
                                <label class="field-label">
                                    Full name
                                    <input class="field-input @error('customer_name') field-error-state @enderror" type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Enter your full name">
                                    @error('customer_name')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </label>

                                <label class="field-label">
                                    Phone number
                                    <input class="field-input @error('customer_phone') field-error-state @enderror" type="text" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="+254 7xx xxx xxx">
                                    @error('customer_phone')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </label>

                                <label class="field-label">
                                    Notes for the business
                                    <textarea class="field-textarea @error('customer_notes') field-error-state @enderror" name="customer_notes" placeholder="Optional booking notes">{{ old('customer_notes') }}</textarea>
                                    @error('customer_notes')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                        </section>

                        <div class="submit-row">
                            <button class="button-dark" type="submit">Confirm booking request</button>
                            <a class="button-light" href="{{ route('business.show', ['slug' => $businessSlug]) }}">Return to services</a>
                        </div>
                    </form>
                </section>

                <aside class="summary-card">
                    <div class="summary-head">
                        <h2>{{ $accountSetup['business_name'] }}</h2>
                        <p class="summary-subtitle">{{ $openSummary }}</p>
                    </div>

                    <div class="summary-block">
                        <div class="summary-line">
                            <span class="summary-label">Selected service</span>
                            <span class="summary-value">{{ $selectedService['name'] }}</span>
                            <span class="summary-helper">{{ $selectedService['duration'] }} / {{ $selectedService['price'] }}</span>
                        </div>

                        <div class="summary-line">
                            <span class="summary-label">Selected professional</span>
                            <span class="summary-value">{{ $selectedStaff['name'] }}</span>
                            <span class="summary-helper">{{ $selectedStaff['role'] }}</span>
                        </div>

                        <div class="summary-line">
                            <span class="summary-label">Chosen slot</span>
                            <span class="summary-value">
                                @foreach ($bookingDates as $bookingDate)
                                    @if ($bookingDate['value'] === $selectedDate)
                                        {{ $bookingDate['label'] }}, {{ $bookingDate['display'] }}
                                    @endif
                                @endforeach
                            </span>
                            <span class="summary-helper">{{ $selectedTime }}</span>
                        </div>
                    </div>

                    <div class="summary-block">
                        <div class="summary-line">
                            <span class="summary-label">Location</span>
                            <span class="summary-value">{{ $addressLine }}</span>
                        </div>

                        <div class="summary-line">
                            <span class="summary-label">Booking note</span>
                            <span class="summary-helper">
                                This request is submitted live. The business owner will see it in their bookings dashboard as soon as you confirm it.
                            </span>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </body>
</html>
