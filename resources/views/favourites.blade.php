<x-app-layout>
    <div class="container grid">
        <div class="grid-row">
            @forelse ($userlikes as $vendor)
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-sm-4">
              <img src="{{$vendor->vendor_image ?? assets('assets/images/cappuccino.jpg')}}" alt="..." class="img-fluid">
          </div>
            <div class="col-sm-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $vendor->vendor_name }}</h5>
                    <p class="card-text"><small class="text-muted">Last
                            updated {{$vendor->updated_at->diffForHumans()}}</small></p>
                    <a href="{{route( 'vendor.products', $vendor )}}" class="btn btn-success px-3 mr-3">Order</a>
                </div>

                <livewire:vendor-like-button :vendor="$vendor" />
            </div>
        </div>
      </div>
                @endforeach
        </div><!-- /.row -->
    </div><!-- /.container -->
</x-app-layout>


