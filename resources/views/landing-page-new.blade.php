@extends('layout.app')
@section('content')
{{-- <!doctype html>
<html lang="en">
  <head> --}}
    <!-- Required meta tags -->
    {{-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="/css/style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1e6705f353.js" crossorigin="anonymous"></script> --}}

    {{-- <title>MyCoffee Concept</title>
  </head>
  <body> --}}
    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="/img/nostamp48x48.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                My Coffees
              </a> --}}
          <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> -->
          {{-- <div class="navbar navbar-expand-md navbar-right d-flex justify-content-between px-2">
            <a class="px-2" href="#"><i class="fas fa-sign-in-alt px-1"></i>Login</a>
            <a class="px-2" href="#"><i class="fas fa-user-circle px-1"></i>Register</a>
          </div>
        </div>
        <nav class="navbar navbar-expand-md fixed-bottom navbar-light bg-light justify-content-between px-2"> --}}
          <!-- <a class="" href="index.html"><i class="fas fa-home"></i></a> -->
          {{-- <a class="" href="orders.html"><i class="fas fa-dollar-sign fa-lg"></i></a> <!--{{ route('orders') }}-->
          <a class="" href="cards.html"><i class="fas fa-id-card fa-lg"></i></a> <!--{{ route('cards') }}-->
          <a class="" href="favourites.html"><i class="fas fa-coffee fa-lg"></i></a> <!--{{ route('user.likes') }}-->
        </nav>
      </nav> --}}
      <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
              @foreach ($vendors as $vendor)
                <div class="card h-100">
                  <a class="vendor-card" href="{{ route('vendor.show', $vendor) }}">
                    <img src="(/storage/img/vendor/cafe1.jpg)" class="card-img-top" alt="...">
                  </a>
                  {{-- @foreach ($vendors as $vendor) --}}
                    <div class="card-body">
                        <h5 class="card-title">{{$vendor->vendor_name}}</h5>
                        <p class="card-text"><i class="fas fa-map-marker-alt px-1"></i>{{$vendor->address}}, {{$vendor->suburb}}</p>
                        <div class="d-flex justify-content-between">
                            <div class="rating">
                            <span><i class="fas fa-coffee checked"></i></span>
                            <span><i class="fas fa-coffee checked"></i></span>
                            <span><i class="fas fa-coffee checked"></i></span>
                            <span><i class="fas fa-coffee unchecked"></i></span>
                            <span><i class="fas fa-coffee unchecked"></i></span><span class="rating-avg badge rounded-pill bg-light text-dark mx-3"> 3.0</span>
                            </div>
                            <div class="favourite">
                            @auth
                            @if (!$vendor->likedBy(auth()->user()))
                                <form action="{{ route('vendor.likes', $vendor) }}" method='post'>
                                @csrf
                                <a id="fav_like" type="submit" class="fav_like float-right"><span class="fas fa-coffee fa-lg checked"></span></a> <!--wil need to be changed to a button in laravel-->
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
                        </div>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><small class="text-muted">last updated {{$vendor->updated_at->diffForHumans()}}</small></p>
                    </div>
                    {{-- @endforeach --}}
              @endforeach
                  </div>
                </div>
            <div class="col">
              <div class="card h-100">
                <a class="vendor-card" href="vendor.html">
                  <img src="/img/vendor/cafe2.jpg" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                  <h5 class="card-title">Cafe 2</h5>
                  <p class="card-text"><i class="fas fa-map-marker-alt px-1"></i>123 main Street, Some suburb, some state, 1234</p>
                  <div class="d-flex justify-content-between">
                    <div class="rating">
                    <span><i class="fas fa-coffee checked"></i></span>
                    <span><i class="fas fa-coffee checked"></i></span>
                    <span><i class="fas fa-coffee checked"></i></span>
                    <span><i class="fas fa-coffee unchecked"></i></span>
                    <span><i class="fas fa-coffee unchecked"></i></span><span class="rating-avg badge rounded-pill bg-light text-dark mx-3"> 3.0</span>
                    </div>
                    <div class="favourite">
                    <!-- @auth
                    @if (!$vendor->likedBy(auth()->user())) -->
                        <form action="{{ route('vendor.likes', $vendor) }}" method='post'>
                        <!-- @csrf  -->
                        <a id="fav_like" type="submit" class="fav_like float-right"><i class="fas fa-coffee fa-lg unchecked"></i></a>
                        </form>
                    <!-- @else -->
                        <!-- <form action="{{ route('vendor.likes', $vendor->id) }}" method='post'> -->
                        <!-- @csrf
                        @method('DELETE') -->
                        <!-- <button id="fav_unlike" type="submit" class="fav_unlike float-right"><span class="fas fa-coffee fa-lg"></span></button>
                        </form> -->
                    <!-- @endif
                    @endauth -->
                    </div>
                </div>
                </div>
                <div class="card-footer">
                  <small class="text-muted">Last updated 3 mins ago</small>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <a class="vendor-card" href="vendor.html">
                  <img src="/img/vendor/cafe3.jpg" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                  <h5 class="card-title">Cafe 3</h5>
                  <p class="card-text"><i class="fas fa-map-marker-alt px-1"></i>123 main Street, Some suburb, some state, 1234</p>
                  <div class="d-flex justify-content-between">
                    <div class="rating">
                    <span><i class="fas fa-coffee checked"></i></span>
                    <span><i class="fas fa-coffee checked"></i></span>
                    <span><i class="fas fa-coffee checked"></i></span>
                    <span><i class="fas fa-coffee checked"></i></span>
                    <span><i class="fas fa-coffee unchecked"></i></span><span class="rating-avg badge rounded-pill bg-light text-dark mx-3"> 4.0</span>
                    </div>
                    <div class="favourite">
                    <!-- @auth
                    @if (!$vendor->likedBy(auth()->user())) -->
                        <form action="{{ route('vendor.likes', $vendor) }}" method='post'>
                        <!-- @csrf  -->
                        <a id="fav_like" type="submit" class="fav_like float-right"><span class="fas fa-coffee fa-lg checked"></span></a>
                        </form>
                    <!-- @else -->
                        <!-- <form action="{{ route('vendor.likes', $vendor->id) }}" method='post'> -->
                        <!-- @csrf
                        @method('DELETE') -->
                        <!-- <button id="fav_unlike" type="submit" class="fav_unlike float-right"><span class="fas fa-coffee fa-lg"></span></button>
                        </form> -->
                    <!-- @endif
                    @endauth -->
                    </div>
                </div>
                </div>
                <div class="card-footer">
                  <small class="text-muted">Last updated 3 mins ago</small>
                </div>
              </div>
            </div>
          </div>
      </div> <!--container end-->
      @endsection


    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> --}}
  {{-- </body> --}}
{{-- </html> --}}