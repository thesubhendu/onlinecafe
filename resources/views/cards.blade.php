@extends('layout.app')
@section('content')
<main role="main" class="">
<div id="card-showcase" class="">
  <div class="showcase-content">
    <h3 class="">Pay it Forward.</h3>
    <p class="">Lorem ipsum dolor sit amet.</p>
    <div class="d-flex justify-content-between">
      <a href="#" class="btn btn-outline-success">Learn More</a>
    </div>
  </div>
</div>
  <div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
      @foreach ($cards as $card)
      <div class="col">
        <div class="card h-100 mt-2">
          <div class="card-logo card-header">
            <img src="storage/img/vendor/{{$card->card_logo}}" style="max-width: 10%; height: auto;">
            {{$card->vendor->vendor_name}} 
            <a href="{{route('vendor.products', $card->vendor_id )}}" class="btn btn-success btn-small float-right">Order</a>
            <div>
              <small class="card-text text-muted">Buy {{$card->vendor->cardstamps}} coffees get 1 free</small>
              {{-- <a href="menu.html" class="btn btn-success btn-small float-right">Order</a> --}}
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between row row-cols-1 row-cols-md-5 g-4">
              @foreach ($card->stamps as $stamp)
              <div class="col">
                <img src="storage/img/stamp48x48.png" width="48" height="48" alt="stamp">
                <img src="storage/img/stamp48x48.png" width="48" height="48" alt="stamp">
                <img src="storage/img/stamp48x48.png" width="48" height="48" alt="stamp">
                <img src="storage/img/stamp48x48.png" width="48" height="48" alt="stamp">
                <img src="storage/img/stamp48x48.png" width="48" height="48" alt="stamp">
              </div>
              @endforeach
              @if($card->maxStamp < $card->stamps->count())
              <div class="col">
                <img src="storage/img/nostamp48x48.png" width="48" height="48" alt="nostamp">
                <img src="storage/img/nostamp48x48.png" width="48" height="48" alt="stamp">
                <img src="storage/img/nostamp48x48.png" width="48" height="48" alt="stamp">
                <img src="storage/img/nostamp48x48.png" width="48" height="48" alt="stamp">
                <img src="storage/img/nostamp48x48.png" width="48" height="48" alt="stamp">
              </div>
              @endif
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
