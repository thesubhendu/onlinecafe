<?php


namespace App\Services;


use App\Models\Deal;
use App\Models\Order;

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
        (new Order())->generateNew($deal->products, $deal->total, $user);
    }

    //addProduct($deal,$product)
    //updateProduct($request,$deal,$product)
    //removeProduct($deal,$product)
}
