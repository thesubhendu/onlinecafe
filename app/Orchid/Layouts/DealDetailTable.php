<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class DealDetailTable extends Table
{

    protected $target = 'deal.products';

    protected function columns(): array
    {
        return [
            TD::make('name'),
            TD::make('quantity')->render(fn($product) => Input::make('quantity['.$product->id.']')->value($product->pivot->quantity) ),
            TD::make('price')->render(fn($product) => Input::make('price['.$product->id.']')->value($product->pivot->price) ),
            TD::make('Options')->render(function($product){
                $options = [];
                foreach (json_decode($product->pivot->options, true) as $key => $value) {
                    if(empty($value)){
                        continue;
                    }
                    $options[] = $value;
                }
                return $options? json_encode($options): "";
            }),
            TD::make("Action")
                ->render(function ($product) {
                    return Group::make([
                        Button::make('Delete')->method('removeProduct')->parameters(['dealId'=>$product->pivot->deal_id,'productId'=> $product->id])->icon('trash'),
                    ]);
                }),
        ];
    }

    public function total():array
    {
        return [
            TD::make('total')
                ->align(TD::ALIGN_RIGHT)
                ->canSee($this->query->get('hasProducts'))
                ->colspan(1)->render(fn($p) => "Total: $"),

            TD::make('total')
                ->align(TD::ALIGN_RIGHT)
                ->canSee($this->query->get('hasProducts'))
                ->colspan(2)->render(fn($p) => Input::make('total')->value($this->query->get('total'))),

        ];
    }

}
