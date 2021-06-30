@extends('layout.app')
@section('content')
      <div class="container mt-4">
        <div class="row row-cols-1 row-cols-md-3 g-3 mt-4">
          @foreach ($vendors as $vendor)
            <div class="col">
                <div class="card h-100">
                  <a class="vendor-card" href="{{ route('vendor.show', $vendor) }}">
                    <img src="storage/img/vendor/{{$vendor->vendor_image}}" class="card-img-top" alt="...">
                  </a>
                  <a class="vendor-card" href="{{ route('vendor.newshow', $vendor) }}">New Show Vendor</a>
                    <div class="card-body">
                        <h5 class="card-title">{{$vendor->vendor_name}}</h5>
                        <p class="card-text"><i class="fas fa-map-marker-alt px-1"></i>{{$vendor->address}}, {{$vendor->suburb}}</p>
                        <div class="user-ratin d-flex justify-content-between">
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
      </div> <!--container end-->
      @endsection