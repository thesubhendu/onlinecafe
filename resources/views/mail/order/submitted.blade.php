@component('mail::message')
# Order Submitted

@foreach($order->products as $product) 
<div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">New Order</h5>
      <p class="card-text">{{$product->productName}}</p>
      <p class="card-text">${{$product->pivot->price}}</p>
      <p class="card-text">Qty; {{$product->pivot->quantity}}</p>
      <div><span class="card-text text-muted">{{$product->pivot->milk}}, Suagrs - {{$product->pivot->sugar}}, Syrup - {{$product->pivot->syrup}}</span></div>
      <p class="card-text">Total: ${{$product->pivot->price}}</p>
      <a href="#" class="card-link btn btn-dark">Confirm order</a>
    </div>
</div>
@endforeach

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
