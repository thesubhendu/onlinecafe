@extends('layout.app')
@section('content')
<main role="main" class="">
<div id="card-showcase" class="">
  <div class="showcase-content">
    <h3 class="">Pay it Forward.</h3>
    <p class="">Lorem ipsum dolor sit amet.</p>
    <div class="d-flex justify-content-between">
      <a href="#" class="btn btn-outline-success">Learn More</a>
    </div>
  </div>
</div>
</main><!-- /.container -->
<div class="container">
    <h1>Login</h1>
    <div class="row mb-5">
      <div class="justify-center p-3 border-rounded">
          @if (session('status'))
          <div class="alert alert-danger">
              {{ session('status')}}
          </div>
          @endif
      </div>
          <form action="{{ route('login') }}" method="post" class="needs-validation" novalidate>
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
                <div class="input-group mb-3">
                    <div class="d-flex mt-2 ">
                      <input type="checkbox" name="remember" id="remember" class="mr-1">
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
              <div class="">
                  <button class="btn btn-success btn-block mt-2" type="submit">Login</button>
                </div>
            </form>
    </div><!-- /.row -->
  </div><!-- /.container -->
@endsection
