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
          <i class="fas fa-comment-dots message-sent"></i> 
        </div>
        <h5 class="display-3">Order Submitted!</h5>
        <p class="lead"><strong>waiting for venue to confirm </strong> payment will be required on pickup</p>
        <label for="file"><strong>waiting for venue to confirm </strong></label>
        <div class="progress">
          <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
        </div>
          <!-- <progress id="file" value="75" max="100"> 75% </progress> -->
        <hr>
      </div>
      <div>
        <a class="btn btn-outline-dark float-right" href="thankyou.html"></a>
      </div>
  </div>
@endsection
</main><!-- /.container -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script></body>
</body>
</html>