<select wire:change="updateQty($event.target.value, '{{$item['rowId']}}')" class="form-select">
    @foreach($options as $qty)
        <option
            value="{{$qty}}" {{$qty == $item['qty']? 'selected' : ''}}>{{$qty}}</option>
    @endforeach
</select>
