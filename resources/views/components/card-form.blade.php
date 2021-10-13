    <form action="{{ $attributes->get('action')}}" method="post" id="card-form">
        @csrf

        <div class="form-group">
            <div class="row gy-3">
                <div class="col-md-12">
                    <label for="card-holder-name" class="form-label">Name on card</label>
                    <input type="text" class="form-control" id="card-holder-name"
                        placeholder="" required>
                    <small class="text-muted">Full name as displayed on card</small>
                    <div class="invalid-feedback">
                        Name on card is required
                    </div>
                </div>

                <div class="col-md-12 mt-2">
                    <label for="name">Card Details</label>
                    <div id="card-element"></div>
                    <div id="card-errors" role="alert"></div>
                </div>

                <hr class="my-4">

                {{ $slot }}

            </div>

        </div>
    </form>

    <script>
        const stripe = Stripe('{{ config('cashier.key')}}')

        const elements = stripe.elements()
        const cardElement = elements.create('card')

        cardElement.mount('#card-element')

        const form = document.getElementById('card-form')

        const cardHolderName = document.getElementById('card-holder-name')
        const cardButton = document.getElementById('card-button')
        const clientSecret = cardButton.dataset.secret

        form.addEventListener('submit', async (e) => {
            e.preventDefault()
            cardButton.disabled = true

            const { setupIntent, error } = await stripe.confirmCardSetup(clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            )
            if (error) {
                cardButton.disabled= false
            } else {

                console.log(setupIntent)
                let token = document.createElement('input')

                token.setAttribute('type', 'hidden')
                token.setAttribute('name', 'token' )
                token.setAttribute('value', setupIntent.payment_method)

                form.appendChild(token)

                form.submit()
            }
        })
    </script>
