
<div class="mt-3">
        <div class="row">
            <div class="container mb-5">
                <div class="card-header">
                    <h2>Shop setup</h2>
                </div>

                <x-message type="error"></x-message>
                <x-message type="message"></x-message>

                <form wire:submit.prevent="submit">
                    <label for="form.shop_name" class="form-label"> Shop name</label>
                    <input class="form-control" type="text" wire:model.lazy="form.shop_name">
                    @error('form.shop_name') <span class="text-danger">{{ $message }}</span> @enderror

                    <label for="form.description" class="form-label">Description</label>
                    <textarea class="form-control"  wire:model.lazy="form.description"> </textarea>
                    @error('form.description') <span class="text-danger">{{ $message }}</span> @enderror


                    <div class="form-group">
                        <label for="logo" class="form-label">Logo</label>
                        <input class="form-control" type="file" wire:model="logo">
                        @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label for="form.opening_hours" class="form-label">Add Opening Hours</label>
                        <input class="form-control" type="text" wire:model="form.opening_hours">
                        @error('form.opening_hours') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>


                    <button type="submit" class="btn btn-success mt-2">Setup</button>
                </form>
            </div>
        </div>

    </div>

