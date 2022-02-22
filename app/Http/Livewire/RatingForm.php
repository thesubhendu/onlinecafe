<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class RatingForm extends Component
{
    public $vendor;
    public $comment = '';

    public function mount(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    public function submit()
    {
        $currentRating = $this->vendor->ratings()->where(['user_id' => auth()->id()])->first();

        $this->vendor->rate($currentRating->rating, null, $this->comment);

        session()->flash('message', 'Rated Successfully!');
        $this->emit('rated');
    }

    public function render()
    {
        return view('livewire.rating-form');
    }
}
