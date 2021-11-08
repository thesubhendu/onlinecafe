<?php

namespace App\Http\Livewire;

use Livewire\Component;

class VendorOnboarding extends Component
{
    public $step;

    private $allSteps =
        [
            'register',
            'payment',
            'shop-setup',
        ];

    protected $listeners = [
        'vendorRegistered' => 'onVendorRegistration',
        'paymentSuccess'   => 'onPaymentSuccess',
        'shopSetup'        => 'onShopSetup',
    ];

    public function mount()
    {
        $authUser = auth()->user();

        if ( ! $authUser->hasRole('vendor')) {
            $this->step = 'register';
        } elseif ($authUser->shop && $authUser->shop->is_subscribed) {
            $this->step = 'shop-setup';
        } else {
            $this->step = 'payment';
        }
    }

    public function render()
    {
        return view('livewire.vendor-onboarding');
    }

    public function updateStep($step)
    {
        $this->step = $step;
    }

    public function onVendorRegistration()
    {
        $this->updateStep('payment');

    }

    public function onPaymentSuccess()
    {
        $this->updateStep('shop-setup');

    }

    public function onShopSetup()
    {

    }


}
