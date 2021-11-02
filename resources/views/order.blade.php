<x-app-layout>

    <div class="container ">

        <div class="row product-confirm">
            <div class="col-lg-2">
                <img src="./assets/images/cappuccino.jpg" class="img-responsive" alt="">
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
        <form action="">
            <div class="row extras">
                <div class="col-lg-12 mb-3">
                    <h6> Options</h6>
                </div>

                <div class="col-lg-4">
                    <h6>Quanitiy</h6>
                    <select name="" id="" class="form-select">
                        @foreach ([1,2,3,4,5,6,7,8,9,10] as $option)
                            <option value="">{{$option}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="">Which Milk</label>
                    <select name="" id="" class="form-select">
                        @foreach ($milkOptions as $option)
                            <option value="">{{$option}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="">How Many Sugars</label>
                    <select name="" id="" class="form-select">
                        @foreach ($sugar as $option)
                            <option value="">{{$option}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="">Syrup</label>
                    <select name="" id="" class="form-select">
                        @foreach ($syrup as $option)
                            <option value="">{{$option}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="total-submit text-right">
                <button class="btn btn-secondary">
                    Add to Cart &nbsp; <i class="fa fa-shopping-cart"></i>
                </button>
            </div>
        </form>

    </div>


</x-app-layout>

