<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Booking request received</title>
    </head>
    <body style="margin: 0; padding: 32px 16px; background: #f3f8fc; color: #17304d; font-family: Arial, sans-serif;">
        <div style="max-width: 640px; margin: 0 auto; padding: 32px; border-radius: 24px; background: #ffffff; border: 1px solid #d6e2f0;">
            <p style="margin: 0 0 16px; font-size: 14px; font-weight: 700; letter-spacing: 0.04em; text-transform: uppercase; color: #1aa0e2;">
                Book Rahisi
            </p>

            <h1 style="margin: 0 0 18px; font-size: 30px; line-height: 1.1;">
                Your booking request has been placed
            </h1>

            <p style="margin: 0 0 18px; font-size: 16px; line-height: 1.7;">
                Hi {{ $booking->customer_name }}, we have received your booking request for
                <strong>{{ $booking->business?->business_name ?? 'the business' }}</strong>.
                The business owner will review it and send the appointment confirmation through email.
            </p>

            <div style="margin: 0 0 24px; padding: 20px; border-radius: 18px; background: #f7fbff; border: 1px solid #d6e2f0;">
                <p style="margin: 0 0 10px; font-size: 14px; color: #607792;">Service</p>
                <p style="margin: 0 0 14px; font-size: 18px; font-weight: 700;">{{ $booking->service_name }}</p>

                <p style="margin: 0 0 10px; font-size: 14px; color: #607792;">Appointment time</p>
                <p style="margin: 0 0 14px; font-size: 18px; font-weight: 700;">
                    {{ $booking->appointment_date?->format('D, j M Y') ?? $booking->appointment_date }} at {{ $booking->appointment_time }}
                </p>

                <p style="margin: 0 0 10px; font-size: 14px; color: #607792;">Professional</p>
                <p style="margin: 0 0 14px; font-size: 18px; font-weight: 700;">{{ $booking->staff_name }}</p>

                <p style="margin: 0 0 10px; font-size: 14px; color: #607792;">Contact</p>
                <p style="margin: 0; font-size: 16px;">{{ $booking->customer_email }} / {{ $booking->customer_phone }}</p>
            </div>

            @if ($booking->customer_notes)
                <p style="margin: 0 0 18px; font-size: 16px; line-height: 1.7;">
                    <strong>Your note:</strong> {{ $booking->customer_notes }}
                </p>
            @endif

            @if ($booking->customer_image_path)
                <p style="margin: 0 0 18px; font-size: 16px; line-height: 1.7;">
                    Your booking request included a reference image for the business to review.
                </p>
            @endif

            @if ($booking->business?->slug)
                <p style="margin: 0;">
                    <a href="{{ route('business.show', ['slug' => $booking->business->slug]) }}" style="display: inline-block; padding: 14px 20px; border-radius: 16px; background: #17345d; color: #ffffff; text-decoration: none; font-weight: 700;">
                        View business page
                    </a>
                </p>
            @endif
        </div>
    </body>
</html>
