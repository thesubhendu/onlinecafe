<section class="payment-form">
    <div class="container">

        <x-message type="error"></x-message>
        <x-message type="message"></x-message>

        <div class="row">

            <div class="card-header">
                <h2>Shop setup</h2>
            </div>

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

                <br>

                <hr>
                <p class="h4 mb-2">Shop Opening Hours</p>

                @foreach($daysInWeek as $day)
                    <div class="row mb-3">
                        <input type="checkbox" class="form-check-input"
                               wire:model="form.opening_hours.{{$day}}.is_active"
                               checked>
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

                        @if($day == 'Monday')
                            <div class="col-sm-3">
                                <button type="button" wire:click.prevent="applyTimesToAllDays">+ Apply times to all
                                    days
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach

                <section class="menu-section my-4">
                    <hr>
                    <h3>Choose your menus</h3>

                    @foreach ($menus as $index=>$menu)
                        <div class="form-group">
                            <input type="checkbox" class="form-check-input"
                                   wire:model="menus.{{$index}}.isSelected"
                                   checked>
                            <label for=""> {{$menu->name}}</label>

                            $ <input style="display:inline-block" type="text" wire:model="menus.{{$index}}.price"
                                     placeholder="price">
                        </div>
                    @endforeach


                </section>
                <section class="menu-option-section my-4">
                    <hr>

                    <div class="mt-5">
                        <h6 class="mb-4">Choose your options</h6>

                        <div class="row">
                            @foreach ($options as $index=>$menu)

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="checkbox" class="form-check-input"
                                               wire:model="options.{{$index}}.isSelected"
                                               checked>
                                        <label for="">{{$menu->name}}</label>
                                        $ <input style="display:inline-block" type="number" step='any'
                                                 placeholder="price"
                                                 wire:model="options.{{$index}}.price">
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>


                </section>


                <button type="submit" class="btn btn-success mt-2">Setup</button>
            </form>

        </div>
    </div>
</section>


