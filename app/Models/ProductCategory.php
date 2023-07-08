<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function optionTypes()
    {
        return $this->hasMany(OptionType::class,'category_id', 'id');
    }
}
