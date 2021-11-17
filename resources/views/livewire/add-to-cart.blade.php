<div>
    <x-message></x-message>
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
                        <form wire:submit.prevent="submit" method="post">
                            @csrf
                            <div class="row extras">
                                <div class="col-lg-12 mb-3">
                                    <h4> Select Options</h4>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label>Quantity</label>
                                    <select wire:model.lazy="cartProduct.quantity" id="" class="form-select" required>
                                        @foreach ([0,1,2,3,4,5,6,7,8,9,10] as $option)
                                            <option value="{{$option}}">{{$option}}</option>
                                        @endforeach
                                    </select>
                                    @error('cartProduct.quantity') <span
                                        class="text-danger">{{ $message }}</span> @enderror

                                </div>

                                @foreach($product->options() as $index => $option)
                                    <div class="col-lg-4 mb-3">
                                        <label for="">{{$option->name}}</label>
                                        <select wire:model="cartProduct.options.{{$option->id}}" class="form-select">
                                            <option value="">Select Option</option>
                                            @foreach ($option->options ?? [] as $subOption)
                                                <option value="{{$option->name}}-{{$subOption}}">{{$subOption}}</option>
                                            @endforeach

                                        </select>
                                        @error('cartProduct.options.'.$option->id) <span
                                            class="text-danger">{{ $message }}</span> @enderror

                                    </div>
                                @endforeach


                                <div class="col-lg-8 mb-3 text-right">
                                    <div class="total-submit">
                                        <button type="submit" class="btn btn-secondary">
                                            Add to Cart &nbsp; <i class="fa fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
