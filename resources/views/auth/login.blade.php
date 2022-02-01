<x-guest-layout class="sigin-layout">
    <x-jet-authentication-card>
        <x-slot name="logo">
            <h3 class="text-center">Login</h3>
        </x-slot>

        <div class="card-body sigin-form">

            <x-jet-validation-errors class="mb-3 rounded-0" />

            @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <x-jet-label value="{{ __('Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                 name="email" :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-4">
                    <x-jet-label value="{{ __('Password') }}" />

                    <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="current-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>
                <div class="row d-flex forgot-password">
                    <div class="custom-control custom-checkbox">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <label class="custom-control-label remember-me" for="remember_me">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div>
                        @if (Route::has('password.request'))
                            <a class="text-muted me-3" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="mb-2">
                    <div class="">
                        <x-jet-button class="mb-2">
                            {{ __('Log in') }}
                        </x-jet-button>
                        <a class=" text-center register-btn text-primary" href="{{ route('register') }}">
                            {{ __('Create New Account') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
