@extends('layout.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Checkout') }}</div>
                <div class="card-body">
                    <div class="container py-3">
                        <main>
                            <div class="row g-5">
                                <div class="col-md-7 col-lg-12">

                                    <h4 class="mb-3">Payment <span class="mr-2"><i
                                                class="fas fa-credit-card text-muted"></i></span><span class="mr-2"><i
                                                class="fab fa-cc-visa text-muted"></i></span><span class="mr-2"><i
                                                class="fab fa-cc-mastercard text-muted"></i></span></h4>

                                    <form class="p-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Promo code">
                                            <button type="submit" class="btn btn-outline-success">Apply</button>
                                        </div>
                                    </form>

                                    <form id="card-form" action="{{ route('subscriptions.store')}}" method="post"
                                        class="needs-validation" novalidate>
                                        @csrf
                                        <div class="my-3">
                                            <div class="form-check">
                                                <input id="credit" name="paymentMethod" type="radio"
                                                    class="form-check-input" checked required>
                                                <label class="form-check-label" for="credit"><span class="mr-2"><i
                                                            class="fas fa-credit-card text-muted"></i></span> Card<small
                                                        class="text-muted mr-2">(Credit or Debit)</small></label>
                                            </div>
                                            <div class="form-check">
                                                <input id="debit" name="paymentMethod" type="radio"
                                                    class="form-check-input" required>
                                                <label class="form-check-label" for="debit"><span class="mr-2"><i
                                                            class="fas fa-cash-register text-muted"></i></span> In
                                                    Store</label>
                                            </div>
                                            {{-- <div class="form-check">
                                                <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                                                <label class="form-check-label" for="paypal">PayPal</label>
                                            </div> --}}
                                        </div>
                                        <hr class="my-4">
                                        <div class="row gy-3 form-group">
                                            <div class="col-md-12">

                                            <x:card-form :action="route('subscriptions.store')">
                                                <input type="hidden" name="plan" value="{{ request('plan') }}">

                                                <button id="card-button" class="w-100 btn btn-success btn-lg" type="submit" data-secret="{{ $intent->client_secret }}">
                                                    Proceed to Checkout.
                                                </button>
                                            </x:card-form>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </main>

                        <footer class="my-5 pt-5 text-muted text-center text-small">
                            <p class="mb-1">&copy; 2017–2021 Company Name</p>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#">Privacy</a></li>
                                <li class="list-inline-item"><a href="#">Terms</a></li>
                                <li class="list-inline-item"><a href="#">Support</a></li>
                            </ul>
                        </footer>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
