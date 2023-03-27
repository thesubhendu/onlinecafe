<div>
    <x-breadcrumb></x-breadcrumb>
    <x-steps step="shop-setup"></x-steps>

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
                            <div class="container">
                                <h4>
                                    <small>Choose your menus</small>
                                </h4>
                                <div class="form-group" data-toggle="buttons">
                                    @foreach($menus as $index => $menu)
                                        <label class="btn btn-default btn-sm toggle-checkbox">
                                            <input id="default" autocomplete="off" wire:model="menus.{{$index}}.isSelected"
                                                   type="checkbox" checked/>
                                            <small>{{$menu->name}}</small>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <h4>
                                    <small>Choose your options</small>
                                </h4>
                                <div class="form-group" data-toggle="buttons">
                                    @foreach($options as $index => $option)
                                        <label class="btn btn-default btn-sm toggle-checkbox">
                                            <input id="default" autocomplete="off" wire:model="options.{{$index}}.isSelected"
                                                   type="checkbox" checked/>
                                            {{$option->name}}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-2 px-5">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

