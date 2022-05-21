<x-app-layout>
    <main role="main" class="container border-0">
        <div class="mx-auto">
            <section class="vendor-menu">
                <div class="container">
                    <h3>Please add a product to claim your loyalty</h3>
                    @foreach ($vendorProducts as $product)
                        <div class="row  mt-4 ">
                            <div class="item">
                                <!-- MENU CARD -->
                                <div class="vendor-product-item">
                                    <div class="content">
                                        <div class="product-image">
                                            @if($product->product_image)
                                                <img src="{{asset("storage/".$product->product_image)}}"
                                                     class="img-responsive" alt="">
                                            @else
                                                <img src="{{asset('assets/images/cafe-2.jpeg')}}" class="img-responsive"
                                                     alt="">
                                            @endif
                                        </div>
                                        <div class="details">
                                            <h5>{{$product->name}}</h5>
                                            <div class="price-and-add">
                                                <p>{{$product->description}}</p>
                                                <div class="row menu-card-footer">
                                                    <div class="col-12">
                                                        <div class="add">
                                                            <a href="{{ route('orders.create', ['product'=> $product->id, 'claim_loyalty_card'=> $card->id]) }}"
                                                               class="shop-btn"> Add &nbsp;
                                                                <i class="fa fa-coffee"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </main>
</x-app-layout>
