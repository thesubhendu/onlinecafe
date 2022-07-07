<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;

class OrderItem
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function add($data): void
    {
        $productExist = OrderProduct::where(
            [
                'product_id' => $data['product_id'],
                'price'      => $data['price'],
                'order_id'   => $this->order->id,
            ]
        )
            ->whereJsonContains('options', $data['options'])
            ->first();

        if ($productExist) {
            $data['quantity'] += $productExist['quantity'];
            $this->update($productExist, $data);
        } else {
            $this->order->products()
                ->attach($data['product_id'], [
                    'price'    => $data['price'],
                    'quantity' => $data['quantity'],
                    'options'  => json_encode($data['options'])
                ]);
        }
    }

    public function remove($productId): int
    {
        return $this->order->products()->detach($productId);

    }

    public function update($orderProduct, array $updateData)
    {
        return $orderProduct->update($updateData);
    }

}
