<div class="container">

    <p>
        Order Number: {{$order->order_number}}
    </p>


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
                    {{$product->pivot->options}}
                </td>
            @endforeach
        </tr>
        </tbody>
    </table>


    </ul>

</div>
