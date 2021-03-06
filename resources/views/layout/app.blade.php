<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>my coffee</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1e6705f353.js" crossorigin="anonymous"></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

     

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

    </style>
    <!-- Custom styles for this template -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
  </head>
  <body>
  {{-- < class="mb-4"> --}}
    <!-- Image and text -->
  <nav class="navbar navbar-dark bg-dark d-flex flex-row">
  <a class="navbar-brand" href="/">
    <img src="/storage/img/nostamp.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
    my coffee
  </a>
  <ul class="navbar-nav ml-auto ">
    <div class="d-flex flex-row">
      <li class="nav-item nav-right">
          <a class="nav-link p-3" href="/" class="text-sm text-gray-700 underline">Home</a>
      </li>
      @auth
      <li class="nav-item nav-right">
        <a class="nav-link p-3" href="{{ route('cart')}}" class="text-sm text-gray-700 underline"> <i class="fas fa-shopping-cart"></i>@if (Cart::instance('default')->count() > 0)<span class="badge bg-light text-dark"> {{Cart::instance('default')->count()}}</span>@endif</a>
    </li>
    @endauth
      @auth
      <li class="nav-item nav-right">
        {{-- <a class="nav-link" href=""><i class="fas fa-user-circle"> </i></a> --}}
        <li class="nav-item nav-right dropdown">
          <a class="nav-link dropdown-toggle p-3" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"> </i> {{ auth()->user()->name }}</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <!-- <a class="dropdown-item" href="#"><i class="far fa-folder"> Admin</i></a> -->
            <a class="dropdown-item p-3" href="#"><i class="fas fa-cog"> Settings</i></a>
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"> logout</i></button>
            </form>
          </div>
      </li>
      </li>
      @endauth
      @guest
      <li class="nav-item nav-right">
        <a class="nav-link p-3" href="{{ route('register') }}">Register</a>
      </li>
      <li class="nav-item nav-right">
        {{-- <a class="nav-link" href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a> --}}
        <a class="nav-link p-3" href="{{ route('login') }}">Login</a>
      </li>
      @endguest
    </div>
  </ul>
</nav>
{{-- bottom Nav --}}
<nav class="navbar navbar-expand-md fixed-bottom navbar-dark bg-dark justify-content-between mt-4">
    <!-- <a class="nav-link" href="index.html"><i id="homeicon" class="fa fa-home"><span class="sr-only">(current)</span></i></a> -->
    <a class="nav-link" href="{{ route('orders') }}"><i id="ordersicon" class="fas fa-dollar-sign fa-lg"></i></a>
    <a class="nav-link" href="{{ route('cards') }}"><i class="fas fa-id-card fa-lg"></i></a>
    <a class="nav-link" href="{{ route('user.likes') }}"><i id="favicon" class="fas fa-coffee fa-lg"></i></a>
</nav>
    @yield('content')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script></body>
</body>
</html>
