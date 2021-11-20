<div class="container mt-3">

    <h3> My Orders</h3>
    <div class="row">
        <table class="table table-light table-borderless">
            <thead>
                <tr>
                    <th scope="col">Order</th>
                    <th scope="col">Vendor</th>
                    <th scope="col">Image</th>
                    <th scope="col">Product</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    {{-- <th scope="row">1</th> --}}
                    {{-- <td>{{$order->vendor_id}}</td> --}}
                    <td>Order-{{$order->order_number}} -- {{$order->getFormattedDate('date')}}</td>
                    <td>{{$order->vendor->shop_name ?? $order->vendor->vendor_name}}</td>
                    @foreach($order->products as $product)
                     <tr>
                         <td></td>
                         <td></td>
                        <td><img src="{{$product->product_image}}" width="48" height="48"></td>
                        <td>{{$product->name}}
                            <div>
                                <small class="text-muted">
                                    {{$product->pivot->options}}
                                </small>
                            </div>
                        </td>
                        <td>${{$product->price}}</td>
                        <td><a href="{{ route('orders.create', $product) }}" class="btn btn-success btn-sm"><i class="fas fa-cart-plus"></i></a>
                        </td>
                     </tr>

                    @endForEach
                </tr>
                @empty

                <p>It's strange, you havent ordered any coffee yet!</P>
                @endforelse
            </tbody>
        </table>
    </div><!-- /.row -->
</div><!-- /.container -->
