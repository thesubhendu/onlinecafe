<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MyOrders extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = auth()->user()->orders()->latest()->get();

    }

    public function render()
    {
        return view('livewire.my-orders');
    }
}
