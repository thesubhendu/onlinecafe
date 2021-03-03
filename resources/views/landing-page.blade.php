
{{-- <!doctype html>
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
  <body class="mb-4">
      <!-- Image and text -->
    <nav class="navbar navbar-dark bg-dark flex justify-between">
    <a class="navbar-brand" href="/">
      <img src="storage/img/nostamp.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
      my coffee
    </a>
    <ul class="navbar-nav ml-auto flex">
      <div>
      <li class="nav-item nav-right">
            <a class="nav-link" href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
        </li>
        @auth
        <li class="nav-item nav-right">
          {{-- <a class="nav-link" href=""><i class="fas fa-user-circle"> </i></a> --}}
          {{-- <li class="nav-item nav-right dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"> </i> {{ auth()->user()->name }}</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01"> --}}
              <!-- <a class="dropdown-item" href="#"><i class="far fa-folder"> Admin</i></a> -->
              {{-- <a class="dropdown-item" href="#"><i class="fas fa-cog"> Settings</i></a>
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
          <a class="nav-link" href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
        </li>
        <li class="nav-item nav-right"> --}}
          {{-- <a class="nav-link" href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a> --}}
          {{-- <a class="nav-link" href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>
        </li>
        @endguest
      </div>
    </ul>
  </nav> --}}
{{-- bottom Nav --}}
  {{-- <nav class="navbar navbar-expand-md fixed-bottom navbar-dark bg-dark justify-content-between mt-4">
      <!-- <a class="nav-link" href="index.html"><i id="homeicon" class="fa fa-home"><span class="sr-only">(current)</span></i></a> -->
      <a class="nav-link" href="orders.html"><i id="ordersicon" class="fas fa-dollar-sign fa-lg"></i></a>
      <a class="nav-link" href="cards.html"><i class="fas fa-id-card fa-lg"></i></a>
      <a class="nav-link" href="favourites.html"><i id="favicon" class="fas fa-coffee fa-lg"></i></a>
</nav> --}}
@extends('layout.app')
@section('content')
<main role="main" class="container mb-5">
  <div class="vendor-index mt-4">
    <div class="vendor-view d-flex flex-row justify-content-between card-header mb-3 mt-4">
      <div class="">
          <img src="storage/img/nostamp.png" width="50" height="50" alt="">
      </div>
      <div>
          <h1>My Coffee</h1>
      </div>
      <div>
          <!-- <a href="index.html" class="btn btn-success">go back</a> -->
      </div>
  </div>
      @foreach ($vendors as $vendor)
        <div class="card mb-3">
            <img src="storage/img/cafe1.jpg" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{$vendor->vendor_name}}</h5>
              <span class="card-text fa fa-star checked"></span>
                <span class="card-text fa fa-star checked"></span>
                <span class="card-text fa fa-star checked"></span>
                <span class="card-text fa fa-star"></span>
                <span class="card-text fa fa-star"></span><span class="badge badge-pill badge-success"> 3.0</span>
              <p class="card-text">{{$vendor->suburb}}</p>
              <a id="menubtn" href="{{route( 'vendor.products', $vendor )}}" class="btn btn-success btn-sm">Menu</a>
              <a id="vendorbtn" href="{{route('vendor.show', $vendor)}}" class="homeScreenVendors btn btn-secondary btn-sm">View</a>
                <a id="addCommentbtn" href="#" class="homeScreenViewComment btn btn-secondary btn-sm"><i class="fas fa-comment-dots" ></i></a>
                <a id="addRatingBtn" href="#" class="homeScreenRating btn btn-secondary btn-sm"><i class="fas fa-star" ></i></a>
                <div class="flex">
                  @auth
                  @if (!$vendor->likedBy(auth()->user()))
                    <form action="{{ route('vendor.likes', $vendor) }}" method='post'>
                      @csrf 
                    <button id="fav_like" type="submit" class="fav_like float-right"><span class="fas fa-coffee fa-lg"></span></button>
                    </form>
                  @else
                    <form action="{{ route('vendor.likes', $vendor->id) }}" method='post'>
                      @csrf
                      @method('DELETE')
                    <button id="fav_unlike" type="submit" class="fav_unlike float-right"><span class="fas fa-coffee fa-lg"></span></button>
                    </form>
                  @endif
                  @endauth
              </div>
                <p class="card-text"><small class="text-muted">last updated {{$vendor->updated_at->diffForHumans()}}</small></p>
            </div>
          </div>
      @endforeach
  </div>
</main><!-- /.container -->
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script></body>
</body>
</html> --}}