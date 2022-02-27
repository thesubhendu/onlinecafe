<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

    public function generate($cartItems, $total)
    {
        $vendorId = $cartItems->first()->model->vendor_id;

        $this->update(['data'=> ['total'=> $total]]);

        DB::transaction(function () use($cartItems) {
            $this->products()->delete();
            foreach ($cartItems as $product) {
                $this->products()->attach($product->id, [
                    'price' => $product->price,
                    'quantity' => $product->qty,
                    'options' => json_encode($product->options)
                ]);
            }
        });

        return $this;
    }
}
