<div>
    <x-message></x-message>

    <form wire:submit.prevent="submit" class="rating-form">

        <div class="form-group">
            <select wire:model="rating" class="form-control">
                <option value="">Select Rating Value</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <textarea wire:model="comment" rows="2" class="form-control" placeholder="Submit review ..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Submit</button>
        @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
    </form>

</div>
