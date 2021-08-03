<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Vendor;
use App\Mail\orderConfirmed;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        $vendor = $order->vendor;
        // Check if is _confirmed has changed from false to true

        if ($order->getOriginal('is_confirmed') == false && $order->wasChanged('is_confirmed')) {

            Mail::to($order->user->email)->send(new orderConfirmed($order, $vendor));
        } else {
            dd('order submitted');
        }

        // Send mail to user/customer

    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
