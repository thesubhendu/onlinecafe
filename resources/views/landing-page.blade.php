
@extends('layout.app')
@section('content')
<main role="main" class="container mb-5">
  <div class="vendor-index mt-4">
    <div class="vendor-view d-flex flex-row justify-content-between card-header mb-3 mt-4">
      <div class="">
          <img src="storage/img/nostamp.png" width="50" height="50" alt="">
      </div>
      <div>
          <h1>My Coffee</h1>
      </div>
      <div>
          <!-- <a href="index.html" class="btn btn-success">go back</a> -->
      </div>
  </div>
      @foreach ($vendors as $vendor)
        <div class="card mb-3">
            <img src="storage/img/cafe1.jpg" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{$vendor->vendor_name}}</h5>
              <span class="card-text fa fa-star checked"></span>
                <span class="card-text fa fa-star checked"></span>
                <span class="card-text fa fa-star checked"></span>
                <span class="card-text fa fa-star"></span>
                <span class="card-text fa fa-star"></span><span class="badge badge-pill badge-success"> 3.0</span>
              <p class="card-text">{{$vendor->suburb}}</p>
              <a id="menubtn" href="{{route( 'vendor.products', $vendor )}}" class="btn btn-success btn-sm">Menu</a>
              <a id="vendorbtn" href="{{route('vendor.show', $vendor)}}" class="homeScreenVendors btn btn-secondary btn-sm">View</a>
                <a id="addCommentbtn" href="#" class="homeScreenViewComment btn btn-secondary btn-sm"><i class="fas fa-comment-dots" ></i></a>
                <a id="addRatingBtn" href="#" class="homeScreenRating btn btn-secondary btn-sm"><i class="fas fa-star" ></i></a>
                <div class="flex">
                  @auth
                  @if (!$vendor->likedBy(auth()->user()))
                    <form action="{{ route('vendor.likes', $vendor) }}" method='post'>
                      @csrf 
                    <button id="fav_like" type="submit" class="fav_like float-right"><span class="fas fa-coffee fa-lg"></span></button>
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
                <p class="card-text"><small class="text-muted">last updated {{$vendor->updated_at->diffForHumans()}}</small></p>
            </div>
          </div>
      @endforeach
  </div>
</main><!-- /.container -->
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script></body>
</body>
</html> --}}