<x-app-layout>
    <section class="product-confirm">
        <div class="container">
            <div class="row ">
                <div class="col-lg-3 mb-3">
                    <div class="product-card">
                        <div class="image">
                            <img src="{{asset('assets/images/cappuccino.jpg')}}" class="img-responsive" alt="">
                        </div>
                        <div class="content">
                            <h4>{{$product->name}}</h4>
                            <p>${{$product->price}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="product-form">
                        <form action="{{ route('cart.store', $product->rowId) }}" method="post">
                            @csrf
                            <div class="row extras">
                                <div class="col-lg-12 mb-3">
                                    <h4> Select Options</h4>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label>Quantity</label>
                                    <select name="quantity" id="" class="form-control" required>
                                        @foreach ([1,2,3,4,5,6,7,8,9,10] as $option)
                                        <option value="{{$option}}">{{$option}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label for="">Which Milk</label>
                                    <select name="milk" id="milk" class="form-control">
                                        @foreach ($milkOptions as $option)
                                        <option value="{{$option}}">{{$option}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label for="">How Many Sugars</label>
                                    <select name="sugar" id="sugar" class="form-control">
                                        @foreach ($sugar as $option)
                                        <option value="{{$option}}">{{$option}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label for="">Syrup</label>
                                    <select name="syrup" id="syrup" class="form-control">
                                        @foreach ($syrup as $option)
                                        <option value="{{$option}}">{{$option}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-8 form-group text-right">
                                    <div class="total-submit">
                                        <button class="btn btn-secondary">
                                            Add to Cart &nbsp; <i class="fa fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <input type="hidden" name="name" value="{{$product->name}}">
                            <input type="hidden" name="price" value="{{$product->price}}">
                            <input type="hidden" name="vendor" value="{{$product->vendor_id}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>