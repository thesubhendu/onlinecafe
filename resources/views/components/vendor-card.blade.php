<!-- CARD -->
<div class="col-md-4 col-sm-6">
    <div class="shop-vendors-item">
        <div class="image">
            <img src="assets/images/cafe.jpeg" class="img-responsive" alt="">
            <!-- <span><i class="ti-time"></i> &nbsp; {{$vendor->is_open ? "Open Now": "Closed"}} </span> -->
            @auth
                <livewire:vendor-like-button :vendor="$vendor"/>
            @endauth

        </div>
        <div class="content">
            <a href="{{route('vendor.show', $vendor)}}">
                <h3>{{$vendor->shop_name ?? $vendor->vendor_name}}</h3>
                <!-- <p><i class="fa fa-map-marker"></i> {{$vendor->address}}, {{$vendor->state}}</p> -->
                <p class="service-item"><span>Coffee</span> &nbsp; <span>Tea</span> &nbsp; <span>Bakery</span> &nbsp <span>Cake</span>&nbsp;<span>Coffee</span> &nbsp; <span>Tea</span> &nbsp; <span>Bakery</span> &nbsp <span>Cake</span>  </p>
                <span class="service-badge"><i class="ti-location-pin"></i>&nbsp; 12.8km </span>
                <span class="service-badge"><i class="ti-timer"></i>&nbsp; 3min </span>
                <span class="service-badge"><i class="ti-heart"></i>&nbsp; 240 </span>
                <span class="service-badge"><i class="ti-time"></i> &nbsp; {{$vendor->is_open ? "Open Now": "Closed"}} </span>


            </a>
        </div>

        <div class="ratings">
            @for($i=0; $i < $vendor->rating(); $i++)
                <i class="fa fa-coffee selected"></i>
            @endfor
            @for($i=0; $i < (5-$vendor->rating()); $i++)
                <i class="fa fa-coffee"></i>
            @endfor

            <span>{{(int)$vendor->rating()}} </span>
        </div>
    </div>
</div>
