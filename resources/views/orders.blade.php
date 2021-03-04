@extends('layout.app')
@section('content')
<main role="main" class="container py-4 mb-5 mt-4">
  <div class="vendor-view d-flex flex-row justify-content-between mb-3 mt-4">
    <div class="">
        <img src="storage/img/nostamp.png" width="50" height="50" alt="">
    </div>
    <div>
        <h1>Orders</h1>
    </div>
    <div>
        <a href="index.html" class="btn btn-success"><i class="fas fa-backward"></i></a>
    </div>
</div>
<hr>

  <div class="vendor-index mt-4">
    <div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Venue</th>
            <th scope="col">Date</th>
            <th scope="col">Total</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Cafe One</td>
            <td>01/10/2020</td>
            <td>$5.50</td>
            <td><a href="cart.html" class="btn btn-success btn-sm"><i class="fas fa-cart-plus"></i></a></td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Cafe Two</td>
            <td>05/10/2020</td>
            <td>$5.50</td>
            <td><a href="cart.html" class="btn btn-success btn-sm"><i class="fas fa-cart-plus"></i></a></td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Cafe One</td>
            <td>07/10/2020</td>
            <td>$5.50</td>
            <td><a href="cart.html" class="btn btn-success btn-sm"><i class="fas fa-cart-plus"></i></a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</main><!-- /.container -->
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script></body>
</body>
</html>