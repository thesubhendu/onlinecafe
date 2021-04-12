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
 <div class="modal-body">
     <h3>{{ Cart::count() }} items in shopping Cart<h3>
         <div class="form-group">
             @foreach(Cart::content() as $item)
            </div>
            <div class="card mb-3">
                <div class="row">
                    <div class="d-flex">
                        <div class="col-md-2">
                            <img src="{{asset('storage/img/nostamp.png')}}" alt="...">
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text"> ${{ $item->price }}</p>
                            </div>
                            <div clas="options">
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
                            </div>
                            <div class="d-flex justify-content-between cart-actions ml-2">
                                <form action="{{ route('cart.remove', $item->rowId) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-default">Remove</button>
                                </form>
                                <form action="{{ route('cart.saveForLater', $item->rowId) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-default">Save For Later</button>
                                </form>
                                <form action="{{ route('cart.store', $item->rowId) }}" method="post">
                                    @csrf
                                    <div class="form-group mt-2 ml-4 mr-4">
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <input type="hidden" name="name" value="{{$item->name}}">
                                        <input type="hidden" name="price" value="{{$item->price}}">
                                        <button id="addOrderbtn" type="submit"  value="submit" class="btn btn-success btn-block">
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
                                {{-- Save for later --}}
                         @if (Cart::instance('saveForLater')->count() > 0)
                         <div class="saveForLater mb-5">
                             <h3 class="mt-4">Save for later</h3>
                             @foreach(Cart::instance('saveForLater')->content() as $item)
                             <div class="card mt-4" style="width: 18rem;">
                                 <img src="{{asset('storage/img/nostamp.png')}}" class="card-img-top" alt="...">
                                 <div class="card-body">
                                 <h5 class="card-title">{{$item->name}}</h5>
                                 <p class="card-text">${{$item->price}}</p>
                                 <div class="d-flex">
                                     <form action="{{ route('saveforlaer.addtocart', $item->rowId) }}" method="post">
                                         @csrf
                                         <button type="submit" class="btn btn-default">Order</button>
                                     </form>
                                     <form action="{{ route('saveforlater.remove', $item->rowId) }}" method="post">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-default">Remove</button>
                                     </form>
                                 </div>
                             </div>
                         </div>
                         @endforeach
                         @endif     
                         @endforeach
                        @else
 <h3> No items in Cart </h3>
 @endif      
    </div> {{--end vendor class --}}
</div>{{-- end of contatiner--}}
@endsection
