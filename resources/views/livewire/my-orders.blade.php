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
                    <th scope="col">Product Options</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{$order->vendor->shop_name ?? $order->vendor->vendor_name}}</td>

                        @foreach($order->products as $product)
                            @if($product->product_image)
                                <td><img src="{{$product->product_image}}" width="48" height="48"></td>
                            @else
                                <td><img src="{{asset('assets/images/cold-coffee.jpg')}}" width="48" height="48"></td>
                            @endif
                            <td>{{$product->name}}</td>
                            <td>
                                <?php $productOption = json_decode($product->pivot->options, true);?>
                                <ul>
                                    @foreach($productOption as $option)
                                        <li>
                                            <small class="text-muted">
                                                {{$option}}
                                            </small>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>${{$product->price}}</td>
                            <td>
                                <a href="{{ route('orders.create', $product) }}" class="btn btn-success btn-sm"><i
                                        class="fa fa-cart-plus"></i></a>
                            </td>
                        @endforeach
                    </tr>
                    <td> {{$orders->links()}}</td>
                @empty
                    <p class="mb-">It's strange, you haven't ordered any coffee yet!</P>
                @endforelse
                </tbody>
            </table>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

