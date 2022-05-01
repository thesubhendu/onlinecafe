<section class="shop-vendors">
    <div class="container">
        <h3>Favourite Partners</h3>
        <div class="row">
            @foreach($vendors as $vendor)

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <x-vendor-card :vendor="$vendor"></x-vendor-card>
                                    <p class="card-text"><small class="text-muted">Last
                                            updated {{$vendor->updated_at->diffForHumans()}}</small>
                                    </p>
                                    <a href="{{route( 'vendor.products', $vendor )}}"
                                       class="btn btn-action px-3 mr-3">Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
