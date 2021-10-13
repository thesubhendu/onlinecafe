<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>my coffee</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1e6705f353.js" crossorigin="anonymous"></script>

    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
  {{-- < class="mb-4"> --}}
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
{{-- bottom Nav --}}
<nav class="navbar fixed-bottom navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="nav-link p-3" href="{{ route('orders.index') }}"><i id="ordersicon" class="fas fa-dollar-sign fa-lg"></i></a>
    <a class="nav-link p-3" href="{{ route('cards.index') }}"><i class="fas fa-id-card fa-lg"></i></a>
    <a class="nav-link p-3" href="{{ route('user.likes') }}"><i id="favicon" class="fas fa-coffee fa-lg"></i></a>
  </div>
</nav>
{{-- @guest
  <div id="showcase-register" class="user-register">
        <div class="showcase-content">
            <div class="">
              <h6>What! do you mean you dont have an account?</h6>
            </div>
            <P>Register here and you can order your coffee from anywhere with your favourite coffee shop</P>
            <div class="">
              <a class="btn btn-success px-3" href="{{ route('register') }}">Register</a>
            </div>
        </div>
  </div>
  @endguest --}}

{{--  validation error section--}}
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

    @yield('content')
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2021 mycofees.com.au</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>
