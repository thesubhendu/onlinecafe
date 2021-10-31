<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'price', 'category_id'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
