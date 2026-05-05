<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Rahisi Customer | My Bookings</title>
        <meta
            name="description"
            content="Manage your Book Rahisi appointments, track payment status, and leave reviews for completed bookings."
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
                            <span class="eyebrow">Appointment management</span>
                            <h1>My bookings</h1>
                            <p class="subtitle">
                                Review upcoming appointments, monitor payment status, cancel eligible visits, and leave reviews once a booking has been completed.
                            </p>
                        </div>

                        <div class="toolbar">
                            <a class="button-light" href="{{ route('customer.dashboard') }}">Back to dashboard</a>
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
                        <div class="error-banner">One or more booking actions could not be completed. Review the submitted values and try again.</div>
                    @endif

                    <section class="hero-card">
                        <div>
                            <span class="eyebrow" style="background: rgba(255, 255, 255, 0.16); color: #fff;">Customer booking history</span>
                            <h2>Track every appointment</h2>
                            <p class="hero-copy">
                                Every booking placed while signed in appears here with its status, payment state, and next available action.
                            </p>
                            <div class="hero-actions">
                                <a class="button-dark" href="#upcoming">Upcoming bookings</a>
                                <a class="button-light" href="#history">Completed and past visits</a>
                            </div>
                        </div>

                        <div class="hero-side">
                            <span class="hero-tag">Signed in</span>
                            <div class="hero-amount">{{ $bookings->count() }}</div>
                            <div class="hero-caption">Bookings linked to your account</div>
                        </div>
                    </section>

                    <div class="panel-stack">
                        <section class="panel" id="upcoming">
                            <div class="panel-head">
                                <div>
                                    <h2 class="panel-title">Upcoming Bookings</h2>
                                    <p class="panel-copy">Pending and confirmed visits stay here until they are completed or cancelled.</p>
                                </div>
                            </div>

                            @php
                                $upcomingBookings = $bookings->filter(fn ($booking) => in_array($booking->status, ['pending', 'confirmed'], true));
                            @endphp

                            @if ($upcomingBookings->isEmpty())
                                <div class="empty-state">You do not have any pending or confirmed appointments right now.</div>
                            @else
                                <div class="booking-grid">
                                    @foreach ($upcomingBookings as $booking)
                                        <article class="booking-row">
                                            <div class="booking-head">
                                                <div>
                                                    <h3>{{ $booking->service_name }}</h3>
                                                    <div class="meta">
                                                        {{ $booking->business?->business_name ?? 'Business unavailable' }} / {{ $booking->appointment_date?->format('D, j M Y') ?? $booking->appointment_date }} at {{ $booking->appointment_time }}
                                                    </div>
                                                    <div class="helper-copy">Professional: {{ $booking->staff_name }} / Contact used: {{ $booking->customer_phone }}</div>
                                                    @if ($booking->customer_image_path)
                                                        <div class="helper-copy">Reference image attached to this booking request.</div>
                                                    @endif
                                                </div>
                                                <div class="chip-row">
                                                    <span class="status-chip is-warning">{{ $booking->status }}</span>
                                                    <span class="status-chip {{ $booking->payment_status === 'paid' ? 'is-success' : ($booking->payment_status === 'failed' ? 'is-danger' : 'is-warning') }}">{{ $booking->payment_status }}</span>
                                                </div>
                                            </div>

                                            <div class="booking-actions">
                                                @if ($booking->business)
                                                    <a class="button-light" href="{{ route('business.show', ['slug' => $booking->business->slug]) }}">View business</a>
                                                @endif
                                                <form action="{{ route('customer.bookings.cancel', ['booking' => $booking]) }}" method="post">
                                                    @csrf
                                                    <button class="button-dark" type="submit">Cancel booking</button>
                                                </form>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @endif
                        </section>

                        <section class="panel" id="history">
                            <div class="panel-head">
                                <div>
                                    <h2 class="panel-title">Booking History</h2>
                                    <p class="panel-copy">Completed and cancelled appointments stay here. Completed visits can be reviewed once.</p>
                                </div>
                            </div>

                            @php
                                $historyBookings = $bookings->reject(fn ($booking) => in_array($booking->status, ['pending', 'confirmed'], true));
                            @endphp

                            @if ($historyBookings->isEmpty())
                                <div class="empty-state">You do not have any completed or cancelled bookings yet.</div>
                            @else
                                <div class="booking-grid">
                                    @foreach ($historyBookings as $booking)
                                        <article class="booking-row">
                                            <div class="booking-head">
                                                <div>
                                                    <h3>{{ $booking->service_name }}</h3>
                                                    <div class="meta">
                                                        {{ $booking->business?->business_name ?? 'Business unavailable' }} / {{ $booking->appointment_date?->format('D, j M Y') ?? $booking->appointment_date }} at {{ $booking->appointment_time }}
                                                    </div>
                                                    <div class="helper-copy">
                                                        Professional: {{ $booking->staff_name }}
                                                        @if ($booking->customer_notes)
                                                            / Notes: {{ $booking->customer_notes }}
                                                        @endif
                                                    </div>
                                                    @if ($booking->customer_image_path)
                                                        <div class="helper-copy">Reference image attached to this booking request.</div>
                                                    @endif
                                                </div>
                                                <div class="chip-row">
                                                    <span class="status-chip {{ $booking->status === 'completed' ? 'is-success' : 'is-danger' }}">{{ $booking->status }}</span>
                                                    <span class="status-chip {{ $booking->payment_status === 'paid' ? 'is-success' : ($booking->payment_status === 'failed' || $booking->payment_status === 'refunded' ? 'is-danger' : 'is-warning') }}">{{ $booking->payment_status }}</span>
                                                </div>
                                            </div>

                                            @if ($booking->status === 'completed' && ! $booking->review)
                                                <div class="review-block">
                                                    <form class="inline-form" action="{{ route('customer.bookings.review', ['booking' => $booking]) }}" method="post">
                                                        @csrf
                                                        <div class="rating-row">
                                                            <strong>Your rating</strong>
                                                            <div class="rating-options">
                                                                @foreach ([5, 4, 3, 2, 1] as $rating)
                                                                    <label>
                                                                        <input type="radio" name="rating" value="{{ $rating }}" {{ old('rating') == $rating ? 'checked' : '' }}>
                                                                        <span>{{ $rating }} star{{ $rating === 1 ? '' : 's' }}</span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <textarea class="field-textarea" name="body" placeholder="Share the experience other customers should know about.">{{ old('body') }}</textarea>
                                                        <div class="booking-actions">
                                                            <button class="button-dark" type="submit">Publish review</button>
                                                            @if ($booking->business)
                                                                <a class="button-light" href="{{ route('business.show', ['slug' => $booking->business->slug]) }}">View business page</a>
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            @elseif ($booking->review)
                                                <div class="review-block">
                                                    <strong>Your review</strong>
                                                    <div class="helper-copy">{{ $booking->review->rating }}/5 stars</div>
                                                    <div class="helper-copy">{{ $booking->review->body }}</div>
                                                </div>
                                            @endif
                                        </article>
                                    @endforeach
                                </div>
                            @endif
                        </section>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
