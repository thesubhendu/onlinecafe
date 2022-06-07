<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Services\RewardService;
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

        $reward = $this->handleAutoReward();

        $rewardData = [
          'free_products_claimed'=> $reward->freeProductsClaimed ?? 0,
          'card_id'=> null,
          'stamp_count'=> $reward->stampCount ?? 0
        ];

        $order = (new Order())->generate($this->items, Cart::total(), $rewardData);

        Cart::destroy();
        return redirect()->route('order.submitted', $order);
    }

    public function hydrate()
    {
        $this->refreshCart();
    }
    private  function refreshCart()
    {
        $this->handleAutoReward();

        //check and update cart items
        $this->items     = Cart::content();
        $this->subtotal  = Cart::subtotal() ;
        $this->tax       = Cart::tax();
        $this->total     = Cart::total();
        $this->itemCount = Cart::count();
    }

    public function updateQty($rowId,$value, $action='add')
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


    private function handleAutoReward(): RewardService
    {
        $rewardData = (new RewardService(Cart::content()));
        $lowestPriceProduct = $rewardData->lowestPriceProduct;

        if(!$lowestPriceProduct){
           return $rewardData;
        }
        if ($rewardData->freeProductsClaimed > 0) {
            Cart::update($lowestPriceProduct->rowId, ['options' => ['extras' => $lowestPriceProduct->options['extras'], 'free_products' => $rewardData->freeProductsClaimed]]);

            Cart::setDiscount($lowestPriceProduct->rowId, $rewardData->discount);
        }else{
            $options = $lowestPriceProduct->options;
            unset($options['free_products']);
            Cart::update($lowestPriceProduct->rowId, ['options' => $options]);
            Cart::setDiscount($lowestPriceProduct->rowId, 0);
        }

        return $rewardData;
    }


}
