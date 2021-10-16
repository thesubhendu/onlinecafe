<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>my coffee</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1e6705f353.js" crossorigin="anonymous"></script>

    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <script src="https://js.stripe.com/v3/"></script>
      @livewireStyles

  </head>
  <body>

  <x-navbar></x-navbar>

{{-- bottom Nav --}}
<nav class="navbar fixed-bottom navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="nav-link p-3" href="{{ route('orders.index') }}"><i id="ordersicon" class="fas fa-dollar-sign fa-lg"></i></a>
    <a class="nav-link p-3" href="{{ route('cards.index') }}"><i class="fas fa-id-card fa-lg"></i></a>
    <a class="nav-link p-3" href="{{ route('user.likes') }}"><i id="favicon" class="fas fa-coffee fa-lg"></i></a>
  </div>
</nav>

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

  <x-footer></x-footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

  @livewireScripts
  </body>
</html>
