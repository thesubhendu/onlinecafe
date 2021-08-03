@extends('layout.app')
@section('content')
<main role="main">
  <div class="container mt-2mb-5">
    <div class="card">
      <div class="card-header">
        <div class="review-block-rate d-flex">
          <div class="rating">
            {{-- /vendor/{{$rating->id}}/rate --}}
            <form action="#" method="POST">
              @csrf
            <input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
            <input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
            <input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
            <input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
            <input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
            {{-- <span class="badge rounded-pill bg-dark ml-3"> 3.0</span> --}}
            </div>
          </div>
          <div class="rating-comment">
            <div class="form-group">
              <textarea class="form-control rounded"></textarea>
            </div>
          </div>
        </form>
          {{-- <span class="card-text fas fa-coffee checked"></span>
          <span class="card-text fas fa-coffee checked"></span>
          <span class="card-text fas fa-coffee checked"></span>
          <span class="card-text fas fa-coffee unchecked"></span>
          <span class="card-text fas fa-coffee unchecked"></span><span class="badge badge-pill badge-dark ml-2"> 3.0</span> --}}
      </div>
      @foreach ($rating as $rate)
      <div class="row">
        <div class="col col-md-6">
          <div class="review-block">
            {{-- <div class="row"> --}}
              <div class="col col-sm-3 ml-4">
                <img src="http://dummyimage.com/60x60/666/ffffff&text=No+Image" class="rounded-circle">
                <div class="review-block-name"><a href="#">nktailor</a></div>
                <div class="review-block-date">March 6, 2016<br/>1 day ago</div>
              </div>
              {{-- /vendor/{{$rating->id}}/rate --}}
              {{-- <form action="#" method="POST">
                @csrf --}}
                <div class="col col-md-9">
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
              {{-- </form> --}}
            {{-- </div> --}}
            <hr/>
          </div>
        </div>
      </div>
    </div> {{--end rating card --}}
    @endforeach
  </div>
</main><!-- /.container -->
@endsection