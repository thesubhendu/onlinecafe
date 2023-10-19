<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Orders Today', Order::whereDate('created_at', today())->count()),
            Stat::make('Total Orders', Order::count()),
            Stat::make('Products', Product::count()),
            Stat::make('Customers', Order::groupBy('user_id')->count()),
            Stat::make('Likes', auth()->user()->shop->favoritesCount ?? 0)->color('success'),
            Stat::make('Reviews', Rating::count() ?? 0),
        ];
    }
}
