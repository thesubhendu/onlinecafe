<section class="near-shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-0 p-0 ">
                <div class="content-heading text-center">
                    <h3 class="title">Near Coffeshop Partners </h3>
                    <img src="assets/images/img-icon-gold.png" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($nearbyShops as $vendor)
                <div class="col-lg-4">
                    <div class="featured-box featured-box-mini">
                        <div class="cat-img-wrapper">
                            {{--                            <span class="ribbon"> <span class="ribbon-edge">700 m</span> </span>--}}
                            <img src="assets/images/cafe.jpeg" class="img-responsive" alt="">
                            <a href="{{route('vendor.show', $vendor->id)}}" class="featured-btn">{{$vendor->name}}</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No shops nearby</p>
            @endforelse

        </div>
    </div>
</section>

<script>
    window.addEventListener('load', function () {
        getLocation();
    })

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(setPosition);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    }

    function setPosition(position) {
        console.log("Latitude: " + position.coords.latitude + position.coords.longitude);
    @this.position
        = [position.coords.latitude, position.coords.longitude];
    }
</script>
