<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Orders Today', Order::whereDate('created_at', today())->count()),
            Stat::make('Total Orders', Order::count())
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Products', Product::count()),
        ];
    }
}
