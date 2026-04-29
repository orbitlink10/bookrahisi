<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi Customer | Dashboard</title>
        <meta
            name="description"
            content="Search businesses, manage appointments, track payments, and review completed visits from your Book Rahisi customer dashboard."
        >
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|manrope:400,500,600,700,800" rel="stylesheet" />
        <style>
            @include('partials.customer-console-styles')
        </style>
    </head>
    <body>
        <div class="console-app">
            @include('partials.customer-console-sidebar', ['customer' => $customer])

            <main class="workspace">
                <div class="workspace-shell">
                    <div class="topbar">
                        <div>
                            <span class="eyebrow">Customer control center</span>
                            <h1>Customer dashboard</h1>
                            <p class="subtitle">
                                Search approved businesses, book new appointments, monitor payment status, and keep your account ready for your next visit.
                            </p>
                        </div>

                        <div class="toolbar">
                            <a class="button-light" href="{{ route('home') }}">Back to marketplace</a>
                            <form action="{{ route('customer.sign-out') }}" method="post">
                                @csrf
                                <button class="button-dark" type="submit">Sign out</button>
                            </form>
                        </div>
                    </div>

                    @if (session('customer_success'))
                        <div class="success-banner">{{ session('customer_success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="error-banner">One or more customer actions could not be completed. Review the submitted values and try again.</div>
                    @endif

                    <section class="hero-card">
                        <div>
                            <span class="eyebrow" style="background: rgba(255, 255, 255, 0.16); color: #fff;">Live booking access</span>
                            <h2>Welcome, {{ $customer->name }}</h2>
                            <p class="hero-copy">
                                Use your Book Rahisi account to search approved salons, spas, and fitness businesses, keep upcoming appointments organized, and publish reviews after completed visits.
                            </p>
                            <div class="hero-actions">
                                <a class="button-dark" href="#browse">Browse businesses</a>
                                <a class="button-light" href="{{ route('customer.bookings') }}">Manage appointments</a>
                            </div>
                        </div>

                        <div class="hero-side">
                            <span class="hero-tag">Customer online</span>
                            <div class="hero-amount">{{ $upcomingBookings }}</div>
                            <div class="hero-caption">Upcoming appointments</div>
                        </div>
                    </section>

                    <section class="stats-grid">
                        <article class="stat-card">
                            <div class="stat-label">Upcoming bookings</div>
                            <div class="stat-value">{{ $upcomingBookings }}</div>
                            <div class="stat-pill">Needs attention</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Completed visits</div>
                            <div class="stat-value">{{ $completedBookings }}</div>
                            <div class="stat-pill is-success">History tracked</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Pending payments</div>
                            <div class="stat-value">{{ $pendingPayments }}</div>
                            <div class="stat-pill is-warning">Awaiting update</div>
                        </article>
                        <article class="stat-card">
                            <div class="stat-label">Reviews posted</div>
                            <div class="stat-value">{{ $reviewCount }}</div>
                            <div class="stat-pill is-success">Public feedback</div>
                        </article>
                    </section>

                    <div class="panel-stack">
                        <section class="panel" id="browse">
                            <div class="panel-head">
                                <div>
                                    <h2 class="panel-title">Browse Businesses</h2>
                                    <p class="panel-copy">Search the approved Book Rahisi marketplace by business name, city, neighborhood, or category before you place your next booking.</p>
                                </div>
                            </div>

                            <form class="search-form" action="{{ route('customer.dashboard') }}" method="get">
                                <div class="search-form-row">
                                    <input class="field-input" type="text" name="q" value="{{ $searchTerm }}" placeholder="Search by business name, category, or neighborhood">
                                    <select class="field-select" name="city">
                                        <option value="">All cities</option>
                                        @foreach ($cities as $cityOption)
                                            <option value="{{ $cityOption }}" {{ $searchCity === $cityOption ? 'selected' : '' }}>{{ $cityOption }}</option>
                                        @endforeach
                                    </select>
                                    <select class="field-select" name="category">
                                        <option value="">All categories</option>
                                        @foreach ($categories as $categoryOption)
                                            <option value="{{ $categoryOption }}" {{ $searchCategory === $categoryOption ? 'selected' : '' }}>{{ $categoryOption }}</option>
                                        @endforeach
                                    </select>
                                    <button class="button-inline" type="submit">Search</button>
                                </div>
                            </form>

                            @if ($businesses->isEmpty())
                                <div class="empty-state">No approved businesses matched the current search filters. Adjust the query or remove a filter to continue browsing.</div>
                            @else
                                <div class="business-grid" style="margin-top: 18px;">
                                    @foreach ($businesses as $business)
                                        <article class="business-card">
                                            <h3>{{ $business->business_name }}</h3>
                                            <div class="meta">
                                                {{ $business->business_category }} / {{ $business->neighborhood }}, {{ $business->city }}
                                            </div>
                                            <div class="chip-row">
                                                <span class="status-chip">{{ $business->reviews_count }} reviews</span>
                                                <span class="status-chip is-success">{{ $business->bookings_count }} bookings</span>
                                            </div>
                                            <div class="helper-copy">{{ $business->tagline }}</div>
                                            <div class="business-actions">
                                                <a class="button-light" href="{{ route('business.show', ['slug' => $business->slug]) }}">View business</a>
                                                <a class="button-dark" href="{{ route('business.book', ['slug' => $business->slug]) }}">Book now</a>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @endif
                        </section>

                        <section class="panel">
                            <div class="panel-head">
                                <div>
                                    <h2 class="panel-title">Recent Activity</h2>
                                    <p class="panel-copy">Your newest appointments appear here first. Open the bookings page for cancellations, payment tracking, and review submission.</p>
                                </div>
                                <a class="button-light" href="{{ route('customer.bookings') }}">Open all bookings</a>
                            </div>

                            @if ($recentBookings->isEmpty())
                                <div class="empty-state">You have not booked any approved businesses yet. Start with the search panel above and make your first appointment.</div>
                            @else
                                <div class="booking-grid">
                                    @foreach ($recentBookings as $booking)
                                        <article class="booking-row">
                                            <div class="booking-head">
                                                <div>
                                                    <h3>{{ $booking->service_name }}</h3>
                                                    <div class="meta">
                                                        {{ $booking->business?->business_name ?? 'Business unavailable' }} / {{ $booking->appointment_date?->format('D, j M Y') ?? $booking->appointment_date }} at {{ $booking->appointment_time }}
                                                    </div>
                                                </div>
                                                <div class="chip-row">
                                                    <span class="status-chip {{ $booking->status === 'completed' ? 'is-success' : ($booking->status === 'cancelled' ? 'is-danger' : 'is-warning') }}">{{ $booking->status }}</span>
                                                    <span class="status-chip {{ $booking->payment_status === 'paid' ? 'is-success' : ($booking->payment_status === 'failed' || $booking->payment_status === 'refunded' ? 'is-danger' : 'is-warning') }}">{{ $booking->payment_status }}</span>
                                                </div>
                                            </div>

                                            <div class="booking-actions">
                                                @if ($booking->business)
                                                    <a class="button-light" href="{{ route('business.show', ['slug' => $booking->business->slug]) }}">View business</a>
                                                @endif
                                                <a class="button-dark" href="{{ route('customer.bookings') }}">Manage appointment</a>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @endif
                        </section>

                        <section class="panel">
                            <div class="panel-head">
                                <div>
                                    <h2 class="panel-title">Account Snapshot</h2>
                                    <p class="panel-copy">This is the customer identity currently used to link bookings, payment status, and reviews to your account.</p>
                                </div>
                            </div>

                            <div class="account-grid">
                                <article class="account-card">
                                    <h3>{{ $customer->name }}</h3>
                                    <div class="meta">{{ $customer->email }}</div>
                                    <div class="helper-copy">{{ $customer->phone_number }}</div>
                                </article>
                                <article class="account-card">
                                    <h3>What this unlocks</h3>
                                    <div class="helper-copy">Signed-in bookings appear in your dashboard automatically, payment status remains visible after checkout, and completed visits can be reviewed on the public business page.</div>
                                </article>
                            </div>
                        </section>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
