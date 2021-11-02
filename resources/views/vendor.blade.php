<x-app-layout>
    <!-- VENDOR BANNER -->
    <section class="banner-inner">
        <div class="container">

            <!-- VENDER DETAILS -->
            <div class="row text-center banner-content">
                <h2>{{$vendor->vendor_name}}</h2>
                <p><i class="fa fa-map-marker"></i> {{$vendor->address}}, {{$vendor->suburb}}
                    , {{$vendor->state}}, {{$vendor->pc}}</p>
                <p><i class="fa fa-envelope"></i> {{$vendor->email}} &nbsp; | &nbsp; <i
                        class="fa fa-phone"></i> {{$vendor->mobile}}</p>
                <p>
                    {{$openingInfo}}
                </p>
                <div class="vendor-actions">
                    <div class="icon-ratings">
                        <i class="fa fa-coffee selected"></i>
                        <i class="fa fa-coffee selected"></i>
                        <i class="fa fa-coffee selected"></i>
                        <i class="fa fa-coffee"></i>
                        <i class="fa fa-coffee"></i>
                        <span>3.0</span>
                        <a href="">Add Review</a>
                        <span>Last Update: {{$vendor->updated_at->diffForHumans()}}</span>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- VENDER MENU -->
    <section class="category">
        <div class="container">

        @forelse ($vendor->products->groupBy('category_id') as $products)
            <!-- TITLE -->
                <div class="row">
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

</x-app-layout>
