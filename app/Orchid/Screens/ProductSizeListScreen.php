<?php

namespace App\Orchid\Screens;

use App\Models\ProductSize;
use App\Orchid\Layouts\ProductSizeListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class ProductSizeListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Product Sizes';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'sizes' => ProductSize::query()->filters()->latest()->paginate(10),
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new Size')
                ->icon('pencil')
                ->route('platform.product-size.edit'),
        ];
    }

    public function layout(): array
    {
        return [
            ProductSizeListLayout::class
        ];
    }

    public function remove(ProductSize $model)
    {
        $model->delete();
        Alert::info('You have successfully deleted');

        return redirect()->route('platform.product-sizes.list');
    }
}
