@extends('layout.app')
@section('content')
<div id="showcase">
  <div class="showcase-content">
    <h1>Lorem, ipsum dolor.</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
    <div class="d-flex justify-content-between">
      {{-- <div class="mr-3">
        <a href="#" class="btn btn-success ">Register My Shop</a>
      </div> --}}
      <div>
        <a href="{{ route('subscriptions.plans') }}" class="btn btn-outline-light">Learn More</a>
      </div>
    </div>
  </div>
</div>
      <div class="container grid border-0">
        <div class="row justify-content-between mx-3">
          <div class="grid-row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
            @foreach ($vendors as $vendor)
              <div class="g-col-6">
                  <div class="card h-100 mb-2 mt-2">
                    <a class="" href="{{ route('vendor.show', $vendor) }}">
                      <img src="storage/img/vendor/{{$vendor->vendor_image}}" class="card-img-top" alt="...">
                    </a>
                      <div class="card-body">
                        <a href="{{ route('vendor.show', $vendor) }}">
                          <h5 class="card-title">{{$vendor->vendor_name}}</h5>
                        </a>
                          <p class="card-text"><i class="fas fa-map-marker-alt px-1"></i>{{$vendor->address}}, {{$vendor->suburb}}</p>
                          <div class="user-rating d-flex justify-content-between">
                              <div class="rating">
                              <span><i class="fas fa-coffee checked"></i></span>
                              <span><i class="fas fa-coffee checked"></i></span>
                              <span><i class="fas fa-coffee checked"></i></span>
                              <span><i class="fas fa-coffee unchecked"></i></span>
                              <span><i class="fas fa-coffee unchecked"></i></span><span class="rating-avg badge rounded-pill bg-light text-dark mx-3"> 3.0</span>
                              </div>
                              <div class="favourite">
                              @auth
                              @if (!$vendor->likedBy(auth()->user()))
                                  <form action="{{ route('vendor.likes', $vendor) }}" method='post'>
                                  @csrf
                                  <button id="fav_like" type="submit" class="fav_like float-right"><span class="fas fa-coffee fa-lg"></span></button> <!--wil need to be changed to a button in laravel-->
                                  </form>
                              @else
                                  <form action="{{ route('vendor.likes', $vendor->id) }}" method='post'>
                                  @csrf
                                  @method('DELETE')
                                  <button id="fav_unlike" type="submit" class="fav_unlike float-right"><span class="fas fa-coffee fa-lg"></span></button>
                                  </form>
                              @endif
                              @endauth
                              </div>
                          </div>
                      </div>
                      <div class="card-footer">
                          <p class="card-text"><small class="text-muted">last updated {{$vendor->updated_at->diffForHumans()}}</small></p>
                      </div>
                    </div>
                  </div>
                  @endforeach
            </div>
        </div>
      </div> <!--container end-->
      @endsection
