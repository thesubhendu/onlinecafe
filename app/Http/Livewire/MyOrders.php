<?php

namespace App\Http\Livewire;

use App\Models\OrderProduct;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrders extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $orderProducts = OrderProduct::whereHas('order', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->with('order', 'order.vendor')->latest()->paginate(10);

        return view('livewire.my-orders', [
            'orderProducts' => $orderProducts,
        ]);
    }
}
