<?php


namespace App\Services;


use App\Mail\orderSubmitted;
use App\Models\Deal;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class DealService
{
    function __construct(
       private Deal $deal
    )
    {
    }

    public function store(array $data)
    {
        $deal = $this->deal->create($data);
    }

    public function update($deal, array $data)
    {
        $deal->update($data);
        return $deal;
    }

    public function destroy($deal)
    {
        $deal->delete();
    }

    public function createOrder(Deal $deal, $user):Order
    {
        $this->generateNew($deal->products, $deal->total, $user);
    }

    public function generateNew($products, $total, $user)
    {
        $firstProduct = Product::find($products->first()->id);
        $vendorId = $firstProduct->vendor_id;

        $order = new Order();
        $order->order_number = uniqid();
        $order->user_id = $user->id;
        $order->vendor_id = $vendorId;
        $order->order_total = $total;
        $order->save();

        foreach ($products as $product) {
            $order->products()->attach($product->id, [
                'price' => $product->price,
                'quantity' => $product->qty ?? $product->quantity,
                'options' => json_encode($product->options)
            ]);
            // only create loyalty cards only after order confirm
        }

        $confirm_url = URL::signedRoute('confirm_order.confirm', $order->id);
        //todo: ask if need to send to owner or vendor email
        Mail::to($order->vendor->shop_email ?? $order->vendor->email)
            ->send(new orderSubmitted($order, $confirm_url));

//        \App\Events\OrderSubmitted::dispatch($order);
        $order->vendor->owner->notify(new NewOrderNotification($order));

        return $order;
    }

    //addProduct($deal,$product)
    //updateProduct($request,$deal,$product)
    //removeProduct($deal,$product)
}
