<?php

namespace App\Mail;

use App\Models\Compra;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;
    public $products;

    public function __construct(Compra $order, $products)
    {
        $this->order = $order;
        $this->products = $products;
    }

    public function build()
    {
        return $this->subject('Nuevo pedido')->view('mails.orders.new_order', [
            "order" => $this->order,
            "products" => $this->products
        ]);
    }
}
