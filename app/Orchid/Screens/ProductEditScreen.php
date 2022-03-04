<?php

namespace App\Orchid\Screens;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ProductEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creating new product';

    public bool $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Product $product): array
    {
        $this->exists = $product->exists;

        if ($this->exists) {
            $this->name = 'Edit Product';
        }

        return [
            'product' => $product,
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
            Button::make('Add Product')
                  ->icon('pencil')
                  ->method('createOrUpdate')
                  ->canSee(! $this->exists),

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
                Input::make('product.name')
                     ->title('Name')
                     ->placeholder('Attractive but mysterious Name'),

                TextArea::make('product.description')
                        ->title('Description')
                        ->rows(3)
                        ->maxlength(200)
                        ->placeholder('Brief description for preview'),

                Input::make('product.price')->title('Price'),
                CheckBox::make('product.is_active')->value(1)->title('Is Active')->sendTrueOrFalse(),
                Picture::make('product.product_image')
                       ->title('Large web banner image, generally in the front and center')
                       ->targetRelativeUrl()
                ,
                Relation::make('product.vendor_id')
                        ->title('Vendor')
                        ->fromModel(Vendor::class, 'vendor_name'),

                Relation::make('product.category_id')
                        ->title('Category')
                        ->fromModel(ProductCategory::class, 'name'),

            ]),
        ];
    }

    public function createOrUpdate(Product $product, Request $request)
    {
        $data = $request->get('product');

        $product->fill($data)->save();

        Alert::info('You have successfully created an product.');

        return redirect()->route('platform.product.list');
    }

    /**
     * @param  Product  $product
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Product $product)
    {
        $product->delete();
        Alert::info('You have successfully deleted the product.');
        return redirect()->route('platform.product.list');
    }
}
