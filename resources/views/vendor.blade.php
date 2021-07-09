@extends('layout.app')
@section('content')
<div class="vendor-showcase">
  <div class="card w-90">
    <img src="/storage/img/vendor/{{$vendor->vendor_image}}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{$vendor->vendor_name}}</h5>
      <p class="card-text"><i class="fas fa-map-marker-alt px-1"></i>{{$vendor->address}}, {{$vendor->suburb}}, {{$vendor->state}}, {{$vendor->pc}}</p>
      <p class="card-text"><i class="fas fa-at px-1"></i>{{$vendor->email}}</p>
      <div class="d-flex justify-content-between">
        <div class="rating">
        <span><i class="fas fa-coffee checked"></i></span>
        <span><i class="fas fa-coffee checked"></i></span>
        <span><i class="fas fa-coffee checked"></i></span>
        <span><i class="fas fa-coffee unchecked"></i></span>
        <span><i class="fas fa-coffee unchecked"></i></span><span class="rating-avg badge rounded-pill bg-success mx-3 align-middle"> 3.0</span>
        <a href="{{ route('vendor_rating.index', $vendor) }}">leave review</a>
        </div>
        <div class="favourite">
        <!-- @auth
        @if (!$vendor->likedBy(auth()->user())) -->
            <form action="{{ route('vendor.likes', $vendor) }}" method='post'>
            <!-- @csrf  -->
            <a id="fav_like" type="submit" class="fav_like float-right"><span class="fas fa-coffee fa-lg checked"></span></a> <!--wil need to be changed to a button in laravel-->
            </form>
        <!-- @else -->
            <!-- <form action="{{ route('vendor.likes', $vendor->id) }}" method='post'> -->
            <!-- @csrf
            @method('DELETE') -->
            <!-- <button id="fav_unlike" type="submit" class="fav_unlike float-right"><span class="fas fa-coffee fa-lg"></span></button>
            </form> -->
        <!-- @endif
        @endauth -->
        </div>
    </div>
      <p class="card-text"><small class="text-muted">{{$vendor->updated_at->diffForHumans()}}</small></p>
    </div>
  </div><!-- end vendor card-->
</div>
        <div class="vendor-ad mb-3" style="max-width: 100%;">
          <img src="https://via.placeholder.com/1300x300" class="img-fluid rounded" alt="..." style="max-width: 100%;">
        </div>
        <div class="card" style="width: 100;">
          <div class="card-body">
            <h3 class="card-title">Coffee</h3>
          </div>
          <div class="row row-cols-1 row-cols-md-4 g-4 mt-2 mb-2 rounded">
            @foreach ($vendor->products as $product)
            <div class="col">
              <div class="card h-100 rounded mb-3">
                <div class="text-center">
                  <img src="/storage/img/{{$product->product_image}}" class="img-fluid" alt="..." height="100" width="100">
                </div>
                <div class="d-flex justify-content-between py-2 px-2">
                  <div class="card-text">{{$product->productName}}</div>
                  <div class="card-text">${{$product->productPrice}}</div>
                  <a href="{{ route('orders.create', $product->id) }}" class="btn btn-outline-success btn-sm"><i class="fas fa-cart-plus"></i></a>
                </div>
            </div>
          </div>
          @endforeach
        </div>
        <div class="card align-middle" style="width: 100;">
          <div class="card-body">
            <h3 class="card-title">Cold Drinks</h3>
          </div>
          <div class="row row-cols-1 row-cols-md-4 g-4 mt-2 rounded">
            <div class="col">
              <div class="card h-100 rounded">
                <div class="text-center">
                  <img src="/storage/app/public/img/nostamp.png" class="img-fluid" alt="...">
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="text-center">
                  <img src="/storage/app/public/img/nostamp.png" class="img-fluid" alt="...">
                </div>
                </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="text-center">
                  <img src="/storage/app/public/img/nostamp.png" class="img-fluid" alt="...">
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="text-center">
                  <img src="/storage/app/public/img/nostamp.png" class="img-fluid" alt="...">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!--container end-->
      @endsection