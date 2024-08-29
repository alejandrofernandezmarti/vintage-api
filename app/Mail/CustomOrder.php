<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido;
    public $email;
    public $telefono;

    /**
     * Create a new message instance.
     */
    public function __construct($pedido, $email, $telefono)
    {
        $this->pedido = $pedido;
        $this->email = $email;
        $this->telefono = $telefono;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Nuevo Pedido Realizado')
            ->view('emails.pedido_realizado');
    }
}
