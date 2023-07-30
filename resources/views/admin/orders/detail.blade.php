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
                Created At : {{$order->created_at->diffForHumans()}}
            </div>

            @if(!empty($order->confirmed_at))
                <div class="col-sm">
                    Confirmed At : {{$order->confirmed_at->diffForHumans()}}
                </div>
            @endif
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

            @foreach($order->products as $product)
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

<script>
    const confirmButton = document.getElementById('order-confirm-button')

    confirmButton.addEventListener('click', () => {
       window.stopSound = true;
    })
</script>
