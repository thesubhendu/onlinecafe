<!-- NAVBAR -->
<div class="middle-header">
    <div class="container">
        <div class="row">

            <!-- LOGO -->
            <div class="col-md-2 col-xs-12 mobile-nav text-right">
                <div class="middle-header-information">
                    <a class="navbar-brand" href="{{route('home')}}"><img
                            src="{{asset('assets/images/coffee-cup.png')}}">
                        {{ config('app.name', 'LaravelCoffee') }}
                    </a>
                </div>
                <div class="visible-xs mobile-nav">
                    <a href="{{ route('vendor-landing') }}" class="partner-with">Partner with Us</a>
                </div>

{{--                MOBILE Dropdown--}}
                <div class="dropdown login-dropdown visible-xs mobile-nav">
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

                            @can('visit-backend')
                                <a class="dropdown-item" href="{{route('platform.main')}}">Admin Panel</a>
                            @endcan
                            <a class="dropdown-item"  href="{{route('orders.index')}}">
                                My Orders
                            </a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"> Logout</i>
                                </button>
                            </form>



                        @endguest

                    </div>
                </div>

            </div>

            <!-- RIGHT CONTENT -->
            <div class="offset-4 col-md-6 col-xs-10  navbar-right xs-left hidden-xs">
                <ul class="cart">
                    <li>
                        <a href="{{ route('vendor-landing') }}">Partner with Us</a>
                    </li>
                    <li>
                        <a href="{{route('checkout.index')}}">
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

{{--                    DESKTOP dropdown--}}
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
                                        <a class="dropdown-item" href="{{route('vendor.show', auth()->user()->shop)}}">My
                                            Shop</a>

                                    @else
                                    @endif

                                    <a class="dropdown-item" href="{{route('orders.index')}}">My Orders</a>
                                    <a class="dropdown-item" href="{{route('user.likes')}}">My Cafes</a>
                                    <a class="dropdown-item" href="{{route('cards.index')}}">My Cards</a>

                                    @can('visit-backend')
                                        <a class="dropdown-item" href="{{route('platform.main')}}">Admin Panel</a>
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

<!-- FOOTER BOTTOM NAVIGATION Mobile -->
<div class="bottom-bar visible-md">
    <div class="container">
        <div class="row">
            @guest
                <div class="col">
                    <a class="dropdown-item" href="{{route('login')}}"> <i class="ti-user"></i> &nbsp;
                         Login</a>

                </div>

                <div class="col">
                    <a class="dropdown-item" href="{{route('register')}}"> <i class="ti-unlock"></i>
                        &nbsp;  Register</a>
                </div>

            @else
                @if (Cart::count())
                    <div class="col">
                        <a href="{{route('checkout.index')}}">
                            <i class="fa fa-shopping-cart"></i>
                            Your Cart

                                <span class="badge bg-success">{{ Cart::count() }}</span>
                        </a>
                    </div>
                @endif

                <div class="col">
                    <a href="{{route('user.likes')}}">
                        <i class="fa fa-coffee"></i>
                        My cafes
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('cards.index') }}">
                        <i class="fa fa-credit-card"></i>
                        My cards
                    </a>
                </div>


            @endguest


        </div>
    </div>
</div>
