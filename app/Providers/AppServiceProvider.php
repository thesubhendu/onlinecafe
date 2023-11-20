<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function () {
            Filament::registerNavigationItems([
                NavigationItem::make('Update Shop Info')
                    ->visible(\Gate::denies('admin'))
                    ->url(fn (): string => route('manage-shop'))
                    ->icon('heroicon-o-building-storefront')
                    ->sort(2),
            ]);
        });

        FilamentAsset::register([
            Js::make('dashboard-js', asset('/js/dashboard.js')),
        ]);
    }
}
