<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Order;
use App\Models\OrderProduct;

class RewardClaimService
{
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

        return (new orderService())->create($order)->load('products', 'card', 'vendor');
    }

    public function addClaimProductOnCart($data): ?Order
    {
        $data['price'] = 0;
        $data['quantity'] = 1;
        $order = $this->getClaimedOrder();
        (new OrderItem($order))->add($data);

        return $order->refresh();
    }

    public function remove(OrderProduct $orderProduct): Order
    {
        $orderProduct->delete();

        return $this->getClaimedOrder();
    }

    public function getClaimedOrder(): null|Order
    {
        return Order::where('user_id', auth()->id())
            ->where('status', 'rewardClaim')
            ->with('products', 'card', 'vendor')
            ->first();
    }

    public function destroy(): bool
    {
        $claimOrder = $this->getClaimedOrder();
        if ($claimOrder) {
            $claimOrder->delete();
        }

        return true;
    }

    public function verifiedLoyaltyCard($card): ?Card
    {
        if ($card && $card->loyalty_claimed === 0 && $card->is_max_stamped === 1 && $card->user_id === auth()->id()) {
            return $card;
        }

        return null;
    }

    public function remainingClaimProductCount($order): int
    {
        $card = $order->card;

        return ($card->vendor->get_free - $card->total_claimed) - $order->products->sum(function ($product) {
                return $product->pivot->quantity;
            });
    }

    public function updateRewardCardOnCheckout($order): void
    {
        $card = $order->card;
        $card->total_claimed += $order->products()->count();
        if ($card->total_claimed === $card->vendor->get_free) {
            $card->loyalty_claimed = 1;
        }
        $card->save();
    }

}
