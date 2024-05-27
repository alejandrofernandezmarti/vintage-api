<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;
    public $orders_lines;

    public function __construct($order, $orders_lines)
    {
        $this->order = $order;
        $this->orders_lines = $orders_lines;
    }

    public function build()
    {
        return $this->subject('Nuevo pedido')->view('mails.orders.new_order_admin', [
            "order" => $this->order,
            "products" => $this->orders_lines
        ]);
    }
}
