<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingPlacedMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public Booking $booking)
    {
        $this->booking->loadMissing('business');
    }

    public function envelope(): Envelope
    {
        $businessName = $this->booking->business?->business_name ?? 'Book Rahisi';

        return new Envelope(
            subject: 'Booking request received for '.$businessName,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-placed',
        );
    }
}
