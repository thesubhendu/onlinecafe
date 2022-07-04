<?php


namespace App\Repositories;


use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function __construct(
        public OrderProduct $orderProduct
    ) {
    }

    public function myOrderProducts(): Collection|array
    {
        return OrderProduct::whereHas('order', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->with('order', 'order.vendor')->latest()->get();
    }

}
