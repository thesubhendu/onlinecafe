@extends('layout.app')
@section('content')
<div  class="container py-4 mb-5">
    <div class="vendor-index mt-4">
        <div class="container">
            <div class="modal-header">
                <img src="{{asset('storage/img/nostamp.png')}}" width="30" height="30" class="d-inline-block align-top float-left" alt="logo">
                <h5 class="modal-title" id="titleLabel">Your cart</h5>
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
    
                <h2>{{ Cart::count() }} item(s) in Shopping Cart</h2>
        
                <div class="mt-4">
                    <div class="row border-bottom border-top border-secondary">
                        <div class="col d-flex justify-content-between mr-3">
                            <a href="#"><img src="{{asset('storage/img/nostamp.png')}}" alt="item" width="30" height="30"class="cart-table-img btn" style="max-width: 50px; max-width: 50px;"></a>
                            <div class="order-details ml-3">
                                <div class="cart-table-item px-3 btn"><a href="">{{ $item->name }}</a></div>
                                <div class="cart-table-description"><small class="text-muted">Fullcream, Sugar - 1, Syrup - No Thanks</small></div>
                            </div>
                        </div>
                        <div class="d-flex ilign-items-center align-content-center">
                            <div class="d-flex flex-column">
                                <a class="btn"><small>Remove</small></a> <!--form in laravel-->
                                <a class="btn"><small>Save for Later</small></a> <!--form in laravel-->
                            </div>
                              <div class="form-group mt-3">
                                <select class="form-control" id="exampleFormControlSelect1">
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                </select>
                              </div>
                              
                            <div class="col mt-3">{{ $item->price }}</div>
                        </div>
                    </div> <!-- end cart-table-row -->
                </div> <!-- end cart-table -->
        
                    <a href="#" class="have-code text-secondary px-2"><small>Have a Code?</small></a>
        
                    <div class="input-group mb-3" style="max-width: 40%;">
                        <input type="text" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" type="button" id="button-addon2">Apply</button>
                        </div>
                      </div>
                    </div> <!-- end have-code-container -->
        
        
                <div class="row cart-totals bg-light">
                    <div class="col cart-totals-left">
                        Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like figuring out :).
                    </div>
        
                    <div class="col cart-totals-right align-items-start">
                        <div>
                            Subtotal <?php echo Cart::subtotal(); ?><br>
                            Tax <?php echo Cart::tax(); ?><br>
                            <span class="cart-totals-total">Total <?php echo Cart::total(); ?></span>
                            <a style="font-size:14px;">Remove</a>
                            <br>
                        </div>
                    </div>
                </div> <!-- end cart-totals -->
                <hr>
        
                <div class="cart-buttons d-flex justify-content-between">
                    <a href="" class="btn btn-outline-secondary">Continue Shopping</a>
                    <a href="" class="btn btn-primary">Proceed to Checkout</a>
                </div>
            </div>
        </div><!--end of new cart-->
    <div class="container">
     <div class="row">
        <h3>{{ Cart::count() }} items in shopping Cart<h3>
             @foreach(Cart::content() as $item)
             {{-- <div class="card mb-3">
                 <div class="col-md-2 d-flex justify-content-between align-content-center mx-auto">
                     <div class="row">
                         <div class="mr-1 col">
                             <img src="{{asset('storage/img/nostamp.png')}}" alt="product" width="70">
                         </div>
                         <div class="card-body d-flex justify-content-between align-items-center product-details col mr-3">
                             <h5 class="card-title">{{ $item->name }}</h5>
                             <p class="card-text ml-4"> ${{ $item->price }}</p>
                             <small><p>{{$item->orderQuanitity}}</P>, <p>{{$item->ordermilk}}</P>, <p>{{$item->ordersugar}}, <p>{{$item->ordersyrup}}</P></P></small>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-10">
                    <form action="{{ route('cart.store', $item->rowId) }}" method="post">
                        @csrf
                        <div class="form-group mt-2 ml-4 mr-4">
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <input type="hidden" name="name" value="{{$item->name}}">
                            <input type="hidden" name="price" value="{{$item->price}}">
                            <button id="addOrderbtn" type="submit"  value="submit" class="btn btn-success btn-sm d-block">
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
             </div> --}}      
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
