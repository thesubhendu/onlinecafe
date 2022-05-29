<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param  Dashboard  $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);
        $dashboard->registerResource('scripts', asset('js/dashboard.js'));
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Back to Website')
                ->icon('monitor')
                ->route('home'),
            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),

            Menu::make('Update Shop Info')
                ->icon('monitor')
                ->route('manage-shop')
                ->title('Shop Management'),

            Menu::make('Product Management')
                ->icon('monitor')
                ->route('platform.product.list'),

            Menu::make('Order Management')
                ->icon('monitor')
                ->route('platform.order.list'),

//            Menu::make('Deal Management')
//                ->icon('monitor')
//                ->route('platform.deal.list'),

            Menu::make('Manage Service')
                ->icon('monitor')
                ->route('platform.service.list')
                ->permission('platform.systems.users'),

        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),

            ItemPermission::group(__('Website'))
                ->addPermission('make-order', __('Make Order'))
        ];
    }
}
