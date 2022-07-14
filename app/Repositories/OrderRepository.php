<?php

namespace App\Repositories;

use App\Models\Order;
use App\Services\RewardClaimService;
use Illuminate\Support\Facades\Mail;
use App\Mail\orderSubmitted;
use Illuminate\Support\Facades\URL;
use App\Notifications\NewOrderNotification;

class OrderRepository
{
    public function __construct(
        public Order $order,
        public RewardClaimService $rewardClaimService
    ) {
    }

    public function submitOrder($status)
    {
        $order = $this->order->where('user_id', auth()->id())
            ->when($status === 'pending', function ($q) {
                return $q->where('status', 'pending');
            })->when($status === 'rewardClaim', function ($q) {
                return $q->where('status', 'rewardClaim');
            })->first();

        $stampCount = $order->products->sum(function ($product) {
            return $product->pivot->quantity;
        });

        $order->status = 'processing';
        $order->stamp_count = $stampCount;
        $order->save();

        if ($order->card_id) {
            $this->rewardClaimService->updateRewardCardOnCheckout($order);
        }

        $confirm_url = URL::signedRoute('confirm_order.confirm', $order->id);

        Mail::to($order->vendor->shop_email ?? $order->vendor->email)
            ->send(new orderSubmitted($order, $confirm_url));
        $order->vendor->owner->notify(new NewOrderNotification($order));

        return $order;
    }

}
