@extends('layout.app')
@section('content')
<main role="main">
  <div class="container">
    <div class="row">
          <table class="table table-striped">
            <thead>
              <tr>
                {{-- <th scope="col">#</th> --}}
                {{-- <th scope="col">Venue</th> --}}
                <th scope="col">Date</th>
                <th scope="col">Image</th>
                <th scope="col">Product</th>
                <th scope="col">Total</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @auth
              @foreach($user as $order)
              @if($order->count() > 0)
              <tr>
                {{-- <th scope="row">1</th> --}}
                {{-- <td>{{$order->vendor_id}}</td> --}}
                <td>{{$order->getFormattedDate('date')}}</td>
                @foreach($order->products as $product) {{--{{asset('/storage/app/public/img/'.'$product->product_image')}}--}}
                <td><img src="storage/img/{{$product->product_image}}" width="48" height="48"></td>
                <td>{{$product->productName}}<div><small class="text-muted">Milk - {{$product->pivot->milk}}, Sugar - {{$product->pivot->sugar}}, Syrup - {{$product->pivot->syrup}}</small></div></td>
                <td>${{$product->productPrice}}</td>
                <td><a href="{{ route('orders.create', $product) }}" class="btn btn-success btn-sm"><i class="fas fa-cart-plus"></i></a></td>
                @endForEach
              </tr>
              @else
                <p>It's strange, you havent ordered any coffee yet!</P>
              @endif
              @endforeach
              @endauth
            </tbody>
          </table>
    </div><!-- /.row -->
  </div><!-- /.container -->
</main>
@endsection