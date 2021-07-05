@extends('layout.app')
@section('content')
<main role="main" class="container py-4 mb-5 mt-4">
  {{-- <div class="vendor-view d-flex flex-row justify-content-between mb-3 mt-4">
    <div>
        <h1>Your Cards</h1>
    </div>
    <div>
        <a href="index.html" class="btn btn-success"><i class="fas fa-backward"></i></a>
    </div>
</div>
<hr> --}}
  <div class="container mt-4">
    <div id="" class="card-showcase">
      <h3>Pay it Forward.</h3>
      <p>Lorem ipsum dolor sit amet.</p>
      <div class="d-flex justify-content-between">
        <a href="#" class="btn btn-outline-success">Learn More</a>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
      @foreach ($user as $card)
      <div class="col">
        <div class="card h-100 mt-2">
          <div class="card-logo card-header">
            <img src="storage/img/vendor/{{$card->card_logo}}" style="max-width: 10%; height: auto;">
            {{$card->vendor->id}} 
            <a href="{{route('vendor.products', $card->vendor_id )}}" class="btn btn-success btn-small float-right">Order</a>
            <div>
              <small class="card-text text-muted">Buy 9 coffees get 1 free</small>
              {{-- <a href="menu.html" class="btn btn-success btn-small float-right">Order</a> --}}
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
              <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
              <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
              <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
              <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
            </div>
            <div class="d-flex justify-content-between">
              <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
              <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
              <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
              <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
            </div>
          </div>
          <div class="card-footer">
            <small class="text-muted">{{$card->updated_at->diffForHumans()}}</small>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

</main><!-- /.container -->
@endsection
