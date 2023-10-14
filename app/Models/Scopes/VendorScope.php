<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class VendorScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $shop = auth()->user()?->shop;

        if($shop){
            $builder->where('vendor_id',$shop->id);
        }
    }
}
