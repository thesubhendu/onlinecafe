<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderSubmitted extends Component
{
    public Order $order;

    public function mount()
    {
    }
    public function render()
    {
        return view('livewire.order-submitted')->layout('layouts.app');
    }
}
