<?php

namespace App\Models;

use App\Traits\ApplyVendorScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class VendorProductOption extends Model
{
    use AsSource;
    use Filterable;
    use HasFactory;
    use ApplyVendorScope;

    protected $guarded = [];
    protected $casts = ['options' => 'array'];


    public function optionType(): BelongsTo
    {
        return $this->belongsTo(OptionType::class, 'option_type_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

}
