<?php

namespace App\Orchid\Screens;

use App\Models\Product;
use App\Orchid\Layouts\ProductListLayout;
use Illuminate\Support\Facades\Gate;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ProductListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'All Products';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $productQuery = Product::with('vendor', 'category','productPrices');

        if (Gate::allows('admin')) {
            $products = $productQuery->filters()->latest()->paginate(50);
        } else {
            $products = $productQuery->where('vendor_id',
                auth()->user()->shop->id)->filters()->latest()->paginate(50);
        }

        return [
            'products' => $products,
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
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.product.edit'),
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
            ProductListLayout::class,
        ];
    }
}
