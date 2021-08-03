<?php

namespace App\Listeners;

use App\Mail\orderConfirmed;
use App\Events\VendorConfirmsOrder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        Mail::to($event->order->user->email)->send(new orderConfirmed($event->order, $event->vendor));
    }
}
