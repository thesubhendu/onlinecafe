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
                            <textarea wire:model="comment" rows="2" class="form-control"
                                      placeholder="Submit review ..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Submit</button>
        @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
    </form>

    <div class="mt-3 comment-section">
        <h5>Comments (1) </h5>

        <ul class="comments">
            @forelse($vendor->ratings as $rating)
                <li class="comment-list">
                   <span class="user-name"> <i class="fa fa-user"></i> {{$rating->author->name}} </span>
                   <span class="rating">{{$rating->rating}} <i class="fa fa-coffee"></i> </span>
                    <div class="comment">{{$rating->comment}}</div>
                </li>
            @empty
                <li class="no-comment">No Comments yet</li>
            @endforelse
        </ul>
    </div>

    @push('scripts')
        <script>

            Livewire.on('rated', function () {
                $('#rating-form-modal .btn-close').click()

            })
        </script>
    @endpush
</div>
