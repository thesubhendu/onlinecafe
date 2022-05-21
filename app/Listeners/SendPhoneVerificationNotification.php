<?php

namespace App\Listeners;

use App\Services\PhoneVerification;

class SendPhoneVerificationNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if (! $event->user->hasVerifiedPhone()) {
            (new PhoneVerification())->sendCode($event->user);
        }
    }

}
