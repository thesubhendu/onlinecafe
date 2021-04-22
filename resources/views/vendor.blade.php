@extends('layout.app')
@section('content')
<main role="main" class="container mb-5">

    <div class="vendor-view d-flex flex-row justify-content-between card-header mb-3 mt-4">
        <div class="">
            <img src="/storage/img/nostamp.png" width="50" height="50" alt="">
        </div>
        <div>
            <h1>Vendor View</h1>
        </div>
        <div>
        <a href="{{route('home')}}" class="btn btn-success"><i class="fas fa-chevron-left"></i> go back</a>
        </div>
    </div>
        <div class="card mb-3">
            <img src="{{asset('storage/img/cafe1.jpg')}}" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{$vendor->vendor_name}}</h5>
              <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto reprehenderit sint dignissimos cumque cupiditate eos voluptas laudantium harum ullam quibusdam.</p>
              <p class="card-text">{{$vendor->address}}</p>
              <p class="card-text">{{$vendor->suburb}} {{$vendor->pc}}</p>
              <p class="card-text">{{$vendor->state}}</p>
              <p class="card-text"><small class="text-muted">Last updated {{$vendor->updated_at->diffForHumans()}}</small></p>
              <div class="flex">
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
                Reviews
                <span class="card-text fas fa-coffee checked"></span>
                <span class="card-text fas fa-coffee checked"></span>
                <span class="card-text fas fa-coffee checked"></span>
                <span class="card-text fas fa-coffee unchecked"></span>
                <span class="card-text fas fa-coffee unchecked"></span><span class="badge badge-pill badge-dark ml-2"> 3.0</span>
            </div>
            <div class="row">
              <div class="col-sm-7">
                <hr/>
                <div class="review-block">
                  <div class="row">
                    <div class="col-sm-3 ml-4">
                      <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
                      <div class="review-block-name"><a href="#">nktailor</a></div>
                      <div class="review-block-date">June 16, 2016<br/>1 day ago</div>
                    </div>
                    <div class="col-sm-9">
                      <div class="review-block-rate">
                        <button type="button" class="btn btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee checked" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee checked" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee checked" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-grey btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee unchecked" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-grey btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee unchecked" aria-hidden="true"></span>
                        </button>
                      </div>
                      <div class="review-block-title ml-4">Lorem ipsum dolor sit amet.</div>
                      <div class="review-block-description ml-4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem quod neque odit, ea esse labore incidunt sequi ut porro commodi, quisquam sunt qui architecto doloribus ipsa autem animi, aspernatur tempora error eum eius quia! Debitis consequatur non magni molestiae rerum.</div>
                    </div>
                  </div>
                  <hr/>
                  <div class="row">
                    <div class="col-sm-3 ml-4">
                      <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
                      <div class="review-block-name"><a href="#">nktailor</a></div>
                      <div class="review-block-date">March 6, 2016<br/>1 day ago</div>
                    </div>
                    <div class="col-sm-9">
                      <div class="review-block-rate">
                        <button type="button" class="btn btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee checked" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee checked" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee checked" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-grey btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee unchecked" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-grey btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee unchecked" aria-hidden="true"></span>
                        </button>
                      </div>
                      <div class="review-block-title ml-4">this was nice in buy</div>
                      <div class="review-block-description ml-4">this was nice in buy. this was nice in buy. this was nice in buy. this was nice in buy this was nice in buy this was nice in buy this was nice in buy this was nice in buy</div>
                    </div>
                  </div>
                  <hr/>
                  <div class="row">
                    <div class="col-sm-3 ml-4">
                      <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="img-rounded">
                      <div class="review-block-name"><a href="#">nktailor</a></div>
                      <div class="review-block-date">January 29, 2016<br/>1 day ago</div>
                    </div>
                    <div class="col-sm-9">
                      <div class="review-block-rate">
                        <button type="button" class="btn btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee checked" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee checked" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee checked" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee checked" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-xs" aria-label="Left Align">
                          <span class="fas fa-coffee unchecked" aria-hidden="true"></span>
                        </button> 
                      </div>
                      <div class="review-block-title ml-4">Lorem ipsum dolor sit amet.</div>
                      <div class="review-block-description ml-4">this was nice in buy. this was nice in buy. this was nice in buy. this was nice in buy this was nice in buy this was nice in buy this was nice in buy this was nice in buy</div>
                    </div>
                  </div>
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