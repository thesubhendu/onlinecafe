@extends('layout.app')
@section('content')
<main role="main" class="container-fluid py-4 mb-5 mt-4">
  <div class="vendor-view d-flex flex-row justify-content-between mb-3 mt-4">
    <div>
        <h1>Orders</h1>
    </div>
    <div>
        <a href="/" class="btn btn-success"><i class="fas fa-backward"></i></a>
    </div>
</div>
<hr>

  <div class="vendor-index mt-4">
    <div>
      <table class="table table-striped">
        <thead>
          {{-- <tr>
            <th scope="col">#</th>
            <th scope="col">Venue</th>
            <th scope="col">Date</th>
            <th scope="col">Image</th>
            <th scope="col">Product</th>
            <th scope="col">Total</th>
            <th scope="col"></th>
          </tr> --}}
        </thead>
        <tbody>
          @auth
          @foreach($user as $order)
          <tr>
            {{-- <th scope="row">1</th> --}}
            {{-- <td>{{$order->vendor_id}}</td> --}}
            <td>{{$order->getFormattedDate('date')}}</td>
            @foreach($order->products as $product) {{--{{asset('/storage/app/public/img/'.'$product->product_image')}}--}}
            <td><img src="storage/img/{{$product->product_image}}" width="48" height="48"></td>
            <td>{{$product->productName}}<div><small class="text-muted">Full Cream, Sugar - 1, Syrup - No Thanks</small></div></td>
            <td>${{$product->productPrice}}</td>
            <td><a href="{{ route('orders.create', $product) }}" class="btn btn-success btn-sm"><i class="fas fa-cart-plus"></i></a></td>
            @endForEach
          </tr>
          @endforeach
          @endauth
        </tbody>
      </table>
    </div>
  </div>

</main><!-- /.container -->
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script></body>
</body>
</html>