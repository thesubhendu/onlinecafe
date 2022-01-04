<h3>
    Hi {{$order->user->name}}
</h3>

Your order has been confirmed!
<h4>Ordered Items</h4>
<table class="table table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th>Qty</th>
        <th>Total Price</th>
        <th>Options</th>
    </tr>
    </thead>
    <tbody>
    <tr>

        @foreach($order->products as $product)
            <td>
                {{$product->name}}
            </td>
            <td>{{ $product->pivot->quantity}}</td>
            <td>
                {{$product->pivot->price}}
            </td>
            <td>
                @foreach(json_decode($product->pivot->options, true) as $id=>$name)
                    {{$name}} <br>
                @endforeach
            </td>
        @endforeach
    </tr>
    </tbody>
</table>


<p>
    Please head to vendor name goes here to collect your order.

    Payment will be required upon collection at <strong>{{$vendor->vendor_name}}

</p>

Thanks,<br>
{{ config('app.name') }}
