@component('mail::message')
# Your customer {{auth()->user()->name}}
# Submitted Order {{$order->id }}
# Please click on the link below to confirm receipt of the order and view details. We will then message {{auth()->user()->name}} to come and collect the order.
@component('mail::panel')
    ## New Order

    @foreach($order->products as $product)

### {{$product->pivot->quantity}} x {{$product->name}}

@include('components.product-options')

@endforeach
# Order Total : ${{$order->order_total}}
@endcomponent

@component('mail::button', ['url' => $url])
    Confirm Order
@endcomponent

Thanks

{{ config('app.name') }}
@endcomponent
