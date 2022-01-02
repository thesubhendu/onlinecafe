@component('mail::message')
    # Your customer
    <img class="img-fluid rounded-start" src="{{asset('storage/img/user/default_user.jpg')}}" alt="" height="50"
         width="50">

    {{auth()->user()->name}}
    # Submitted Order {{$order->id }}
    # Please click on the link below to confirm receipt of the order and view details, will then message {{auth()->user()->name}} to come and collect the order.
    @component('mail::panel')
        <div class="container">
            @foreach($order->products as $product)
                <div class="card" style="width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img class="img-fluid rounded-start" src="{{asset('storage/img/nostamp.png')}}" alt=""
                                 height="50"
                                 width="50">
                        </div>

                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">New Order</h5>
                                <p class="card-text">{{$product->pivot->quantity}} x {{$product->name}}</p>
                                @foreach (json_decode($product->pivot->options, true) as $key => $value )
                                    {{$value}} <br>
                                @endforeach

                                ## Total: ${{$product->pivot->price}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endcomponent

    @component('mail::button', ['url' => $url])
        Confirm Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
