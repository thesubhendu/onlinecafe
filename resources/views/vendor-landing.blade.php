<x-app-layout>

    <!-- VENDOR REGISTRATION BEFORE LANDING PAGE -->
    <section class="inner-banner-box vendor-before">
        <div class="color-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-capiton">
                            <h2 class="display-3 text-white">Mycoffees.com.au is an Australian owned and operated order
                                a head platform.</h2>
                            <h5>Created to help Australian small business take advantage of the booming online order
                                ahead market.
                                Simple online registration means you could be providing your customers with convenience
                                and efficiency in 15 mins.</h5>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <a href="{{ route('register-business.create') }}">
                            <button class="btn btn-primary btn-block btn-lg btn-get-started">Get Started Today</button>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="our-features">
        <div class="container">
            <div class="row">
                <div class="col-md-6 p-0">
                    <img src="../assets/images/vendor-1.jpg" class="img-responsive" alt="">
                </div>
                <div class="col-md-6 p-0">
                    <div class="features-content">
                        <h2>Giving you time to get on to running your business.
                        </h2>
                        <p>Stats</p>
                        <ul>
                            <li>* More than 90% off aussies used their phone to shop Online in 2020*</li>
                            <li>
                                * 9.1million australian house holds shopped online in FY2021*
                            </li>

                            <li>
                                * Australians spent $50.46 billion online in 2020*
                            </li>
                        </ul>

                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 p-0">
                    <div class="features-content">
                        <h2>Steps to register</h2>
                        <p>mycoffees.com.au has made it simple for you to sell online.In three simple steps you could be
                            selling on line in 15mins.
                        </p>

                        <ol>
                            <li>
                                Register your business
                            </li>
                            <li>
                                Select your subscription
                            </li>
                            <li>
                                Set up your shop.
                            </li>
                        </ol>

                    </div>
                </div>
                <div class="col-md-6 p-0">
                    <img src="../assets/images/vendor-2.jpg" class="img-responsive" alt="">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 p-0">
                    <img src="../assets/images/vendor-3.jpg" class="img-responsive" alt="">
                </div>
                <div class="col-md-6 p-0">
                    <div class="features-content">
                        <h2>Why mycoffees.com.au</h2>
                        <p>* No lock in contracts makes it simple to sell online.
                            <br>
                            * No revenue based commissions means more profit for you <br>

                            * Simple online order head platform is ready to go. <br>

                            * Manage customer loyalty in one place. <br>

                            * Engage with your customers using marketing campaigns for your business in our admin
                            dashboard <br>

                            * See your top selling products, daly, weekly or monthly sales with our admin dashboard.
                            <br>

                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partnerwithus-cto')

    {{--    <section class="get-start-banner">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-10 col-md-offset-1">--}}
    {{--                    <div class="row">--}}
    {{--                        <div class="col-md-3 col-sm-3">--}}

    {{--                        </div>--}}
    {{--                        <div class="col-md-9">--}}
    {{--                            <h3>Get Started Today!</h3>--}}
    {{--                            <div class="emaillist">--}}
    {{--                                <form action="#" method="post">--}}
    {{--                                    <input class="form-control" type="email" name="email" placeholder="YOUR EMAIL"--}}
    {{--                                           required="">--}}
    {{--                                    <button type="submit" name="submit" class="btn-newsletter">Subscribe now</button>--}}
    {{--                                </form>--}}

    {{--                                <span class="es_subscription_message success"--}}
    {{--                                      id="es_subscription_message_1565425856"></span>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}

    <x-footer></x-footer>

</x-app-layout>
