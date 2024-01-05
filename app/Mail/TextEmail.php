<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class TextEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $emailData;

    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    public function build(Mailer $mailer)
    {
        $message = $mailer->createMessage();
        $message->setBody($this->emailData['message'], 'text/plain');

        return $this->withSwiftMessage($message)
            ->subject($this->emailData['subject'])
            ->to($this->emailData['recipient']);
    }
}

