<section class="payment-form registration-steps ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <x-message type="error"></x-message>
                <x-message type="message"></x-message>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shop-setup-card">
                    <form wire:submit.prevent="submit">

                        <div class="form-part">
                            <h2 class="title">Shop setup</h2>
                            <div class="form-group">
                                <label for="form.shop_name" class="form-label"> Shop name</label>
                                <input class="form-control" type="text" wire:model.lazy="form.shop_name">
                                @error('form.shop_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
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
                        </div>

                        <div class="opening-hours form-part">
                            <h2 class="title">Shop Opening Hours</h2>
                            @foreach($daysInWeek as $day)
                                <div class="row mb-3 day-select">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input type="checkbox" class="form-check-input"
                                                    wire:model="form.opening_hours.{{$day}}.is_active"
                                                    checked>
                                                <label for="inputEmail3">{{$day}}</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <select class="form-control" wire:model="form.opening_hours.{{$day}}.from">
                                                    @foreach($openingHoursOptions as $option)
                                                        <option>{{$option}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <select class="form-control" wire:model="form.opening_hours.{{$day}}.to">
                                                    @foreach($openingHoursOptions as $option)
                                                        <option>{{$option}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        @if($day == 'Monday')
                                                <button type="button" class="btn btn-primary" wire:click.prevent="applyTimesToAllDays">+ Apply times to all
                                                    days
                                                </button>
                                        @endif
                                    </div>



                                </div>
                            @endforeach
                        </div>

                        <div class="menu-section form-part">
                            <h2 class="title">Choose your menus</h2>
                            <div class="row">
                                @foreach ($menus as $index=>$menu)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="checkbox" class="form-check-input"
                                                wire:model="menus.{{$index}}.isSelected"
                                                checked>


                                            <label for=""> {{$menu->name}}</label>

                                            $ <input style="display:inline-block" type="text" class="form-control" wire:model="menus.{{$index}}.price"
                                                    placeholder="price">

                                        <input type="checkbox" class="form-check-input" wire:model="menus.{{$index}}.is_stamp" checked>
                                                        Is Stamp?
                                                    </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>



                        <div class="menu-option-section form-part">
                            <h2 class="title">Choose your options</h6>
                            <div class="row">
                                @foreach ($options as $index=>$menu)

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="checkbox" class="form-check-input"
                                                wire:model="options.{{$index}}.isSelected"
                                                checked>
                                            <label for="">{{$menu->name}}</label>
                                            $ <input style="display:inline-block" class="form-control" type="number" step='any'
                                                    placeholder="price"
                                                    wire:model="options.{{$index}}.price">
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mt-2 px-5">Setup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


