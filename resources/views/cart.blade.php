<x-app-layout>
    <!-- ORDERED ITEMS TABLE -->
    <section class="ordered-food-item ">
        <div class="container">
            <!-- TABLE ITEMS  -->
            <div class="row hidden-xs">
                <div class="col-md-12">
                    <h2>{{ Cart::count() }} {{ Str::plural('item', Cart::count())}} in Shopping Cart</h2>

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
                                    {{-- <th class="item-subtotal">TOTAL </th>--}}

                                </tr>
                            </thead>

                            <!-- TABLE BODY -->
                            <tbody>
                                @foreach(Cart::content() as $item)

                                <!-- ITEM ROW -->
                                <tr class="item-row">
                                    <td class="item-remove ">
                                        <form action="{{ route('cart.remove', $item->rowId) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn remove-item"><i class="fa fa-trash mb-1 text-danger"></i></button>
                                        </form>
                                    </td>
                                    <td class="item-thumbnail">
                                        <img src="{{asset('assets/images/cappuccino.jpg')}}" alt="">
                                    </td>
                                    <td class="item-name">{{$item->name}}</td>
                                    <td class="description">
                                        {{$item->options->milk}}, Sugar - {{$item->options->sugar}}, Syrup
                                        - {{$item->options->syrup}}
                                    </td>
                                    <td class="price-box"> ${{$item->price}} </td>
                                    <td class="item-quantity">
                                        <div class="control-btn ">
                                            <select class="form-control form-select" id="cartQuantity">

                                                @foreach([1,2,3,'4',5] as $qty)
                                                <option value="{{$qty}}" {{$qty == $item->qty ? 'selected' : ''}}>{{$qty}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </td>
                                    {{-- <td class="item-subtotal">$5.0</td>--}}
                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>

            <div class="cart-items-mobile">

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
                            <h4>Cappuccino</h4>
                        </div>
                        <div class="col-xs-9">
                            <p>Cream, Sugar - , Syrup</p>
                        </div>
                        <div class="col-xs-3">
                            <h5>$30</h5>
                        </div>
                    </div>

                    <!-- PRICE -->
                    <div class="row product-price">
                        <div class="col-xs-2 ">
                            <label for="">QTY</label>
                        </div>
                        <div class="col-xs-4 no-gutters">
                            <select name="quantity" id="" class="form-select">
                                <option>1</option>
                            </select>
                        </div>
                        <div class="col-xs-6 text-end">
                            <button type="submit" class="btn remove-item">
                                <i class="fa fa-pencil mb-1 text-danger"></i>
                            </button>
                            <button type="submit" class="btn remove-item">
                                <i class="fa fa-trash mb-1 text-danger"></i>
                            </button>
                        </div>
                    </div>
                </div>

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
                            <h4>Cappuccino</h4>
                        </div>
                        <div class="col-xs-9">
                            <p>Cream, Sugar - , Syrup</p>
                        </div>
                        <div class="col-xs-3">
                            <h5>$30</h5>
                        </div>
                    </div>

                    <!-- PRICE -->
                    <div class="row product-price">
                        <div class="col-xs-2 ">
                            <label for="">QTY</label>
                        </div>
                        <div class="col-xs-4 no-gutters">
                            <select name="quantity" id="" class="form-select">
                                <option>1</option>
                            </select>
                        </div>
                        <div class="col-xs-6 text-end">
                            <button type="submit" class="btn remove-item">
                                <i class="fa fa-pencil mb-1 text-danger"></i>
                            </button>
                            <button type="submit" class="btn remove-item">
                                <i class="fa fa-trash mb-1 text-danger"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CART TOTAL -->
            <div class="row">
                <div class="col-md-4">
                    <div class="col cart-totals-left alert alert-danger">
                        Please note that payment will be required on collection from "(vendor name goes here)"
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
                                    <h4>${{Cart::subtotal()}}</h4>
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
                                    <h4 class="final-pay">${{Cart::tax()}}</h4>
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
                                    <h4 class="final-pay">${{Cart::total()}}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row ">

                            <div class="col-md-12">
                                <div class="cart-totals-result">

                                    <a href="{{route('checkout.index')}}" class="btn btn-secondary mt-25">
                                        CHECKOUT
                                    </a>
                                    <a href="{{route('home')}}" class="btn btn-default d-block">
                                        Back to Shopping
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</x-app-layout>