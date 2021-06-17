@extends('layout.app')
@section('content')
<main role="main" class="container mb-5">

    <div class="vendor-view d-flex flex-row justify-content-between card-header mb-3 mt-4">
        {{-- <div>
            <h1>Vendor View</h1>
        </div> --}}
        <div>
        <a href="{{route('home')}}" class="btn btn-success"><i class="fas fa-chevron-left"></i> go back</a>
        </div>
    </div>
        <div class="card mb-3">
            <img src="/storage/img/vendor/{{$vendor->vendor_image}}" class="card-img-top img-fluid" alt="..." style="max-width: 100%;">
            <div class="card-body">
              <h5 class="card-title">{{$vendor->vendor_name}}</h5>
              <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto reprehenderit sint dignissimos cumque cupiditate eos voluptas laudantium harum ullam quibusdam.</p>
              <p class="card-text">{{$vendor->address}}</p>
              <p class="card-text">{{$vendor->suburb}} {{$vendor->pc}}</p>
              <p class="card-text">{{$vendor->state}}</p>
              <p class="card-text"><small class="text-muted">Last updated {{$vendor->updated_at->diffForHumans()}}</small></p>
              <div class="row d-flex">
                @auth
                @if (!$vendor->likedBy(auth()->user()))
                  <form action="{{ route('vendor.likes', $vendor->id) }}" method='post'>
                    @csrf 
                  <button id="FavIcon" type="submit" class="fav_like float-right"><span class="fas fa-coffee fa-lg"></span></button>
                  </form>
                @else
                  <form action="{{ route('vendor.likes', $vendor->id) }}" method='post'>
                    @csrf
                    @method('DELETE')
                  <button id="unFavIcon" type="submit" class="fav_unlike float-right"><span class="fas fa-coffee fa-lg"></span></button>
                  </form>
                @endif
                <span>{{ $vendor->likes->count() }} {{ Str::plural('like', $vendor->likes->count())}}</span>
                @endauth
            </div>
              <a href="{{route( 'vendor.products', $vendor )}}" class="btn btn-success">Order</a>
            </div>
          </div>
        <div class="card">
            <div class="card-header">
              <div class="review-block-rate d-flex">
                <div class="rating">
                  <input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
                  <input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
                  <input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
                  <input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
                  <input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
                  <span class="badge rounded-pill bg-dark ml-3"> 3.0</span>
                  </div>
              </div>
                {{-- <span class="card-text fas fa-coffee checked"></span>
                <span class="card-text fas fa-coffee checked"></span>
                <span class="card-text fas fa-coffee checked"></span>
                <span class="card-text fas fa-coffee unchecked"></span>
                <span class="card-text fas fa-coffee unchecked"></span><span class="badge badge-pill badge-dark ml-2"> 3.0</span> --}}
              <div class="rating-comment">
                <div class="form-group">
                  <textarea class="form-control"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-7">
                <hr/>
                <div class="review-block">
                  <div class="row">
                    <div class="col-6 col-sm-3 ml-4">
                      <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="rounded-circle">
                      <div class="review-block-name"><a href="#">nktailor</a></div>
                      <div class="review-block-date">March 6, 2016<br/>1 day ago</div>
                    </div>
                    <form action="/vendor/{{$vendor->id}}/rate" method="POST">
                      @csrf
                      <div class="col-6 col-sm-9">
                        <div class="review-block-rate justify-content-between m-4">
                          <div class="rating d-flex">
                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
                          {{-- <span class="fas fa-coffee checked ml-4" aria-hidden="true"></span>                          
                          <span class="fas fa-coffee checked ml-4" aria-hidden="true"></span>                          
                          <span class="fas fa-coffee checked ml-4" aria-hidden="true"></span>                          
                          <span class="fas fa-coffee unchecked ml-4" aria-hidden="true"></span>                          
                          <span class="fas fa-coffee unchecked ml-4" aria-hidden="true"></span> --}}
                        </div>
                        <div class="review-block-title fw-bold py-2">Lorem ipsum dolor sit amet.</div>
                        <div class="review-block-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit suscipit maxime vitae accusantium quidem amet dignissimos. Ex, hic vero a quisquam sit dolor officiis? Ipsam, nostrum qui voluptatibus culpa hic debitis accusantium possimus neque consequuntur voluptate necessitatibus dolorum id similique.</div>
                      </div>
                      </div>
                    </form>
                  </div>
                  <hr/>
                </div>
              </div>
            </div>
          </div> 
  
  </main><!-- /.container -->
  @endsection
  {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script></body>
</body>
  </html> --}}