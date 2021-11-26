<x-app-layout>

    <!-- IMAGE SLIDER WITH CAPTION -->
    <section>
        <div id="demo" class="carousel main-carousel slide" data-ride="carousel">

            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/images/home-banner.jpg" alt="Los Angeles">
                    <div class="carousel-caption">
                        <h3>Get your <span>50% Discount</span> on Sunday <strong>Coffee</strong></h3>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <!-- <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a> -->
        </div>
    </section>

    <!-- COFFEE SHOP VENDER CARD -->
    <section class="shop-vendors">
        <div class="container">
            <!-- TITLE  -->
            <div class="row">
                <div class="col-lg-12 m-0 p-0 mb-5 ">
                    <div class="content-heading text-center">
                        <h3 class="title">Our Coffeshop Vendors </h3>
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


    <section class="inner-banner-box about-box">
        <div class="color-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="box-capiton text-center">
                            <h1 class="large-text">Welcome to <em class="text-primary">Laravel Coffee</em></h1>
                            <h6>MAKE YOUR COFFEE MEMORABLE</h6>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-us-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 text-center">
                    <h6>WE HEARTLY WELCOME OUR CUSTOMERS ON</h6>
                    <h2>Laravel Coffee</h2>
                    <img src="assets/images/img-icon-gold.png" class="mb-4" alt="">

                    <p>Temple Tree situates in the City of Lakes, Pokhara. It is a boutique hotel where you can have
                        your ‘me time’ with classy services. The hotel has a suite, deluxe and deluxe family room, each
                        of which is the expression of stylish comfort. Spend quality time in the well-furnished room
                        along with modern day amenities. It is one of the beautiful suites in Pokhara and the first
                        hotel with rooftop swimming pool.</p>
                    <p>Tree situates in the City of Lakes, Pokhara. It is a boutique hotel where you can have your ‘me
                        time’ with classy services. The hotel has a suite, deluxe and deluxe family room, each of which
                        is the expression of stylish comfort. Spend quality time in the well-furnished room along with
                        modern day amenities. It is one of the beautiful suites in Pokhara and the first hotel with
                        rooftop swimming pool.</p>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>

    <section class="at-hotel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-0 p-0 ">
                    <div class="content-heading text-center">
                        <h3 class="title">Near Coffeshop Vendors </h3>
                        <img src="assets/images/img-icon-gold.png" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="featured-box featured-box-mini">
                        <div class="cat-img-wrapper">
                            <span class="ribbon"> <span class="ribbon-edge">700 m</span> </span>
                            <img src="assets/images/cafe.jpeg" class="img-responsive" alt="">
                            <a href="#" class="featured-btn">Greenfelder and Sons</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="featured-box featured-box-mini">
                        <div class="cat-img-wrapper">
                            <span class="ribbon"> <span class="ribbon-edge">700 m</span> </span>
                            <img src="assets/images/cafe-2.jpeg" class="img-responsive" alt="">
                            <a href="#" class="featured-btn">Adams, Lehner and Bednar</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="featured-box featured-box-mini">
                        <div class="cat-img-wrapper">
                            <span class="ribbon"> <span class="ribbon-edge">700 m</span> </span>
                            <img src="assets/images/cafe-3.jpeg" class="img-responsive" alt="">
                            <a href="#" class="featured-btn">Vendor coffee Shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="featured-box featured-box-mini">
                        <div class="cat-img-wrapper">
                            <span class="ribbon"> <span class="ribbon-edge">700 m</span> </span>
                            <img src="assets/images/cafe-4.jpeg" class="img-responsive" alt="">
                            <a href="#" class="featured-btn">Prosacco-Heller</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="featured-box featured-box-mini">
                        <div class="cat-img-wrapper">
                            <span class="ribbon"> <span class="ribbon-edge">700 m</span> </span>
                            <img src="assets/images/cafe-5.jpg" class="img-responsive" alt="">
                            <a href="#" class="featured-btn">Hill PLC </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="featured-box featured-box-mini">
                        <div class="cat-img-wrapper">
                            <span class="ribbon"> <span class="ribbon-edge">700 m</span> </span>
                            <img src="assets/images/cafe-2.jpeg" class="img-responsive" alt="">
                            <a href="#" class="featured-btn">Webdev coffee Shop </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ourfacilities">
        <div class="container">
        <div class="row mb-5">
                <div class="col-lg-12 m-0 p-0 ">
                    <div class="content-heading text-center">
                        <h3 class="title">Laravel Coffee Provides </h3>
                        <img src="assets/images/img-icon-gold.png" alt="">
                    </div>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-md-4 col-xs-6">
                    <div class="icon-box">

                        <div class="icon-image">
                            <img src="assets/images/bar.png" alt="">
                        </div>
                        <div class="icon-title">
                            <h3>Healthy Coffee</h3>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-xs-6">
                    <div class="icon-box">

                        <div class="icon-image">
                            <img src="assets/images/bar.png" alt="">
                        </div>
                        <div class="icon-title">
                            <h3>Healthy Coffee</h3>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-xs-6">
                    <div class="icon-box">

                        <div class="icon-image">
                            <img src="assets/images/bar.png" alt="">
                        </div>
                        <div class="icon-title">
                            <h3>Healthy Coffee</h3>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-xs-6">
                    <div class="icon-box">

                        <div class="icon-image">
                            <img src="assets/images/bar.png" alt="">
                        </div>
                        <div class="icon-title">
                            <h3>Healthy Coffee</h3>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-xs-6">
                    <div class="icon-box">

                        <div class="icon-image">
                            <img src="assets/images/bar.png" alt="">
                        </div>
                        <div class="icon-title">
                            <h3>Healthy Coffee</h3>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-xs-6">
                    <div class="icon-box">

                        <div class="icon-image">
                            <img src="assets/images/bar.png" alt="">
                        </div>
                        <div class="icon-title">
                            <h3>Healthy Coffee</h3>
                        </div>

                    </div>
                </div>
                
             
            </div>
        </div>
    </section>

  






    <!-- CALL TO ACTION -->
    <!-- **************** -->
    <section class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <img src="assets/images/call.png" class="aos-init aos-animate" data-aos="fade-down" data-aos-duration="500">
                    <p>061 560884</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <img src="assets/images/mail.png" class="aos-init aos-animate" data-aos="fade-down" data-aos-duration="1000">
                    <p>info@ourresort.com</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <img src="assets/images/map.png" class="aos-init aos-animate" data-aos="fade-down" data-aos-duration="1500">
                    <p>Lakeside, Pokhara</p>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>