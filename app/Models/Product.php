<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory, AsSource, Attachable, Filterable;

    protected $fillable = ['name', 'description', 'product_image', 'price', 'category_id', 'vendor_id', 'is_active'];

    protected $allowedSorts = [
        'name',
        'created_at',
        'updated_at',
    ];

    protected $allowedFilters = [
        'name',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function options()
    {
//        return ProductOption::where('category_id', $this->category_id)->get();
        return VendorProductOption::where('category_id', $this->category_id)->where('vendor_id', $this->vendor_id)->get();
    }
}
