<?php

namespace App\Mail;

use App\Models\Transacciones;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompraCocheMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Transacciones $transaccion,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de Compra: ' . $this->transaccion->coche->marca . ' ' . $this->transaccion->coche->modelo,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.compra-coche',
        );
    }
}
