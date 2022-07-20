<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Order;
use App\Models\OrderProduct;

class RewardClaimService
{
    public function applyManualClaim($card): Order
    {
        $this->destroyClaimedOrder($card->user_id);

        $order = [
            'order_number' => uniqid(),
            'user_id'      => $card->user_id,
            'vendor_id'    => $card->vendor->id,
            'status'       => 'rewardClaim',
            'card_id'      => $card->id,
        ];

        return (new OrderService())->create($order)->load('products', 'card', 'vendor');
    }

    public function addClaimProductOnCart($order, $data): ?Order
    {
        $data['price'] = 0;
        $data['quantity'] = 1;
        (new OrderItem($order))->add($data);

        return $order->refresh();
    }

    public function remove(OrderProduct $orderProduct): Order
    {
        $userId = $orderProduct->order->user_id;
        $orderProduct->delete();

        return $this->getClaimedOrder($userId);
    }

    public function getClaimedOrder($userId): null|Order
    {
        return Order::where('user_id', $userId)
            ->where('status', 'rewardClaim')
            ->with('products', 'card', 'vendor')
            ->first();
    }

    public function destroyClaimedOrder($userId): bool
    {
        $claimOrder = $this->getClaimedOrder($userId);
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
        $card->total_claimed += $order->products->sum(function ($product) {
            return $product->pivot->quantity;
        });
        if ($card->total_claimed === $card->vendor->get_free) {
            $card->loyalty_claimed = 1;
        }
        $card->save();
    }

}
