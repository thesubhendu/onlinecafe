<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class FavoriteVendors extends Component
{
    public $vendors;

    public $listeners = ['favoriteVendorsUpdated'=>'refreshVendors'];

    public function mount()
    {
        $this->refreshVendors();
    }

    public function refreshVendors()
    {
        $this->vendors = auth()->user()->favorite(Vendor::class);

    }

    public function render()
    {
        return view('livewire.favorite-vendors');
    }
}
