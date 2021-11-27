<x-app-layout>
    <!-- VENDOR BANNER -->
    <section class="banner-inner">
        <div class="container">
            <!-- VENDER DETAILS -->
            <div class="row text-center banner-content">
                <h2>{{$vendor->shop_name ?? $vendor->vendor_name}}</h2>
                <p><i class="fa fa-map-marker"></i> {{$vendor->address}}, {{$vendor->suburb}}
                    , {{$vendor->state}}, {{$vendor->pc}}</p>
                <p><i class="fa fa-envelope"></i> {{$vendor->email}} &nbsp; | &nbsp; <i class="fa fa-phone"></i> {{$vendor->mobile}}</p>
                <p>
                    {{$openingInfo}}
                </p>
                <div class="vendor-actions">
                    <div class="icon-ratings">
                        <span class="xs-block">
                            <i class="fa fa-coffee selected"></i>
                            <i class="fa fa-coffee selected"></i>
                            <i class="fa fa-coffee selected"></i>
                            <i class="fa fa-coffee"></i>
                            <i class="fa fa-coffee"></i>
                            <span>3.0</span>
                        </span>
                        <a href="" class="xs-block">Add Review</a>
                        <span class="xs-block last-update">Last Update: {{$vendor->updated_at->diffForHumans()}}</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- VENDER MENU -->
    <section class="vendor-menu">
        <div class="container">

            @forelse ($vendor->products->groupBy('category_id') as $products)
            <!-- TITLE -->
            <div class="row mb-4">
                <div class="col-md-12 m-0 p-0 ">
                    <div class="content-heading">
                        <h3 class="title">{{$products->first()->category->name}}</h3>
                    </div>
                </div>
            </div>

            <div class="row  @if($loop->index > 0) mt-4 @endif ">
                @foreach ($products as $product)
                <x-menu-card :product="$product"></x-menu-card>
                @endforeach
            </div>

            @empty
            <h2>No Products</h2>
            @endforelse


        </div>

    </section>

    <!-- VENDOR REGISTRATION BEFORE LANDING PAGE -->
    <section class="inner-banner-box vendor-before">
        <div class="color-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-capiton">
                            <h1>Get more orders with <em class="text-primary">Laravel Coffee</em></h1>
                            <h5>Connect your restaurant to 950,000+ Aussies on the Hey You app, with over 30 million food and drink orders taken to date.</h5>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-block btn-lg btn-get-started">Get Started Today</button>
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
                        <p>Grow customer loyalty by up to 15% using Hey You’s Artificial Intelligence based personalized marketing tools tailored to your customer’s buying habits</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 p-0">
                    <div class="features-content">
                        <h2>Google Food Ordering</h2>
                        <p>Get access to millions of customers through Hey You’s integration with Google Food Ordering</p>

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
                        <p>Increase staff productivity by up to 30% by leveraging Hey You’s digital solution for take-away, dine-in and self delivery</p>

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
                                    <input class="form-control" type="email" name="email" placeholder="YOUR EMAIL" required="">
                                    <button type="submit" name="submit" class="btn-newsletter">Subscribe now </button>
                                </form>

                                <span class="es_subscription_message success" id="es_subscription_message_1565425856"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-content">
                            <h2>Location</h2>
                            <ul class="contact-list">
                                <li>
                                    Envato
                                    Level 13, 2 Elizabeth
                                    Victoria 3000
                                    Australia
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-content">
                            <h2>Contact</h2>
                            <ul class="contact-list">

                                <li>
                                    <i class="fa fa-phone"></i> 9851016391
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i> itbridgenp@gmail.com
                                </li>
                                <li>

                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer-content">
                            <h2>Opening Hours</h2>
                            <ul class="contact-list">
                                <li>
                                    We work from Monday to Friday.
                                </li>
                                <li>
                                    From 8:00 to 18:00
                                </li>


                                
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="bottom-footer">
            <div class="container">
                <small> 2021 © Laravel Coffee . All rights reserved. </small>
            </div>
        </div>
    </footer>

</x-app-layout>