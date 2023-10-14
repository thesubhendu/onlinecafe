<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AllProduct extends Model
{
    use HasFactory, AsSource, Attachable, Filterable;

    protected $guarded = [];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

}
