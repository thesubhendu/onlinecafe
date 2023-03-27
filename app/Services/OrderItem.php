<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;

class OrderItem
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function add(Product $product, $quantity, array $options): void
    {
        $calculateProductTotal = new CalculateProductTotal($product, $options);
        $readableOptions = $calculateProductTotal->redableOptions;

        $productExist = OrderProduct::where(
            [
                'product_id' => $product->id,
                'order_id'   => $this->order->id,
            ]
        )
            ->whereJsonContains('options', $readableOptions)
            ->first();

        if ($productExist) {
            $quantity += $productExist->quantity;
            $productExist->update(['quantity'=> $quantity]);
        } else {
            $this->order->products()
                ->attach($product->id, [
                    'price'    => $calculateProductTotal->totalPrice,
                    'quantity' => $quantity,
                    'options'  => json_encode($readableOptions)
                ]);
        }
    }
    public function addRewardProduct(Product $product, $quantity, array $options): void
    {
        $cardId = $options['card_id'];
        $calculateProductTotal = new CalculateProductTotal($product, $options);
        $readableOptions = $calculateProductTotal->redableOptions;

        $productExist = OrderProduct::where(
            [
                'product_id' => $product->id,
                'price'      => 0,
                'card_id'=> $cardId,
                'order_id'   => $this->order->id,
            ]
           )
            ->first();

        if ($productExist) {
            $productExist->update(['options'  => json_encode($readableOptions)]);
        } else {
            $this->order->products()
                ->attach($product->id, [
                    'price'    => 0,
                    'card_id'=> $cardId,
                    'quantity' => $quantity,
                    'options'  => json_encode($readableOptions)
                ]);
        }
    }

    public function remove($productId): int
    {
        return $this->order->products()->detach($productId);

    }

    public function update($orderProduct, array $updateData)
    {
        unset($updateData['vendor_id']);

        return $orderProduct->update($updateData);
    }

}
