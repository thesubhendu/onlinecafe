<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\SubscriptionPolicy;
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

        Gate::define('subscribed', function (User $user) {
            return $user->subscribed('subscribed');
        });

        Gate::define('vendor', function (User $user) {
            return $user->subscribed('subscribed') && $user->shop;
        });

        Gate::define('visit-backend', function (User $user) {
            return $user->hasAccess('platform.index');
        });

        Gate::define('admin', function (User $user) {
            return $user->hasAccess('platform.systems.roles');
        });

//        $permissions = ItemPermission::group('backend')
//                                     ->addPermission('visit-backend', 'Access to admin panel');
//
//        $dashboard->registerPermissions($permissions);
    }
}
