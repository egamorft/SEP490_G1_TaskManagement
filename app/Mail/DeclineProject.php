<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeclineProject extends Mailable
{
    use Queueable, SerializesModels;
    public $supervisorName;
    public $pmName;
    public $url;
    public $projectName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($supervisorName, $pmName, $projectName, $url)
    {
        $this->supervisorName = $supervisorName;
        $this->pmName = $pmName;
        $this->projectName = $projectName;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Decline Project',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.project.rejected',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
