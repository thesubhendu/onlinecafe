<?php

namespace App\Orchid\Resources;

use Orchid\Screen\TD;
use App\Models\Product;
use Orchid\Crud\Resource;
use App\Models\AllProduct;
use App\Models\ProductCategory;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Crud\Filters\DefaultSorted;

class AllProductResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = AllProduct::class;

    public static function label(): string
    {
        return "Product Setting: 4 All Products";
    }
    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        // $sizes = config('sizes');
        $fields = [
            Input::make('name')
            ->title('Name')
            ->placeholder('Attractive but mysterious Name'),

            TextArea::make('description')
            ->title('Description')
            ->rows(3)
                ->maxlength(200)
                ->placeholder('Brief description for preview'),

            Input::make('price')->title('Price')->required(),
        ];
        // $sizeInputs = [];
        // foreach ($sizes as $key => $size) {
        //     $sizeInputs[] = Input::make('productPrices.' . $size)
        //         ->type('number')
        //         ->title($key . '(' . $size .  ') size price')
        //         ->value($this->product->productPrices()->where('size', $size)->first()->price ?? $this->product->price)
        //         ->required();
        // }

        // if ($sizeInputs) {
        //     $fields =  array_merge($fields, $sizeInputs);
        // }

        $fields[] =  CheckBox::make('is_all_sizes_available')
        ->value(1)
            ->title('All Sizes Available')
            ->sendTrueOrFalse();


        $fields[] = Relation::make('category_id')
        ->title('Category')
        ->fromModel(ProductCategory::class, 'name');


        return $fields;
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id'),
            TD::make('name'),
            TD::make('price'),
            TD::make('category_id', 'Category')->render(fn ($p) => $p->productCategory->name ?? 'n/a'),


        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            new DefaultSorted('created_at', 'desc'),
        ];
    }

    public static function displayInNavigation(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }
}
