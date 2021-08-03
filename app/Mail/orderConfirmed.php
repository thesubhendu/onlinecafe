<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class orderConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $vendor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, Vendor $vendor)
    {
        $this->order = $order;
        $this->vendor = $vendor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.order.confirmed');
    }
}
