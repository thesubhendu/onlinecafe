<?php


namespace App\Repositories;


use App\Models\Cart;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Collection;

class CartRepository
{
    public function __construct(
        public Cart $cart
    ) {
    }

    public function addToCart($data)
    {
        return auth()->user()->carts()->create($data);
    }

    public function removeFromCart(Cart $cart): ?bool
    {
        return $cart->delete();
    }

}
