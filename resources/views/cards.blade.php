@extends('layout.app')
@section('content')
<main role="main" class="container py-4 mb-5 mt-4">
  <div class="vendor-view d-flex flex-row justify-content-between mb-3 mt-4">
    <div>
        <h1>Your Cards</h1>
    </div>
    <div>
        <a href="index.html" class="btn btn-success"><i class="fas fa-backward"></i></a>
    </div>
</div>
<hr>
  <div class="container mt-4">
    <div id="card-showcase" class="">
      <h1>Pay it Forward.</h1>
      <div class="d-flex justify-content-between">
        <a href="#" class="btn btn-outline-success ">Register</a>
        <a href="#" class="text-success">Learn More</a>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
      <div class="col">
        <div class="card h-100">
          <div class="card-logo card-header">
            <img src="storage/img/nostamp.png" style="max-width: 10%; height: auto;">
            Cafe One
            <a href="menu.html" class="btn btn-success btn-small float-right">Order</a>
            <div>
              <small class="card-text text-muted">Buy 9 coffees get 1 free</small>
              {{-- <a href="menu.html" class="btn btn-success btn-small float-right">Order</a> --}}
            </div>
          </div>
          <div class="card-body">
              <div class="d-flex justify-content-between">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
              </div>
              <div class="d-flex justify-content-between">
                <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
                <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
                <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
                <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
              </div>
          </div>
          <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="card-logo card-header">
            <img src="storage/img/nostamp.png" style="max-width: 10%; height: auto;">
            Cafe Two
            <div>
              <small class="card-text text-muted">Buy 9 coffees get 1 free</small>
              <a href="menu.html" class="btn btn-success btn-small float-right">Order</a>
            </div>
          </div>
          <div class="card-body">
              <div class="d-flex justify-content-between">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
              </div>
              <div class="d-flex justify-content-between">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="nostamp">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="nostamp">
                <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
                <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
              </div>
          </div>
          <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <div class="card-logo card-header">
            <img src="storage/img/nostamp.png" style="max-width: 10%; height: auto;">
            Cafe Three
            <div>
              <small class="card-text text-muted">Buy 9 coffees get 1 free</small>
              <a href="menu.html" class="btn btn-success btn-small float-right">Order</a>
            </div>
          </div>
          <div class="card-body">
              <div class="d-flex justify-content-between">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
                <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
                <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="stamp">
                <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="stamp">
              </div>
              <div class="d-flex justify-content-between">
                <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
                <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
                <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
                <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
              </div>
          </div>
          <div class="card-footer">
            <small class="text-muted">Last updated 3 mins ago</small>
          </div>
        </div>
      </div>
    </div>
  </div>

</main><!-- /.container -->
@endsection
