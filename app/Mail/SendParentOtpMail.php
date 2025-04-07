<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class SendParentOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $parentName,
        public string $studentName,
        public string $otp,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: config('app.name') . ' - OTP for Accessing Student Info',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.parent.otp',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}