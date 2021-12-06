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
                                <div class="xs-block last-update">Last Update: {{$vendor->updated_at->diffForHumans()}}</div>
                            </div>
                            <div class="col-md-6">
                                <livewire:rating-form :vendor="$vendor"/>
                            </div>
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
                <div class="item">
                    <div class="vendor-product-item">
                        <div class="image">
                            <img src="{{asset('assets/images/cafe-2.jpeg')}}" class="img-responsive" alt="">
                            <span class="ribbon"> <span class="ribbon-edge">Featured</span> </span>
                        </div>
                        <div class="content">
                            <h5>Product Item</h5>
                            <div class="price-and-add">
                                <div class="price"><p><i class="fa fa-dollar"></i> 5</p></div>
                                <div class="add"><a href="" class="shop-btn"> Add &nbsp; <i class="fa fa-coffee"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="vendor-product-item">
                        <div class="image">
                            <img src="{{asset('assets/images/cafe-2.jpeg')}}" class="img-responsive" alt="">
                            <span class="ribbon"> <span class="ribbon-edge">Featured</span> </span>
                        </div>
                        <div class="content">
                            <h5>Product Item</h5>
                            <div class="price-and-add">
                                <div class="price"><p><i class="fa fa-dollar"></i> 5</p></div>
                                <div class="add"><a href="" class="shop-btn"> Add &nbsp; <i class="fa fa-coffee"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="vendor-product-item">
                        <div class="image">
                            <img src="{{asset('assets/images/cafe-2.jpeg')}}" class="img-responsive" alt="">
                            <span class="ribbon"> <span class="ribbon-edge">Featured</span> </span>
                        </div>
                        <div class="content">
                            <h5>Product Item</h5>
                            <div class="price-and-add">
                                <div class="price"><p><i class="fa fa-dollar"></i> 5</p></div>
                                <div class="add"><a href="" class="shop-btn"> Add &nbsp; <i class="fa fa-coffee"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="vendor-product-item">
                        <div class="image">
                            <img src="{{asset('assets/images/cafe-2.jpeg')}}" class="img-responsive" alt="">
                            <span class="ribbon"> <span class="ribbon-edge">Featured</span> </span>
                        </div>
                        <div class="content">
                            <h5>Product Item</h5>
                            <div class="price-and-add">
                                <div class="price"><p><i class="fa fa-dollar"></i> 5</p></div>
                                <div class="add"><a href="" class="shop-btn"> Add &nbsp; <i class="fa fa-coffee"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="vendor-product-item">
                        <div class="image">
                            <img src="{{asset('assets/images/cafe-2.jpeg')}}" class="img-responsive" alt="">
                            <span class="ribbon"> <span class="ribbon-edge">Featured</span> </span>
                        </div>
                        <div class="content">
                            <h5>Product Item</h5>
                            <div class="price-and-add">
                                <div class="price"><p><i class="fa fa-dollar"></i> 5</p></div>
                                <div class="add"><a href="" class="shop-btn"> Add &nbsp; <i class="fa fa-coffee"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
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
                @foreach ($products as $product)
                <x-menu-card :product="$product"></x-menu-card>
                @endforeach
            </div>

            @empty
            <h2>No Products</h2>
            @endforelse


        </div>

    </section>

    <x-footer></x-footer>

</x-app-layout>