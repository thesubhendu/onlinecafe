<!-- STEPS CONTENT -->
<div class="row bs-wizard">

    <!-- INFORMATION -->
    <div wire:click="updateStep('register')"
         class="col-md-4 col-sm-4 col-xs-4 bs-wizard-step {{$step == 'register'? 'active': ''}}">
        <div class="text-center bs-wizard-stepnum">Register Business</div>
        <div class="progress">
            <div class="progress-bar"></div>
        </div>
        <a href="#" class="bs-wizard-dot"></a>
    </div>

    <!-- SHIPPING -->
    <div wire:click="updateStep('payment')"
         class="col-md-4 col-sm-4 col-xs-4 bs-wizard-step {{$step == 'payment'? 'active': ''}}">
        <div class="text-center bs-wizard-stepnum">Payment</div>
        <div class="progress">
            <div class="progress-bar"></div>
        </div>
        <a href="#" class="bs-wizard-dot"></a>
    </div>

    <!-- NOT COMPLETE -->
    <div wire:click="updateStep('shop-setup')"
         class="col-md-4 col-sm-4 col-xs-4 bs-wizard-step {{$step == 'shop-setup'? 'active': ''}}">
        <div class="text-center bs-wizard-stepnum">Setup your shop</div>
        <div class="progress">
            <div class="progress-bar"></div>
        </div>
        <a href="#" class="bs-wizard-dot"></a>
    </div>

</div>
