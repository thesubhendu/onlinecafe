<!-- MENU CARD -->
<div class="col-md-3 col-sm-4">
    <div class="vendor-product-item">

        <!-- IMAGE with ICON -->
        <div class="image">

            @if($product->product_image)
                <img src="{{asset($product->product_image)}}" class="img-responsive" alt="">
            @else
                <img src="{{asset('assets/images/cafe-2.jpeg')}}" class="img-responsive" alt="">
            @endif
            {{-- <i class="ti-heart"></i> --}}
        </div>

        <!-- CONTENT -->
        <div class="content">
            <h5>{{$product->name}}</h5>
            <div class="price-and-add">
                <div class="price"><p><i class="fa fa-dollar"></i> {{$product->price}}</p></div>
                <div class="add"><a href="{{ route('orders.create', $product->id) }}" class="shop-btn"> Add &nbsp; <i
                            class="fa fa-shopping-cart"></i></a></div>
            </div>

        </div>
    </div>
</div>
