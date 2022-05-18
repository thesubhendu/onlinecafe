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
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Total Price</th>
                    <th>Additions</th>
                </tr>
                </thead>
                <tbody>
                <tr>

                    @foreach($order->products as $product)
                        <td>
                            {{$product->name}}
                        </td>
                        <td>{{ $product->pivot->quantity}}</td>
                        <td>
                            {{$product->pivot->price}}
                        </td>
                        <td>
                            @foreach (json_decode($product->pivot->options, true) as $key => $value )
                                {{$value}} <br>
                            @endforeach
                        </td>
                    @endforeach
                </tr>
                </tbody>
            </table>

            <p>has been confirmed by the venue {{$order->vendor->name}}</strong> payment will be required on pickup</p>
            <hr>

            <div class="avatar">
                <img src="{{asset('assets/images/thanks/girl-standing-1.png')}}" alt=""  >

            </div>

            <p class="lead mt-4">
                <a class="btn btn-success btn-sm" href="/" role="button">Back to homepage</a>
            </p>
            <!-- <p>
                Having trouble? <a href="">Contact us</a>
              </p> -->
        </div>
    </div>

</main><!-- /.container -->
