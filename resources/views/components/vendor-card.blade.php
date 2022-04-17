<!-- CARD -->
<div class="col-md-4 col-sm-6">
    <div class="shop-vendors-item">
        <div class="image">
            <img src="assets/images/cafe.jpeg" class="img-responsive" alt="">
         <span><i class="ti-time"></i> &nbsp; {{$vendor->is_open ? "Open Now": "Closed"}} </span>
            @auth
                <livewire:vendor-like-button :vendor="$vendor"/>
            @endauth

        </div>
        <div class="content">
            <a href="{{route('vendor.show', $vendor)}}">
                <h3>{{$vendor->shop_name ?? $vendor->vendor_name}}</h3>
{{--                <p><i class="fa fa-map-marker"></i> {{$vendor->getDistanceFromCustomer()}} </p>--}}
                <p class="service-item">
                    @foreach($vendor->services ?? [] as $service)
                        <span>{{$service}}</span> &nbsp;
                    @endforeach
                     </p>


            </a>
        </div>

        <div class="ratings">
            @for($i=0; $i < $vendor->rating(); $i++)
                <i class="fa fa-coffee selected"></i>
            @endfor
            @for($i=0; $i < (5-$vendor->rating()); $i++)
                <i class="fa fa-coffee"></i>
            @endfor

        @if($vendor->rating())
            <span>{{(int)$vendor->rating()}} </span>
                @endif
        </div>
    </div>
</div>
