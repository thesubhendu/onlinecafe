<?php

namespace App\Orchid\Screens;

use App\Models\Order;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class OrderDetailScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Order Detail';

    private $order;
    /**
     * Query data.
     *
     * @param Order $order
     * @return array
     */
    public function query(Order $order): array
    {
        $this->order = $order;
        return [
            'order' => $order
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
            Button::make('Confirm Order')
                ->canSee(!$this->order->confirmed_at)
                ->icon('user-following')
                ->method('confirmOrder')

        ];
    }

    public function confirmOrder(Request $request)
    {
        $order = Order::find($request->order);

        if ($order->confirmed_at) {
            Toast::info("Order already confirmed!");
        } else {
            $order->confirm();
            Toast::success("Order Confirmed!");
        }

    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::view('admin.orders.detail')
        ];
    }
}
