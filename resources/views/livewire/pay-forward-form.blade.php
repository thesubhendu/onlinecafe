<div>
    <div class="mt-2">

        <form wire:submit.prevent="send">
            <label for="email">Email of User</label>
            <input type="email" wire:model="email">

            @error('email') <span class="text-danger">{{ $message }}</span> @enderror


            <button type="submit">Send</button>
        </form>

        <p wire:loading.delay.long>Sending Please Wait...</p>

        @if($feedbackMessage)
            {{$feedbackMessage}}
        @endif
    </div>
</div>
