<section class="favorite-vendor">
    <div class="container">
        <h3>Favourite Vendors</h3>
        <div class="row mt-3">
            @forelse ($vendors as $vendor)
            <div class="mb-3 col-md-6">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-sm-3">
                            <div class="product-image">
                                <!-- <img src="{{$vendor->vendor_image ?? assets('assets/images/cappuccino.jpg')}}" alt="..." class="img-fluid"> -->
                                <img src="/assets/images/cappuccino.jpg" alt="..." class="img-fluid">
                                <livewire:vendor-like-button :vendor="$vendor" :key="$vendor->id" class="favorite-icon" />
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9 mb-2">
                                        <h5 class="card-title">{{ $vendor->vendor_name }}</h5>
                                        <p class="card-text"><small class="text-muted">Last
                                            updated {{$vendor->updated_at->diffForHumans()}}</small>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{route( 'vendor.products', $vendor )}}" class="btn btn-action px-3 mr-3">Order</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>
