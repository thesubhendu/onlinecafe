<x-app-layout>
<section>
    <br>
    <div class="container">

        <div class="row">
            <form name="vendor-search" method="get" action="{{url('vendor-search')}}">
                <div class="input-group">
                    <input type="search" required class="form-control rounded" name="search"
                           placeholder="Search Vendors" aria-label="Search" aria-describedby="search-addon" />
                    <button type="submit" class="btn btn-secondary">search</button>
                </div>
            </form>
        </div>
    </div>
    <br>
</section>
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
                <div class="row headline-row">
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
                            <h4>No queues</h4>
                            <div class="icon-title">
                                <p>Avoid the queues by ordering ahead</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="icon-box">
                            <div class="icon-image">
                                <img src="{{asset('assets/images/trophy-bw.png')}}" alt="">
                            </div>
                            <h4>Rewards and deals</h4>
                            <div class="icon-title">
                                <p>All your rewards and deals in one spot. No more carrying multiple coffee loyalty
                                    cards,
                                    they are all tracked here in one place
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="icon-box">
                            <div class="icon-image">
                                <img src="{{asset('assets/images/online-payment.png')}}" alt="">
                            </div>
                            <h4>Go cashless</h4>
                            <div class="icon-title">
                                <p>Go cashless with safe and secure online payments</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="icon-box">
                            <div class="icon-image">
                                <img src="{{asset('assets/images/donation.png')}}" alt="">
                            </div>
                            <h4>Feel Good</h4>
                            <div class="icon-title">
                                <p> Feel good with a pay it forward scheme.Pay your reward coffees forward to someone yu
                                    might need one.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endguest

<!-- COFFEE SHOP VENDER CARD -->
    <section class="shop-vendors" style="padding: 20px 0 !important;">

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
                    <div class="col-md-4 col-sm-6">
                        <x-vendor-card :vendor="$vendor"></x-vendor-card>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <livewire:nearby-vendors/>

    @cannot('vendor')
        @include('partnerwithus-cto')
    @endcannot
    <x-footer></x-footer>

</x-app-layout>
