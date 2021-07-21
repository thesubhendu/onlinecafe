@component('mail::message')avatar}}
# Your customer <img class="img-fluid rounded-start" src="{{asset('storage/img/user/default_user.jpg')}}" alt="" height="50" width="50"> {{auth()->user()->name}}
# Submitted Order {{$order->id }} 
# please click on the link below to confirm receipt of the order, will then message {{auth()->user()->name}} to come a collect the order.
@component('mail::panel')
<div class="container">
  
  @foreach($order->products as $product) 
  <div class="card" style="width: 540px;">
      <div class="row g-0">
        <div class="col-md-4">
          <img class="img-fluid rounded-start" src="{{asset('storage/img/nostamp.png')}}" alt="" height="50" width="50">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">New Order</h5>
          <p class="card-text">{{$product->pivot->quantity}} x {{$product->productName}}</p>
          <span class="card-text text-muted">{{$product->pivot->milk}}, Suagrs - {{$product->pivot->sugar}}, Syrup - {{$product->pivot->syrup}}</span>
          <p class="card-text">Total: ${{$product->pivot->price}}</p>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endcomponent

@component('mail::button', ['url' => 'laracelcoffee.test'])
Confirm Order
@endcomponent
{{$product}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

