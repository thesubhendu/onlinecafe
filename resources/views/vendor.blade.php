<x-app-layout>

    <!-- VENDOR BANNER -->
    <section class="banner-inner">
        <div class="container">
            <!-- VENDER DETAILS -->
            <div class="row text-center banner-content">
                <h2>{{$vendor->name}}


                </h2>
                <p><i class="fa fa-map-marker"></i> {{$vendor->address}}, {{$vendor->suburb}}
                    , {{$vendor->state}}, {{$vendor->pc}}</p>

                <p>
                    {{$openingInfo}}
                </p>
                <div class="vendor-actions">
                    <div class="icon-ratings">
                        <div class="row">
                            <div class="col">
                                <div class="shop-rating">
                                    <div class="xs-block">
                                        @can('make-order')
                                            <livewire:rating-star :vendor="$vendor"/>
                                        @endcan

                                        @cannot('make-order')
                                                @for($i=0; $i < round($vendor->rating()); $i++)
                                                    <i class="fa fa-coffee selected"></i>
                                                @endfor
                                                @for($i=0; $i< 5 - round($vendor->rating()); $i++)
                                                    <i class="fa fa-coffee"></i>
                                                @endfor
                                                <span><b>{{$vendor->rating()}}</b></span>

                                            @endcannot
                                    </div>
                                    <div class="xs-block last-update">Last
                                        Update: {{$vendor->updated_at->diffForHumans()}}
                                    </div>
                                </div>
                                @can('make-order')
                                    <span title="Like cafe" >
                                             <livewire:vendor-like-button :vendor="$vendor" />
                                    </span>
                                @endcan
                            </div>

                            @can('make-order')
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
                            @endcan

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
                        <x-menu-card :product="$product"></x-menu-card>
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
                    @foreach ($products as $product)
                        <div class="col-md-6">
                        <x-menu-card :product="$product"></x-menu-card>
                        </div>
                    @endforeach
                </div>

            @empty
                <h2>No Products</h2>
            @endforelse


        </div>

    </section>

    <x-footer></x-footer>

</x-app-layout>

    <script>
        Livewire.on('ratingSet', id => {
            var myModal = new bootstrap.Modal(document.getElementById('rating-form-modal'), {
                keyboard: false
            })
            myModal.toggle()
        })
    </script>
