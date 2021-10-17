@extends('layout.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pricing') }}</div>
                <div id="price-showcase">
                    <div class="showcase-content">
                      <h1>Save, time & money.</h1>
                      <p>in 3 simple steps.</p>
                      <div class="d-flex justify-content-between">
                      </div>
                    </div>
                  </div>
                  <div class="steps">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5>step 1.</h5>
                                <p>register you business</p>
                            </div>
                            <a href="{{route('register-business.create')}}" class="w-100 btn btn-sm btn-primary">Register Here</a>
                        </li>
                        <li class="list-group-item d-flex disabled">
                            <div class="d-flex w-100 justify-content-between">
                                <h5>step 2.</h5>
                                <p>Select your subscription plan</p>
                            </div>
                        </li>
                        <li class="list-group-item disabled">
                            <div class="d-flex w-100 justify-content-between">
                                <h5>step 3.</h5>
                                <p>Set up your shop</p>
                            </div>
                        </li>
                    </ul>
                  </div>
                <div class="card-body">
                    <div class="container py-3">
                        <header>
                            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                                <h1 class="display-4 fw-normal">Pricing</h1>
                                <p class="fs-5 text-muted">Quickly build an effective pricing table for your potential
                                    customers with this Bootstrap example. It’s built with default Bootstrap components
                                    and utilities with little customization.</p>
                            </div>
                        </header>
                        <main>
                            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                                @foreach($plans as $plan)
                                <div class="col">
                                    <div class="card mb-4 border-success rounded-3 shadow-sm">
                                        <div class="card-header py-3">
                                            <h4 class="my-0 fw-normal">{{$plan->title}}</h4>
                                        </div>
                                        <div class="card-body">
                                            <h1 class="card-title pricing-card-title">$0<small
                                                    class="text-muted fw-light">/mo</small></h1>
                                            <p>Allow your customers to order ahead of time</P>
                                            <ul class="list-unstyled mt-3 mb-4">
                                                <li>1 user included</li>
                                                <li>Email support</li>
                                            </ul>
                                            <a href="{{ route('plans.subscribe', ['plan' => $plan->slug])}}"
                                                class="w-100 btn btn-lg btn-outline-success">Sign up for
                                                {{$plan->title}}</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </main>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
