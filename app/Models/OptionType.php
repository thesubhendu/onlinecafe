<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OptionType extends Model
{
    use HasFactory;

    public function vendorProductOptions(): HasMany
    {
        return $this->hasMany(VendorProductOption::class);
    }
}
