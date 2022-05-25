<?php

namespace App\Http\Livewire;

use App\Mail\orderSubmitted;
use App\Models\Card;
use App\Models\Deal;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\NewOrderNotification;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
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

    public $deal;
    public $claimLoyaltyCard;
    public $totalCardClaimedCount = 0;

    public function mount()
    {
        if(request('deal')) {
            Cart::destroy();
            $deal = Deal::find(request('deal'));
            if($deal->isActive()){
                $this->deal = $deal;
                $deal->addToCart();
            }
        }
        $this->claimLoyaltyCard = $this->verifyLoyaltyCard();

        $this->refreshCart();
        $this->fill([
            'user'=> auth()->user(),
            'cartItems'=> Cart::content(),
        ]);

        $this->qtyOptions = [1, 2, 3, 4, 5, 6, 7, 8];
    }

    public function submit()
    {
        if(empty($this->items)) {
            session()->flash('message', 'Empty Cart');
            return back();
        }

        $order = (new Order())->generate($this->items, Cart::total());

        $confirm_url = URL::signedRoute('confirm_order.confirm', $order->id);

        Mail::to($order->vendor->shop_email ?? $order->vendor->email)
            ->send(new orderSubmitted($order, $confirm_url));

//        \App\Events\OrderSubmitted::dispatch($order);
        $order->vendor->owner->notify(new NewOrderNotification($order));

        if($this->claimLoyaltyCard) {
            $this->updateLoyaltyCard($this->claimLoyaltyCard, $this->items);
        }

        Cart::destroy();

        return redirect()->route('order.submitted', $order);
    }

    public function hydrate()
    {
        $this->items = Cart::content();
    }
    private function refreshCart()
    {
        $this->items     = Cart::content();
        $this->subtotal  = Cart::subtotal();
        $this->tax       = Cart::tax();
        $this->total     = Cart::total();
        $this->itemCount = Cart::count();
    }

    public function render()
    {
        return view('livewire.checkout')->layout('layouts.app');
    }

    public function updateQty($rowId,$value,$action='add')
    {
        if($action == 'remove') {
            $value--;
        }else{
            $value ++;
        }
        if($value < 1) {
            return;
        }
        Cart::update($rowId, $value);
        $this->refreshCart();
    }

    public function removeItem($id)
    {
        Cart::remove($id);
        $this->refreshCart();
        $this->verifyLoyaltyCard();
        session()->flash("message", "Item has been removed");
    }

    private function verifyLoyaltyCard()
    {
        if(request('claim_loyalty_card'))
        {
            $claimCard = Card::find(request('claim_loyalty_card'));
            if ($claimCard && $claimCard->eligibleClaimLoyalty()) {
                $this->totalCardClaimedCount = $claimCard->total_claimed;
                foreach(Cart::content() as $row) {
                    if($row->price == 0)
                    {
                        $this->totalCardClaimedCount += $row->qty;
                    }
                }

                return $claimCard;
            }
            Cart::destroy();
        }

        return null;
    }

    private function updateLoyaltyCard($loyaltyCard ,$products): void
    {
        $loyaltyCard->total_claimed = $this->totalCardClaimedCount;
        if($loyaltyCard->total_claimed === $loyaltyCard->vendor->get_free)
        {
            $loyaltyCard->loyalty_claimed = 1;
            $loyaltyCard->is_active = 0;
        }
        $loyaltyCard->save();
    }
}
