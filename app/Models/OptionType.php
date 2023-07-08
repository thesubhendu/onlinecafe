<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class OptionType extends Model
{
    use HasFactory, AsSource, Filterable;

    public function vendorProductOptions(): HasMany
    {
        return $this->hasMany(VendorProductOption::class)->orderBy('default_option', 'desc');
    }

    public function optionTypes(): BelongsToMany
    {
        return $this->belongsToMany(OptionType::class, 'product_category_option_type','product_category_id','option_type_id');
    }

    public function productCategories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_option_type','option_type_id','product_category_id');
    }
}
