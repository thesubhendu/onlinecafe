<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="card-body">
            <div class="mb-3 small text-muted">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success" role="alert">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="mt-4 d-flex justify-content-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <x-jet-button type="submit">
                            {{ __('Resend Verification Email') }}
                        </x-jet-button>
                    </div>
                </form>

                <form method="POST" action="/logout">
                    @csrf

                    <button type="submit" class="btn btn-link">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>

        @if(empty(auth()->user()->phone_verified_at))

            <h3>Mobile Verification</h3>
            <div class="card-body">
                <div class="mt-4 d-flex justify-content-between">

                    <form method="POST" action="{{ route('phone-verification.verify') }}">
                        @csrf

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Verification Code') }}"/>

                            <x-jet-input class="{{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code"
                                         :value="old('code', $request->code)" required autofocus/>
                            <x-jet-input-error for="code"></x-jet-input-error>
                        </div>

                        <div>
                            <x-jet-button type="submit">
                                {{ __('Verify Phone') }}
                            </x-jet-button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('phone-verification.send') }}">
                        @csrf

                        <div>
                            <x-jet-button type="submit">
                                {{ __('Resend Code') }}
                            </x-jet-button>
                        </div>
                    </form>


                </div>
            </div>
        @endif

    </x-jet-authentication-card>
</x-guest-layout>
