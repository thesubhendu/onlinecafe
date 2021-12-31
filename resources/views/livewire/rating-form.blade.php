<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#rating-form-modal">
        Rate the vendor
    </button>

    <!-- Modal -->
    <div class="modal fade" id="rating-form-modal" aria-labelledby="rating-form-modal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rate the vendor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
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

                </div>

            </div>
        </div>
    </div>

</div>
