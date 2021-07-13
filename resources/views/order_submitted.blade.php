@extends('layout.app')
@section('content')
<main role="main" class="">
  <div class="container">
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
        <div>
          <a class="btn btn-outline-dark float-right" href="{{route('order.thankyou')}}"></a>
        </div>
      </div>
  </div><!-- /.container -->
</main>
@endsection
