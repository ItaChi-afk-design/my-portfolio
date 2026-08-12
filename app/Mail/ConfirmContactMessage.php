<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactMessage $contactMessage,
        public string $confirmationUrl,
    ) {
    }

    public function build(): self
    {
        return $this
            ->subject('Confirm your portfolio message')
            ->view('emails.confirm-contact');
    }
}
