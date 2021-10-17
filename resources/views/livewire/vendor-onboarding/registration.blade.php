<div class="mt-3">
    <div class="row">
        <div class="container mb-5">
            <div class="card-header">
                <h1>Register your business</h1>
            </div>

            <x-message type="error"></x-message>
            <x-message type="message"></x-message>


            <div wire:loading.delay.class.remove="d-none" class="d-none text-primary my-3 h3" role="status">
                Validating ABN. Please Wait...
            </div>

            <form wire:submit.prevent="register">
                <label for="name" class="form-label"> Business Name</label>
                <input class="form-control" type="text" wire:model.lazy="name">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                <label for="abn" class="form-label">Enter ABN/ASIC</label>
                <input class="form-control" type="text" wire:model.lazy="abn">
                @error('abn') <span class="text-danger">{{ $message }}</span> @enderror

                <label for="email" class="form-label"> Email</label>
                <input class="form-control" type="email" wire:model.lazy="email">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                <br>

                <label for="contactName" class="form-label"> Contact First Name</label>
                <input class="form-control" type="text" wire:model.lazy="contactName">
                @error('contactName') <span class="text-danger">{{ $message }}</span> @enderror

                <label for="contactLastName" class="form-label"> Contact Last Name</label>
                <input class="form-control" type="text" wire:model.lazy="contactLastName">
                @error('contactLastName') <span class="text-danger">{{ $message }}</span> @enderror


                <label for="address" class="form-label"> Address</label>
                <input class="form-control" type="text" wire:model.lazy="address">
                @error('address') <span class="text-danger">{{ $message }}</span> @enderror


                <label for="suburb" class="form-label"> Suburb</label>
                <input class="form-control" type="text" wire:model.lazy="suburb">
                @error('suburb') <span class="text-danger">{{ $message }}</span> @enderror


                <label for="state" class="form-label"> State</label>
                <input class="form-control" type="text" wire:model.lazy="state">
                @error('state') <span class="text-danger">{{ $message }}</span> @enderror


                <label for="pc" class="form-label"> Postal Code</label>
                <input class="form-control" type="number" wire:model.lazy="pc">
                @error('pc') <span class="text-danger">{{ $message }}</span> @enderror

                <label for="cardstamps" class="form-label"> Card Stamps</label>
                <input class="form-control" type="number" wire:model.lazy="cardstamps">
                @error('cardstamps') <span class="text-danger">{{ $message }}</span> @enderror


                <label for="phone" class="form-label"> Phone</label>
                <input class="form-control" type="number" wire:model.lazy="phone">
                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror

                <div class="form-check m-2" >
                    <input class="form-check-input" type="checkbox" wire:model="agreement" />
                    <label class="form-check-label" for="invalidCheck">
                        Agree to  <a style="color:#0056b3 !important;" href="#">terms and conditions</a>
                    </label>
                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                    @error('agreement') <span class="text-danger">{{ $message }}</span> @enderror
                </div>


                <button type="submit" class="btn btn-success mt-2">Register</button>
            </form>
        </div>
    </div>

</div>
