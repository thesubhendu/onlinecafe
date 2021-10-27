<x-app-layout>
    <div class="container">
        <div class="card">
            {{--        <img src="{{asset('storage/img/vendor/'.$vendor->vendor_image)}}" class="card-img-top w-100" alt="...">--}}

            <div class="card-body">
                <h5 class="card-title">{{$vendor->vendor_name}}</h5>
                <h3>Shop Opening Status: {{$openingInfo}}</h3>
                <p class="card-text"><i class="fas fa-map-marker-alt px-1"></i>{{$vendor->address}}, {{$vendor->suburb}}
                    , {{$vendor->state}}, {{$vendor->pc}}</p>
                <p class="card-text"><i class="fas fa-at px-1"></i>{{$vendor->email}}</p>
                <div class="d-flex justify-content-between">
                    <span><i class="fas fa-coffee fa-xs checked"></i></span>
                    <div class="rating">
                        <span><i class="fas fa-coffee fa-xs checked"></i></span>
                        <span><i class="fas fa-coffee fa-xs checked"></i></span>
                        <span><i class="fas fa-coffee fa-xs unchecked"></i></span>
                        <span><i class="fas fa-coffee fa-xs unchecked"></i></span><span
                            class="rating-avg badge rounded-pill bg-success mx-3 align-middle text-white"> 3.0</span>
                        <div>
                            <a class="small" href="{{ route('vendor_rating.index', $vendor) }}">leave review</a>
            </div>
            </div>
            <div class="favourite">
            <!-- @auth
            @if (!$vendor->likedBy(auth()->user())) -->
                <form action="{{ route('vendor.likes', $vendor) }}" method='post'>
                <!-- @csrf  -->
                <a id="fav_like" type="submit" class="fav_like float-right"><span class="fas fa-coffee fa-sm checked"></span></a> <!--wil need to be changed to a button in laravel-->
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
          <p class="card-text small text-muted pt-2">last updated {{$vendor->updated_at->diffForHumans()}}</p>
        </div>
      </div><!-- end vendor card-->
    </div>
    {{-- vendor ad --}}
    <div>
      <div class="card text-center">
        <img src="{{asset('/storage/img/vendor/default_ad.jpg')}}" class="card-img" alt="vendor_ad">
        <div class="card-img-overlay p-0">
          <div class="row align-items-center">
            <div class="col-9 col-sm-3 p-0 ">
              <h5 class="card-title mb-2 text-light text-uppercase">Today only!</h5>
              <p class="card-text text-success mb-1">$2 fruit toast with any coffee purchase</p>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
    <div>
      {{-- products by category --}}
        <div class="card text-white bg-dark" style="width: 100;">
            <div class="card-body py-0">
                <h3 class="card-title my-0">Coffee</h3>
            </div>
        </div>
        <div class="row row-cols row-cols-md-3 row-cols-lg-4 g-4 rounded-3">
          @foreach ($vendor->products as $product)
          <div class="col">
            <div class="card h-100 p-3">
              <div class="text-center">
                <img src="/storage/img/{{$product->product_image}}" class="img-fluid" alt="..." height="100" width="100">
              </div>
              <div class="card-body d-flex justify-content-between py-2 px-2">
                <div class="card-text">{{$product->productName}}</div>
                <div class="card-text">${{$product->productPrice}}</div>
                <a href="{{ route('orders.create', $product->id) }}" class="btn btn-outline-success btn-sm"><i class="fas fa-cart-plus"></i></a>
              </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="card text-white bg-dark" style="width: 100;">
            <div class="card-body py-0">
                <h3 class="card-title my-0">Cold Drinks</h3>
            </div>
        </div>
        <div class="row row-cols row-cols-md-4 g-4 mt-2 rounded">
          <div class="col">
            <div class="card h-100 rounded">
              <div class="text-center">
                <img src="/storage/img/cold_drink.png" class="img-fluid" alt="..." height="100" width="100">
              </div>
              <div class="card-footer d-flex justify-content-between py-2 px-2">
                <div class="card-text">name</div>
                <div class="card-text">$0.00</div>
                <a href="" class="btn btn-outline-success btn-sm"><i class="fas fa-cart-plus"></i></a>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 rounded">
              <div class="text-center">
                <img src="/storage/img/cold_drink.png" class="img-fluid" alt="..." height="100" width="100">
              </div>
              <div class="card-footer d-flex justify-content-between py-2 px-2">
                <div class="card-text">name</div>
                <div class="card-text">$0.00</div>
                <a href="" class="btn btn-outline-success btn-sm"><i class="fas fa-cart-plus"></i></a>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 rounded">
              <div class="text-center">
                <img src="/storage/img/cold_drink.png" class="img-fluid" alt="..." height="100" width="100">
              </div>
              <div class="card-footer d-flex justify-content-between py-2 px-2">
                <div class="card-text">name</div>
                <div class="card-text">$0.00</div>
                <a href="" class="btn btn-outline-success btn-sm"><i class="fas fa-cart-plus"></i></a>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 rounded">
              <div class="text-center">
                <img src="/storage/img/cold_drink.png" class="img-fluid" alt="..." height="100" width="100">
              </div>
                <div class="card-footer d-flex justify-content-between py-2 px-2">
                    <div class="card-text">name</div>
                    <div class="card-text">$0.00</div>
                    <a href="" class="btn btn-outline-success btn-sm"><i class="fas fa-cart-plus"></i></a>
                </div>
            </div>
          </div>
        </div>
    </div>
    </div><!--container end-->
</x-app-layout>
