<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PhishingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $attachmentPath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details,$attachmentPath)
    {
        $this->details = $details;
        $this->attachmentPath = $attachmentPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Test Mail from Laravel')
            ->view('emails.phishing')
            ->attach($this->attachmentPath);
    }
}
