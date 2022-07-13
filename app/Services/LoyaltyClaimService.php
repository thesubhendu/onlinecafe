<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class LoyaltyClaimService
{

    public function __construct(
        public OrderService $orderService,
        public Card $card,
        public Order $order
    ) {

    }

    public function applyManualClaim($card): Order
    {
        $this->destroy();

        $order = [
            'order_number' => uniqid(),
            'user_id'      => auth()->id(),
            'vendor_id'    => $card->vendor->id,
            'status'       => 'rewardClaim',
            'card_id'      => $card->id,
        ];

        return $this->orderService->create($order);
    }

    public function addClaimProductOnCart($card, $data)
    {
        $card->order->products()
            ->attach($data['product_id'], [
                'price'    => 0,
                'quantity' => 0,
                'options'  => json_encode($data['options'])
            ]);

        return $order->refresh();
    }

    public function remove(OrderProduct $orderProduct): Order
    {
        $orderProduct->delete();

        return $this->getClaimOrder();
    }

    public function getClaimOrder(): null|Order
    {
        return Order::where('user_id', auth()->id())->where('status', 'rewardClaim')->with('products')->first();
    }

    public function destroy(): bool
    {
        $claimOrder = $this->getClaimOrder();
        if ($claimOrder) {
            $claimOrder->delete();
        }

        return true;
    }


//    public function addClaimProductOnCart($card, $cartProduct): void
//    {
//        if ($this->remainingClaim($card)) {
//            $cartProduct['price'] = 0;
//            Cart::instance('manualClaimedProducts')->add($cartProduct)->associate(Product::class);
//        }
//    }

    public function verifiedLoyaltyCard($cardId): ?Card
    {
        $card = Card::find($cardId);
        if ($card && $card->loyalty_claimed === 0 && $card->is_max_stamped === 1 && $card->user_id === auth()->id()) {
            return $card;
        }
        Cart::instance('manualClaimedProducts')->destroy();

        return null;
    }

    public function remainingClaim($card): int
    {
        return ($card->vendor->get_free - $card->total_claimed) - $this->totalProductClaimedOnCart();
    }

    public function totalProductClaimedOnCart(): int
    {
        return Cart::instance('manualClaimedProducts')->content()->sum('qty');
    }

    public function updateLoyaltyCardOnCheckout($cardId): void
    {
        $card = Card::find($cardId);
        $card->total_claimed += $this->totalProductClaimedOnCart();
        if ($card->total_claimed === $card->vendor->get_free) {
            $card->loyalty_claimed = 1;
        }
        $card->save();
    }

}
