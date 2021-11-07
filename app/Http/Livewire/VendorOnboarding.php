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
        $this->step = 'register';
//        $this->step = 'shop-setup';
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
