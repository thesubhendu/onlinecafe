@extends('layout.app')
@section('content')
<div  class="container py-4 mb-5">
    <div class="vendor-index mt-4">

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
        <form action="{{route('order.store')}}" method="post">
          <div class="vendor-index mt-4">
                <h1>Checkout</h1>
                    @csrf
                    <label for="fname"><i class="fa fa-user"></i></label>
                    <input type="text" id="fname" name="name" placeholder="John M. Doe" value="{{ $user->name}}">
                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                    <input type="text" id="email" name="email" placeholder="john@example.com" value="{{ $user->email}}">
                    <label for="email"><i class="fas fa-mobile-alt"></i> Mobile</label>
                    <input type="text" id="Mobile" name="mobile" placeholder="0412345678" value="{{ $user->mobile}}">
                    <div class="cart-row">
                        <div class="col-75">
                            <div class="container">
                                <h4 class="mt-2">Cart
                                    <span class="price" style="color:black">
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
                                <button type="submit" class="btn btn-success"><i class="fas fa-credit-card"></i> Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main><!-- /.container -->
@endsection