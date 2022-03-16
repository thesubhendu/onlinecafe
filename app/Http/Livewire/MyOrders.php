<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class MyOrders extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.my-orders', ['orders'=> auth()->user()->orders()->latest()->paginate(10)]);
    }
}
