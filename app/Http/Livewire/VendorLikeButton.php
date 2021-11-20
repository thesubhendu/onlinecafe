<?php

namespace App\Http\Livewire;

use Livewire\Component;

class VendorLikeButton extends Component
{

    public $vendor;

    public function mount($vendor)
    {
        $this->vendor = $vendor;
    }

    public function toggleLike()
    {
        $this->vendor->toggleFavorite();

        session()->flash('message', 'Favourites Updated');
    }

    public function render()
    {
        return view('livewire.vendor-like-button');
    }
}
