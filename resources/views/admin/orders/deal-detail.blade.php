<div class="container">

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

            @foreach($deal->products as $product)
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
