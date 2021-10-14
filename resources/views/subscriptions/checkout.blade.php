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

                                        <hr class="my-4">
                                        <div class="row gy-3 form-group">
                                            <div class="col-md-12">
                                                <x:card-form :action="route('subscriptions.store')">
                                                    <input type="hidden" name="plan" value="{{ request('plan') }}">

                                                    <button id="card-button" class="w-100 btn btn-success btn-lg mt-2" type="submit" data-secret="{{ $intent->client_secret }}">
                                                        Proceed to Checkout.
                                                    </button>
                                                </x:card-form>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </main>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
