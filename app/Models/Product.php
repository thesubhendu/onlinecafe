<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;
use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements Buyable
{

    use \App\Traits\CanBeBought;

    use HasFactory, AsSource, Attachable, Filterable;

    protected $fillable = ['name', 'description', 'product_image', 'price', 'category_id', 'vendor_id', 'is_active', 'is_stamp', 'is_all_sizes_available'];

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

    public function optionTypes()
    {
        return OptionType::where('category_id', $this->category_id)
            ->whereHas('vendorProductOptions')
            ->with(['vendorProductOptions' =>  function($query){
                return $query->where('vendor_id', $this->vendor_id)->orderBy('price');
            }])
            ->orderBy('name')
            ->get();
    }

    public function productPrices(): HasMany
    {
        return $this->hasMany(ProductPrice::class);
    }

//    public function stamps(): HasMany
//    {
//        return $this->hasMany(Stamp::class);
//    }

}
