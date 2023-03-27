<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Deal extends Model
{
    use HasFactory, Filterable, AsSource, Attachable;

    protected $dates = ['expires_at'];
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

    public function addToCart()
    {
        if(!$this->isActive()) {
            return false;
        }

        $dealProducts = $this->products;

        foreach ($dealProducts as $product) {
            $cartProduct = [
                'id'      => $product->id,
                'name'    => $product->name,
                'price'   => $product->pivot->price,
                'weight'  => '0',
                'qty'     => $product->pivot->quantity,
                'options' => json_decode($product->pivot->options['extras'] ?? [], true),
            ];

            Cart::add($cartProduct)->associate(Product::class);
        }

    }

    public function isActive()
    {
        return $this->status && $this->expires_at->greaterThanOrEqualTo(now());
    }

    public function scopeActive($query)
    {
        $query->where('status', '1')->where('expires_at','>=',now());
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function updateTotal()
    {
        $this->fill([
            'total'=> $this->products->reduce(fn($carry,$product) => $carry + ($product->pivot->price*$product->pivot->quantity))
        ])->save();
    }
}
