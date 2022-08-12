<?php


namespace App\Services;


use App\Models\Vendor;

class StripeService
{
    private \Stripe\StripeClient $stripe;
    function __construct()
    {
        $this->stripe = new \Stripe\StripeClient('sk_test_M8hfDnQwXx36Lm8qJ2zWjVDP');
    }
    public function createAccount(Vendor $vendor): string
    {
        if(!is_null($vendor->stripe_account_id)){
            return $this->refreshUrl($vendor->stripe_account_id);
        }

        $stripe_account = $this->stripe->accounts->create(
            $this->data($vendor)
        );

        $accountId = $stripe_account->id;
        $vendor->stripe_account_id = $accountId;
        $vendor->save();

        return $this->refreshUrl($accountId);
    }

    public function refreshUrl(string $accountId) : string
    {
        return $this->stripe->accountLinks->create(
            [
                'account' => $accountId,
                'refresh_url' => route('stripe.refreshUrl'),
                'return_url' => route('stripe.returnUrl'),
                'type' => 'account_onboarding',
            ]
        )->url;
    }

    /**
     * @param Vendor $vendor
     * @return array
     */
    private function data(Vendor $vendor): array
    {
        return [
            'country' => 'AU',
            'type' => 'standard',
            'email' => $vendor->email,
            // 'phone' => $vendor['contact_phone'],
//            'capabilities' => [
//                'card_payments' => ['requested' => true],
//                'transfers' => ['requested' => true],
//            ],
            'business_type' => 'individual',
            'business_profile' => [
                "mcc" => '5462',
                'name' => $vendor->shop_name,
                'url' => 'https://mycoffees.online',
            ],
            'company' => [
                'address' => [
                    'line1' => $vendor->address,
//                        'line2' => $vendor['street_address'],
                    'city' => $vendor->suburb,
                    'state' => $vendor->state,
                    'postal_code' => $vendor->pc,
                ],
                'tax_id' => $vendor->abn
            ]
        ];
    }
}
