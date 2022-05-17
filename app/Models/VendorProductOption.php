<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorProductOption extends Model implements Buyable
{

    use HasFactory;

    protected $guarded = [];
    protected $casts = ['options' => 'array'];

    public function getBuyableIdentifier($options=null)
    {
        return $this->id;
    }
    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }
    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }
    public function getBuyableWeight($options = null)
    {
        return '0';
    }

    public function optionType(): BelongsTo
    {
        return $this->belongsTo(OptionType::class, 'option_type_id', 'id');
    }

}
