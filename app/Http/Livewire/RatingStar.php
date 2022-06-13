<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class RatingStar extends Component
{
    public $vendor;
    public $ratings;
    public function render()
    {
        return view('livewire.rating-star');
    }

    public function mount(Vendor $vendor)
    {
        $this->vendor = $vendor;

    }

    public function setRating($val)
    {
       try {
           $this->vendor->rate($val);
           $this->vendor->refresh();
           $this->emit('ratingSet');

       } catch (\InvalidArgumentException $e) {

       }
    }
}
