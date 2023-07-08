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
                                <h4>
                                    <small>Choose your menus</small>
                                </h4>

                                @foreach($menus->groupBy('category_id') as $categoryId => $products)

                                    <div class="accordion-item">
                                        <h2 class="accordion-header ">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#category-{{$categoryId}}">
                                                {{$categories[$categoryId]}}
                                            </button>
                                        </h2>
                                        <div id="category-{{$categoryId}}" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
{{--                                                <p>Select Products</p>--}}
                                                @foreach($products as $index => $product)

                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button" type="button"
                                                                >
                                                            <label>
                                                                <input
                                                                    autocomplete="off"
                                                                    wire:model="formData.products.{{$product->id}}"
                                                                    type="checkbox"
                                                                />

                                                                <span class="ml-3">{{$product->name}}</span>
                                                            </label>
                                                        </button>
                                                    </h2>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                            <hr>
{{--                            options container--}}
                            <div class="container">
                                <h4>
                                    Choose your options
                                </h4>
                                @foreach($options->groupBy('option_type_id') as $optionTypeId => $options)

                                    <div class="accordion-item">
                                        <h2 class="accordion-header ">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#category-{{$optionTypeId}}">
                                                {{ $optionTypes[$optionTypeId]  }}
                                            </button>
                                        </h2>
                                        <div id="category-{{$optionTypeId}}" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                <p>Select Options</p>
                                                @foreach($options as $index => $option)

                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#product-{{$option->id}}">
                                                            <label>
                                                                <input
                                                                    autocomplete="off"
                                                                    wire:model="formData.options.{{$option->id}}"
                                                                    type="checkbox"
                                                                />

                                                                <span class="ml-3">{{$option->name}}</span>
                                                            </label>
                                                        </button>
                                                    </h2>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-success mt-2 px-5">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

