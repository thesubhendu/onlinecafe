<div>
<div wire:loading.delay.longest>
   <p class="h4">Submitting Order Please wait...</p>
</div>
<!-- CHECKOUT FORM / TABLE -->
    <section class="terms checkout-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="term-content">
                        <!-- CHECKOUT FORM -->
                        <div class="row checkout-form">
                            <!-- ORDERED LIST ITEMS -->
                            <div class="col-md-6 cart-payment orderd-items mb-5">
                                <h4 class="title">Ordered Item(s)</h4>

                                <!-- ORDERED LISTS -->
                                <div class="orderd-item-lists">

                                @foreach($cartItems as $item )
                                <!-- PRODUCT ROW -->
                                <div class="row product-row">

                                    <!-- ITEM IMAGE -->
                                    <div class="col-md-2 col-sm-3 col-xs-3">
                                        <div class="product-image">
                                            <img src="{{asset('assets/images/cappuccino.jpg')}}" class="img-responsive"
                                                alt="">
                                        </div>
                                    </div>

                                    <!-- ITEM COTENT -->
                                    <div class="col-md-7 col-sm-7 col-xs-6">
                                        <div class="product-details">
                                            <a href="">{{$item->name}}  (${{$item->model->price}})</a>

                                            <x-cart.description :item="$item" />

                                            <p class="quantity">( {{$item->qty}} )</p>
                                        </div>
                                    </div>

                                    <!-- ITEM PRICE -->
                                    <div class="col-md-3 col-sm-2 col-xs-3">
                                        <h4 class="price"> ${{$item->price}}</h4>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                            <!-- Coupon CARD -->
                            <div class="coupen-card">

                                <!-- COUPEN -->
                                <div class="coupen">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder=" Coupon Code">
                                        <a href="#" class="btn btn-primary">
                                            APPLY
                                        </a>
                                    </div>
                                </div>

                                <!-- PAYEMENT FINAL -->
                                <div class="payment-final">
                                    <div class="row cart-totals-row">
                                        <div class="col-md-6 col-xs-6">
                                            <div class="cart-totals-title">
                                                <h4>Subtotal</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6 text-right">
                                            <div class="cart-totals-result">
                                                <h4>$ {{$cartTotal['subtotal']}} </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row cart-totals-row ">
                                        <div class="col-md-6 col-xs-6">
                                            <div class="cart-totals-title">
                                                <h4>Tax</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6 text-right">
                                            <div class="cart-totals-result">
                                                <h4>
                                                    $ {{$cartTotal['tax']}}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row cart-totals-row ">
                                        <div class="col-md-6 col-xs-6">
                                            <div class="cart-totals-title">
                                                <h4><b>Total</b></h4>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6 text-right">
                                            <div class="cart-totals-result">
                                                <h4 class="final-pay"><strong>$ {{$cartTotal['total']}} </strong></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- BACK TO SHOP -->
                                <div class="back-to-shop ">
                                    <a href="{{route('vendor.show', $cartItems->first()->model->vendor_id)}}"><i class="fa fa-angle-left"></i> &nbsp; Back To
                                        Shopping</a>
                                </div>

                            </div>

                        </div>

                        <!-- CONTACT INFORMATION -->
                        <div class="col-md-6">
                            <h4 class="title">Contact Information</h4>
                            <div class="shipping-information">
                                <form wire:submit.prevent="submit" >
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder=" Your Name"
                                            wire:model.lazy="form.name">

                                        <x-input-error name='form.name' />
                                    </div>

                                    <div class="form-group">
                                        <input  type="text" class="form-control" placeholder=" Your Email"
                                            wire:model.lazy="form.email">

                                        <x-input-error name='form.email' />
                                    </div>

                                    <div class="form-group">
                                        <input  type="text" class="form-control" placeholder="Mobile"
                                            wire:model.lazy="form.mobile">

                                        <x-input-error name='form.mobile' />
                                    </div>

                                    <h4 class="mb-3 mt-4">Payment</h4>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input"  id=""
                                                 checked>
                                            <label class="form-check-label" for="credit">In Store</label>

                                        </label>

                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input"  id=""
                                                disabled>
                                            <label class="form-check-label" for="credit">Credit Card</label>

                                        </label>
                                    </div>


                                    <!-- SHIPPING BUTTON -->
                                    <div class="cart-totals-result checkout-btn">
                                        <button type="submit" class="btn btn-secondary "><i
                                                class="fa fa-credit-card"></i> &nbsp; Checkout
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


</div>
