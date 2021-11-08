<!-- NAVBAR -->
<div class="middle-header">
    <div class="container">
        <div class="row">

            <!-- LOGO -->
            <div class="col-md-2 col-xs-12 text-right">
                <div class="middle-header-information">
                    <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('assets/images/coffee-cup.png')}}">
                        {{ config('app.name', 'LaravelCoffee') }}
                    </a>
                </div>
                <div class="dropdown login-dropdown visible-xs">
                        <a data-bs-toggle="dropdown" class="user-thumbnail">
                            <img src="/assets/images/images.jpg" alt="">
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"> <i class="ti-user"></i> &nbsp; User Login</a>
                            <a class="dropdown-item" href="#"> <i class="ti-unlock"></i> &nbsp; User Register</a>
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
                        <a href="#" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="ti-shopping-cart"></i>
                            <span class="badge">8</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="ti-heart"></i>
                            <span class="badge">4</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="ti-user"></i>
                        </a>
                    </li>
                    <li class="register">
                        <div class="dropdown login-dropdown">
                            <a data-bs-toggle="dropdown">
                                Login / Register &nbsp;<i class="ti-angle-down"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"> <i class="ti-user"></i> &nbsp; User Login</a>
                                <a class="dropdown-item" href="#"> <i class="ti-unlock"></i> &nbsp; User Register</a>
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