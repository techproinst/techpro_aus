<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;


class PaymentApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $firstname;
     public $lastname;
     public $email;
     public $course;
     public $app_no;
     public $payment_reference;
     public $amount;
     public $currency;

    public function __construct($firstname, $lastname, $email, $course, $app_no, $payment_reference, $amount, $currency)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->course = $course;
        $this->app_no = $app_no;
        $this->payment_reference = $payment_reference;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from:new Address(env('MAIL_FROM_ADDRESS')),
            subject: 'Payment :: Approval',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.payment-approval',
            with: [
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'email' => $this->email,
                'course' => $this->course,
                'app_no' => $this->app_no,
                'payment_reference' => $this->payment_reference,
                'amount' => $this->amount,
                'currency' => $this->currency,
                
                
            ],
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
