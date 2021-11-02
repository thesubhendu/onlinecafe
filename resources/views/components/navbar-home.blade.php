<!-- NAVBAR -->
<div class="middle-header">
    <div class="container">
        <div class="row">

            <!-- LOGO -->
            <div class="col-md-2 ">
                <div class="middle-header-information">
                    <a class="navbar-brand" href="{{route('home')}}"><img
                            src="{{asset('assets/images/coffee-cup.png')}}">
                        {{ config('app.name', 'LaravelCoffee') }}
                    </a>
                </div>
            </div>

            <!-- SEARCH -->
            <div class="col-md-6">
                {{--                <div class="input-group mt-2">--}}
                {{--                    <input type="text" class="form-control" placeholder="Search your favourite coffee & coffee shop..."--}}
                {{--                           _vkenabled="true">--}}
                {{--                    <div class="input-group-append">--}}
                {{--                        <button class="btn btn-default" type="button">--}}
                {{--                            <i class="fa fa-search"></i>--}}
                {{--                        </button>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>

            <!-- RIGHT CONTENT -->
            <div class="col-md-4 text-right">
                <ul class="cart">
                    <li>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="ti-shopping-cart"></i>
                            <span class="badge">8</span>
                        </a>
                    </li>
                    <li>
                        <a href="wishlist.php">
                            <i class="ti-heart"></i>
                            <span class="badge">4</span>
                        </a>
                    </li>
                    <li>
                        <a href="profile-details.php">
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
