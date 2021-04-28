@extends('layout.app')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-8">
                <div class="p-2">
                    <img src="{{asset('storage/img/nostamp.png')}}" width="30" height="30" class="d-inline-block align-top float-left" alt="logo">
                    <h4>Shopping cart</h4>
                    <div class="d-flex flex-row align-items-center pull-right"><span class="mr-1">Sort by:</span><span class="mr-1 font-weight-bold">Price</span><i class="fa fa-angle-down"></i></div>
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
                @if (Cart::count() > 0)
                <h3>{{ Cart::count() }} items in shopping Cart<h3>
                @foreach(Cart::content() as $item)
                <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded">
                    <div class="mr-1"><img class="rounded" src="{{asset('storage/img/nostamp.png')}}" alt="product" width="70"></div>
                    <div class="d-flex flex-column align-items-center product-details"><span class="font-weight-bold">{{ $item->name }}</span>
                        <div class="d-flex flex-row product-desc">
                            <div class="size mr-1"><span class="text-grey">Milk:</span><span class="font-weight-bold">&nbsp;</span></div>
                            <div class="sugar"><span class="text-grey">Sugar:</span><span class="font-weight-bold">&nbsp;</span></div>
                            <div class="syrup"><span class="text-grey">Syrup:</span><span class="font-weight-bold">&nbsp;</span></div>
                            <div class="shot"><span class="text-grey">Extra Shot:</span><span class="font-weight-bold">&nbsp;</span></div>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center qty"><i class="fa fa-minus text-danger"></i>
                        <h5 class="text-grey mt-1 mr-1 ml-1">2</h5><i class="fa fa-plus text-success"></i>
                    </div>
                    <div>
                        <h5 class="text-grey">${{ $item->price }}</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <form action="{{ route('cart.remove', $item->rowId) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-default"><i class="fa fa-trash mb-1 text-danger"></i></button>
                        </form>
                    </div>
                    <div class="d-flex align-items-center">
                        <form action="{{ route('cart.saveForLater', $item->rowId) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-default"><i class="fas fa-cart-arrow-down"></i></button>
                        </form>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center mt-3 p-2 bg-white rounded"><input type="text" class="form-control border-0 gift-card" placeholder="discount code/gift card"><button class="btn btn-outline-success btn-sm ml-2" type="button">Apply</button></div>
                <div class="d-flex flex-row align-items-center mt-3 p-2 bg-white rounded">
                    <form action="{{ route('cart.store', $item->rowId) }}" method="post">
                        @csrf
                        <div class="form-group mt-2 ml-4 mr-4">
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <input type="hidden" name="name" value="{{$item->name}}">
                            <input type="hidden" name="price" value="{{$item->price}}">
                            {{-- <button id="addOrderbtn" type="submit"  value="submit" class="btn btn-success btn-block">add to cart</button> --}}
                            <button class="btn btn-success btn-block btn-lg ml-2 pay-button" type="submit">Proceed to Pay</button>
                                
                        </div>
                    </form>
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
                @endforeach
                {{-- @endif      --}}
                {{-- @endforeach --}}
                @else
                 <h3> No items in Cart </h3>
                @endif
            </div>
        </div>
    </div>
    @endsection