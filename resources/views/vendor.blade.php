<x-app-layout>

    <!-- VENDOR BANNER -->
    <section class="banner-inner">
        <div class="container">
            <!-- VENDER DETAILS -->
            <div class="row text-center banner-content">
                <h2>{{$vendor->shop_name ?? $vendor->vendor_name}}</h2>
                <p><i class="fa fa-map-marker"></i> {{$vendor->address}}, {{$vendor->suburb}}
                    , {{$vendor->state}}, {{$vendor->pc}}</p>
                <p><i class="fa fa-envelope"></i> {{$vendor->email}} &nbsp; | &nbsp; <i class="fa fa-phone"></i> {{$vendor->mobile}}</p>
                <p>
                    {{$openingInfo}}
                </p>
                <div class="vendor-actions">
                    <div class="icon-ratings">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="xs-block">
                                    @for($i=0; $i < round($vendor->rating()); $i++)
                                        <i class="fa fa-coffee selected"></i>
                                    @endfor
                                    @for($i=0; $i< 5 - round($vendor->rating()); $i++)
                                        <i class="fa fa-coffee"></i>
                                    @endfor
                                    <span><b>{{$vendor->rating()}}</b></span>
                                </div>
                                <div class="xs-block last-update">Last
                                    Update: {{$vendor->updated_at->diffForHumans()}}</div>
                            </div>

                            @auth
                                <div class="col-md-6">

                                    <div>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#rating-form-modal">
                                            Rate the vendor
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="rating-form-modal"
                                             aria-labelledby="rating-form-modal"
                                             aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Rate the
                                                            vendor</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <livewire:rating-form :vendor="$vendor"/>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- VENDER MENU -->
    <section class="vendor-menu">
        <div class="container">

            <!-- TITLE -->
            <div class="row mb-4">
                <div class="col-md-12 m-0 p-0 ">
                    <div class="content-heading">
                        <h3 class="title">Featured Coffee</h3>
                    </div>
                </div>
            </div>

            <div class="owl-carousel owl-theme mb-4">
                @foreach($featuredProducts as $product)
                    <div class="item">
                        <div class="vendor-product-item">
                            <div class="image">
                                @if($product->product_image)
                                    <img src="{{asset($product->product_image)}}" class="img-responsive" alt="">
                                @else
                                    <img src="{{asset('assets/images/cafe-2.jpeg')}}" class="img-responsive" alt="">
                                @endif
                                <span class="ribbon"> <span class="ribbon-edge">Featured</span> </span>
                            </div>
                            <div class="content">
                                <h5>{{$product->name}}</h5>
{{--                                @can('make-order')--}}
                                    <div class="price-and-add">
                                        <div class="price"><p><i class="fa fa-dollar"></i> $ {{$product->price}}</p>
                                        </div>
                                        <div class="add"><a href="{{ route('orders.create', $product->id) }}"
                                                            class="shop-btn"> Add &nbsp; <i
                                                    class="fa fa-coffee"></i></a>
                                        </div>
                                    </div>
                                {{--                                @endcan--}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @forelse ($vendor->products->groupBy('category_id') as $products)
            <!-- TITLE -->
                <div class="row mb-4">
                    <div class="col-md-12 m-0 p-0 ">
                        <div class="content-heading">
                            <h3 class="title">{{$products->first()->category->name}}</h3>
                        </div>
                    </div>
            </div>

            <div class="row  @if($loop->index > 0) mt-4 @endif ">
                <div class="col-md-8">
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-md-6">
                            <x-menu-card :product="$product"></x-menu-card>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>

            @empty
            <h2>No Products</h2>
            @endforelse


        </div>

    </section>

    <x-footer></x-footer>

</x-app-layout>
