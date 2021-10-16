@extends('layout.app')
@section('content')
<main role="main" class="">
  <div class="row">
      <div class="container mb-5">
            <div class="card-header">
                <h1>Register</h1>
            </div>
          <form action="{{ route('register') }}" method="post" class="needs-validation" novalidate>
              @csrf
              <label for="name" class="form-label">Name</label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="nameGroupPrepend"><i class="far fa-user"></i></span>
                <input type="text" class="form-control @error('name') border-danger @enderror" name="name" placeholder="Enter your fullname..." id="name" value="{{ old('name')}}" required>
                @error('name')
                <div class="text-danger mt-2 text-sm">
                  {{ $message }}
                </div>
                @enderror
              </div>
                <label for="email" class="form-label">Email</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="emailGroupPrepend"><i class="fas fa-at"></i></span>
                  <input type="email" class="form-control @error('email') border-danger @enderror" name="email" placeholder="Enter your email address..." id="email_username" value="{{ old('email')}}" required>
                  @error('email')
                  <div class="text-danger mt-2 text-sm">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <label for="mobile" class="form-label">Mobile</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="mobileGroupPrepend"><i class="fas fa-mobile-alt"></i></span>
                  <input type="text" class="form-control @error('mobile') border-danger @enderror" name="mobile" placeholder="Enter your mobile..." id="mobile" value="{{ old('mobile')}}" required>
                  @error('mobile')
                  <div class="text-danger mt-2 text-sm">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <label for="password" class="form-label">Password</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="passwordGroupPrepend"><i class="fas fa-key"></i></span>
                  <input type="password" class="form-control @error('password') border-danger @enderror" name="password" id="password" aria-describedby="passwordGroupPrepend" required>
                  @error('password')
                  <div class="text-danger mt-2 text-sm">
                      {{ $message }}
                    </div>
                    @enderror
                </div>
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="confirmGroupPrepend"><i class="fas fa-key"></i></span>
                  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" aria-describedby="confirmGroupPrepend" required>
                  <div class="invalid-feedback">
                    confirm password
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
                  <button class="btn btn-success mt-2" type="submit">Register</button>
              </div>
            </form>
      </div> <!-- /.container -->
  </div> <!-- /.row -->
</main>
@endsection
