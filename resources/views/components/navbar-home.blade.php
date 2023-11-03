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
                    @guest()
                        <a href="{{ route('register-business.create') }}" class="partner-with">Partner with Us</a>
                    @endguest
                </div>

{{--                MOBILE Dropdown--}}
                <div class="dropdown login-dropdown visible-xs mobile-nav">
                    <a data-bs-toggle="dropdown" class="user-thumbnail">
                        <img src="/assets/images/images.jpg" alt="">
                    </a>
                    <div class="dropdown-menu">
                        @guest
                            <a class="dropdown-item" href="{{route('login')}}"> <i class="ti-user"></i> &nbsp;
                                Login</a>
{{--                            <a class="dropdown-item" href="{{route('register')}}"> <i class="ti-unlock"></i> &nbsp;--}}
{{--                                Register</a>--}}
                        @else

                            @can('visit-backend')
                                <a class="dropdown-item" href="{{route('login')}}">Admin Panel</a>
                                <a class="dropdown-item" href="{{route('download-customer-flyer')}}">Download Flyer</a>
                            @endcan

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
                        @guest()
                            <a href="{{ route('register-business.create') }}">Partner with Us</a>

                        @endguest
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
                                         Login</a>
{{--                                    <a class="dropdown-item" href="{{route('register')}}"> <i class="ti-unlock"></i>--}}
{{--                                        &nbsp;  Register</a>--}}
                                @else


                                    @can('visit-backend')
                                        <a class="dropdown-item" href="{{route('filament.admin.pages.dashboard')}}">Admin Panel</a>
                                        <a class="dropdown-item" href="{{route('download-customer-flyer')}}">Download Flyer</a>
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


