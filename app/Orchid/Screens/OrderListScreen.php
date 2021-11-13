<?php

namespace App\Orchid\Screens;

use App\Models\Order;
use Illuminate\Support\Facades\Gate;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class OrderListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Orders';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $orders = Order::query()->with('vendor')->filters()->latest();
        if (Gate::allows('admin')) {
            $orders = $orders;
        } else {
            $orders->where('vendor_id', auth()->user()->shop->id);
        }

        return [
            'orders' => $orders->paginate(50),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::table('orders', [
                TD::make('id'),
                TD::make('order_number'),
                TD::make('payment_method'),
                TD::make('confirmed_at'),
                TD::make('confirmed_by'),
                TD::make('confirmed_by'),
                TD::make('user_id', "Ordered By")->render(fn($o) => $o->user->name),
                TD::make('order_total'),
                TD::make('Action')->render(function ($order) {
                    return Group::make([
                        Link::make('Show')->route('platform.order.show', $order)->icon('eye'),
                        Link::make('Edit')->icon('pencil')->route('platform.order.edit', $order),
                    ]);
                }),
            ]),
        ];
    }
}
