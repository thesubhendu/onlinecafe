<x-app-layout>

{{--    <section>--}}
{{--        <div id="demo" class="carousel main-carousel slide" data-ride="carousel">--}}
{{--            <div class="carousel-inner">--}}
{{--                <div class="carousel-item active">--}}
{{--                    <img src="assets/images/home-banner.jpg" alt="Los Angeles">--}}
{{--                    <div class="carousel-caption">--}}
{{--                        <h3>Get your <span>50% Discount</span> on Sunday <strong>Coffee</strong></h3>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}


<!-- MAIN LANDING PAGE -->
    <section class="inner-banner-box landing-banner">
        <div class="color-overlay">
            <div class="container">
                <div class="row">
                    <div class="offset-md-3 col-md-6">
                        <div class="box-capiton text-center">
                            <h1 class="large-text">Welcome to <em class="text-primary">Mycoffees</em></h1>
                            <h6>MAKE YOUR COFFEE MEMORABLE</h6>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </section>


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

                        <div class="icon-image">
                            <img src="{{asset('assets/images/queue.png')}}" alt="">
                        </div>
                        <div class="icon-title">
                            <h3>No queues- avoid the queues by ordering a head</h3>
                        </div>

                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="icon-box">

                        <div class="icon-image">
                            <img src="{{asset('assets/images/trophy-bw.png')}}" alt="">
                        </div>
                        <div class="icon-title">
                            <h3>All your rewards and deals in one spot. No more carrying multiple coffee loyalty cards,
                                they are all tracked here in one place
                            </h3>
                        </div>

                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="icon-box">

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


{{--    <section class="welcome-content">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-2"></div>--}}
{{--                <div class="col-md-8 text-center">--}}
{{--                    <h6>WE HEARTLY WELCOME OUR CUSTOMERS ON</h6>--}}
{{--                    <h2>Laravel Coffee</h2>--}}
{{--                    <img src="assets/images/img-icon-gold.png" class="mb-4" alt="">--}}

{{--                    <p>Temple Tree situates in the City of Lakes, Pokhara. It is a boutique hotel where you can have--}}
{{--                        your ‘me time’ with classy services. The hotel has a suite, deluxe and deluxe family room, each--}}
{{--                        of which is the expression of stylish comfort. Spend quality time in the well-furnished room--}}
{{--                        along with modern day amenities. It is one of the beautiful suites in Pokhara and the first--}}
{{--                        hotel with rooftop swimming pool.</p>--}}

{{--                </div>--}}
{{--                <div class="col-md-2"></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

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


    <!-- CALL TO ACTION -->
    <!-- **************** -->
    <section class="call-to-action">
        <div class="container">
            <div class="row">
                <div>
                    <h2 class="text-white">Want to sell online?</h2>
                    <p>Partner with us in 3 easy steps</p>
                    <a href="{{ route('register-business.create') }}">
                        <button class="btn btn-primary btn-block btn-lg btn-get-started">Partner with us</button>
                    </a>
                </div>

            </div>
        </div>
    </section>
    <x-footer></x-footer>

</x-app-layout>
