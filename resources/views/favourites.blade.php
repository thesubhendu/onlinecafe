
@extends('layout.app')
@section('content')
<main role="main" class="container py-4 mb-5">
    <div class="vendor-view d-flex flex-row justify-content-between mb-3 mt-4">
      <div class="favourites">
          <h1>favourites</h1>
      </div>
      <div>
          <a href="/" class="btn btn-success"><i class="fas fa-backward"></i></a>
      </div>
  </div>
  <hr>
  {{-- @if ($vendors->likedBy(auth()->user())) @endif --}}
  @foreach ($userlikes as $vendor)
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="/storage/img/cafe1.jpg" alt="..." class="img-fluid">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">{{ $vendor->vendor->vendor_name }}</h5>
            <p class="card-text"><small class="text-muted">Last updated {{$vendor->vendor->updated_at->diffForHumans()}}</small></p>
            <a href="{{route( 'vendor.products', $vendor )}}" class="btn btn-success px-3 mr-3">Order</a>
          </div>
          <form action="{{ route('vendor.likes', $vendor->vendor_id) }}" method='post'>
            @csrf
                  @method('DELETE')
          <button id="fav_unlike" type="submit" class="fav_unlike float-right mr-2"><span class="fas fa-coffee fa-lg"></span></button>
              </form>
          {{-- @else
            <p>you havent liked anything</p> --}}
  
         
        {{-- @if (!$vendor->likedBy(auth()->user())) --}}
                {{-- <form action="{{ route('vendor.likes', $favourite->vendor_id) }}" method='post'>
                  @csrf 
                <button id="fav_like" type="submit" class="fav_like float-right"><span class="fas fa-coffee fa-lg"></span></button>
                </form> --}}
                {{-- <form action="{{ route('vendor.likes', $vendor->vendor_id) }}" method='post'>
                  @csrf
                  @method('DELETE')
                <button id="fav_unlike" type="submit" class="fav_unlike float-right"><span class="fas fa-coffee fa-lg"></span></button>
                </form>
              @else
                <div>  <p>you havent liked anything</p>  </div>
              @endif --}}
        </div>
        
      </div>
    </div>
    @endforeach

</main><!-- /.container -->
@endsection

{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script></body>
</body>
</html> --}}