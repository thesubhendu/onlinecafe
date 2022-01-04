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
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                <div class="price">
                    <p><i class="fa fa-dollar"></i> {{$product->price}}</p>
                </div>
            </div>
            {{-- @can('make-order')--}}
                <div class="add">
                    <a href="{{ route('orders.create', $product->id) }}" class="shop-btn"> Add &nbsp;
                        <i class="fa fa-coffee"></i>
                    </a>
                </div>
            {{-- @endcan--}}
        </div>
    </div>
</div>