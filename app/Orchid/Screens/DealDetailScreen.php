<?php

namespace App\Orchid\Screens;

use App\Models\Deal;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class DealDetailScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Deal Detail';

    private $deal;

    public function query(Deal $deal): array
    {
        $this->deal = $deal;
        return [
            'deal' => $deal
        ];
    }


    public function commandBar(): array
    {
        return [];
    }


    public function layout(): array
    {
        return [
            Layout::view('admin.orders.deal-detail')
        ];
    }
}
