<div>
    <x-message></x-message>
    <x-message type="error"></x-message>

    <section class="product-confirm">
        <div class="container">
            <form wire:submit.prevent="submit" method="post">
                @csrf
                <div class="row ">
                    <div class="col-lg-3 mb-3">
                        <div class="product-card">
                            <div class="image">
                                <img src="{{asset('assets/images/cappuccino.jpg')}}" class="img-responsive" alt="">
                            </div>
                            <div class="content">
                                <div class="d-flex mb-3 ">
                                    <div class="p-1">
                                        <h5>{{$product->name}}</h5>
                                        <p>${{number_format($cartProduct['price'], 2)}}</p>
                                    </div>
                                    <div class="p-2"></div>
                                    <div class="p-1 mr-4">
                                        <label>Quantity</label>
                                        <div class="control-btn ">
                                            <button type="button" class="value-button decrease"
                                                    wire:click="updateQty('remove')" value="Decrease Value">-
                                            </button>
                                            <input type="number" id="number" wire:model="cartProduct.qty"/>
                                            <button type="button" class="value-button increase" wire:click="updateQty()"
                                                    value="Increase Value">+
                                            </button>
                                        </div>

                                        @error('cartProduct.qty') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="product-form">
                            <div class="row extras">

                                <div class="col-lg-9">
                                    @if($vendorOptionsExist)
                                        <h4> Select Options</h4>
                                    @endif
                                    <div class="row">
                                        @if($product->is_all_sizes_available && count($product->productPrices))
                                            <div class="col-lg-4 mb-3">
                                                <label for="">Size</label>
                                                @foreach($product->productPrices as $index => $productPrice)
                                                    <div class="form-check">
                                                        <input type="radio" id="productPrice-{{$index}}"
                                                               value="{{$productPrice->size}}"
                                                               class="form-check-input"
                                                               wire:model.lazy="selectSize"
                                                               wire:change="updateProductPrice()">
                                                        <label for="productPrice-{{$index}}" class="form-check-label">
                                                            @if($productPrice->size === 'S')
                                                                {{$productPrice->size }}
                                                            @else
                                                                {{$productPrice->size}} +${{ number_format(($productPrice->price- $product->price), 2) }}
                                                            @endif
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        @foreach($product->optionTypes() as $index => $optionType)
                                            @if($optionType->vendorProductOptions->count())
                                                <div class="col-lg-4 mb-3">
                                                    <label for="">{{$optionType->name}}</label>
                                                    @foreach($optionType->vendorProductOptions as $key => $option)
                                                        <div class="form-check">
                                                            <input wire:model.lazy="cartProduct.options.{{$optionType->id}}"
                                                                   class="form-check-input" type="radio"
                                                                   id="product-{{$index}}-{{$key}}"
                                                                   value="{{$option->name}}"
                                                                   wire:change="updateProductPrice()"
                                                            >
                                                            <label class="form-check-label" for="product-{{$index}}-{{$key}}">
                                                                {{$option->name}} +${{ $option->price}}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    @error('cartProduct.options.'.$optionType->id) <span
                                                        class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3 text-right">
                                    <div class="total-submit">
                                        <button type="submit" class="btn btn-secondary">
                                            Add to Cart &nbsp; <i class="fa fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>

</div>
