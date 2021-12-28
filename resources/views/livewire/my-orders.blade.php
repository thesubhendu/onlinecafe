<section class="my-orders">
    <div class="container">
        <h3> My Orders</h3>
        <div class="row">
            <table class="table table-borderless mt-3">
                <thead>
                    <tr>
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
                        <td>{{$order->vendor->shop_name ?? $order->vendor->vendor_name}}</td>
                        @foreach($order->products as $product)
                        <td><img src="{{$product->product_image}}" width="48" height="48"></td>
                        <td>{{$product->name}}
                            <div>
                                <small class="text-muted">
                                    {{$product->pivot->options}}
                                </small>
                            </div>
                        </td>
                        <td>${{$product->price}}</td>
                        <td><a href="{{ route('orders.create', $product) }}" class="btn btn-success btn-sm"><i class="fa fa-cart-plus"></i></a>
                        </td>
                    </tr>

                    @endForEach
                    </tr>
                    @empty

                    <p class="mb-">It's strange, you havent ordered any coffee yet!</P>
                    @endforelse
                </tbody>
            </table>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>
