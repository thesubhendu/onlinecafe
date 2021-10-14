@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <ul class="nav flex-column mb-4">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account') }}">Account</a>
                </li>
            </ul>

            <ul class="nav flex-column mb-4">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account.subscriptions')}}">Subscription</a>
                </li>
                @if (auth()->user()->subscribed('subscribed'))
                    @can('cancel', auth()->user()->subscription('subscribed'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('account.subscriptions.cancel')}}">Cancel subscription</a>
                        </li>
                    @endcan
                    @can('resume', auth()->user()->subscription('subscribed'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('account.subscriptions.resume')}}">Resume subscription</a>
                        </li>
                    @endcan
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account.subscriptions.invoices')}}">Invoices</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account.subscriptions.swap')}}">Swap subscription</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account.subscriptions.card')}}">Update Card</a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            @yield('account')
        </div>
    </div>
</div>
@endsection
