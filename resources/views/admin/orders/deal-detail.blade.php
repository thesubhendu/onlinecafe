<div class="container">

    <h4>Items</h4>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Qty</th>
            <th> Price</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>

            @foreach($deal->products as $product)
                <tr>
                    <td>
                        {{$product->name}}
                    </td>
                    <td>{{ $product->pivot->quantity}}</td>
                    <td>
                        {{$product->pivot->price}}
                    </td>
                    <td>
                        @include('components.product-options')

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    </ul>

</div>
