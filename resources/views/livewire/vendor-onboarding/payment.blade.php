<div>
    <x-breadcrumb></x-breadcrumb>
    <x-steps step="payment"></x-steps>


    <section class="registration-steps">

        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-md-8">
                    <div class="card payment_form">
                        <div class="card-body">
                            @if($loader)
                                <div class="loader-container">
                                    <div class="loader text-center"></div>
                                </div>
                            @endif
                            <div class="container py-3">
                                <main>
                                    <div class="row g-5">
                                        <div class="col-md-7 col-lg-12">

                                            <h4 class="mb-3">Payment <span class="mr-2"><i
                                                        class="fa fa-credit-card text-muted"></i></span></h4>

                                            <hr class="my-4">
                                            <div class="row gy-3 form-group">
                                                <div class="col-md-12">


                                                    <form wire:submit.prevent="subscribe" id="card-form">


                                                        <div class="form-group">
                                                            <label for="plan" class="form-label">Select Plan</label>
                                                            <div class="form-check form-check-inline">

                                                                @foreach($availablePlans as $title => $slug)
                                                                    <label class="form-check-label mx-4">
                                                                        <input type="radio" class="form-check-input"
                                                                               wire:model="plan"
                                                                               value="{{$slug}}">
                                                                        {{$title}}
                                                                        ( @if($slug=='monthly') $19.95/month
                                                                        @elseif($slug=='yearly') $179/year @endif)
                                                                    </label>
                                                                @endforeach

                                                            </div>
                                                            @error('plan') <span
                                                                class="text-danger">{{ $message }}</span> @enderror
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="card-holder-name" class="form-label">Name on
                                                                card</label>
                                                            <input type="text" class="form-control"
                                                                   id="card-holder-name"
                                                                   placeholder="" required>
                                                            <small class="text-muted">Full name as displayed on
                                                                card</small>
                                                            <small class="invalid-feedback">
                                                                Name on card is required
                                                            </small>
                                                        </div>


                                                        <div class="form-group mt-2">
                                                            <label for="name">Enter Your Card Details</label>
                                                            <div id="card-element"></div>
                                                            <div id="card-errors" role="alert"></div>
                                                        </div>


                                                        <button id="card-button"
                                                                class="w-100 btn btn-success btn-lg mt-4"
                                                                type="submit" data-secret="{{ $clientSecret }}">
                                                            Proceed to Checkout.
                                                        </button>
                                                    </form>


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

        @push('scripts')
            <script>
                const stripe = Stripe('{{ config('cashier.key')}}')

                const elements = stripe.elements()

                const cardElement = elements.create('card', {
                    hidePostalCode: true,
                })
                cardElement.mount('#card-element')

                const form = document.getElementById('card-form')

                const cardHolderName = document.getElementById('card-holder-name')
                const cardButton = document.getElementById('card-button')
                const clientSecret = cardButton.dataset.secret

                form.addEventListener('submit', async (e) => {
                    e.preventDefault()
                    cardButton.disabled = true
                    Livewire.emit('showLoader')

                    const {setupIntent, error} = await stripe.confirmCardSetup(clientSecret, {
                            payment_method: {
                                card: cardElement,
                                billing_details: {
                                    name: cardHolderName.value
                                }
                            }
                        }
                    )
                    if (error) {
                        cardButton.disabled = false
                    } else {

                    @this.token
                        = setupIntent.payment_method;

                        Livewire.emit('subscribeToPlan');
                    }
                })
            </script>
        @endpush

    </section>
</div>



