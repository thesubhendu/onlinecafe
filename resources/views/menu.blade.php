<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>my coffee</title>

    {{-- <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/starter-template/"> --}}

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1e6705f353.js" crossorigin="anonymous"></script>


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
              <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt">logout</i></a>
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
    <div class="vendor-menu d-flex flex-row justify-content-between mb-3 mt-4">
        <div class="">
            <img src="storage/img/nostamp.png" width="50" height="50" alt="">
        </div>
        <div class="vendor">
            <h1>Vendor Menu</h1>
        </div>
        <div>
            <a href="index.html" class="btn btn-success"><i class="fas fa-backward"></i></a>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="card mt-4">
            <div class="row no-gutters">
                <div class="product-info card-body">
                    <div class="flex-fill">
                          <img src="storage/img/nostamp.png" class="card-product-img" alt="...">
                      </div>
                        <div class="flex-fill">
                            <p class="card-text">Coffee 1</p>
                        </div>
                        <div class="flex-fill">
                            <p class="card-text">Lorem ipsum dolor sit amet.</p>
                        </div>
                        <div class="flex-fill">
                            <p class="card-text">$3.50</p>
                        </div>
                        <div class="float-sm-right">
                            <a href="#" class="btn btn-success"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                              </svg></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
              <div class="row no-gutters">
                  <div class="product-info card-body">
                      <div class="flex-fill">
                          <img src="storage/img/nostamp.png" class="card-product-img" alt="...">
                      </div>
                      <div class="flex-fill">
                          <p class="card-text">Coffee 2</p>
                      </div>
                      <div class="flex-fill">
                          <p class="card-text">Lorem ipsum dolor sit amet.</p>
                      </div>
                      <div class="flex-fill">
                          <p class="card-text">$4.50</p>
                      </div>
                      <div class="float-sm-right">
                          <a href="#" class="btn btn-success"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                              <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                            </svg></a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="card mt-4">
            <div class="row no-gutters">
                <div class="product-info card-body">
                    <div class="flex-fill">
                        <img src="storage/img/nostamp.png" class="card-product-img" alt="...">
                    </div>
                    <div class="flex-fill">
                        <p class="card-text">Coffee 3</p>
                    </div>
                    <div class="flex-fill">
                        <p class="card-text">Lorem ipsum dolor sit amet.</p>
                    </div>
                    <div class="flex-fill">
                        <p class="card-text">$5.50</p>
                    </div>
                    <div class="float-sm-right">
                        <a href="#" class="btn btn-success"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                            <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                          </svg></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
          <div class="row no-gutters">
              <div class="product-info card-body">
                  <div class="flex-fill">
                      <img src="storage/img/nostamp.png" class="card-product-img" alt="...">
                  </div>
                  <div class="flex-fill">
                      <p class="card-text">Coffee 4</p>
                  </div>
                  <div class="flex-fill">
                      <p class="card-text">Lorem ipsum dolor sit amet.</p>
                  </div>
                  <div class="flex-fill">
                      <p class="card-text">$3.50</p>
                  </div>
                  <div class="float-sm-right">
                      <a href="#" class="btn btn-success"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                          <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg></a>
                  </div>
              </div>
          </div>
      </div>
      <div class="card mt-4">
        <div class="row no-gutters">
            <div class="product-info card-body">
                <div class="flex-fill">
                    <img src="storage/img/nostamp.png" class="card-product-img" alt="...">
                </div>
                <div class="flex-fill">
                    <p class="card-text">Coffee 5</p>
                </div>
                <div class="flex-fill">
                    <p class="card-text">Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="flex-fill">
                    <p class="card-text">$4.50</p>
                </div>
                <div class="float-sm-right">
                    <a href="#" class="btn btn-success"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                        <path fill-rule="evenodd" d="M8.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                      </svg></a>
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