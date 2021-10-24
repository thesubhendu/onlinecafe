<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'order_number', 'is_confirmed', 'paymnent_method', 'order_total', 'user_id', 'vendor_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        'date' => 'datetime:d-m-Y'
    ];

    public function getFormattedDate()
    {
        return $this->date->format('d-m-Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price', 'quantity', 'milk', 'sugar', 'syrup')->withTimestamps();
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function confirm()
    {
        $this->confirmed_at = now();
        $this->confirmed_by = auth()->id();
        $this->save();

        return $this;
    }
}
