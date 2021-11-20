<!-- NAVBAR -->
<div class="middle-header">
    <div class="container">
        <div class="row">

            <!-- LOGO -->
            <div class="col-md-2 col-xs-12 text-right">
                <div class="middle-header-information">
                    <a class="navbar-brand" href="{{route('home')}}"><img
                            src="{{asset('assets/images/coffee-cup.png')}}">
                        {{ config('app.name', 'LaravelCoffee') }}
                    </a>
                </div>
                <div class="dropdown login-dropdown visible-xs">
                    <a data-bs-toggle="dropdown" class="user-thumbnail">
                        <img src="/assets/images/images.jpg" alt="">
                    </a>
                    <div class="dropdown-menu">
                        @guest
                            <a class="dropdown-item" href="{{route('login')}}"> <i class="ti-user"></i> &nbsp; User
                                Login</a>
                            <a class="dropdown-item" href="{{route('register')}}"> <i class="ti-unlock"></i> &nbsp; User
                                Register</a>
                        @else
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"> logout</i>
                                </button>
                            </form>
                        @endguest

                    </div>
                </div>

            </div>

            <!-- RIGHT CONTENT -->
            <div class="offset-4 col-md-6 col-xs-10 text-right xs-left hidden-xs">
                <ul class="cart">
                    <li>
                        <a href="{{ route('register-business.create') }}">Partner with Us</a>
                        {{-- <a href="{{ route('subscriptions.plans') }}">Partner with Us</a>--}}{{-- todo make vendor landing page --}}
                    </li>
                    <li>
                        <a href="{{route('cart')}}">
                            <i class="ti-shopping-cart"></i>
                            @if (Cart::count())
                                <span class="badge">{{ Cart::count() }}</span>
                            @endif
                        </a>
                    </li>

                    <li>
                        <a href="{{route('profile.show')}}">
                            <i class="ti-user"></i>
                        </a>
                    </li>
                    <li class="register">
                        <div class="dropdown login-dropdown">
                            <a data-bs-toggle="dropdown">
                                @guest Login / Register @else {{auth()->user()->name}} @endguest &nbsp;<i
                                    class="ti-angle-down"></i>
                            </a>
                            <div class="dropdown-menu">
                                @guest
                                    <a class="dropdown-item" href="{{route('login')}}"> <i class="ti-user"></i> &nbsp;
                                        User Login</a>
                                    <a class="dropdown-item" href="{{route('register')}}"> <i class="ti-unlock"></i>
                                        &nbsp; User Register</a>
                                @else
                                    @if(auth()->user()->shop)
                                        <a class="dropdown-item" href="{{route('vendor.show', auth()->user()->shop)}}">My Shop</a>

                                        @else
                                    @endif

                                    <a class="dropdown-item" href="{{route('orders.index')}}">My Orders</a>

                                    @can('visit-backend')
                                        <a class="dropdown-item" href="{{url('/admin')}}">Admin Panel</a>
                                    @endcan

                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt">
                                                logout</i>
                                        </button>
                                    </form>
                                @endguest
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER BOTTOM NAVIGATION -->
<div class="bottom-bar visible-xs">
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="">
                    <i class="fa fa-shopping-cart"></i>
                    Your Cart
                </a>
            </div>
            <div class="col">
                <a href="">
                    <i class="fa fa-heart-o"></i>
                    Favourites
                </a>
            </div>
            <div class="col">
                <a href="{{ route('register-business.create') }}">
                    <i class="fa fa-users"></i>
                    Partner With Us
                </a>
            </div>
        </div>
    </div>
</div>
