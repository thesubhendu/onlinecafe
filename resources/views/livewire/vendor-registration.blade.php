<div>
    <div class="row">
        <div class="container mb-5">
            <div class="card-header">
                <h1>Register your business</h1>
            </div>

            <form wire:submit.prevent="register">
                <label for="name" class="form-label"> Business Name</label>
                <input class="form-control" type="text" wire:model="name">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                <label for="abn" class="form-label">Enter ABN/ASIC</label>
                <input class="form-control" type="text" wire:model="abn">
                @error('abn') <span class="text-danger">{{ $message }}</span> @enderror

                <label for="email" class="form-label"> Email</label>
                <input class="form-control" type="text" wire:model="email">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror


                <label for="phone" class="form-label"> Phone</label>
                <input class="form-control" type="number" wire:model="phone">
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
