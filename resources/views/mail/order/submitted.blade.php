@component('mail::message')
# Order Submitted

@foreach($order->products as $product) 
<div class="card" style="width: 18rem;">
    <div class="card-body">
      {{$product}}
      <h5 class="card-title">New Order</h5>
      <img src="{{asset('storage/img/nostamp.png')}}" alt="" height="50" width="50">
      <p class="card-text">{{$product->pivot->quantity}} x {{$product->productName}}</p>
      <div><span class="card-text text-muted">{{$product->pivot->milk}}, Suagrs - {{$product->pivot->sugar}}, Syrup - {{$product->pivot->syrup}}</span></div>
      <div>
        <p class="card-text">Total: ${{$product->pivot->price}}</p>
      </div>
      <a href="#" class="card-link btn btn-dark">Confirm order</a>
    </div>
</div>
@endforeach

@component('mail::button', ['url' => ''])
Confirm Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
