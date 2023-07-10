<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;

class VendorQueryFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = [];

    /**
     * @return string
     */
    public function name(): string
    {
        return '';
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {

        return $builder->where('vendor_id', request()->user()->shop->id);
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [Input::make('')
            ->type('hidden')
        ];
    }
}
