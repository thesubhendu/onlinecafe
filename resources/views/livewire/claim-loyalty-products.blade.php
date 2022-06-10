<main role="main" class="container border-0">
    <section class="ordered-food-item vendor-menu">
        @if($claimItems->count())
            <div class="container">
                <!-- TABLE ITEMS  -->
                <div class="row hidden-xs">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="item-remove"></th>
                                    <th class="item-thumbnail">PRODUCT</th>
                                    <th class="item-name">Name</th>
                                    <th class="description">Options</th>
                                    <th class="price-box">PRICE</th>
                                    <th class="item-quantity">QUANTITY</th>
                                </tr>
                                </thead>

                                <!-- TABLE BODY -->
                                <tbody>
                                @foreach($claimItems as $key=>$item)
                                    <!-- ITEM ROW -->
                                    <tr class="item-row">
                                        <td class="item-remove ">
                                            <button type="button" wire:click="removeItem('{{$item->rowId}}')"
                                                    class="btn remove-item"><i class="fa fa-trash mb-1 text-danger"></i>
                                            </button>
                                        </td>
                                        <td class="item-thumbnail">
                                            <img src="{{asset('assets/images/cappuccino.jpg')}}" alt="">
                                        </td>
                                        <td class="item-name">{{$item->name}}</td>
                                        <td class="description">
                                            <x-cart.description :item="$item"/>
                                        </td>
                                        <td class="price-box"> ${{$item->price}} </td>
                                        <td class="item-quantity">
                                            <span>{{$item->qty}}</span>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- MOBILE CART-Items -->
                <div class="cart-items-mobile">
                @foreach($claimItems as $item)
                    <!-- MOBILE CART -->
                        <div class="mobile-cart ">
                            <!-- IMAGE  -->
                            <div class="row product-image">
                                <div class="col-xs-12">
                                    <div class="item-image">
                                        <img src="{{asset('assets/images/cappuccino.jpg')}}" class="img-responsive"
                                             alt="">
                                    </div>
                                </div>
                            </div>

                            <!-- TITLE -->
                            <div class="row product-title">
                                <div class="col-xs-12">
                                    <h4>{{$item->name}}</h4>
                                </div>
                                <div class="col-xs-9">
                                    <x-cart.description :item="$item"/>
                                </div>
                                <div class="col-xs-3 text-end">
                                    <h5>${{$item->price}} </h5>
                                </div>
                            </div>

                            <!-- PRICE -->
                            <div class="row product-price">
                                <div class="col-xs-5 qty-label">
                                    <label for="">Qunatity: {{$item->qty}}</label>
                                </div>

                                <div class="col-xs-7 text-end">
                                    <button type="button" wire:click="removeItem('{{$item->rowId}}')"
                                            class="btn remove-item"><i class="fa fa-trash mb-1 text-danger"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <a
                        href="{{route('loyalty-checkout', [$card->id])}}"
                        class="btn btn-default d-block">
                        Go to Loyalty Checkout Page
                    </a>
                </div>
            </div>
        @endif
        @if($remainingClaim)
            <br/>
            <div class="container">
                <h3>Please choose a product to claim your loyalty</h3>
                @if($remainingClaim >= 1)
                    <div class="col-md-12">
                        <div class="col alert alert-info">
                            <b>Note: You have {{$remainingClaim}} product left to claim</b>
                        </div>
                    </div>
                @endif
                @foreach ($vendor->freeCategoryProducts() as $product)
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
                                                        <a href="{{ route('orders.create', ['product'=> $product->id, 'claimCardId' => $card->id]) }}"
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
        @endif
    </section>
</main>
