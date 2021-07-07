@extends('layout.app')
@section('content')
<div  class="container py-4 mb-5">
    <div class="vendor-index mt-4">
        <div class="container">
            <div class="modal-header">
                <h5 class="modal-title text-center">Your cart</h5>
                <div>
                    <a href="/" class="btn btn-success"><i class="fas fa-backward"></i></a>
                </div>
            </div>
        </div>
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
                @foreach ($error->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {{-- cart --}}
        @if (Cart::count() > 0)
            <div class="cart-section container"> <!--new cart-->
                <div>
        
                    <h2>{{ Cart::count() }}  {{ Str::plural('item', Cart::count())}} in Shopping Cart</h2>
            
                    <div class="mt-4">
                        @foreach(Cart::content() as $item)
                        <div class="row border-bottom border-top border-secondary">
                            <div class="col d-flex justify-content-between mr-3">
                                <a href="#"><img src="{{asset('storage/img/nostamp.png')}}" alt="item"class="cart-table-img" style="max-width: 50px; max-width: 50px;"></a>
                                <div class="order-details ml-3">
                                    <div class="cart-table-item px-3 btn"><a href="">{{ $item->name }}</a></div>
                                    <div class="cart-table-description"><small class="text-muted">{{$item->options->milk}}, Sugar - {{$item->options->sugar}}, Syrup - {{$item->options->syrup}}</small></div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justifiy-content-between">
                                <div class="d-flex flex-column">
                                    <form action="{{ route('cart.remove', $item->rowId) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn"><i class="fa fa-trash mb-1 text-danger"></i></button>
                                    </form>
                                    {{-- <a class="btn text-danger"><small>Remove</small></a> <!--form in laravel--> --}}
                                    <a class="btn"><small><i class="fas fa-cart-arrow-down"></i></small></a> <!--form in laravel-->
                                </div>
                                <div class="form-group mt-3">
                                    <select class="form-control form-select" id="cartQuantity">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    </select>
                                </div>
                                <div class="col mt-3">$ {{ $item->price }}</div>
                            </div>
                        </div> <!-- end cart-table-row -->
                        @endforeach
                    </div> <!-- end cart-table -->
                        <a href="#" class="have-code text-secondary px-2"><small>Have a Code?</small></a>
                        <div class="input-group mb-3" style="max-width: 100%;">
                            <input type="text" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Apply</button>
                            </div>
                        </div>
                        </div> <!-- end have-code-container -->
                    <div class="row cart-totals bg-light">
                        <div class="col cart-totals-left alert alert-danger">
                            Please note that payment will be required on collection from "(vendor name goes here)"
                        </div>
            
                        <div class="col cart-totals-right align-items-start">
                            <div>
                                Subtotal <?php echo Cart::subtotal(); ?><br>
                                Tax <?php echo Cart::tax(); ?><br>
                                <span class="cart-totals-total">Total <?php echo Cart::total(); ?></span>
                                <br>
                            </div>
                        </div>
                    </div> <!-- end cart-totals -->
                    <hr>
                    <div class="cart-buttons d-flex justify-content-between">
                        @foreach(Cart::content() as $vendor)
                        <a href="{{route('vendor.products', $vendor->model->vendor_id )}}" class="btn btn-outline-success">Continue Shopping</a>
                        @endforeach
                        <a href="{{route('checkout.index')}}" class="btn btn-success">Proceed to Checkout</a>
                    </div>
                </div>
        @else
            <h3> Your Cart is Empty </h3>
            <div class="cart-buttons d-flex justify-content-between">
                <a href="/" class="btn btn-outline-success">Continue Shopping</a>
            </div>
        @endif 
        </div><!--end of new cart-->           
            {{-- Save for later --}}
            @if (Cart::instance('saveForLater')->count() > 0)
            <div class=container>
                <div class="row">
                    <h3 class="mt-4">Saved for later</h3>
                    @foreach(Cart::instance('saveForLater')->content() as $item)
                    <div class="d-flex saveForLater mx-auto mb-5">
                            <div class="card mt-4" style="width: 5rem;">
                                <div class="mr-1">
                                    <img src="{{asset('storage/img/nostamp.png')}}" class="" alt="product" width="70" height="70">
                                </div>
                                {{-- <img src="{{asset('storage/img/nostamp.png')}}" class="card-img-top" alt="product" width="70"> --}}
                                <div class="card-body">
                                <h5 class="card-title">{{$item->name}}</h5>
                                <p class="card-text">${{$item->price}}</p>
                            </div>
                            <div class="d-flex">
                                <form action="{{ route('saveforlaer.addtocart', $item->rowId) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-default"><i class="fas fa-cart-plus"></i></button>
                                </form>
                                <form action="{{ route('saveforlater.remove', $item->rowId) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-default"><i class="fa fa-trash mb-1 text-danger"></i></button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
            @else
            
            @endif     
        </div>    
    </div> {{--end vendor class --}}
</div>{{-- end of contatiner--}}
@endsection
