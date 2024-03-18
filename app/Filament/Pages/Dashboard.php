<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\OrderChart;
use App\Filament\Widgets\SalesChart;
use App\Filament\Widgets\StatsOverview;
use Filament\Facades\Filament;

class Dashboard extends \Filament\Pages\Dashboard
{
    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            OrderChart::class,
            SalesChart::class
        ];
    }
}

