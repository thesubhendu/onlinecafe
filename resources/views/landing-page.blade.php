<x-app-layout>

    <!-- IMAGE SLIDER WITH CAPTION -->
    <section>
        <div id="demo" class="carousel main-carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/images/home-banner.jpg" alt="Los Angeles">
                    <div class="carousel-caption">
                        <h3>Get your <span>50% Discount</span> on Sunday <strong>Coffee</strong></h3>
                    </div>
                </div>
            </div>
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
</x-app-layout>