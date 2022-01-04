<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class RatingForm extends Component
{
    public $vendor;
    public $rating;
    public $comment = '';

    public function mount(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    public function submit()
    {
        $this->validate([
            'rating' => ['required', 'in:1,2,3,4,5']
        ]);

        $this->vendor->rate($this->rating, null, $this->comment);

        session()->flash('message', 'Rated Successfully!');
        $this->emit('rated');
    }

    public function render()
    {
        return view('livewire.rating-form');
    }
}
