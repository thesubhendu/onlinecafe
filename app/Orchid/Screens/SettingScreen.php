<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;

class SettingScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Toggle Is Taking Order -->';

    public $vendor;



    public function query(): array
    {

        $this->vendor = auth()->user()->shop;

        return [
            'vendor'=> auth()->user()->shop
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [

            Button::make('Start Taking Order')->method('toggleTakingOrder')->icon('control-play')->canSee(!$this->vendor->is_taking_orders),
            Button::make('Stop Taking Order')->method('toggleTakingOrder')->icon('ban')->canSee($this->vendor->is_taking_orders),

        ];
    }

    public function toggleTakingOrder()
    {
        $vendor = auth()->user()->shop;
        $vendor->is_taking_orders = $vendor->is_taking_orders ? false : true;
        $vendor->save();


    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [

        ];
    }
}
