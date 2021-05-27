@extends('layout.app')
@section('content')
<div  class="container py-4 mb-5">
    <div class="vendor-index mt-4">
        <div class="container">
            <div class="modal-header">
                <img src="{{asset('storage/img/nostamp.png')}}" width="30" height="30" class="d-inline-block align-top float-left" alt="logo">
                <h5 class="modal-title" id="titleLabel">Order</h5>
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
        {{-- order --}}
    <div class="container">
     <div class="row">
        <h3>New Order<h3>
             <div class="card mb-3">
                 @foreach($order_product as $product)
                 <div class="col-md-2 d-flex justify-content-between align-content-center mx-auto">
                     <div class="row">
                         <div class="mr-1 col">
                             <img src="{{asset('storage/img/nostamp.png')}}" alt="product" width="70">
                         </div>
                         <div class="card-body d-flex justify-content-between align-items-center product-details col mr-3">
                             <h5 class="card-title">{{$product->productName}}</h5>
                             <p class="card-text ml-4"> ${{$product->productPrice}}</p>
                         </div>
                     </div>
                     <div class="options mt-2 ml-4 mx-auto">
                         {{-- @dd($item); --}}
                         <select class="form-control" id="orderQuanitity" name="orderQuanitity" required>
                             <option selected>how many...</option>
                             <option value="1"{{ old('orderQuanitity') == "1" ? 'selected' : ''}}>1</option>
                             <option value="2"{{ old('orderQuanitity') == "2" ? 'selected' : ''}}>2</option>
                             <option value="3"{{ old('orderQuanitity') == "3" ? 'selected' : ''}}>3</option>
                             <option value="4"{{ old('orderQuanitity') == "4" ? 'selected' : ''}}>4</option>
                             <option value="5"{{ old('orderQuanitity') == "5" ? 'selected' : ''}}>5</option>
                             <option value="6"{{ old('orderQuanitity') == "6" ? 'selected' : ''}}>6</option>
                             <option value="7"{{ old('orderQuanitity') == "7" ? 'selected' : ''}}>7</option>
                             <option value="8"{{ old('orderQuanitity') == "8" ? 'selected' : ''}}>8</option>
                             <option value="9"{{ old('orderQuanitity') == "9" ? 'selected' : ''}}>9</option>
                             <option value="10"{{ old('orderQuanitity') == "10" ? 'selected' : ''}}>10</option>
                         </select>
                         <div class="invalid-feedback">
                         we need to know how many you would like
                         </div>
                         <select class="form-control mt-2" id="orderMilk" name="ordermilk" required>
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
                         <select class="form-control mt-2" id="orderSugars" name="ordersugar" required>
                             <option selected>how many sugars...</option>
                             <option value="None"{{ old('sugar') == "None" ? 'selected' : ''}}>None</option>
                             <option value="1"{{ old('sugar') == "1" ? 'selected' : ''}}>1</option>
                             <option value="2"{{ old('sugar') == "2" ? 'selected' : ''}}>2</option>
                             <option value="3"{{ old('sugar') == "3" ? 'selected' : ''}}>3</option>
                             <option value="4"{{ old('sugar') == "4" ? 'selected' : ''}}>4</option>
                             <option value="5"{{ old('sugar') == "5" ? 'selected' : ''}}>5</option>
                         </select>
                         <div class="invalid-feedback">
                         we need to know how many sugars you'd like
                         </div>
                         <select class="form-control mt-2" id="orderSyrup" name="ordersyrup" required>
                             <option selected>Syrup...</option>
                             <option value="No Thanks"{{ old('syrup') == "NO Thanks" ? 'selected' : ''}}>No Thanks</option>
                             <option value="Caramel"{{ old('syrup') == "Caramel" ? 'selected' : ''}}>Caramel</option>
                             <option value="Vanilla"{{ old('syrup') == "Vanilla" ? 'selected' : ''}}>Vanilla</option>
                             <option value="Hazelnut"{{ old('syrup') == "Hazelnut" ? 'selected' : ''}}>Hazelnut</option>
                         </select>
                         <div class="invalid-feedback">
                         we need to know if you would like syrup
                         </div>
                         <div class="d-flex justify-content-between cart-actions ml-2">
                            <form action="#" method="post"> {{--{{ route('cart.remove', $item->rowId) }}--}}
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-default"><i class="fa fa-trash mb-1 text-danger"></i></button>
                            </form>
                            <form action="#" method="post"> {{--{{ route('cart.saveForLater', $item->rowId) }}--}}
                                @csrf
                                <button type="submit" class="btn btn-default"><i class="fas fa-cart-arrow-down text-info"></i></button>
                            </form>
                            
                        </div>
                     </div>
                 </div>
                 @endforeach
                 <div class="col-md-10">
                    <form action="{{ route('cart.store') }}" method="post"> {{--{{ route('cart.store', $item->rowId) }}--}}
                        @csrf
                        <div class="form-group mt-2 ml-4 mr-4">
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <input type="hidden" name="name" value="{{$product->name}}">
                            <input type="hidden" name="price" value="{{$product->price}}"> {{--move to session for production--}}
                            <input type="hidden" name="vendor" value="{{$product->vendor_id}}">
                            {{-- <input type="hidden" name="quanitity" value="{{app('request')->input('orderQuanitity')}}">
                            <input type="hidden" name="milk" value="{{app('request')->input('ordermilk')}}">
                            <input type="hidden" name="sugars" value="{{app('request')->input('ordersugar')}}">
                            <input type="hidden" name="syrup" value="{{app('request')->input('ordersyrup')}}"> --}}
                            <button id="addOrderbtn" type="submit" class="btn btn-success d-block">
                                add to cart</button>
                        </div>
                    </form>
                 </div>
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
                 </div>    
    </div> {{--end vendor class --}}
</div>{{-- end of contatiner--}}
@endsection
