<?php

namespace App\Listeners;

use App\Events\VendorConfirmsOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RedirectUserToThankyouPage
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
        dd('redirect to Thnak you');
    }
}
