<x-app-layout>
    <div class="container py-4 mb-5">

        <div class="mt-2">
            @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
            @endif
        </div>
        @if(count($errors) > 0)
        <div id="cart_error" class="d-none alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <main role="main" class="container py-4 mb-5 mt-4">
            <div class="vendor-index mt-4">
                <h1>Checkout</h1>
                <form action="{{route('order.store')}}" method="post">
                    @csrf
                    <label for="name"><i class="fa fa-user"></i>Name</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="John M. Doe" value="{{ $user->name}}">
                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                    <input class="form-control" type="text" id="email" name="email" placeholder="john@example.com" value="{{ $user->email}}">
                    <label for="mobile"><i class="fas fa-mobile-alt"></i> Mobile</label>
                    <input class="form-control" type="text" id="Mobile" name="mobile" placeholder="0412345678" value="{{ $user->mobile}}">
                <h4 class="mb-3">Payment</h4>
                    <div class="form-check">
                    <input id="inStore" name="paymentMethod" type="radio" class="form-check-input" checked required>
                    <label class="form-check-label" for="inStore">In Store</label>
                    </div>
                    <div class="form-check">
                    <input id="credit" name="paymentMethod" type="radio" class="form-check-input" disabled>
                    <label class="form-check-label" for="credit">Credit Card</label>
                    </div>
                <hr>
                {{-- <div class="row gy-3"> --}}
                    {{-- <div class="col-md-3 my-3">
                    <label for="cc-name" class="form-label">Name on card</label>
                    <input type="text" class="form-control" id="cc-name" placeholder="" required>
                    <small class="text-muted">Full name as displayed on card</small>
                    <div class="invalid-feedback">
                        Name on card is required
                    </div>
                    </div>

                    <div class="col-md-3">
                    <label for="cc-number" class="form-label">Credit card number</label>
                    <input type="text" class="form-control" id="cc-number" placeholder="" required>
                    <div class="invalid-feedback">
                        Credit card number is required
                    </div>
                    </div>

                    <div class="col-md-3">
                    <label for="cc-expiration" class="form-label">Expiration</label>
                    <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                    <div class="invalid-feedback">
                        Expiration date required
                    </div>
                    </div>

                    <div class="col-md-3">
                    <label for="cc-cvv" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                    <div class="invalid-feedback">
                        Security code required
                    </div>
                    </div> --}}
                {{-- </div> --}}
                <div class="cart-row mt-3">
                    <div class="col-75">
                        <div class="">
                            <h4 class="mt-2">Cart
                                <span class="price" style="color:grey">
                                    <i class="fa fa-shopping-cart"></i>
                                    <b>{{ Cart::count() }}</b>
                                </span>
                            </h4>
                            @foreach($cartItems as $item )
                            <div class="row">
                                <div class="col d-flex justify-content-between align-items-center align-middle">
                                    <a href="#"><img src="{{asset('storage/img/nostamp.png')}}" alt="item"class="cart-table-img" style="max-width: 30%; max-width: 30%;"></a>
                                    <div class="col btn flex-fill">
                                        <a href="">{{$item->name}} </a><span><small class="text-mute">{{$item->options->milk}}, sugar - {{$item->options->sugar}}, Syrup - {{$item->options->syrup}}</small></span>
                                    </div>
                                    <div class="col">
                                        <span class="price">${{$item->price}}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <hr>
                            <p>Subtotal <span class="price" style="color:black"><b>${{Cart::subtotal()}}</b></span></p>
                            <p>Tax <span class="price" style="color:black"><b>${{Cart::tax()}}</b></span></p>
                            <p>Total <span class="price" style="color:black"><b>${{Cart::total()}}</b></span></p>

                            <input type="hidden" id="vendor" name="vendor" value="{{ $item->model->vendor_id}}">
                            <input type="hidden" id="milk" name="milk" value="{{ $item->options->milk}}">
                            <input type="hidden" id="sugar" name="sugar" value="{{ $item->options->sugar}}">
                            <input type="hidden" id="syrup" name="syrup" value="{{ $item->options->syrup}}">
                            <button type="submit" class="w-100 btn btn-success btn-lg"><i class="fas fa-credit-card"></i> Checkout</button>
                            {{-- <button class="btn btn-primary" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                submitting...
                            </button> --}}
                        </div>
                    </div>
                </div>
                </form>
            </div>
    </div>
    </main><!-- /.container -->
</x-app-layout>
