
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

                    <div class="form-group">
                        <label for="form.description" class="form-label">Description</label>
                        <textarea class="form-control" wire:model.lazy="form.description"> </textarea>
                        @error('form.description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label for="logo" class="form-label">Logo</label>
                        <input class="form-control" type="file" wire:model="logo">
                        @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <strong class="h4 mb-3">Add Opening Hours</strong>

                    @foreach($daysInWeek as $day)
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">{{$day}}</label>
                            <div class="col-sm-3">
                                <select class="form-control" wire:model="form.opening_hours.{{$day}}.from">
                                    @foreach($openingHoursOptions as $option)
                                        <option>{{$option}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <select class="form-control" wire:model="form.opening_hours.{{$day}}.to">
                                    @foreach($openingHoursOptions as $option)
                                        <option>{{$option}}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if($day == 'Mon')
                                <div class="col-sm-3">
                                    <button type="button" wire:click.prevent="applyTimesToAllDays">+ Apply times to all
                                        days
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach


                    <button type="submit" class="btn btn-success mt-2">Setup</button>
                </form>
            </div>
        </div>

</div>

