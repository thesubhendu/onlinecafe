<?php


namespace App\Services;


use App\Models\Order;
use App\Models\User;

class OrderService
{

    public function create(array $orderData): Order
    {
        return Order::create($orderData);
    }

    public function update($order, array $updateData): Order
    {
        return tap($order->fill($updateData))->save();
    }

    public function destroy($orderId)
    {

    }

    public function pendingOrder($order)
    {
        return Order::where('user_id', auth()->id())->where('status', 'pending')->with('products')->first();
    }
}
