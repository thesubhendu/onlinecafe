<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('confirmOrder')
                ->form([
                    TextInput::make('order_ready_in')
                        ->required()
                        ->numeric(),
                ])
                ->action(function (array $data, Order $order): void {
                    $order->order_ready_in = $data['order_ready_in'];
                    $order->save();
                    $order->confirm();
                }),
            Actions\DeleteAction::make(),
        ];
    }
}
