<?php

namespace App\Providers;

use App\Events\VendorConfirmsOrder;
use App\Listeners\EmailUserOrderConfirmed;
use App\Listeners\RedirectUserToThankyouPage;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        VendorConfirmsOrder::class => [
            EmailUserOrderConfirmed::class,
            RedirectUserToThankyouPage::class,
        ],


    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
