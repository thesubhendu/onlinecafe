<div class="container">

    <div class="">
        <div class="row">
            <div class="col-sm">
                Order Number: {{$order->order_number}}
            </div>
            <div class="col-sm">
                Ordered By: {{$order->user->name}}
            </div>
            <div class="col-sm">
                Created At : {{$order->created_at->toDateTimeString()}}
            </div>
        </div>
    </div>

    <br>
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
                    @foreach (json_decode($product->pivot->options, true) as $key => $value )
                        {{$value}} <br>
                    @endforeach
                </td>
            @endforeach
        </tr>
        </tbody>
    </table>


    </ul>

</div>
