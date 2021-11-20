<div class="container grid mt-2">

    <h3>Favourite Vendors</h3>
    <div class="grid-row">
        @forelse ($vendors as $vendor)
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-sm-4">
                    <img src="{{$vendor->vendor_image ?? assets('assets/images/cappuccino.jpg')}}" alt="..."
                        class="img-fluid">
                </div>
                <div class="col-sm-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $vendor->vendor_name }}</h5>
                        <p class="card-text"><small class="text-muted">Last
                                updated {{$vendor->updated_at->diffForHumans()}}</small></p>
                        <a href="{{route( 'vendor.products', $vendor )}}" class="btn btn-success px-3 mr-3">Order</a>
                    </div>

                    <livewire:vendor-like-button :vendor="$vendor" :key="$vendor->id" />
                </div>
            </div>
        </div>
        @endforeach
    </div><!-- /.row -->
</div><!-- /.container -->
