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

    public $product;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Product $product): array
    {
        $this->product = $product->load('productPrices');
        $this->exists = $product->exists;

        if ($this->exists) {
            $this->name = 'Edit Product';
        }

        return [
            'product' => $this->product,
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
        $sizes = config('sizes');
        $fields = [
            Input::make('product.name')
                ->title('Name')
                ->placeholder('Attractive but mysterious Name'),

            TextArea::make('product.description')
                ->title('Description')
                ->rows(3)
                ->maxlength(200)
                ->placeholder('Brief description for preview'),

            Input::make('product.price')->title('Price')->required(),
        ];
        $sizeInputs = [];
        foreach($sizes as $key => $size)
        {
            $sizeInputs[] = Input::make('product.productPrices.'.$size)
                ->type('number')
                ->title($key.'('.$size .  ') size price')
                ->value($this->product->productPrices()->where('size', $size)->first()->price ?? $this->product->price)
                ->required();
        }

        if ($sizeInputs)
        {
            $fields =  array_merge($fields, $sizeInputs);
        }

        $fields[] =  CheckBox::make('product.is_all_sizes_available')
            ->value(1)
            ->title('All Sizes Available')
            ->sendTrueOrFalse();
        $fields[]=CheckBox::make('product.is_stamp')->value(1)
            ->title('Is Stamp')->sendTrueOrFalse();
        $fields[]=CheckBox::make('product.is_active')->value(1)
            ->title('Is Active')->sendTrueOrFalse();
        $fields[]=Input::make('product.product_image')->type('file')
            ->title('Upload Product Image');


        if(auth()->user()->isAdmin()) {
            $fields[] = Relation::make('product.vendor_id')
                ->title('Vendor')
                ->fromModel(Vendor::class, 'vendor_name');

            $fields[] = Relation::make('product.category_id')
                ->title('Category')
                ->fromModel(ProductCategory::class, 'name');
        }else{
            $fields[] = Input::make('product.vendor_id')->hidden(true)->value(auth()->user()->shop->id);
            $fields[] = Input::make('product.category_id')->hidden(true)->value(1);
        }

        return [
            Layout::rows($fields),
        ];
    }

    public function createOrUpdate(Product $product, Request $request)
    {
        $data = $request->get('product');
        $product->fill($data)->save();

        if($data['productPrices'])
        {
            foreach ($data['productPrices'] as $key=> $productPrice)
            {
                $product->productPrices()->updateOrCreate(
                    ['size' => $key,'product_id' => $product->id],
                    ['price' => $productPrice]
                );
            }
        }

        $pimage = $request->all()['product']['product_image'] ?? null;

        if(!empty($pimage)){
            $product->product_image = $pimage->store('product-images');
            $product->save();
        }

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
