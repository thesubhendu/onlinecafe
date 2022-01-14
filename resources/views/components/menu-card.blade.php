<!-- MENU CARD -->
<div class="vendor-product-item">
    <div class="content">
        <div class="product-image">
            @if($product->product_image)
                <img src="{{asset($product->product_image)}}" class="img-responsive" alt="">
            @else
                <img src="{{asset('assets/images/cafe-2.jpeg')}}" class="img-responsive" alt="">
            @endif
        </div>
        <div class="details">
            <h5>{{$product->name}}</h5>
            <div class="price-and-add">
                <p>{{$product->description}}</p>
                <div class="row menu-card-footer">
                    <div class="col-6">
                        <div class="price">
                            <p><i class="fa fa-dollar"></i> {{$product->price}}</p>
                        </div>
                    </div>
                    <div class="col-6">
                        @guest
                            <div class="add">
                                <a href="{{ route('orders.create', $product->id) }}" class="shop-btn"> Add &nbsp;
                                <i class="fa fa-coffee"></i>
                            </a>
                        </div>
                        @endguest
                        @if(auth()->check() && auth()->id() != $product->vendor->owner_id)
                        <div class="add">
                            <a href="{{ route('orders.create', $product->id) }}" class="shop-btn"> Add &nbsp;
                                <i class="fa fa-coffee"></i>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- @can('make-order')--}}
            <!-- <div class="add">
                <a href="{{ route('orders.create', $product->id) }}" class="shop-btn"> Add &nbsp;
                    <i class="fa fa-coffee"></i>
                </a>
            </div> -->
            {{-- @endcan--}}
        </div>
    </div>
</div>
