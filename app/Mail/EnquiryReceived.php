<?php

namespace App\Mail;

use App\Models\Enquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnquiryReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Enquiry $enquiry) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New website enquiry — '.($this->enquiry->subject ?: $this->enquiry->name),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.enquiry-received',
            with: [
                'name' => $this->enquiry->name,
                'email' => $this->enquiry->email,
                'phone' => $this->enquiry->phone,
                'adminUrl' => rtrim(config('app.url'), '/').'/admin',
            ],
        );
    }
}
