<x-app-layout>
    <div class="container grid">
        <div class="grid-row">
            {{-- @if ($vendors->likedBy(auth()->user())) @endif --}}
    @forelse ($userlikes as $vendor)
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-sm-4">
              <img src="/storage/img/vendor/{{$vendor->vendor->vendor_image}}" alt="..." class="img-fluid">
          </div>
            <div class="col-sm-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $vendor->vendor->vendor_name }}</h5>
                    <p class="card-text"><small class="text-muted">Last
                            updated {{$vendor->vendor->updated_at->diffForHumans()}}</small></p>
                    <a href="{{route( 'vendor.products', $vendor )}}" class="btn btn-success px-3 mr-3">Order</a>
                </div>
                <form action="{{ route('vendor.likes', $vendor->vendor_id) }}" method='post'>
                    @csrf
                    @method('DELETE')
                    <button id="fav_unlike" type="submit" class="fav_unlike float-right mr-2"><span
                            class="fas fa-coffee fa-lg"></span></button>
                </form>
            </div>
        </div>
      </div>
                @endforeach
        </div><!-- /.row -->
    </div><!-- /.container -->
</x-app-layout>


