<?php

namespace App\Http\Livewire\VendorOnboarding;

use App\Models\Plan;
use Livewire\Component;

class Payment extends Component
{
    public $clientSecret;

    public $plan;
    public $token;


    public $availablePlans;

    protected $listeners = ['subscribeToPlan' => 'subscribe'];

    public function mount()
    {
        $this->availablePlans = cache()->remember('plans',3600, function() {
            return Plan::pluck('slug', 'title')->all();
        });
        $this->clientSecret = auth()->user()->createSetupIntent()->client_secret;
    }
    public function render()
    {
        return view('livewire.vendor-onboarding.payment');
    }

    public function subscribe()
    {
        $this->validate([
            'token' => 'required',
            'plan' => 'required|exists:plans,slug'
        ]);

        $plan = Plan::where('slug', $this->plan)
                    ->first();

        //todo Subscribe using webhook instead

        auth()->user()->newSubscription('subscribed', $plan->stripe_id)
                ->create($this->token);

        $shop = auth()->user()->shop;
        $shop->is_subscribed = true;
        $shop->save();

        $this->emitUp('paymentSuccess');
    }
}
