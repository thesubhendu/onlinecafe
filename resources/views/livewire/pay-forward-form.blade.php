<div>
    <div>
        <form wire:submit.prevent="send" class="pay-forward-form">
            <label for="email">Email of User</label>
            <input type="email" wire:model="email" class="form-control">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
        <p wire:loading.delay.long>Sending Please Wait...</p>
        @if($feedbackMessage)
            {{$feedbackMessage}}
        @endif
    </div>
</div>
