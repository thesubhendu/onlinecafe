@extends('layout.app')
@section('content')
<div  class="container py-4 mb-5">
    <div class="vendor-index mt-4">
        <div class="container" style="border: none;">
            <div class="modal-header" style="border: none;">
                <h3 class="modal-title" id="titleLabel">New Order</h3>
                <a href="/" class="btn btn-success"><i class="fas fa-backward"></i></a>
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
        {{-- order --}}
    <div class="container">
        <div class="card mb-3" style="max-width: 100%; border: none;">
            @foreach($order_product as $product)
            <div class="row g-0">
                <div class="col-sm-12">
                    <form action="{{ route('cart.store', $product->rowId) }}" method="post"> {{--{{ route('cart.store', $item->rowId) }}--}}
                        @csrf
                {{-- <div class="card-body d-flex p-2 justify-content-between align-content-center"> --}}
                            <div class="form-group card-body d-flex p-2 justify-content-between align-items-center">
                                <img src="{{asset('storage/img/nostamp.png')}}" alt="product" width="100px" height="100px">
                                <h5 class="card-title">{{$product->productName}}</h5>
                                <p class="card-text"> ${{$product->productPrice}}</p>
                                <label class="sr-only" for="quantity">Quantity</label>
                                <select class="form-control form-select" id="quantity" name="quantity" required style="max-width:30%;">
                                    <option selected>how many...</option>
                                    <option {{ old('quantity') == "1" ? 'selected' : ''}} value="1">1</option>
                                    <option {{ old('quantity') == "2" ? 'selected' : ''}} value="2">2</option>
                                    <option {{ old('quantity') == "3" ? 'selected' : ''}} value="3">3</option>
                                    <option {{ old('quantity') == "4" ? 'selected' : ''}} value="4">4</option>
                                    <option {{ old('quantity') == "5" ? 'selected' : ''}} value="5">5</option>
                                    <option {{ old('quantity') == "6" ? 'selected' : ''}} value="6">6</option>
                                    <option {{ old('quantity') == "7" ? 'selected' : ''}} value="7">7</option>
                                    <option {{ old('quantity') == "8" ? 'selected' : ''}} value="8">8</option>
                                    <option {{ old('quantity') == "9" ? 'selected' : ''}} value="9">9</option>
                                    <option {{ old('quantity') == "10" ? 'selected' : ''}} value="10">10</option>
                                </select>
                                {{-- <input type="submit" value="Submit"> --}}
                                <div class="invalid-feedback">
                                we need to know how many you would like
                                </div>

                            </div>
                            <div class="card mt-4 mb-4">
                                <h6 class="card-header mt-2">options</h6>
                                <div class="form-group card-body">
                                {{-- @dd($item); --}}
                                <select class="form-control mt-2" id="milk" name="milk" required>
                                    <option selected>which milk...</option>
                                    <option value="Full Cream"{{ old('milk') == "Full Cream" ? 'selected' : ''}}>Full Cream</option>
                                    <option value="Skim"{{ old('milk') == "Skim" ? 'selected' : ''}}>Skim</option>
                                    <option value="Soy"{{ old('milk') == "Soy" ? 'selected' : ''}}>Soy</option>
                                    <option value="Zymil"{{ old('milk') == "Zymil" ? 'selected' : ''}}>Zymil</option>
                                    <option value="Almond"{{ old('milk') == "Almond" ? 'selected' : ''}}>Almond</option>
                                </select>
                                <div class="invalid-feedback">
                                we need to know which milk
                                </div>
                                <select class="form-control mt-2" id="sugar" name="sugar" required>
                                    <option selected>how many sugars...</option>
                                    <option {{ old('sugar') == "None" ? 'selected' : ''}} value="0">None</option>
                                    <option {{ old('sugar') == "1" ? 'selected' : ''}} value="1">1</option>
                                    <option {{ old('sugar') == "2" ? 'selected' : ''}} value="2">2</option>
                                    <option {{ old('sugar') == "3" ? 'selected' : ''}} value="3">3</option>
                                    <option {{ old('sugar') == "4" ? 'selected' : ''}} value="4">4</option>
                                    <option {{ old('sugar') == "5" ? 'selected' : ''}} value="5">5</option>
                                </select>
                                <div class="invalid-feedback">
                                we need to know how many sugars you'd like
                                </div>
                                <select class="form-control mt-2" id="syrup" name="syrup" required>
                                    <option selected>Syrup...</option>
                                    <option {{ old('syrup') == "No Thanks" ? 'selected' : ''}} value="No Thanks">No Thanks</option>
                                    <option {{ old('syrup') == "Caramel" ? 'selected' : ''}} value="Caramel">Caramel</option>
                                    <option {{ old('syrup') == "Vanilla" ? 'selected' : ''}} value="Vanilla">Vanilla</option>
                                    <option {{ old('syrup') == "Hazelnut" ? 'selected' : ''}} value="Hazelnut">Hazelnut</option>
                                </select>
                                <div class="invalid-feedback">
                                we need to know if you would like syrup
                                </div>
                                </div>
                                    {{-- <div class="form-group"> --}}
                                        <input type="hidden" name="id" value="{{$product->id}}">
                                        <input type="hidden" name="name" value="{{$product->productName}}">
                                        <input type="hidden" name="price" value="{{$product->productPrice}}">
                                        <input type="hidden" name="vendor" value="{{$product->vendor_id}}">
                                        {{-- <input type="hidden" name="quantity" value="{{app('request')->input('quantity')}}">
                                        <input type="hidden" name="milk" value="{{app('request')->input('milk')}}">
                                        <input type="hidden" name="sugar" value="{{app('request')->input('sugar')}}">
                                        <input type="hidden" name="syrup" value="{{app('request')->input('syrup')}}"> --}}
                                    {{-- </div> --}}
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-trash mb-1 text-danger"></i></button>
                                        <button type="submit" class="btn btn-default"><i class="fas fa-cart-arrow-down text-info"></i></button>
                                    </div>
                                    <button id="addOrderbtn" type="submit" value="submit" class="w-100 btn btn-success d-block">
                                        add to cart</button>
                                </form>
                                <div class="d-flex justify-content-between cart-actions ml-2">
                                    {{-- <form action="#" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-default"><i class="fa fa-trash mb-1 text-danger"></i></button>
                                    </form>
                                    <form action="#" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-default"><i class="fas fa-cart-arrow-down text-info"></i></button>
                                    </form> --}}
                                    
                                </div>
                            </div>
                        {{-- </div> --}}
                </div>
            </div>
            <div class="col-sm-12 d-flex p-2 justify-content-between align-items-center">
                {{-- <form action="{{ route('cart.store', $product->rowId) }}" method="post"> 
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <input type="hidden" name="name" value="{{$product->productName}}">
                        <input type="hidden" name="price" value="{{$product->productPrice}}"> 
                        <input type="hidden" name="vendor" value="{{$product->vendor_id}}">
                        <input type="hidden" name="quantity" value="{{app('request')->input('quantity')}}">
                        <input type="hidden" name="milk" value="{{app('request')->input('milk')}}">
                        <input type="hidden" name="sugar" value="{{app('request')->input('sugar')}}">
                        <input type="hidden" name="syrup" value="{{app('request')->input('syrup')}}">
                    </div>
                    <button id="addOrderbtn" type="submit" class="w-100 btn btn-success d-block">
                        add to cart</button>
                </form> --}}
            </div>
            @endforeach
        </div>
                        {{-- Save for later --}}
                        {{-- <div class=container>
                            <div class="row">
                                <h3 class="mt-4">Saved for later</h3>
                                <div class="d-flex saveForLater mx-auto mb-5">
                                        <div class="card mt-4" style="width: 5rem;">
                                            <div class="mr-1">
                                                <img src="{{asset('storage/img/nostamp.png')}}" class="" alt="product" width="70" height="70">
                                            </div> --}}
                                            {{-- <img src="{{asset('storage/img/nostamp.png')}}" class="card-img-top" alt="product" width="70"> --}}
                                            {{-- <div class="card-body">
                                            <h5 class="card-title">Latte</h5>
                                            <p class="card-text">$3.50</p>
                                        </div>
                                        <div class="d-flex">
                                            <form action="#" method="post"> {{ route('saveforlater.addtocart', $item->rowId) }} --}}
                                                {{-- @csrf
                                                <button type="submit" class="btn btn-default"><i class="fas fa-cart-plus"></i></button>
                                            </form>
                                            <form action="#" method="post"> {{ route('saveforlater.remove', $item->rowId) }} --}}
                                                {{-- @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-default"><i class="fa fa-trash mb-1 text-danger"></i></button>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div> --}}
                            {{-- @else
                            <h3> No items saved for later </h3>
                            @endif      --}}
                 {{-- </div>     --}}
     {{--end vendor class --}}
</div>{{-- end of contatiner--}}
@endsection
