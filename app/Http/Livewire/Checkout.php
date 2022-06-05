<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Checkout extends Component
{
    public $items;
    public $itemCount;
    public $subtotal;
    public $total;
    public $tax;
    public $user;
    public $qtyOptions;

    public function render()
    {
        return view('livewire.checkout')->layout('layouts.app');
    }

    public function mount()
    {
        $this->refreshCart();
        $this->fill([
            'user'=> auth()->user(),
            'qtyOptions' => [1, 2, 3, 4, 5, 6, 7, 8]
        ]);
    }

    public function submit()
    {
        if(empty($this->items)) {
            session()->flash('message', 'Empty Cart');
            return back();
        }

        $order = (new Order())->generate($this->items, Cart::total());

        Cart::destroy();
        return redirect()->route('order.submitted', $order);
    }

    public function hydrate()
    {
        $this->refreshCart();
    }
    private  function refreshCart()
    {
        //check and update cart items
        $this->items     = $this->getCartContent();
        $this->subtotal  = Cart::subtotal();
        $this->tax       = Cart::tax();
        $this->total     = Cart::total();
        $this->itemCount = Cart::count();
    }

    protected function getCartContent()
    {
        $items = Cart::content();
        $stampableProducts = $this->stampableProducts($items);
        $this->resetFreeProductCount($stampableProducts); //value may change on quantity update

        list($lowestPriceProduct, $finalFreeQty) = $this->freeItemsCount($stampableProducts);
        Cart::update($lowestPriceProduct->rowId, ['options'=> ['extras'=> $lowestPriceProduct->options['extras'], 'free_products'=>$finalFreeQty]]);

        return Cart::content();
    }


    public function updateQty($rowId,$value,$action='add')
    {
        if($action == 'remove') {
            $value--;
        }else{
            $value ++;
        }
        if($value < 1) {
            $this->refreshCart();
            return;
        }
        Cart::update($rowId, $value);
        $this->refreshCart();
    }

    public function removeItem($id)
    {
        Cart::remove($id);
        $this->refreshCart();
        session()->flash("message", "Item has been removed");
    }

    /**
     * @param $items
     * @return mixed
     */
    private function stampableProducts($items)
    {
        $stampableProducts = $items->filter(function ($product) {
            $model = $product->model;
            return $model->category_id == $model->vendor->free_category;
        });
        return $stampableProducts;
    }

    /**
     * @param mixed $stampableProducts
     */
    protected function resetFreeProductCount(mixed $stampableProducts): void
    {
        $stampableProducts->each(function ($product) {
            $options = $product->options;
            unset($options['free_products']);
            Cart::update($product->rowId, ['options' => $options]);
        });
    }

    /**
     * @param $items
     * @return array
     */
    protected function freeItemsCount($stampableProducts): array
    {
//            $freeProductsToClaim = auth()->user()->remainingClaims();
//            $stampsToCompleteCard = auth()->user()->remainingStampsOnActiveCard();
        $remainingFreeProductClaims = 2;
        $stampsToCompleteCard = 3;

        $this->resetFreeProductCount($stampableProducts); //value may change on quantity update

        $lowestPriceProduct = $stampableProducts->sortBy('price')->first();

        $totalPurchaseQty = $stampableProducts->sum('qty');
        $extraQtyAfterStamps = $totalPurchaseQty - $stampsToCompleteCard;
        $vendor = $lowestPriceProduct->model->vendor;

        $vendorOfferedFreeQty = $vendor->get_free;

        if ($extraQtyAfterStamps >= $vendorOfferedFreeQty) {
            $extraQtyAfterStamps = $vendorOfferedFreeQty;
        }

        if ($extraQtyAfterStamps >= $lowestPriceProduct->qty) {
            $finalFreeQty = $lowestPriceProduct->qty;
        } else {
            $finalFreeQty = $extraQtyAfterStamps;
        }

        if ($finalFreeQty < 1) {
            $finalFreeQty = 0;
        }
        return array($lowestPriceProduct, $finalFreeQty);
    }

}
