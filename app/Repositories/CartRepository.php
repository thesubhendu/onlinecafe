<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    public function __construct(
        public Cart $cart
    ) {
    }

    public function get()
    {
        return auth()->user()->carts()->with('product')->get();
    }

    public function addToCart($data)
    {
        $cartExist = auth()->user()->carts()->where(
            [
                'product_id' => $data['product_id'],
                'price'      => $data['price'],
            ]
        )
            ->whereJsonContains('options', $data['options'])
            ->first();

        if ($cartExist) {
            $data['quantity'] += $cartExist['quantity'];
            $data['options'] = json_encode($data['options']);

            return tap($cartExist)->update($data);
        }

        return auth()->user()->carts()
            ->create([
                'product_id' => $data['product_id'],
                'price'      => $data['price'],
                'quantity'   => $data['quantity'],
                'options'    => json_encode($data['options'])
            ]);

    }

    public function removeFromCart(Cart $cart): ?bool
    {
        return $cart->delete();
    }

    public function update($cart, $data)
    {
        return tap($cart)->update($data);
    }

    //destroy
}
