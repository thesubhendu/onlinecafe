<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        return $this->markdown('mail.order.submitted');
    }
}
