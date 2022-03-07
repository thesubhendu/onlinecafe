{{--<select wire:change="updateQty($event.target.value, '{{$item->rowId}}')" class="form-select">--}}
{{--    @foreach($options as $qty)--}}
{{--        <option--}}
{{--            value="{{$qty}}" {{$qty == $item->qty? 'selected' : ''}}>{{$qty}}</option>--}}
{{--    @endforeach--}}
{{--</select>--}}
<div class="control-btn ">
    <button type="button" class="value-button decrease"
            wire:click="updateQty('{{$item->rowId}}','{{$item->qty}}','remove')" value="Decrease Value">-
    </button>
    <input type="number" id="number" value="{{$item->qty}}"/>

    <button type="button" class="value-button increase" wire:click="updateQty('{{$item->rowId}}','{{$item->qty}}','add')"
            value="Increase Value">+
    </button>
</div>
