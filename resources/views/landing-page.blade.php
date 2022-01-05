<x-app-layout>
@guest
    <!-- MAIN LANDING PAGE -->
        <section class="inner-banner-box landing-banner">
            <div class="color-overlay">
                <div class="container">
                    <div class="row">
                        <div class="offset-md-3 col-md-6">
                            <div class="box-capiton text-center">
                                <h1 class="text-primary display-1">mycoffees<span
                                        class="text-white display-6">.com.au</span></h1>
                                <p class="h5">All your favourites in one place</p>
                                <br>
                                <a href="{{ route('register') }}">
                                    <button class="btn btn-primary btn-block btn-lg btn-get-started">Register
                                    </button>
                                </a>

                                <a href="{{ route('login') }}">
                                    <button class="btn btn-outline-light btn-lg">Already have an
                                        Account
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>

                </div>
            </div>
        </section>
    @endguest
    @guest
            <section class="we-provide">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-lg-12 m-0 p-0 ">
                            <div class="content-heading text-center">
                                <h3 class="title">Key Features </h3>
                                <img src="assets/images/img-icon-gold.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-md-3 col-xs-12">
                            <div class="icon-box">
                                <h4>No queues</h4>
                                <div class="icon-image">
                                    <img src="{{asset('assets/images/queue.png')}}" alt="">
                                </div>
                                <div class="icon-title">
                                    <h3>Avoid the queues by ordering ahead</h3>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <div class="icon-box">
                                <h4>Rewards and deals</h4>
                                <div class="icon-image">
                                    <img src="{{asset('assets/images/trophy-bw.png')}}" alt="">
                        </div>
                                <div class="icon-title">
                                    <h3>All your rewards and deals in one spot. No more carrying multiple coffee loyalty
                                        cards,
                                        they are all tracked here in one place
                                    </h3>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <div class="icon-box">
                                <h4>Go cashless</h4>
                                <div class="icon-image">
                                    <img src="{{asset('assets/images/online-payment.png')}}" alt="">
                                </div>
                                <div class="icon-title">
                                    <h3>Go cashless with safe and secure online payments</h3>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <div class="icon-box">
                                <h4>Feel Good</h4>
                                <div class="icon-image">
                                    <img src="{{asset('assets/images/donation.png')}}" alt="">
                        </div>
                        <div class="icon-title">
                            <h3> Feel good with a pay it forward scheme.Pay your reward coffees forward to someone yu
                                might need one.</h3>
                        </div>

                    </div>
                </div>

            </div>
                </div>
            </section>
    @endguest

<!-- COFFEE SHOP VENDER CARD -->
    <section class="shop-vendors">
        <div class="container">

            <!-- TITLE  -->
            <div class="row">
                <div class="col-lg-12 m-0 p-0 mb-5 ">
                    <div class="content-heading text-center">
                        <h3 class="title">Our Coffeshop Partners </h3>
                        <img src="assets/images/img-icon-gold.png" alt="">
                    </div>
                </div>
            </div>

            <!-- VENDER CARDS -->
            <div class="row">
                @foreach ($vendors as $vendor)
                    <x-vendor-card :vendor="$vendor"></x-vendor-card>
                @endforeach
            </div>
        </div>
    </section>


    <livewire:nearby-vendors/>


 @include('partnerwithus-cto')
    <x-footer></x-footer>

</x-app-layout>
