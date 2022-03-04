<?php

namespace App\Orchid\Screens;

use App\Models\Deal;
use App\Models\DealProduct;
use App\Orchid\Layouts\DealDetailTable;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

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
            'deal' => $deal,
            'total' => $deal->products->reduce(fn($carry,$product) => $carry + ($product->pivot->price*$product->pivot->quantity)),
        ];
    }



    public function commandBar(): array
    {
        return [
            Button::make('Update Detail')
                ->icon('pencil')
                ->method('updateDetail'),
        ];
    }

    public function updateDetail(Deal $deal, Request $request)
    {
        $productIds = $deal->products->pluck('id')->toArray();
        $optionsArray = DealProduct::where('deal_id', $deal->id)->pluck('options','product_id')->toArray();
        $deal->products()->detach($productIds);

        foreach ($request['quantity'] as $productId => $quantity){
            $deal->products()->attach($productId, [
                'price' => $request->price[$productId],
                'quantity' => $quantity,
                'options' => $optionsArray[$productId]
            ]);
        }
    }

    public function layout(): array
    {
        return [
            DealDetailTable::class,
        ];
    }
}
