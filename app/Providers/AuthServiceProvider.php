<?php

namespace App\Providers;

use App\Policies\SubscriptionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Cashier\Subscription;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;

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
            return $user->subscribed('subscribed') && $user->hasRole('vendor');
        });

        $permissions = ItemPermission::group('modules')
                                     ->addPermission('analytics', 'Access to data analytics')
                                     ->addPermission('monitor', 'Access to the system monitor');

        $dashboard->registerPermissions($permissions);
    }
}
