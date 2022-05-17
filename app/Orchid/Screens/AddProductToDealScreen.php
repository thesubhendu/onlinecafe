<?php

namespace App\Orchid\Screens;

use App\Models\Deal;
use App\Models\Product;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class AddProductToDealScreen extends Screen
{
    public $name = 'Add product to deal';

    protected  $product;

    public function query(Deal $deal,Product $product): array
    {
        $this->name = 'Deal '. $deal->title;
        $this->product = $product;
        return [
            'deal' => $deal,
            'product' => $product,
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Add Product')
                  ->icon('pencil')
                  ->method('addToDeal')
        ];
    }

    public function layout(): array
    {
        $fields = [
            Input::make('product.price')->title('Price'),
            Input::make('product.qty')->title('Quantity'),
        ];
        foreach ($this->product->optionTypes() ?? [] as $optionType) {
            $optionOptions = ["" => "Select"];
            foreach ($optionType->vendorProductOptions ?? [] as $opt) {
                $optionOptions[$optionType->name.':'.$opt->name] = $opt->name. "(+". $opt->price .")";
            }

            $fields[] = Select::make('productoptions.'.$optionType->id)
                ->options($optionOptions)
                ->title($optionType->name);
        }

        return [
            Layout::rows($fields),
        ];
    }

    public function addToDeal(Deal $deal, Product $product, Request $request)
    {
        $data = $request->get('product');
        $deal->products()->attach($product->id,[
            'price' => $data['price'],
            'quantity' => $data['qty'],
            'options' => json_encode(array_filter($request->get('productoptions')) ?? [])
        ]);

        Alert::info('You have successfully added product to deal.');

        return redirect()->route('platform.deal.show', $deal);
    }

    public function remove(Product $product)
    {
        $product->delete();
        Alert::info('You have successfully deleted the product.');
        return redirect()->route('platform.product.list');
    }
}
