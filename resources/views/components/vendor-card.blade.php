<!-- CARD -->
<div class="col-md-3 col-sm-4">
    <div class="shop-vendors-item">
            <div class="image">
                <img src="assets/images/cafe.jpeg" class="img-responsive" alt="">

                  <livewire:vendor-like-button :vendor="$vendor"/>

                <span><i class="ti-time"></i> &nbsp; {{$vendor->is_open ? "Open Now": "Closed"}}</span>
            </div>
            <div class="content">
                <a href="{{route('vendor.show', $vendor)}}">
                    <h3>{{$vendor->shop_name ?? $vendor->vendor_name}}</h3>
                    <p><i class="fa fa-map-marker"></i> {{$vendor->address}}, {{$vendor->state}}</p>
                </a>
            </div>
            <div class="ratings">
                <i class="fa fa-coffee selected"></i>
                <i class="fa fa-coffee selected"></i>
                <i class="fa fa-coffee selected"></i>
                <i class="fa fa-coffee selected"></i>
                <i class="fa fa-coffee"></i>
                <span>4.0 </span>
            </div>
    </div>
</div>
