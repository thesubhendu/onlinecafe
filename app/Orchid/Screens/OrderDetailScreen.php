<?php

namespace App\Orchid\Screens;

use App\Models\Order;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;

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
            ModalToggle::make('Confirm Order')
            ->rawClick()
            ->id("order-confirm-button")
            ->modal('order-confirm-modal')
            ->canSee(!$this->order->confirmed_at)
            ->icon('user-following')
            ->method('confirmOrder')

        ];
    }

    public function confirmOrder(Request $request)
    {
        $request->validate([
            'order_ready_in'=>'required|numeric'
        ]);

        $order = Order::find($request->order);
        if ($order->confirmed_at) {
            Toast::info("Order already confirmed!");
        } else {
            $order->confirm();
            $order->order_ready_in = $request->get('order_ready_in');
            $order->save();
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
            Layout::view('admin.orders.detail'),
            Layout::modal('order-confirm-modal', [
                Layout::rows([
                    Input::make('order_ready_in')
                    ->type('number')
                    ->value(10)
                    ->required()
                    ->title('How many minutes order will be ready?')
                    ->placeholder('enter in minutes'),
                ]),
            ])->title("Order ready in?"),
        ];
    }
}
