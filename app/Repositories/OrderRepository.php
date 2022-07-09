<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\orderSubmitted;
use Illuminate\Support\Facades\URL;
use App\Notifications\NewOrderNotification;

class OrderRepository
{
    public function __construct(
        public Order $order
    ) {
    }

    public function submitPendingOrder()
    {
        $order = $this->order
            ->where('status', 'pending')
            ->where('user_id', auth()->id())
            ->first();
        $order->status = 'processing';
        $order->save();

        $confirm_url = URL::signedRoute('confirm_order.confirm', $order->id);

        Mail::to($order->vendor->shop_email ?? $order->vendor->email)
            ->send(new orderSubmitted($order, $confirm_url));
        $order->vendor->owner->notify(new NewOrderNotification($order));

        return $order;
    }
}
