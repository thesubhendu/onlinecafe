<!-- Image and text -->
<nav class="navbar navbar-dark bg-dark d-flex flex-row">
    <div class="">
        <a class="navbar-brand" href="/">
            <img src="/storage/img/nostamp.png" class="" alt="..." width="48" height="48">
            <div class="small">
                {{ config('app.name', 'LaravelCoffee') }}
            </div>
            {{-- d-sm-none .d-md-block --}}
        </a>
    </div>
    <ul class="navbar-nav ml-auto">
        <div class="d-flex flex-row">
            <li class="nav-item nav-right">
                <a class="nav-link p-3" href="/" class="text-sm text-gray-700 underline">Home</a>
            </li>
            @guest
                <li class="nav-item nav-right">
                    <a class="btn btn-outline-success p-3" href="{{ route('register') }}">Register</a>
                </li>
                <li class="nav-item nav-right">
                    <a class="nav-link p-3" href="{{ route('login') }}">Login</a>
                </li>
            @endguest
            @auth
                <li class="nav-item nav-right">
                    <a class="nav-link p-3" href="{{ route('cart')}}" class="text-sm text-gray-700 underline"> <i class="fas fa-shopping-cart"></i>@if (Cart::instance('default')->count() > 0)<span class="badge bg-light text-dark"> {{Cart::instance('default')->count()}}</span>@endif</a>
                </li>
            @endauth
            @auth
                <li class="nav-item nav-right">
                    {{-- <a class="nav-link" href=""><i class="fas fa-user-circle"> </i></a> --}}
                </li>
                <li class="nav-item nav-right dropdown">
                    <a class="nav-link dropdown-toggle p-3" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/storage/img/users/{{ Auth::user()->avatar}}" class="mb-3 px-auto" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%;"> {{ auth()->user()->name }}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <!-- <a class="dropdown-item" href="#"><i class="far fa-folder"> Admin</i></a> -->
                        <a class="dropdown-item p-3" href="{{ route('subscriptions.plans') }}"><i class="fas fa-file-invoice-dollar"> Plans</i></a> <!--should only been seen if account is a vendor role-->
                        <a class="dropdown-item p-3" href="{{ route('account') }}"><i class="fas fa-cog"> Account</i></a>
                        <a class="dropdown-item p-3" href="#"><i class="fas fa-cog"> Settings</i></a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"> logout</i></button>
                        </form>
                    </div>
                </li>
            @endauth
        </div>
    </ul>
</nav>
