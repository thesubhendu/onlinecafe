<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class orderSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $url)
    {
        $this->order = $order;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('orders@mycoffees.com.au')->markdown('mail.order.submitted');
    }
}
