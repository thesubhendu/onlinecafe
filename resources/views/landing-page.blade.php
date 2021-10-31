<x-app-layout>

    <!-- IMAGE SLIDER WITH CAPTION -->
    <section>
        <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/images/slide-1.jpeg" alt="Los Angeles">
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
    <section class="category">
        <div class="container">
            <!-- TITLE  -->
            <div class="row">
                <div class="col-md-12 m-0 p-0 ">
                    <div class="content-heading">
                        <h3 class="title">Our Coffee Shop Venders</h3>
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
