<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;


class CartService
{
    public function addToCart(array $productData): Order
    {
        $activeOrder = $this->getActiveOrder();

        if (!$activeOrder) {
            $activeOrder = $this->createActiveOrder($productData);
        }

        (new OrderItem($activeOrder))->add($productData);

        return $this->updateOrder($activeOrder);
    }

    public function remove(OrderProduct $orderProduct): Order
    {
        $orderProduct->delete();

        return $this->updateOrder($this->getActiveOrder());
    }

    public function update(OrderProduct $orderProduct, array $updateData): Order
    {
        (new OrderItem($this->getActiveOrder()))->update($orderProduct, $updateData);

        return $this->updateOrder($this->getActiveOrder());
    }

    public function destroy(): void
    {
        $activeOrder = $this->getActiveOrder();
        if ($activeOrder) {
            $activeOrder->delete();
        }
    }

    private function updateOrder($order): Order
    {
        $subTotal = $this->priceTotal($order->products->sum('pivot.price'), $order->products->sum('pivot.quantity'));
        $taxTotal = $this->tax($subTotal);
        $data = [
            'sub_total'   => $subTotal,
            'tax'         => $taxTotal,
            'order_total' => $this->total($subTotal, $taxTotal)
        ];

        return (new orderService())->update($order, $data);
    }

    public function getActiveOrder(): null|Order
    {
        return Order::where('user_id', auth()->id())->where('status', 'pending')->with('products')->first();
    }

    public function priceTotal($price, $qty): float
    {
        return round($price * $qty, 2);
    }

    public function tax($price): float
    {
        return round($price * (10 / 100), 2);
    }

    private function total($subtotal, $taxTotal): float
    {
        return round($subtotal + $taxTotal, 2);
    }

    private function createActiveOrder(array $productData): Order
    {
        $orderService = new OrderService();
        $subTotal = $this->priceTotal($productData['price'], $productData['qty']);
        $taxTotal = $this->tax($subTotal);

        $order = [
            'order_number' => uniqid(),
            'user_id'      => auth()->id(),
            'vendor_id'    => $productData['vendor_id'],
            'sub_total'    => $subTotal,
            'tax'          => $taxTotal,
            'order_total'  => $this->total($subTotal, $taxTotal),
            'status'       => 'pending'
        ];

        return $orderService->create($order);
    }

}
