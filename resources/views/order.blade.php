<x-app-layout>
    <br>
    <div class="container ">
        <div class="row product-confirm">
            <div class="col-lg-2">
                <img src="{{asset('assets/images/cappuccino.jpg')}}" class="img-responsive" alt="">
            </div>
            <div class="col-lg-3">
                <h6>Product</h6>
                <p>{{$product->name}}</p>
            </div>
            <div class="col-lg-3">
                <h6>Rate</h6>
                <p>${{$product->price}}</p>
            </div>

        </div>
        <form action="{{ route('cart.store', $product->rowId) }}" method="post">
            @csrf
            <div class="row extras">
                <div class="col-lg-12 mb-3">
                    <h6> Options</h6>
                </div>

                <div class="col-lg-4">
                    <h6>Quantity</h6>
                    <select name="quantity" id="" class="form-select" required>
                        @foreach ([1,2,3,4,5,6,7,8,9,10] as $option)
                            <option value="{{$option}}">{{$option}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="">Which Milk</label>
                    <select name="milk" id="milk" class="form-select">
                        @foreach ($milkOptions as $option)
                            <option value="{{$option}}">{{$option}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="">How Many Sugars</label>
                    <select name="sugar" id="sugar" class="form-select">
                        @foreach ($sugar as $option)
                            <option value="{{$option}}">{{$option}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="">Syrup</label>
                    <select name="syrup" id="syrup" class="form-select">
                        @foreach ($syrup as $option)
                            <option value="{{$option}}">{{$option}}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <input type="hidden" name="id" value="{{$product->id}}">
            <input type="hidden" name="name" value="{{$product->name}}">
            <input type="hidden" name="price" value="{{$product->price}}">
            <input type="hidden" name="vendor" value="{{$product->vendor_id}}">

            <div class="total-submit text-right">
                <button class="btn btn-secondary">
                    Add to Cart &nbsp; <i class="fa fa-shopping-cart"></i>
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

