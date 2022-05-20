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
                @forelse($orderProducts as $orderProduct)
                    <tr>
                        <td>{{$orderProduct->order->vendor->shop_name ?? $orderProduct->order->vendor->name}}</td>
                            @if($orderProduct->product->product_image)
                                <td><img src="{{asset('storage/'.$orderProduct->product->product_image)}}" width="48" height="48"></td>
                            @else
                                <td><img src="{{asset('assets/images/cold-coffee.jpg')}}" width="48" height="48"></td>
                            @endif
                            <td>{{$orderProduct->product->name}}</td>
                            <td>
                                <?php $productOption = json_decode($orderProduct->options, true);?>
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
                            <td>${{$orderProduct->price}}</td>
                            <td>
                                <a href="{{ route('orders.create', $orderProduct->product) }}" class="btn btn-success btn-sm"><i
                                        class="fa fa-cart-plus"></i></a>
                            </td>
                    </tr>
                @empty
                    <p class="mb-">It's strange, you haven't ordered any coffee yet!</P>
                @endforelse
                <tr><td>{{$orderProducts->links() }}</td></tr>
                </tbody>
            </table>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

