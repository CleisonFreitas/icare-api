<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PinRecuperacaoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pin;
    public $usuario;

    public function __construct($pin, $usuario)
    {
        $this->pin = $pin;
        $this->usuario = $usuario;
    }

    public function build()
    {
        return $this->subject('Código PIN para recuperação de senha')
            ->view('emails.pin_recuperacao');
    }
}
