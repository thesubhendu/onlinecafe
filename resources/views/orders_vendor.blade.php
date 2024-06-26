<x-app-layout>
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
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
            @auth

                @if($order->count() > 0)
                    <tr>
                        {{-- <th scope="row">1</th> --}}
                        {{-- <td>{{$order->vendor_id}}</td> --}}
                        <td>{{$order->getFormattedDate('date')}}</td>
                        @foreach($order->products as $product) {{--{{asset('/storage/app/public/img/'.'$product->product_image')}}--}}
                        @dd($product)
                        <td><img src="/storage/img/{{$product->product_image}}" width="48" height="48"></td>
                        <td>{{$product->name}}
                            <div><small class="text-muted">Milk - {{$product->pivot->milk}}, Sugar
                                    - {{$product->pivot->sugar}}, Syrup - {{$product->pivot->syrup}}</small></div>
                        </td>
                        <td>${{$product->price}}</td>
                        <td><a href="{{ route('confirm_order.confirm', $order) }}" class="btn btn-success btn-sm"><i
                                    class="fas fa-check-square"></i></a></td>
                        @endForEach
                    </tr>
                @else
                    <p>It's strange, you dont any orders yet!</P>
                @endif
            @endauth
            </tbody>
                </table>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </main>
</x-app-layout>
