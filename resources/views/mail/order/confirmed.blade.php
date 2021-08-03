@component('mail::message')
# whoo! {{auth()->user()->name}},

your order 
@foreach($order->products as $product)
<p class="card-text">{{$product->pivot->quantity}} x {{$product->productName}}</p>
<span class="card-text text-muted">{{$product->pivot->milk}}, Suagrs - {{$product->pivot->sugar}}, Syrup - {{$product->pivot->syrup}}</span>
<p class="card-text">Total: ${{$product->pivot->price}}</p>
@endforeach

# has been confirmed!

Please head to vendor name goes here to collect your order.

<div class="alert alert-danger" role="alert">
    Payment will be required upon collection at <strong>{{$vendor->vendor_name}}</strong>
</div>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
