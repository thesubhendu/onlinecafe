<div class="partners-steps">

    <div class="container">

        <div class="row bs-wizard">

            <!-- INFORMATION -->
            <div
                class="col-md-4 col-sm-4 col-xs-4 bs-wizard-step active">
                <div class="text-center bs-wizard-stepnum">Register Business ({{$step !== 'register' ? 'done' : 'notDone'}})
                </div>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
                <a href="#" class="bs-wizard-dot"></a>
            </div>

            <!-- SHIPPING -->
            <div
                class="col-md-4 col-sm-4 col-xs-4 bs-wizard-step active">
                <div class="text-center bs-wizard-stepnum">Payment ({{ $step == 'shop-setup' ? 'done' : 'notDone'}})</div>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
                <a href="#" class="bs-wizard-dot"></a>
            </div>

            <!-- NOT COMPLETE -->
            <div
                class="col-md-4 col-sm-4 col-xs-4 bs-wizard-step active">
                <div class="text-center bs-wizard-stepnum">Setup your shop</div>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
                <a href="#" class="bs-wizard-dot"></a>
            </div>

        </div>

    </div>
</div>
