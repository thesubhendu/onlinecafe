@extends('layout.app')
@section('content')
<main role="main" class="container mb-5 mt-4">
    <div class="register-view d-flex flex-row justify-content-between card-header mb-3 mt-4">
        <div class="">
            <img src="/storage/img/nostamp.png" width="50" height="50" alt="">
        </div>
        <div>
            <h1>Login</h1>
        </div>
    </div>
    <div class="justify-center bg-white p-5 border-rounded">
        @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status')}}
        </div>
        @endif

    <form action="{{ route('login') }}" method="post" class="row g-3 needs-validation" novalidate>
        @csrf
          <label for="email_username" class="form-label">Email</label>
          <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend">@</span>
            <input type="email" class="form-control @error('email') border-danger @enderror" name="email" placeholder="Enter your email address..." id="email_username" value="{{ old('email')}}" aria-describedby="inputGroupPrepend" required>
            @error('email')
            <div class="text-danger mt-2 text-sm">
              {{ $message }}
            </div>
            @enderror
          </div>
          <label for="password" class="form-label">Password</label>
          <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-key"></i></span>
            <input type="password" class="form-control @error('password') border-danger @enderror" name="password" id="password" aria-describedby="inputGroupPrepend" required>
            @error('password')
            <div class="text-danger mt-2 text-sm">
                {{ $message }}
              </div>
              @enderror
          </div>
          <div class="mb-4 mt-2">
              <div class="flex">
                  <input type="checkbox" name="remember" id="remember" class="mr-2">
                  <label for="remember">Remember Me</label>
              </div>

          </div>
          {{-- <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">
              Agree to terms and conditions
            </label>
            <div class="invalid-feedback">
              You must agree before submitting.
            </div>
          </div>
        </div> --}}
        <div class="col-12">
            <button class="btn btn-success btn-block mt-2" type="submit">Login</button>
          </div>
      </form>
    </div>
</main><!-- /.container -->
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script></body>
</body>
</html>