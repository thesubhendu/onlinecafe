@extends('layout.app')
@section('content')
<main role="main" class="container py-4 mb-5 mt-4">
  <div class="vendor-view d-flex flex-row justify-content-between mb-3 mt-4">
    <div class="">
        <img src="storage/img/nostamp.png" width="50" height="50" alt="">
    </div>
    <div>
        <h1>Your Cards</h1>
    </div>
    <div>
        <a href="index.html" class="btn btn-success"><i class="fas fa-backward"></i></a>
    </div>
</div>
<hr>
  <div class="container d-flex mt-4">
    {{-- <div> --}}
      <div class="card mt-4 mr-3" style="max-width: 540px;">
        <div class="card-logo card-header">
          <img src="storage/img/nostamp.png" style="max-width: 10%; height: auto;">
          Cafe One
          <div>
            <small class="card-text text-muted">Buy 9 coffees get 1 free</small>
            <a href="menu.html" class="btn btn-success btn-small float-right">Order</a>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between flex-wrap">
            <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
            <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
            <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
            <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
            <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
          </div>
          <div class="d-flex justify-content-between flex-wrap">
            <img src="storage/img/nostamp.png" width="60" height="60" alt="nostamp">
            <img src="storage/img/nostamp.png" width="60" height="60" alt="nostamp">
            <img src="storage/img/nostamp.png" width="60" height="60" alt="nostamp">
            <img src="storage/img/nostamp.png" width="60" height="60" alt="nostamp">
          </div>
        </div>
      </div>
      <div class="card mt-4" style="max-width: 540px;">
        <div class="card-logo card-header">
          <img src="storage/img/nostamp.png" style="max-width: 10%; height: auto;">
          Cafe Two
          <div>
            <small class="card-text text-muted">Buy 9 Coffee get 1 free</small>
            <a href="menu.html" class="btn btn-success btn-small float-right">Order</a>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-between flex-wrap">
            <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
            <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
            <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
            <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
            <img src="storage/img/stamp48x48.png" width="60" height="60" alt="stamp">
          </div>
          <div class="d-flex justify-content-between flex-wrap">
            <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
            <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
            <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
            <img src="storage/img/nostamp48x48.png" width="60" height="60" alt="nostamp">
          </div>
        </div>
      </div>
    {{-- </div> --}}
  </div>

</main><!-- /.container -->
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script></body>
</body>
</html>