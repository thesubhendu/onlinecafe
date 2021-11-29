<?php

namespace App\Http\Livewire;

use App\Mail\FreeCoffeeGiftMail;
use App\Models\Card;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class PayForwardForm extends Component
{
    public $card;

    public $email;

    public $feedbackMessage;

    public function mount(Card $card)
    {
        $this->card = $card;
    }

    public function send()
    {
        $this->validate(['email' => 'required|email']);

        $this->card->update(['receiver_email' => $this->email]);

        Mail::to($this->email)->send(new FreeCoffeeGiftMail(auth()->user()));

        $this->feedbackMessage = "Gift sent!";
        $this->emitUp('giftTransferred', $this->card);
    }


    public function render()
    {
        return view('livewire.pay-forward-form');
    }
}
