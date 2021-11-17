<section>
    <x-message type="error"></x-message>
    <x-message type="message"></x-message>

    <div wire:loading.delay.class.remove="d-none" class="d-none text-primary my-3 h3" role="status">
        Validating ABN. Please Wait...
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 ">
            <h4 class="title mt-5 mb-4">Register your business</h4>
            <div class="">
                <form wire:submit.prevent="register">
                    <div class="form-group">
                        <label for="name" class="form-label"> Business Name</label>
                        <input type="text" class="form-control" wire:model.lazy="vendor_name"
                               placeholder="Business Name">
                        @error('vendor_name') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>
                    <div class="form-group">
                        <label for="abn" class="form-label">Enter ABN/ASIC</label>
                        <input type="text" class="form-control" wire:model.lazy="abn"
                               placeholder="Enter ABN / ASIC">
                        @error('abn') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label"> Email</label>
                        <input type="email" class="form-control" wire:model.lazy="email"
                               placeholder="Email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>
                    <div class="form-group">
                        <label for="contact_name" class="form-label"> Contact First Name</label>
                        <input type="text" class="form-control" wire:model.lazy="contact_name"
                               placeholder="Contact First Name">
                        @error('contact_name') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>
                    <div class="form-group">
                        <label for="contact_lastname" class="form-label"> Contact Last Name</label>

                        <input type="text" class="form-control" wire:model.lazy="contact_lastname"
                               placeholder="Contact Last Name">
                        @error('contact_lastname') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label"> Address</label>

                        <input type="text" class="form-control" wire:model.lazy="address"
                               placeholder="Address">
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>
                    <div class="form-group">
                        <label for="suburb" class="form-label"> Suburb</label>
                        <input type="text" class="form-control" wire:model.lazy="suburb"
                               placeholder="Suburb">
                        {{--                        @error('suburb') <span class="text-danger">{{ $message }}</span> @enderror--}}

                    </div>
                    <div class="form-group">
                        <label for="state" class="form-label"> State</label>
                        <input type="text" class="form-control" wire:model.lazy="state" placeholder="State">
                        @error('state') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>
                    <div class="form-group">
                        <label for="pc" class="form-label"> Postal Code</label>
                        <input type="text" class="form-control" wire:model.lazy="pc"
                               placeholder="Postal Code">
                        @error('pc') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>

                    <div class="form-group">
                        <label for="mobile" class="form-label"> Phone</label>
                        <input type="text" class="form-control" wire:model.lazy="mobile"
                               placeholder="Phone No ">
                        @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>

                    <div class="form-group">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" wire:model="is_pet_friendly"
                                   checked>
                            Is Pet Friendly
                        </label>

                        @error('is_pet_friendly') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>

                    <div class="form-group row mt-4">
                        <div class="col-md-9">
                            <input class="styled-checkbox" id="styled-checkbox-2" type="checkbox"
                                   wire:model="agreement">
                            <label for="styled-checkbox-2"> Agree to <a href="">Terms & Conditions</a>
                            </label>
                            @error('agreement') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div class="col-md-3 text-right">
                            <button type="submit" class="btn btn-success px-3">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>


</section>

