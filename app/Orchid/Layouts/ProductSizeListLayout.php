<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductSizeListLayout extends Table
{

    public $target = 'sizes';


    public function columns(): array
    {
        return [
            TD::make('id'),
            TD::make('name'),
            TD::make('slug'),
            TD::make('Base Size')->render(function ($size) {
                return $size->base_size ? "True" : "False";
            }),
            TD::make("Action")
                ->render(function ($size) {
                    return Group::make([
                        Link::make('Edit')->icon('pencil')->route('platform.product-size.edit', ['productSize' => $size->id]),
                        Button::make('Delete')->method('remove')->parameters(['productSize' => $size->id])->icon('trash'),
                    ]);
                }),
        ];
    }
}
