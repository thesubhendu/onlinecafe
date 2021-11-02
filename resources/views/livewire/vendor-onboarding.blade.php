<div>
    <x-breadcrumb></x-breadcrumb>
    <x-steps :step="$step"></x-steps>

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
