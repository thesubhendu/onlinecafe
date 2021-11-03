<x-app-layout>
    <!-- CHECKOUT FORM / TABLE -->
    <section class="terms checkout-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="term-content">
                        <!-- CHECKOUT FORM -->
                        <div class="row checkout-form">
                            <!-- ORDERED LIST ITEMS -->
                            <div class="col-md-6 cart-payment orderd-items">
                                <h4 class="title">Ordered Items</h4>

                                <!-- ORDERED LISTS -->
                                <div class="orderd-item-lists">

                                @foreach($cartItems as $item )
                                    <!-- PRODUCT ROW -->
                                        <div class="row product-row">

                                            <!-- ITEM IMAGE -->
                                            <div class="col-md-2 col-sm-3 col-xs-3">
                                                <div class="product-image">
                                                    <img src="{{asset('assets/images/cappuccino.jpg')}}"
                                                         class="img-responsive" alt="">
                                                </div>
                                            </div>

                                            <!-- ITEM COTENT -->
                                            <div class="col-md-7 col-sm-7 col-xs-6">
                                                <div class="product-details">
                                                    <a href="">{{$item->name}} </a><span><small class="text-mute">{{$item->options->milk}}, sugar - {{$item->options->sugar}}, Syrup - {{$item->options->syrup}}</small></span>

                                                    <p class="quantity">{{$item->qty}}</p>
                                                </div>
                                            </div>

                                            <!-- ITEM PRICE -->
                                            <div class="col-md-3 col-sm-2 col-xs-3">
                                                <p class="price"> ${{$item->price}}</p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                <!-- Coupon CARD -->
                                <div class="coupen-card">

                                    <!-- COUPEN -->
                                    <div class="coupen">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder=" Coupen Code">
                                            <a href="#" class="btn btn-primary">
                                                APPLY
                                            </a>
                                        </div>
                                    </div>

                                    <!-- PAYEMENT FINAL -->
                                    <div class="payment-final">
                                        <div class="row cart-totals-row">
                                            <div class="col-md-6">
                                                <div class="cart-totals-title">
                                                    <h4>Subtotal</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <div class="cart-totals-result">
                                                    <h4>$ {{Cart::subtotal()}} </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row cart-totals-row ">
                                            <div class="col-md-6">
                                                <div class="cart-totals-title">
                                                    <h4>Tax</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <div class="cart-totals-result">
                                                    <h4>
                                                        $ {{Cart::tax()}}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row cart-totals-row ">
                                            <div class="col-md-6">
                                                <div class="cart-totals-title">
                                                    <h4>Total</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <div class="cart-totals-result">
                                                    <h4 class="final-pay"><strong>$ {{Cart::total()}} </strong></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- BACK TO SHOP -->
                                    <div class="back-to-shop ">
                                        <a href="{{route('home')}}"><i class="fa fa-angle-left"></i> &nbsp; Back To
                                            Shopping</a>
                                    </div>

                                </div>

                            </div>

                            <!-- CONTACT INFORMATION -->
                            <div class="col-md-6">
                                <h4 class="title">Contact Information</h4>
                                <div class="shipping-information">
                                    <form action="{{route('order.store')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input name="name" type="text" class="form-control" placeholder=" Your Name"
                                                   value="{{$user->name}}">
                                        </div>

                                        <div class="form-group">
                                            <input name="email" type="text" class="form-control"
                                                   placeholder=" Your Email" value="{{$user->email}}">
                                        </div>

                                        <div class="form-group">
                                            <input name="mobile" type="text" class="form-control" placeholder="Mobile"
                                                   value="{{$user->mobile}}">
                                        </div>

                                        <h4 class="mb-3">Payment</h4>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="paymentMethod" id=""
                                                       value="card" checked>
                                                <label class="form-check-label" for="credit">In Store</label>

                                            </label>

                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="paymentMethod" id=""
                                                       value="card" disabled>
                                                <label class="form-check-label" for="credit">Credit Card</label>

                                            </label>
                                        </div>

                                        <input type="hidden" id="vendor" name="vendor"
                                               value="{{ $item->model->vendor_id}}">
                                        <input type="hidden" id="milk" name="milk" value="{{ $item->options->milk}}">
                                        <input type="hidden" id="sugar" name="sugar" value="{{ $item->options->sugar}}">
                                        <input type="hidden" id="syrup" name="syrup" value="{{ $item->options->syrup}}">


                                        <!-- SHIPPING BUTTON -->
                                        <div class="cart-totals-result checkout-btn">
                                            <button type="submit" class="btn btn-secondary "><i
                                                    class="fas fa-credit-card"></i> Checkout
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
</x-app-layout>
