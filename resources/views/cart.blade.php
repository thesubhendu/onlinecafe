
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

        /* a.nav-link {
        color: #fff;
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
      <img src="storage/img/nostamp.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
      my coffee
    </a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item nav-right dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <!-- <a class="dropdown-item" href="#"><i class="far fa-folder"> Admin</i></a> -->
              <a class="dropdown-item" href="#"><i class="fas fa-cog"> Settings</i></a>
              <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"> logout</i></a>
            </div>
          </li>
    </ul>
  </nav>

    <nav class="navbar navbar-expand-md fixed-bottom navbar-dark bg-dark">
        <a class="nav-link" href="index.html"><i id="homeicon" class="fa fa-home"><span class="sr-only">(current)</span></i></a>
      <a class="nav-link" href="orders.html"><i id="ordersicon" class="fas fa-dollar-sign"></i></a>
      <a class="nav-link" href="cards.html"><i class="fas fa-id-card"></i></a>
      <a class="nav-link" href="favourites.html"><i id="favicon" class="fas fa-heart"></i></a>
    </nav>
<main role="main" class="container py-4 mb-5">
  <div class="vendor-index mt-4">
        <h1>Order Details</h1>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="email"><i class="fas fa-mobile-alt"></i> Mobile</label>
            <input type="text" id="Mobile" name="mobile" placeholder="0412345678">
            <div class="cart-row">
                <div class="col-75">
                    <div class="container">
                        <h4>Cart
                            <span class="price" style="color:black">
                            <i class="fa fa-shopping-cart"></i>
                            <b>1</b>
                            </span>
                        </h4>
                        <p><a href="menu.html">Latte Small</a> <span class="price">$3.50</span></p>
                        <hr>
                        <p>Total <span class="price" style="color:black"><b>$3.50</b></span></p>
                        <div>
                            <a href="order_suibmitted.html"class="btn btn-success mt-4">Submit</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</main><!-- /.container -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script></body>
</body>
</html>