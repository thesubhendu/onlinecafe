<?php

namespace App\Orchid\Layouts;

use App\Models\Product;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'products';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id'),
            TD::make('name', 'Name')
              ->filter(Input::make())
              ->render(function (Product $product) {
                  return Link::make($product->name)
                             ->route('platform.product.edit', $product);
              }),

            TD::make('price', 'Price'),
            TD::make('vendor')->render(fn($product) => $product->vendor->vendor_name),
            TD::make('is_active', 'Is Active')->render(fn($p) => $p->is_active ? "Active" : "Inactive"),
            TD::make('category_id', 'Category')->render(fn($p) => $p->category->name),
            TD::make('is_all_sizes_available', 'All Sizes Available')
                ->render(fn($p) => $p->is_all_sizes_available ? "Yes" : "No"),
            TD::make('created_at', 'Created'),
            TD::make("Action")
              ->render(function ($product) {
                  $links = [
//                      Link::make('Show')->route('platform.product.show', $product),
                      Link::make('Edit')->icon('pencil')->route('platform.product.edit', $product),
                      Link::make('Add')->icon('plus')->route('platform.product.edit', $product),

                  ];

                  if(request('deal')) {
                      $links[] =Link::make('Add to Deal')
                          ->icon('plus')
                          ->route('platform.deal.addProduct',[request('deal'), $product]);
                  }

                  return Group::make($links);
              }),
        ];
    }
}
