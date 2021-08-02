<?php

namespace App\Listeners;

use App\Events\VendorConfirmsOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmailUserOrderConfirmed
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  VendorConfirmsOrder  $event
     * @return void
     */
    public function handle(VendorConfirmsOrder $event)
    {
        dd('Email User');
        // Mail::to($order->user->email)->send(new orderConfirmed($order, $vendor));
    }
}
