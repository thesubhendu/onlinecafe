<?php

namespace App\Orchid\Screens;

use App\Models\ProductSize;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ProductSizeEditScreen extends EditScreen
{

    public function query(ProductSize $model): array
    {
        $this->exists = $model->exists;
        $this->name = 'Create New Product Size';

        if ($this->exists) {
            $this->name = 'Edit';
        }

        return [
            'productSize' => $model,
        ];
    }

    public function getModelKey()
    {
        return 'productSize';
    }

    public function layout(): array
    {
        $fields = [
            Input::make('productSize.name')->required()
                ->title('Name'),
            Input::make('productSize.slug')->required()
                ->title('Slug'),
            CheckBox::make('productSize.base_size')->value(0)->title('Base Size')->sendTrueOrFalse(),
        ];

        return [
            Layout::rows($fields),
        ];
    }

    public function createOrUpdate(ProductSize $model, Request $request)
    {
        $data = $request->get('productSize');
        $model->fill($data)->save();
        if ($request->get('productSize')['base_size']) {
            ProductSize::where('id', '!=', $model->id)
                ->update([
                    'base_size' => 0,
                ]);
        }

        Alert::info('Successfully Created');

        return redirect()->route('platform.product-sizes.list');
    }

    public function remove(ProductSize $model)
    {
        $model->delete();
        Alert::info('You have successfully deleted');

        return redirect()->route('platform.product-sizes.list');
    }


}
