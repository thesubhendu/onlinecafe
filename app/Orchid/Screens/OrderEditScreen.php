<?php

namespace App\Orchid\Screens;

use App\Models\Order;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class OrderEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Order';

    /**
     * Query data.
     *
     * @param Order $order
     * @return array
     */
    public function query(Order $order): array
    {
        $this->exists = $order->exists;

        if ($this->exists) {
            $this->name = 'Edit Order';
        }

        return [
            'order' => $order,
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
            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
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
            Layout::rows([
                Input::make('order.confirmed_by')
                    ->title('Confirmed By')
            ])
        ];
    }
}
