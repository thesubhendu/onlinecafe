<div >
    <div class="stepwizard mt-4 mb-3">
        <div class="stepwizard-row">
            <div class="stepwizard-step">

                <button wire:click="updateStep('register')" type="button"
                        class="btn btn-{{$step == 'register'? 'primary': 'secondary'}} btn-circle">1
                </button>
                <p>Register Business</p>
            </div>
            <div class="stepwizard-step">
                <button wire:click="updateStep('payment')" type="button"
                        class="btn btn-{{$step == 'payment'? 'primary': 'secondary'}} btn-circle">2
                </button>
                <p>Payment</p>
            </div>
            <div class="stepwizard-step">
                <button wire:click="updateStep('shop-setup')" type="button"
                        class="btn btn-{{$step == 'shop-setup'? 'primary': 'secondary'}} btn-circle">3
                </button>
                <p>Setup Your Shop</p>
            </div>
        </div>
    </div>

    @if($step =='register')
        <livewire:vendor-onboarding.registration/>
    @endif

   @if($step =='payment')
        <livewire:vendor-onboarding.payment/>
   @endif

   @if($step =='shop-setup')
        <livewire:vendor-onboarding.shop-setup/>
   @endif
</div>
