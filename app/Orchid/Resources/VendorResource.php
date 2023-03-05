<?php

namespace App\Orchid\Resources;

use Orchid\Crud\Resource;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\TD;

class VendorResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Vendor::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
          Input::make('vendor_name')->title('Vendor Name')->required(),
          Input::make('mobile')->title('Vendor Mobile')->required(),
          Input::make('stripe_account_id')->title('Stripe account ID'),
          CheckBox::make('is_active')
            ->value(1)
            ->title('Shop Active Status')
            ->sendTrueOrFalse()


        ];
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

            TD::make('vendor_name'),
            TD::make('contact_name'),
            TD::make('contact_lastname'),
            TD::make('email'),
            TD::make('mobile'),
//            TD::make('stripe_account_id'),

            TD::make('created_at', 'Date of creation')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),

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
