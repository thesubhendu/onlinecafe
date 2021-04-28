@extends('layout.app')
@section('content')
<div  class="container py-4 mb-5">
    <div class="vendor-index mt-4">
        <div class="container">
            <div class="modal-header">
                <img src="{{asset('storage/img/nostamp.png')}}" width="30" height="30" class="d-inline-block align-top float-left" alt="logo">
                <h5 class="modal-title" id="titleLabel">new order</h5>
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
    <div class="container">
     <div class="row">
        <h3>{{ Cart::count() }} items in shopping Cart<h3>
             @foreach(Cart::content() as $item)
             <div class="card mb-3">
                 <div class="col-md-2 d-flex mx-auto">
                     <div class="mr-1">
                         <img src="{{asset('storage/img/nostamp.png')}}" alt="product" width="70">
                     </div>
                     <div class="card-body d-flex align-items-center product-details">
                         <h5 class="card-title">{{ $item->name }}</h5>
                         <p class="card-text ml-4"> ${{ $item->price }}</p>
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
                         <select class="form-control mt-2" id="orderMilk" name="milk" required>
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
                         <select class="form-control mt-2" id="orderSugars" name="sugar" required>
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
                         <select class="form-control mt-2" id="orderSyrup" name="syrup" required>
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
                            <form action="{{ route('cart.remove', $item->rowId) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-default"><i class="fa fa-trash mb-1 text-danger"></i></button>
                            </form>
                            <form action="{{ route('cart.saveForLater', $item->rowId) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-default"><i class="fas fa-cart-arrow-down text-info"></i></button>
                            </form>
                            
                        </div>
                     </div>
                 </div>
                 <div class="col-md-10 d-flex">
                    <form action="{{ route('cart.store', $item->rowId) }}" method="post">
                        @csrf
                        <div class="form-group mt-2 ml-4 mr-4">
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <input type="hidden" name="name" value="{{$item->name}}">
                            <input type="hidden" name="price" value="{{$item->price}}">
                            <button id="addOrderbtn" type="submit"  value="submit" class="btn btn-success btn-sm">
                                add to cart</button>
                        </div>
                    </form>
                 </div>
                 <div class="cart-totals">       
                     <table>            
                         <tfoot>
                             <tr>
                                 <td colspan="2">&nbsp;</td>
                                 <td>Subtotal</td>
                                 <td><?php echo Cart::subtotal(); ?></td>
                             </tr>
                             <tr>
                                 <td colspan="2">&nbsp;</td>
                                 <td>Tax</td>
                                 <td><?php echo Cart::tax(); ?></td>
                             </tr>
                             <tr>
                                 <td colspan="2">&nbsp;</td>
                                 <td>Total</td>
                                 <td><strong><?php echo Cart::total(); ?></strong></td>
                             </tr>
                         </tfoot>
                     </table>
                     </div>
             </div>
                                
                         @endforeach
                        @else
                        <h3> No items in Cart </h3>
                        @endif 
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
                            <h3> No items saved for later </h3>
                            @endif     
                 </div>    
    </div> {{--end vendor class --}}
</div>{{-- end of contatiner--}}
@endsection
