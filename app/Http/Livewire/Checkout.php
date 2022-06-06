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

        $autoReward = $this->handleAutoReward();

        $rewardData = [
          'free_products_claimed'=> $autoReward['free_products_claimed'],
          'card_id'=> null,
          'stamp_count'=> $autoReward['stamp_count']
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


    /**
     * @param mixed $stampableProducts
     */
    private function resetFreeProductCount(mixed $stampableProducts): void
    {
        $stampableProducts->each(function ($product) {
            $options = $product->options;
            unset($options['free_products']);
            Cart::update($product->rowId, ['options' => $options]);
        });
    }

    private function handleAutoReward(): array
    {
        $stampableProducts = (new RewardService())->stampableProducts(Cart::content());
        $lowestPriceProduct = $stampableProducts->sortBy('price')->first();

        $this->resetFreeProductCount($stampableProducts); //value may change on quantity update
        $rewardData = (new RewardService())->freeItemsCount($stampableProducts);
        $finalFreeQty = $rewardData['free_products_claimed'];
        if ($lowestPriceProduct && $finalFreeQty > 0) {
            Cart::update($lowestPriceProduct->rowId, ['options' => ['extras' => $lowestPriceProduct->options['extras'], 'free_products' => $finalFreeQty]]);
            $priceToReduce = $finalFreeQty * $lowestPriceProduct->price ?? 0;
            Cart::setDiscount($lowestPriceProduct->rowId, $priceToReduce);
        }

        return $rewardData;
    }

}
