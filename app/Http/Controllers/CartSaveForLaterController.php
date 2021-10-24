<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartSaveForLaterController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * move to save for later.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function save($id)
    {
        $item = Cart::get($id);

        Cart::remove($id);

        Cart::instance('saveForLater')->add([
            'id' => $item->id, 'name' => $item->name, 'qty' => 1, 'price' => $item->price, 'options' => [
                'milk'  => 'Full Cream',
                'sugar' => 1,
                'syrup' => 'No Thanks',
            ],
        ])
            ->associate(Product::class);

        return back()->with('success_message', 'Item has been moved to save for later');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        return back()->with('success_message', 'Item has been removed from save for later');
    }

    /**
     * move item to the cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function moveToCart($id)
    {
        $item = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)
                ->associate(Product::class);

        return back()->with('success_message', 'Item has been moved to cart');
    }
}
