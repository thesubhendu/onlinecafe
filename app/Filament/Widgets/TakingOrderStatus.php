<?php

namespace App\Filament\Widgets;

use App\Models\Vendor;
use Filament\Widgets\Widget;

class TakingOrderStatus extends Widget
{
    public Vendor $vendor;

    protected $listeners = [
      'order-status-changed' => '$refresh'
    ];


    protected static string $view = 'filament.widgets.taking-order-status';
}
