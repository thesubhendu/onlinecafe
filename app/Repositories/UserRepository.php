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
        return $this->orderProduct::with('order', 'product')
            ->get();
    }

}
