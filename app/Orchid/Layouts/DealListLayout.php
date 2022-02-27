<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class DealListLayout extends Table
{

    public $target = 'deals';


    public function columns(): array
    {
        return [
            TD::make('id'),
            TD::make('title'),
            TD::make('expires_at'),
            TD::make('status')->render(fn($deal) => $deal->status?"Active":"Inactive"),
            TD::make("Action")
                ->render(function ($deal) {
                    return Group::make([
                        Link::make('Edit')->icon('pencil')->route('platform.deal.edit', $deal),
                        Link::make('View')->icon('eye')->route('platform.deal.show', $deal),
                        Button::make('Add Product')
                            ->method('addProduct')
                            ->icon('plus')
                            ->parameters(['vendor'=> $deal->vendor_id,'deal'=>$deal->id])
                    ]);
                }),
        ];
    }
}
