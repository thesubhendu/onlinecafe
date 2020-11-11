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

      /* .checked {
          color:#2eec71;
      } */

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
      <!-- Image and text -->
    <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="index.html">
      <img src="./img/loyaltyGreen.jpg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
      my coffee
    </a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item nav-right dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <!-- <a class="dropdown-item" href="#"><i class="far fa-folder"> Admin</i></a> -->
              <a class="dropdown-item" href="#"><i class="fas fa-cog"> Settings</i></a>
              <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt">logout</i></a>
            </div>
          </li>
    </ul>
  </nav>
    <nav class="navbar navbar-expand-md fixed-bottom navbar-dark bg-dark mt-4">
      <a class="nav-link" href="index.html"><i id="homeicon" class="fa fa-home"><span class="sr-only">(current)</span></i></a>
      <a class="nav-link" href="orders.html"><i id="ordersicon" class="fas fa-dollar-sign"></i></a>
      <a class="nav-link" href="cards.html"><i class="fas fa-id-card"></i></a>
      <a class="nav-link" href="favourites.html"><i id="favicon" class="fas fa-heart"></i></a>
  <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button> -->

  <!-- <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.html"><i id="homeicon" class="fa fa-home"><span class="sr-only">(current)</span></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="orders.html"><i id="ordersicon" class="fas fa-dollar-sign"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cards.html"><i class="fas fa-id-card"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="favourites.html"><i id="favicon" class="fas fa-heart"></i></a>
      </li> -->
      <!-- <li class="nav-item nav-right dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="#">Admin</a>
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">logout</a>
        </div>
      </li> -->
    <!-- </ul>

  </div> -->
</nav>
<main role="main" class="container py-4 mb-5">

    <div class="vendor-view d-flex flex-row justify-content-between mb-3 mt-4">
        <div class="">
            <img src="./img/loyaltyGreen.jpg" width="30" height="30" alt="">
        </div>
        <div>
            <h1>Vendor View</h1>
        </div>
        <div>
            <a href="index.html" class="btn btn-success">go back</a>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="card mb-3" style="max-width: 540px;">
            <img src="./img/cafe1.jpg" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
              <h5 class="card-title">Cafe One</h5>
              <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto reprehenderit sint dignissimos cumque cupiditate eos voluptas laudantium harum ullam quibusdam.</p>
              <p class="card-text">123 main street</p>
              <p class="card-text">Suburb 4000</p>
              <p class="card-text">state</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              <a id="addFavIcon" href="favourites.html" class="btn btn-outline-success btn-sm float-right"><span class="card-text fas fa-heart checked"></span></i></a>
              <a href="menu.html" class="btn btn-success">Order</a>
            </div>
          </div>
    </div>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                Rating <span class="badge badge-pill badge-dark"> 3.0</span>
            </div>
            <div class="card-body">
            <span class="card-text fa fa-star checked"></span>
            <span class="card-text fa fa-star checked"></span>
            <span class="card-text fa fa-star checked"></span>
            <span class="card-text fa fa-star"></span>
            <span class="card-text fa fa-star"></span>
            </div>
          </div>
    </div>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                comments <span class="badge badge-pill badge-dark"> 5.0</span>
            </div>
            <div class="card-body">
                <p class="card-text">Lorem ipsum dolor sit amet.</p>
                <p class="card-text">Lorem ipsum dolor sit amet.</p>
                <p class="card-text">Lorem ipsum dolor sit amet.</p>
                <p class="card-text">Lorem ipsum dolor sit amet.</p>
            </div>
          </div>
    </div>
  
  </main><!-- /.container -->
  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script></body>
</body>
  </html>