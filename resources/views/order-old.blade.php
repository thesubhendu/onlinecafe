<x-app-layout>
    <div class="container py-4 mb-5">
        <div class="vendor-index mt-4">
            {{-- order --}}
            <div class="container">
                <div class="card mb-3" style="max-width: 100%; border: none;">
                    @foreach($order_product as $product)
                        <div class="row g-0">
                            <div class="col-sm-12">
                                <form action="{{ route('cart.store', $product->rowId) }}"
                                      method="post"> {{--{{ route('cart.store', $item->rowId) }}--}}
                                    @csrf
                                    {{-- <div class="card-body d-flex p-2 justify-content-between align-content-center"> --}}
                                    <div
                                        class="form-group card-body d-flex p-2 justify-content-between align-items-center">
                                        <img src="{{asset('storage/img/nostamp.png')}}" alt="product" width="100px"
                                             height="100px">
                                        <h5 class="card-title">{{$product->name}}dsd</h5>
                                        <p class="card-text"> ${{$product->price}}</p>
                                        <label class="sr-only" for="quantity">Quantity</label>
                                        <select class="form-control form-select" id="quantity" name="quantity" required
                                                style="max-width:30%;">
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
                                            <option {{ old('quantity') == "10" ? 'selected' : ''}} value="10">10
                                            </option>
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
                                                <option
                                                    value="Full Cream"{{ old('milk') == "Full Cream" ? 'selected' : ''}}>
                                                    Full Cream
                                                </option>
                                                <option value="Skim"{{ old('milk') == "Skim" ? 'selected' : ''}}>Skim
                                                </option>
                                                <option value="Soy"{{ old('milk') == "Soy" ? 'selected' : ''}}>Soy
                                                </option>
                                                <option value="Zymil"{{ old('milk') == "Zymil" ? 'selected' : ''}}>
                                                    Zymil
                                                </option>
                                                <option value="Almond"{{ old('milk') == "Almond" ? 'selected' : ''}}>
                                                    Almond
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                we need to know which milk
                                            </div>
                                            <select class="form-control mt-2" id="sugar" name="sugar" required>
                                                <option selected>how many sugars...</option>
                                                <option {{ old('sugar') == "None" ? 'selected' : ''}} value="0">None
                                                </option>
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
                                                <option
                                                    {{ old('syrup') == "No Thanks" ? 'selected' : ''}} value="No Thanks">
                                                    No Thanks
                                                </option>
                                                <option
                                                    {{ old('syrup') == "Caramel" ? 'selected' : ''}} value="Caramel">
                                                    Caramel
                                                </option>
                                                <option
                                                    {{ old('syrup') == "Vanilla" ? 'selected' : ''}} value="Vanilla">
                                                    Vanilla
                                                </option>
                                                <option
                                                    {{ old('syrup') == "Hazelnut" ? 'selected' : ''}} value="Hazelnut">
                                                    Hazelnut
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                we need to know if you would like syrup
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="{{$product->id}}">
                                        <input type="hidden" name="name" value="{{$product->name}}">
                                        <input type="hidden" name="price" value="{{$product->price}}">
                                        <input type="hidden" name="vendor" value="{{$product->vendor_id}}">

                                        <div class="d-flex justify-content-between">
                                            <button type="submit" class="btn btn-default"><i
                                                    class="fa fa-trash mb-1 text-danger"></i></button>
                                            <button type="submit" class="btn btn-default"><i
                                                    class="fas fa-cart-arrow-down text-info"></i></button>
                                        </div>
                                        <button id="addOrderbtn" type="submit" value="submit"
                                                class="w-100 btn btn-success d-block">
                                            add to cart
                                        </button>
                                </form>
                                <div class="d-flex justify-content-between cart-actions ml-2">


                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-sm-12 d-flex p-2 justify-content-between align-items-center">

                </div>
                @endforeach
            </div>

        </div>
</x-app-layout>
