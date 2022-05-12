<div>
<div wire:loading.delay.longest>
   <p class="h4">Submitting Order Please wait...</p>
</div>

    <section class="ordered-food-item ">
        <div class="container">
            <!-- TABLE ITEMS  -->
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $itemCount }} {{ Str::plural('item', $itemCount)}} in Shopping Cart</h2>
                    @if($deal)
                        <span>({{$deal->title}})</span>
                    @endif

                    <div class="table-responsive">
                        <!-- TABLE -->
                        <table class="table">
                            <!-- TABLE HEAD -->
                            <thead>
                            <tr>
                                <th class="item-remove"></th>
                                <th class="item-thumbnail">PRODUCT</th>
                                <th class="item-name"></th>
                                <th class="description"></th>
                                <th class="price-box">PRICE</th>
                                <th class="item-quantity">QUANTITY</th>
                            </tr>
                            </thead>

                            <!-- TABLE BODY -->
                            <tbody>
                            @foreach($items as $key=>$item)

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
                                        @if($deal || $item->price == 0 )
                                            <span>{{$item->qty}}</span>
                                        @else
                                            <div class="control-btn ">
                                                <x-cart.update-quantity :item="$item"
                                                                        :options="$qtyOptions"></x-cart.update-quantity>
                                            </div>
                                        @endif


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
            @foreach($items as $item)
                <!-- MOBILE CART -->
                    <div class="mobile-cart ">
                        <!-- IMAGE  -->
                        <div class="row product-image">
                            <div class="col-xs-12">
                                <div class="item-image">
                                    <img src="{{asset('assets/images/cappuccino.jpg')}}" class="img-responsive" alt="">
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
                            <div class="col-xs-2 qty-label">
                                <label for="">QTY</label>
                            </div>

                            <div class="col-xs-7 no-gutters">
                                @if($deal)
                                    <span>{{$item->qty}}</span>
                                @else
                                    <x-cart.update-quantity :item="$item" :options="$qtyOptions"></x-cart.update-quantity>

{{--                                    <!-- Quantity Control -->--}}
{{--                                    <div class="control-btn ">--}}
{{--                                        <button type="button" class="value-button decrease" value="Decrease Value">-</button>--}}
{{--                                        <input type="number" id="number" value="1" />--}}
{{--                                        <button type="button" class="value-button increase" value="Increase Value">+</button>--}}
{{--                                    </div>   --}}
                                @endif
                            </div>
                            <div class="col-xs-3 text-end">
                                <button type="button" wire:click="removeItem('{{$item->rowId}}')"
                                        class="btn remove-item"><i class="fa fa-trash mb-1 text-danger"></i></button>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        @if($items->first())

            <!-- CART TOTAL -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="col cart-totals-left alert alert-danger">
                            Please note that payment will be required on collection from {{$items->first()->model->vendor->name}}
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="coupen">
                            <h4>DO YOU HAVE A PROMO CODE ?</h4>
                            <form action="">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder=" Promo Code">
                                    <a href="#" class="btn btn-primary">
                                        APPLY PROMO
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="payment-final">
                            <div class="row cart-totals-row">
                                <div class="col-md-12">
                                    <div class="cart-totals-title">
                                        <h3>CART TOTALS</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row cart-totals-row">
                                <div class="col-md-6">
                                    <div class="cart-totals-title">
                                        <h4>Subtotal</h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cart-totals-result">
                                        <h4>${{$subtotal}}</h4>
                                    </div>
                                </div>
                            </div>


                            <div class="row cart-totals-row">
                                <div class="col-md-6">
                                    <div class="cart-totals-title">
                                        <h4>Tax</h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cart-totals-result">
                                        <h4 class="final-pay">${{$tax}}</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="row cart-totals-row">
                                <div class="col-md-6">
                                    <div class="cart-totals-title">
                                        <h4>Total</h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cart-totals-result">
                                        <h4 class="final-pay">${{$total}}</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="row ">

                                <div class="col-md-12">
                                    <div class="cart-totals-result">

                                        <a wire:click="submit({{$loyaltyCardId}})" class="btn btn-secondary mt-25">
                                            CHECKOUT
                                        </a>
                                        <a
                                            href="{{route('vendor.show', $items->first()->model->vendor_id)}}"
                                            class="btn btn-default d-block">
                                            Back to Shopping
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </section>

</div>
