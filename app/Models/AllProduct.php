<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AllProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

}
