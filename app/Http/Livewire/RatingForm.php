<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class RatingForm extends Component
{
    public $vendor;
    public $comment = '';
    public $currentRating;

    public $listeners = ['refreshRating'=>'refreshRating'];

    public function mount(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    public function submit()
    {
        $this->vendor->rate($this->currentRating->rating, null, $this->comment);
        $this->vendor->refresh();

        session()->flash('message', 'Rated Successfully!');
    }

    public function render()
    {
        return view('livewire.rating-form');
    }

    public function refreshRating()
    {
        $this->currentRating = $this->vendor->ratings()->where(['user_id' => auth()->id()])->first();
    }

    public function setRating($val)
    {
        $this->vendor->rate($val);
        $this->refreshRating();
        $this->vendor->refresh();
    }
}
