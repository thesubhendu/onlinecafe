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

                            <div >
                                <h2 class="title">Shop setup</h2>
                                <div class="form-group">
                                    <label for="form.shop_name" class="form-label"> Shop name</label>
                                    <input class="form-control" type="text" wire:model.blur="form.shop_name">
                                    @error('form.shop_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="form-group col-lg-6 col-sm-12">
                                    <label for="email" class="form-label"> Email</label>
                                    <input type="email" class="form-control" wire:model.blur="form.shop_email"
                                           placeholder="Email">
                                    @error('form.shop_email') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>

                                <div class="form-group col-lg-6 col-sm-12 mb-5">
                                    <label for="mobile" class="form-label"> Mobile</label>
                                    <input type="text" class="form-control" wire:model.blur="form.shop_mobile"
                                           placeholder="Phone No ">
                                    @error('form.shop_mobile') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>

                                <div class="form-group">
                                    <label for="form.description" class="form-label">Description</label>
                                    <textarea class="form-control" wire:model.blur="form.description"> </textarea>
                                    @error('form.description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>


                                <div class="form-group">
                                    <label for="form.address" class="form-label">Address</label>
                                    <br>
                                    @error('form.address') <span class="text-danger">{{ $message }}</span> @enderror
                                    <livewire:g-map/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input class="form-control" type="file" wire:model.live="logo">
                                    @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col">
                                    @if($vendor->vendor_logo)
                                        <img class="mt-4" src="{{asset('storage/'.$vendor->vendor_logo)}}" alt="" width="50" height="50">
                                    @endif
                                </div>


                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label for="vendorImage" class="form-label">Vendor Image</label>
                                    <input class="form-control" type="file" wire:model.live="vendorImage">
                                    @error('vendorImage') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col">
                                    @if($vendor->vendor_image)
                                        <img class="mt-3" src="{{asset('storage/'.$vendor->vendor_image)}}" alt="" width="300" height="100">
                                    @endif
                                </div>

                            </div>

                            <div class="opening-hours form-part">
                                <h2 class="title">Shop Opening Hours</h2>
                                @foreach($daysInWeek as $day)
                                    <div class="row mb-3 day-select">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <input type="checkbox" class="form-check-input"
                                                           wire:model.live="form.opening_hours.{{$day}}.is_active" checked>
                                                    <label for="inputEmail3">{{$day}}</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-control"
                                                            wire:model.live="form.opening_hours.{{$day}}.from">
                                                        @foreach($openingHoursOptions as $key => $option)
                                                            <option value="{{$key}}">{{$option}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-control"
                                                            wire:model.live="form.opening_hours.{{$day}}.to">
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

                            <section class="mb-4">
                                <h2 class="title">Services</h2>
                                <div class="row">
                                    @foreach ($services as $index => $service)
                                        <div class="col">
                                            <input type="checkbox" class="form-check-input" wire:model.live="form.services.{{$service->name}}" >
                                            <label for="">{{$service->name}}</label>
                                        </div>
                                    @endforeach
                                      <div class="col">
                                          <input type="text" class="form-control" placeholder="add new service" wire:model.live="newService">
                                      </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-primary btn-sm" wire:click="addService">Add</button>
                                    </div>
                                    @error('newService')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                @error('form.services')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </section>

                            <section>
                                <h4 class="title">
                                    Loyalty Program
                                </h4>

                                <div class="mb-3">
                                    <input type="checkbox" class="form-check-input" wire:model.live="form.is_rewarding_active" >
                                    <label for="">Loyalty Program</label>
                                </div>

                                @if($form['is_rewarding_active'])
                                    <div class="form-row row">
                                        <div class="form-group col-md-4">
                                            <label for="form.max_stamps" class="form-label">Buy</label>
                                            <input class="form-control" type="number" wire:model.blur="form.max_stamps" required>
                                            @error('form.max_stamps') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="form.free_product" class="form-label">Select Free Category</label>
                                            <select class="form-control" wire:model.live="form.free_category" wire:change="freeProductCategoryChange()" required>
                                                <option value selected>Select Option</option>
                                                @foreach(\App\Models\ProductCategory::all() as $key => $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('form.free_category') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="form.get_free" class="form-label">To Get Free</label>
                                            <input class="form-control" type="number" wire:model.blur="form.get_free" required>
                                            @error('form.get_free') <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            </section>

                            <button type="submit" class="btn btn-success mt-2 px-5">{{$vendorProductsExists ? 'Submit' : 'Continue'}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
