<?php

namespace App\Orchid\Resources;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Crud\Resource;
use Orchid\Crud\ResourceRequest;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\TD;

class OptionTypeResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\OptionType::class;

    public function with(): array
    {
        return ['productCategories'];
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return "Product Setting: 2 Option Types";
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [

            Input::make('name')->title('Name')->required(),
            Input::make('order_no')->title('Order')->required(),

            CheckBox::make('is_multiselect')
                ->value(1)
                ->title('Is Multiselect')
                ->sendTrueOrFalse(),

            Relation::make('productCategories.')
                ->fromModel(ProductCategory::class, 'name')
                ->multiple()
                ->title('Category')
                ->required()
                ->chunk(50)

        ];
    }

    public function onSave(ResourceRequest $request, Model $model)
    {
        $data = $request->except('productCategories');

        $model->forceFill($data)->save();

        if($request->has('productCategories')){
            $model->productCategories()->sync($request->productCategories);
        }
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
            TD::make('Categories')
                ->render(function ($option) {
                    return implode(", ", $option->productCategories->pluck('name')->toArray());
                })
            ,
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
        return [];
    }

    public static function displayInNavigation(): bool
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Get the permission key for the resource.
     *
     * @return string|null
     */
    public static function permission(): ?string
    {
        return 'platform.systems.users'; //user management permission , only admin can access this
    }
}
