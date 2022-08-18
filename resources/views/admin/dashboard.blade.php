<div class="container">



    <div class="card my-4">
        <div class="card bg-danger">
            <div class="card-body">
                <h5 class="card-title">Account</h5>
                <p class="card-text">
                    @php
                        $shop = auth()->user()?->shop;
                    @endphp
                    @if(!$shop)
                        Please setup the shop. <a href="{{route('register-business.shop-setup')}}">Shop Setup</a>
                    @elseif(!$shop->stripe_account_id)
                        <a href="{{route('stripe.createAccount', $shop)}}">Please Create Account on stripe to received payment. Click here</a>
                    @elseif($shop->charges_enabled_at)
                        Please complete stripe connect onboarding flow to receive payment.
                        <a href="{{route('stripe.refreshUrl', $shop)}}" target="_blank">Click Here</a>
                    @endif
                </p>

            </div>
        </div>
    </div>

    <h3>Summary</h3>

    <ul class="list-group h4">
        <li class="list-group-item">
            Sales Today: $ {{$salesToday}}
        </li>
        <li class="list-group-item">
            Total Sales: $ {{$totalSales}}
        </li>

        <li class="list-group-item">
            Total Orders: {{$totalOrders}}
        </li>

        <li class="list-group-item">
            Customers: {{$customers}}
        </li>

        <li class="list-group-item">
            Likes : {{$likes}}
        </li>
    </ul>



</div>
