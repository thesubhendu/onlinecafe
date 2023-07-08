<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class ProductCategory extends Model
{
    use AsSource;
    use Filterable;
    use HasFactory;

    protected $guarded = [];

    public function allProducts()
    {
        return $this->hasMany(AllProduct::class,'category_id', 'id');
    }

    public function optionTypes(): BelongsToMany
    {
        return $this->belongsToMany(OptionType::class, 'product_category_option_type','product_category_id','option_type_id');
    }
}
