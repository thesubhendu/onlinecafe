<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Deal extends Model
{
    use HasFactory, Filterable, AsSource;

    protected $guarded = [];
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price', 'quantity','options')->withTimestamps();
    }
}
