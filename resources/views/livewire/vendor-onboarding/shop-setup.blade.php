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

                            <div >
                                <h2 class="title">Shop setup</h2>
                                <div class="form-group">
                                    <label for="form.shop_name" class="form-label"> Shop name</label>
                                    <input class="form-control" type="text" wire:model.lazy="form.shop_name">
                                    @error('form.shop_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group col-lg-6 col-sm-12">
                                    <label for="email" class="form-label"> Email</label>
                                    <input type="email" class="form-control" wire:model.lazy="form.shop_email"
                                           placeholder="Email">
                                    @error('form.shop_email') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>

                                <div class="form-group col-lg-6 col-sm-12 mb-5">
                                    <label for="mobile" class="form-label"> Mobile</label>
                                    <input type="text" class="form-control" wire:model.lazy="form.shop_mobile"
                                           placeholder="Phone No ">
                                    @error('form.shop_mobile') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>

                                <div class="form-group">
                                    <label for="form.description" class="form-label">Description</label>
                                    <textarea class="form-control" wire:model.lazy="form.description"> </textarea>
                                    @error('form.description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>


                                <div class="form-group">
                                    <label for="form.address" class="form-label">Address</label>
                                    <br>
                                    @error('form.address') <span class="text-danger">{{ $message }}</span> @enderror
                                    <livewire:g-map/>
                                </div>

                                <div class="form-row row">
                                    <div class="form-group col">
                                        <label for="form.max_stamps" class="form-label">Buy</label>
                                        <input class="form-control" type="number" wire:model.lazy="form.max_stamps">
                                        @error('form.max_stamps') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col">
                                        <label for="form.free_product" class="form-label">Select Free Product</label>
                                        <select class="form-control" wire:model="form.free_product" wire:change="freeProductChange">
                                            <option value selected>Select Option</option>
                                            @foreach($vendorProducts as $key => $option)
                                                <option value="{{$option->id}}">{{$option->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('form.free_product') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col">
                                        <label for="form.get_free" class="form-label">To Get Free</label>
                                        <input class="form-control" type="number" wire:model.lazy="form.get_free">
                                        @error('form.get_free') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="logo" class="form-label">Logo</label>
                                <input class="form-control" type="file" wire:model="logo">
                                @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="opening-hours form-part">
                                <h2 class="title">Shop Opening Hours</h2>
                                @foreach($daysInWeek as $day)
                                    <div class="row mb-3 day-select">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <input type="checkbox" class="form-check-input"
                                                           wire:model="form.opening_hours.{{$day}}.is_active" checked>
                                                    <label for="inputEmail3">{{$day}}</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-control"
                                                            wire:model="form.opening_hours.{{$day}}.from">
                                                        @foreach($openingHoursOptions as $key => $option)
                                                            <option value="{{$key}}">{{$option}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-control"
                                                            wire:model="form.opening_hours.{{$day}}.to">
                                                        @foreach($openingHoursOptions as $key => $option)
                                                            <option value="{{$key}}">{{$option}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-1"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            @if($day == 'Monday')
                                                <button type="button" class="btn btn-primary"
                                                        wire:click.prevent="applyTimesToAllDays">+ Apply times to all
                                                    days
                                                </button>
                                            @endif
                                        </div>


                                    </div>
                                @endforeach
                            </div>

                            <div class="menu-section form-part">
                                <h2 class="title">Choose your menus</h2>
                                <div class="row">
                                    @foreach ($menus as $index=>$menu)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="checkbox" class="form-check-input"
                                                       wire:model="menus.{{$index}}.isSelected" checked>


                                                <label for=""> {{$menu->name}}</label>

                                                $ <input style="display:inline-block" type="number" class="form-control"
                                                         wire:model="menus.{{$index}}.price" placeholder="price">
                                                <input type="checkbox" class="form-check-input"
                                                       wire:model="menus.{{$index}}.is_stamp" checked>
                                                Is Stamp?
                                                @if($menu->is_all_sizes_available)
                                                    <div class="row" style="margin: 0 -5px 1.1rem -5px">

                                                        @foreach($sizes as $key => $size)
                                                            <div class="col-md-2">
                                                                <div>
                                                                    <label class="input-sizer">
                                                                        <label class="input-sign-icon hy-text-title-2">{{$size}}</label>
                                                                        <span class="hy-text-title-2"> $</span>
                                                                        <input
                                                                            wire:model.lazy="productPrice.{{$menu->id}}.{{$size}}"
                                                                            type="number"
                                                                            value="{{$productPrice[$menu->id][$size] ?? 0}}"
                                                                        />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                @endif

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="menu-option-section form-part">
                                <h2 class="title">Choose your options</h6>
                                    <div class="row">
                                        @foreach ($options as $index=>$menu)

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="checkbox" class="form-check-input"
                                                           wire:model="options.{{$index}}.isSelected" checked>
                                                    <label for="">{{$menu->name}}</label>
                                                    $ <input style="display:inline-block" class="form-control"
                                                             type="number"
                                                             step='any' placeholder="price"
                                                             wire:model="options.{{$index}}.price">
                                                </div>

                                            </div>
                                        @endforeach

                                    </div>
                            </div>
                            @if($productSizes->count())
                                <div class="menu-option-section form-part">
                                    <h2 class="title">Set Price for Sizes</h6>
                                        <div class="row">
                                            @foreach ($productSizes as $index=>$size)
                                                @if(!$size->base_size)
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">{{$size->name}} ({{$size->slug}})</label>
                                                            $ <input min="0" style="display:inline-block" class="form-control"
                                                                     type="number"
                                                                     step='any' placeholder="price"
                                                                     wire:model="productSizes.{{$index}}.price">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                </div>
                                @endif

                            <section class="mb-4">
                                <h2 class="title">Services</h2>
                                <div class="row">
                                    @foreach ($services as $index => $service)
                                        <div class="col">
                                            <input type="checkbox" class="form-check-input" wire:model="form.services.{{$service}}" >
                                            <label for="">{{$service}}</label>
                                        </div>
                                    @endforeach
                                      <div class="col">
                                          <input type="text" class="form-control" placeholder="add new service" wire:model="newService">
                                      </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-primary btn-sm" wire:click="addService">Add</button>

                                    </div>
                                </div>

                                @error('form.services')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </section>

                            <button type="submit" class="btn btn-success mt-2 px-5">Setup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
