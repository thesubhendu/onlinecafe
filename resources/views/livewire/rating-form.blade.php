<div>
    <x-message></x-message>

    <form wire:submit.prevent="submit">

        <label for="rating">Rating</label>
        <select wire:model="rating">
            <option value="">Select Value</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>

        @error('rating') <span class="text-danger">{{ $message }}</span> @enderror

        <button type="submit">Submit</button>

    </form>
</div>
