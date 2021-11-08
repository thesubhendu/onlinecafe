<!-- CARD -->
<div class="col-md-3 col-sm-4">
    <div class="category-item">
        <a href="{{route('vendor.show', $vendor)}}">
            <div class="image">
                <img src="assets/images/cafe.jpeg" class="img-responsive" alt="">
                <i class="ti-heart"></i>
                <span><i class="ti-time"></i> &nbsp; {{$vendor->is_open ? "Open Now": "Closed"}}</span>
            </div>
            <div class="content">
                <h3>{{$vendor->shop_name ?? $vendor->vendor_name}}</h3>
                <p><i class="fa fa-map-marker"></i> {{$vendor->address}}, {{$vendor->state}}</p>
            </div>
            <div class="ratings">
                <i class="fa fa-coffee selected"></i>
                <i class="fa fa-coffee selected"></i>
                <i class="fa fa-coffee selected"></i>
                <i class="fa fa-coffee selected"></i>
                <i class="fa fa-coffee"></i>
                <span>4.0 </span>
            </div>
        </a>
    </div>
</div>
