<div>
    <x-breadcrumb></x-breadcrumb>
    <x-steps step="shop-setup"></x-steps>

    <section class="payment-form registration-steps ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <x-message type="error"></x-message>
                    <x-message type="message"></x-message>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shop-setup-card">
                        <form wire:submit="submit">
                            <div class="container">
                                <h3>
                                    <b>Set Your Product Prices</b>
                                </h3>
                                <div class="form-group row">
                                    @foreach ($vendorProducts as $index => $product)
                                        <div class="col-md-6 col-sm-12">
                                            @if($index === 0)
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5><b>{{$product->name}}</b></h5>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-primary"
                                                                wire:click.prevent="applyPricesToAllProducts">+ Apply prices to all
                                                            products
                                                        </button>
                                                    </div>

                                                </div>
                                            @else
                                                <h5><b>{{$product->name}}</b></h5>
                                            @endif
                                            <div class="form-group form-inline row">
                                                @foreach($sizes as $key => $size)
                                                    <div class="col-sm-3 col-sm-3">
                                                        <h6>{{$size}} $</h6>
                                                        <input
                                                            wire:model.blur="productPrices.{{$product->id}}.{{$size}}"
                                                            type="number"
                                                            class="form-control"
                                                            value="{{$productPrices[$product->id][$size] ?? 0}}"
                                                            required
                                                        />
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="container">
                                <h4>
                                    Set your Options Price
                                </h4>
                                <div class="form-group row">
                                    @foreach ($vendorProductOptions as $index => $productOption)
                                        <div class="col-md-3">
                                            <h5><b>{{$productOption->name}}</b></h5>
                                            @if($index === 0)
                                                <button type="button" class="btn btn-primary"
                                                        wire:click.prevent="applyPricesToAllOptions">+ Apply prices to all
                                                    options
                                                </button>
                                            @endif
                                            <div class="form-group form-inline row">
                                                <input
                                                    wire:model.live="vendorProductOptions.{{$index}}.price"
                                                    type="number"
                                                    class="form-control"
                                                    value="{{$productOption->price}}"
                                                    required
                                                />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-2 px-5">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

