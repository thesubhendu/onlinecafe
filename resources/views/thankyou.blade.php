@extends('layout.app')
@section('content')
<main role="main" class="container py-4 mb-5">

  <div class="vendor-index mt-4">
    <div class="vendor-view d-flex flex-row justify-content-between mb-3 mt-4">
        <div>
            <!-- <h1>Thank You</h1> -->
        </div>
        <!-- <div>
            <a href="index.html" class="btn btn-success">go back</a>
        </div> -->
    </div>
    <hr>
    <div class="jumbotron text-center">
        <div class="">
            <i class="far fa-check-circle display-tick"></i> 
        </div>
        <h1 class="display-3">Thank You!</h1>
        <p class="lead"><strong>Your Order has been confirmed by the venue</strong> payment will be required on pickup</p>
        <hr>
        
        <p class="lead">
          <a class="btn btn-success btn-sm" href="/" role="button">Back to homepage</a>
        </p>
        <!-- <p>
            Having trouble? <a href="">Contact us</a>
          </p> -->
      </div>
  </div>

</main><!-- /.container -->
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script></body>
</body>
</html>