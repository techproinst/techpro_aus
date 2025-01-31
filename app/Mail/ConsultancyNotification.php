<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ConsultancyNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $name;
     public $email;
     public $phone_number;
     public $description;
    public function __construct($name, $email, $phone_number, $description)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->description = $description;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from:new Address(env('MAIL_FROM_ADDRESS')),
            subject: 'Consultancy :: Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.consultancy',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'description' => $this->description,

            ]

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
