<section class="shop-vendors" style="padding: 20px 0 !important;">
    <div class="container">
        <div class="input-group col-md-4">
            <input type="text" class="form-control" placeholder="Search Vendors" wire:model.lazy="search"/>
            <button class="btn btn-secondary">Search</button>
        </div>
        <br/>
        <!-- VENDER CARDS -->
        <div class="row">
        @forelse( $vendors as $vendor)
            <!-- CARD -->
                <div class="col-md-4 col-sm-6">
                    <div class="shop-vendors-item">
                        <div class="image">
                            <img src="{{asset('assets/images/cafe.jpeg')}}" class="img-responsive" alt="">
                            <span><i class="ti-time"></i> &nbsp; {{$vendor->is_open ? "Open Now": "Closed"}} </span>
                            @auth
                                <livewire:vendor-like-button :vendor="$vendor" :key="$vendor->id"
                                                             class="favorite-icon"/>
                            @endauth
                        </div>
                        <div class="content">
                            <a href="{{route('vendor.show', $vendor)}}">
                                <h3>{{$vendor->shop_name ?? $vendor->vendor_name}}</h3>
                                <p>
                                    <i class="fa fa-map-marker"></i> {{$vendor->getDistanceFromCustomer(geoip()->getLocation())}}
                                    km</p>
                                <p class="service-item">
                                    @foreach($vendor->services ?? [] as $service)
                                        <span>{{$service}}</span> &nbsp;
                                    @endforeach
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Result not found.</p>
            @endforelse
            <span>{{$vendors->links()}}</span>
        </div>
    </div>
</section>

