<?php

namespace App\Orchid\Resources;

use App\Models\OptionType;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\TD;

class ProductOptionResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ProductOption::class;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isAdmin();
    }

    public function with(): array
    {
        return ['optionType'];
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
        Input::make('price')->title('Price')->required(),
        Relation::make('option_type_id')
            ->fromModel(OptionType::class, 'name')
            ->title('Option Type')->required()
            ->chunk(200),
        CheckBox::make('default_option')
                    ->value(1)
                    ->title('Is Default Option')
                    ->sendTrueOrFalse(),

        CheckBox::make('charge')
                    ->value(1)
                    ->title('Is Chargeable')
                    ->sendTrueOrFalse()


        ];
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return "Product Setting: 3 Options";
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
            TD::make('option_type_id', 'Option Type')->render(fn($p) => $p->optionType->name),

            TD::make('default_option','Is Default'),
            TD::make('charge'),

            TD::make('updated_at', 'Update date')
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
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
        if(auth()->check() && auth()->user()->isAdmin()){
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
