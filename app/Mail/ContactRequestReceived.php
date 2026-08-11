<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactRequestReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly array $contact) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            replyTo: [new Address($this->contact['email'], $this->contact['name'])],
            subject: 'Nouvelle demande depuis le portfolio',
        );
    }

    public function content(): Content
    {
        return new Content(view: 'mail.contact-request');
    }

    public function attachments(): array
    {
        return [];
    }
}
