<div>
    <x-message></x-message>

    <form wire:submit.prevent="submit" class="rating-form">
        <select wire:model="rating" class="form-select">
            <option value="">Select Rating Value</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
        <button type="submit" class="btn btn-primary">Submit</button>
        @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
    </form>
</div>
