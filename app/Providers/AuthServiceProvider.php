<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Vendor;
use App\Policies\SubscriptionPolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Cashier\Subscription;
use Orchid\Platform\Dashboard;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Subscription::class => SubscriptionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Dashboard $dashboard)
    {
        $this->registerPolicies();

//        ResetPassword::createUrlUsing(function ($user, string $token) {
//            return config('app.client_url').'?token='.$token."&email=".$user->email;
//        });

        Gate::define('subscribed', function (User $user) {
            return $user->subscribed('subscribed');
        });

        Gate::define('vendor', function (User $user) {
            return $user->shop;
        });

        Gate::define('visit-backend', function (User $user) {
            return $user->hasAccess('platform.index');
        });

        Gate::define('admin', function (User $user) {
            return $user->hasAccess('platform.systems.roles');
        });

        Gate::define('make-order', function (User $user, Vendor $vendor) {
             return  !$user->shop  ;
//             return  !$user->shop && $vendor->is_open ; todo uncomment it in production
        });

        Gate::define('make-rating', function (User $user) {
             return  !$user->shop ;
        });

        Gate::define('can-create-deal', function (User $user) {
            return  Gate::allows('vendor') && request()->get('deal');
        });

    }
}
