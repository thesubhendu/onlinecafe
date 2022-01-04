<?php

namespace App\Orchid\Screens;

use App\Models\Order;
use Illuminate\Support\Facades\URL;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

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
            Link::make('Confirm Order')
                ->canSee(!$this->order->confirmed_at)
                ->icon('user-following')
                ->href(URL::signedRoute('confirm_order.confirm', $this->order->id)),
        ];
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
