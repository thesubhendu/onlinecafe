<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class OptionType extends Model
{
    use HasFactory, AsSource, Filterable;

    public function vendorProductOptions(): HasMany
    {
        return $this->hasMany(VendorProductOption::class);
    }
}
