<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Appointment $appointment) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New appointment request — '.$this->appointment->name,
        );
    }

    public function content(): Content
    {
        // DPDP: deliberately no clinical reason in the email — staff open the
        // dashboard to view full details.
        return new Content(
            markdown: 'emails.appointment-received',
            with: [
                'name' => $this->appointment->name,
                'phone' => $this->appointment->phone,
                'preferredDate' => $this->appointment->preferred_date?->toFormattedDateString(),
                'preferredTime' => $this->appointment->preferred_time,
                'adminUrl' => rtrim(config('app.url'), '/').'/admin',
            ],
        );
    }
}
