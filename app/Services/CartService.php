<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Deal;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;


class CartService
{
    public function __construct(
        public OrderService $orderService
    ) {

    }

    public function addDealToCart(Deal $deal)
    {
        $activeOrder = $this->getActiveOrder();
        $activeOrder->delete();
        $activeOrder = $this->getActiveOrder();
        if (!$activeOrder) {
            $activeOrder = $this->createActiveOrder(auth()->user(), $deal->vendor);
        }

        //see if deal present in cart
        $dealProduct = $activeOrder->products()->where('deal_id', $deal)->first();
        if($dealProduct){
            return $activeOrder;
        }

        $taxTotal = $this->tax($deal->total);
        $data = [
            'sub_total'   => $deal->total,
            'tax'         => $taxTotal,
            'order_total' => $this->total($deal->total, $taxTotal),
        ];

        $order = $this->orderService->update($activeOrder, $data);
        foreach ($deal->products as $product) {
            $activeOrder->products()
                ->attach($product->id, [
                    'price'    => $product->pivot->price,
                    'quantity' => $product->pivot->quantity,
                    'options'  => json_encode(['extra'=> json_decode($product->pivot->options)]),
                    'deal_id'=> $deal->id
            ]);
        }


        return $order;

    }

    public function addToCart(Product $product, $quantity, array $options): Order
    {
        $activeOrder = $this->getActiveOrder();

        if (!$activeOrder) {
            $activeOrder = $this->createActiveOrder(auth()->user(), $product->vendor);
        }

        //handling reward item added to cart
        if(!empty($options['card_id'])) {
            $card = Card::find($options['card_id']);
            if ($card && $card->loyalty_claimed === 0 && $card->is_max_stamped === 1 && $card->user_id === auth()->id()) {
                (new OrderItem($activeOrder))->addRewardProduct($product, $quantity, $options);
            }
        }else{
            (new OrderItem($activeOrder))->add($product, $quantity, $options);
        }

        return $this->updateOrder($activeOrder->refresh());
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

    public function destroy(): bool
    {
        $activeOrder = $this->getActiveOrder();
        if ($activeOrder) {
            $activeOrder->delete();
        }
        return true;
    }

    private function updateOrder($order): Order
    {

        $subTotal = $order->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });

        $taxTotal = $this->tax($subTotal);
        $data = [
            'sub_total'   => $subTotal,
            'tax'         => $taxTotal,
            'order_total' => $this->total($subTotal, $taxTotal)
        ];

        return $this->orderService->update($order, $data);
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
        return round($price * (1 / 11), 2);
    }

    private function total($subtotal, $taxTotal): float
    {
        return round($subtotal, 2);
    }

    private function createActiveOrder(User $user, Vendor $vendor): Order
    {

//        $subTotal = $this->priceTotal($productData['price'], $productData['quantity']);
//        $taxTotal = $this->tax($subTotal);

        $order = [
            'order_number' => uniqid(),
            'user_id'      => $user->id,
            'vendor_id'    => $vendor->id,
            'status'       => 'pending'
        ];

        return $this->orderService->create($order);
    }



}
