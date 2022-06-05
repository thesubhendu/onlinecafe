<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class LoyalityCheckout extends Component
{
    public $items;
    public $itemCount;
    public $subtotal;
    public $total;
    public $tax;
    public $user;
    public $qtyOptions;
    public $deal;
    public $validLoyaltyClaimCard;

    public function render()
    {
        return view('livewire.loyality-checkout')->layout('layouts.app');
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

    private  function refreshCart()
    {
        $this->items     = Cart::content();
        $this->subtotal  = Cart::subtotal();
        $this->tax       = Cart::tax();
        $this->total     = Cart::total();
        $this->itemCount = Cart::count();
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

}
