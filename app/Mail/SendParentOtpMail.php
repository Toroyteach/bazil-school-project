<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendParentOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $studentName;
    public string $otp;

    public function __construct(string $studentName, string $otp)
    {
        $this->studentName = $studentName;
        $this->otp = $otp;
    }

    public function build(): self
    {
        return $this->subject(config('app.name') . ' - OTP for Accessing Student Info')
            ->markdown('emails.parent.otp');
    }
}