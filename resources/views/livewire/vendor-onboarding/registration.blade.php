<div>
    <x-breadcrumb></x-breadcrumb>
    <x-steps step="register"></x-steps>

    <section class="registration-steps">

        <div class="container">
            <div class="row">
                <x-message type="error"></x-message>
                <x-message type="message"></x-message>
            </div>
        </div>

        {{--        <div wire:loading.delay.longest.class.remove="d-none" class="d-none alert alert-wartning validator" role="status">--}}
        {{--            <div class="container">--}}
        {{--                <div class="row">--}}
        {{--                    <div class="alert alert-info">--}}
        {{--                        <strong>Validating ABN. Please Wait...</strong>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <div class="container">
            <div class="row">
                <div class="register-form">
                    <h4 class="">Register your business</h4>
                    <p>(Please keep photo of driving license with you) </p>

                    <div class="">
                        <form id="vendor-registration-form" wire:submit.prevent="submit" class="row">
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="vendor_name" class="form-label"> Business Name (Entity Name)</label>
                                <input type="text" class="form-control" wire:model.lazy="vendor_name"
                                       placeholder="Business Name">
                                @error('vendor_name') <span class="text-danger">{{ $message }}</span> @enderror

                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="abn" class="form-label">Enter ABN/ASIC</label>
                                <input type="text" class="form-control" wire:model.lazy="abn"
                                       placeholder="Enter ABN / ASIC">
                                @error('abn') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="email" class="form-label"> Email</label>
                                <input type="email" class="form-control" wire:model.lazy="email" placeholder="Email">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="contact_name" class="form-label"> Contact First Name</label>
                                <input type="text" class="form-control" wire:model.lazy="contact_name"
                                       placeholder="Contact First Name">
                                @error('contact_name') <span class="text-danger">{{ $message }}</span> @enderror

                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="contact_lastname" class="form-label"> Contact Last Name</label>

                                <input type="text" class="form-control" wire:model.lazy="contact_lastname"
                                       placeholder="Contact Last Name">
                                @error('contact_lastname') <span class="text-danger">{{ $message }}</span> @enderror

                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="address" class="form-label"> Address</label>

                                <input type="text" class="form-control" wire:model.lazy="address" placeholder="Address">
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror

                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="suburb" class="form-label"> Suburb</label>
                                <input type="text" class="form-control" wire:model.lazy="suburb" placeholder="Suburb">
                                {{-- @error('suburb') <span class="text-danger">{{ $message }}</span> @enderror--}}

                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="state" class="form-label"> State</label>
                                <input type="text" class="form-control" wire:model.lazy="state" placeholder="State">
                                @error('state') <span class="text-danger">{{ $message }}</span> @enderror

                            </div>
                            <div class="form-group col-lg-6 col-sm-12">
                                <label for="pc" class="form-label"> Postal Code</label>
                                <input type="text" class="form-control" wire:model.lazy="pc" placeholder="Postal Code">
                                @error('pc') <span class="text-danger">{{ $message }}</span> @enderror

                            </div>


                            <div class="form-group col-lg-6 col-sm-12 mb-5">
                                <label for="mobile" class="form-label"> Phone</label>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">+61</span>

                                    <input type="text" class="form-control" wire:model.lazy="mobile"
                                           placeholder="Phone No ">
                                    @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>

                            </div>
                            @if(!auth()->user())
                                <div class="form-group col-lg-6 col-sm-12 mb-5">
                                    <label for="mobile" class="form-label"> Password</label>
                                    <input type="password" class="form-control" wire:model.lazy="password"
                                           placeholder="Password ">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>

                                <div class="form-group col-lg-6 col-sm-12 mb-5">
                                    <label for="mobile" class="form-label"> Confirm Password</label>
                                    <input type="password" class="form-control" wire:model.lazy="password_confirmation"
                                           placeholder="Confirm Password ">
                                    @error('password_confirmation') <span
                                        class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @endif

                            <div class="form-group">
                                <div class="row">

                                    <div class="col-lg-3 col-sm-12 mb-4">
                                        <input class="styled-checkbox" id="styled-checkbox-2" type="checkbox"
                                               wire:model="agreement">
                                        <label for="styled-checkbox-2"> Agree to <a href="">Terms & Conditions</a>
                                        </label>
                                        @error('agreement') <span class="text-danger">{{ $message }}</span> @enderror

                                    </div>
                                    <div class="col-lg-3 col-sm-12 text-right">
                                        <button id="vendor-register-submit-button" type="submit" class="btn btn-success d-block" style="width:100%">
                                            Register
                                        </button>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 text-right"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>
</div>

