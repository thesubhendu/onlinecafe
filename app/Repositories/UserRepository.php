<?php


namespace App\Repositories;


use App\Models\Order;
use App\Models\OrderProduct;
use DB;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function __construct(
        public OrderProduct $orderProduct,
        public Order $order
    ) {
    }

    public function myOrderProducts(): Collection|array
    {
        return $this->orderProduct::whereHas('order', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->with('order', 'order.vendor')->latest()->get();
    }

    public function mostOrderedProducts($userId)
    {
        return $this->orderProduct
            ->select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->whereHas('order', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->with([
                'product'             => function ($query) {
                    $query->select('id', 'name', 'price', 'vendor_id', 'category_id');
                }, 'product.category' => function ($query) {
                    $query->select('id', 'name');
                },
            ])
            ->orderByRaw('count(*) DESC')
            ->limit(5)
            ->get();
    }

    public function mostFrequentVendors($userId)
    {
        return $this->order->where('user_id', $userId)
            ->select('vendor_id', DB::raw('count(*) as total'))
            ->groupBy('vendor_id')
            ->with('vendor')
            ->orderByRaw('count(*) DESC')
            ->limit(5)
            ->get();
    }

}
