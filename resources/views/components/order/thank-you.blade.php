<main role="main" class="container py-4 mb-5">

    <div class="vendor-index mt-4">
        <div class="vendor-view d-flex flex-row justify-content-between mb-3 mt-4">
            <div>
                <!-- <h1>Thank You</h1> -->
            </div>
            <!-- <div>
                <a href="index.html" class="btn btn-success">go back</a>
            </div> -->
        </div>
        <hr>
        <div class="jumbotron text-center">
            <div class="">
                <i class="far fa-check-circle display-tick"></i>
            </div>
            <h1 class="display-3">Thank You!</h1>
            <p class="lead"><strong>Your Order  </p>
            {{-- @foreach($order->products as $product)
            <p class="card-text">{{$product->pivot->quantity}} x {{$product->productName}}</p>
            <span class="card-text text-muted">{{$product->pivot->milk}}, Suagrs - {{$product->pivot->sugar}}, Syrup - {{$product->pivot->syrup}}</span>
            <p class="card-text">Total: ${{$product->pivot->price}}</p>
            @endforeach --}}
            {{-- <p>has been confirmed by the venue {{$vendor->vendor_name}}</strong> payment will be required on pickup</p> --}}
            <p>has been confirmed by the venue</strong> payment will be required on pickup</p>
            <hr>

            <p class="lead">
                <a class="btn btn-success btn-sm" href="/" role="button">Back to homepage</a>
            </p>
            <!-- <p>
                Having trouble? <a href="">Contact us</a>
              </p> -->
        </div>
    </div>

</main><!-- /.container -->
