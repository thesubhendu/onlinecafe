<?php

namespace App\Orchid\Resources;

use App\Models\OptionType;
use App\Models\Vendor;
use App\Orchid\Filters\VendorQueryFilter;
use Orchid\Crud\Filters\DefaultSorted;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\TD;

class VendorProductOptionResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\VendorProductOption::class;

    public function with(): array
    {
        return ['vendor','optionType'];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        $fields = [
        Input::make('name')->title('Name')->required(),
        Input::make('price')->title('Price')->required(),
        Relation::make('option_type_id')->fromModel(OptionType::class, 'name')->title('Option Type')->required()->chunk(200),
        CheckBox::make('default_option')
                    ->value(1)
                    ->title('Is Default Option')
                    ->sendTrueOrFalse(),

        CheckBox::make('charge')
                    ->value(1)
                    ->title('Is Chargeable')
                    ->sendTrueOrFalse()


        ];

        if(auth()->user()->isAdmin()){
            $fields[] = Relation::make('vendor_id')->fromModel(Vendor::class, 'vendor_name')->title('Vendor')->required()->chunk(100);
        }else{
            $fields[] = Input::make('vendor_id')
                ->type('hidden')
                ->value(auth()->id());
        }

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
            TD::make('vendor_id', 'Vendor')->render(fn($p) => $p->vendor->name),
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
        if(auth()->user()->isAdmin()){
            return [ new DefaultSorted('option_type_id', 'desc')];
        }

        return [VendorQueryFilter::class, new DefaultSorted('option_type_id', 'desc')];
    }

     public static function displayInNavigation(): bool
    {
//        if(auth()->check() && auth()->user()->isAdmin()){
//                return true;
//        }
        return true;
    }

        /**
     * Get the permission key for the resource.
     *
     * @return string|null
     */
    public static function permission(): ?string
    {
        return null;
    }
}
