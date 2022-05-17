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
                        <form wire:submit.prevent="submit">
                            <div class="container">
                                <h3>
                                    <b>Set Your Product Prices</b>
                                </h3>
                                <div class="form-group row">
                                    @foreach ($vendorProducts as $index => $product)
                                        <div class="col-md-6 col-sm-12">
                                            <h5><b>{{$product->name}}</b></h5>
                                            <div class="form-group form-inline row">
                                                @foreach($sizes as $key => $size)
                                                    <div class="col-sm-3 col-sm-3">
                                                        <h6>{{$size}} $</h6>
                                                        <input
                                                            wire:model.lazy="productPrice.{{$product->id}}.{{$size}}"
                                                            type="number"
                                                            class="form-control"
                                                            value="{{$productPrice[$product->id][$size] ?? 0}}"
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
                                            <h5><b>{{$productOption->name}} $</b></h5>
                                            <div class="form-group form-inline row">
                                                <input
                                                    wire:model="vendorProductOptions.{{$index}}.price"
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
                            <div class="container">
                                <h4>
                                    Set Loyalty Product
                                </h4>
                                <div class="form-row row">
                                    <div class="form-group col">
                                        <label for="form.max_stamps" class="form-label">Buy</label>
                                        <input class="form-control" type="number" wire:model.lazy="form.max_stamps" required>
                                        @error('form.max_stamps') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col">
                                        <label for="form.free_product" class="form-label">Select Free Product</label>
                                        <select class="form-control" wire:model="form.free_product" required>
                                            <option value selected>Select Option</option>
                                            @foreach($vendorProducts as $key => $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('form.free_product') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col">
                                        <label for="form.get_free" class="form-label">To Get Free</label>
                                        <input class="form-control" type="number" wire:model.lazy="form.get_free" required>
                                        @error('form.get_free') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
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

