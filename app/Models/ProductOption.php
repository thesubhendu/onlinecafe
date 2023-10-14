<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class ProductOption extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $fillable = ['name', 'description', 'image', 'price', 'option_type_id'];

    protected $casts = ['options' => 'array'];


    public function scopeZeroChargeProductOptions($query)
    {
        return $query->where('charge', 0);
    }

    public function optionType()
    {
        return $this->belongsTo(OptionType::class);
   }

}
