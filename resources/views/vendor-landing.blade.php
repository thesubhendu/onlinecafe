<x-app-layout>

    <!-- VENDOR REGISTRATION BEFORE LANDING PAGE -->
    <section class="inner-banner-box vendor-before">
        <div class="color-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-capiton">
                            <h1>Get more orders with <em class="text-primary">Laravel Coffee</em></h1>
                            <h5>Connect your restaurant to 950,000+ Aussies on the Hey You app, with over 30 million
                                food and drink orders taken to date.</h5>
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
                        <h2>Grow customer loyalty</h2>
                        <p>Grow customer loyalty by up to 15% using Hey You’s Artificial Intelligence based personalized
                            marketing tools tailored to your customer’s buying habits</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 p-0">
                    <div class="features-content">
                        <h2>Google Food Ordering</h2>
                        <p>Get access to millions of customers through Hey You’s integration with Google Food
                            Ordering</p>

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
                        <h2>Easily Handle Dine-in, Delivery
                            & Take Away Orders In One Place</h2>
                        <p>Increase staff productivity by up to 30% by leveraging Hey You’s digital solution for
                            take-away, dine-in and self delivery</p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="get-start-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">

                        </div>
                        <div class="col-md-9">
                            <h3>Get Started Today!</h3>
                            <div class="emaillist">
                                <form action="#" method="post">
                                    <input class="form-control" type="email" name="email" placeholder="YOUR EMAIL"
                                           required="">
                                    <button type="submit" name="submit" class="btn-newsletter">Subscribe now</button>
                                </form>

                                <span class="es_subscription_message success"
                                      id="es_subscription_message_1565425856"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-footer></x-footer>

</x-app-layout>
