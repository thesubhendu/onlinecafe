@extends('layout.app')
@section('content')
<main role="main" class="container py-4 mb-5">
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

        @if (Cart::count() > 0) 
            <div class="modal-body">
                <form id="newOrderForm" method="POST" action="" class="needs-validation" novalidate>
                    <h3>{{ Cart::count() }} items in shopping Cart<h3>
                    <!-- <div class="form-group">
                    <input type="text" class="form-control" id="orderUser_id" name="orderUser_id" value="" placeholder="User ID..." required>
                    </div> -->
                    <div class="form-group">
                        @foreach(Cart::content() as $item)
                        {{-- <div class="row"> --}}
                            <div class="card mb-3">
                                <div class="row g-0">
                                <div class="col-md-2">
                                    <img src="{{asset('storage/img/nostamp.png')}}" alt="...">
                                </div>
                                <div class="col-md-10">
                                    <div class="card-body">
                                        <input type="text" class="form-control" id="orderProduct_id" name="orderProduct_id" value="{{ $item->name }}" placeholder="product ID..." required>
                                    <div class="invalid-feedback">
                                        You need to let us know what you would like
                                    </div>
                                    <h5 class="card-title">{{ $item->name }}</h5>
                                    <p class="card-text"> ${{ $item->price }}</p>
                                    </div>
                                    <div class="form-group mt-2">
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
                                        </div>
                                        <div class="card milk mt-2 mb-4">
                                            <h6 class="card-header">Milk</h6>
                                            <div class="form-group card-body">
                                                <select class="form-control" id="orderMilk" name="milk" required>
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
                                            </div>
                                        </div>
                                    <div class="card sugars mt-2 mb-4">
                                        <h6 class="card-header">Sugar</h6>
                                        <div class="form-group card-body">
                                            <select class="form-control" id="orderSugars" name="sugar" required>
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
                                            </div>
                                        </div>
                                        <div class="card syurps mt-2 mb-4">
                                            <h6 class="card-header">Syrup</h6>
                                            <div class="form-group - card-body">
                                                <select class="form-control" id="orderSyrup" name="syrup" required>
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
                                            </div>
                                            <div class="form-group d-grid gap-2 col-12 mx-auto">
                                                <button id="addOrderbtn" type="submit"  value="submit" class="btn btn-success btn-block">
                                                     add to cart</button>
                                            </div>
                                </div>
                                </div>
                                
                            </div>
                        {{-- </div> --}}
                        @endforeach
                    </div>
                </div>    
            @else

                <h3> No items in Cart </h3>
                
            @endif
            <div class="form-group">
                <input hidden type="text" class="form-control" id="orderVendor_id" name="orderVendor_id" value="{{app('request')->input('vendor_id')}}" placeholder="business ID..." required>
                <div class="invalid-feedback">
                    we need to know which business your buying from
                </div>
                <div>       
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
                
            </form>
        </div>
</div>
</main><!-- /.container -->
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script></body>
</body>
</html>