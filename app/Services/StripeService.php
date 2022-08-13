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

        return $this->refreshUrl($vendor);
    }

    public function refreshUrl(Vendor $vendor) : string
    {
        return $this->stripe->accountLinks->create(
            [
                'account' => $vendor->stripe_account_id,
                'refresh_url' => route('stripe.refreshUrl',$vendor),
                'return_url' => route('vendor.show', $vendor->id),
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
        $data = [
            'country' => 'AU',
            'type' => 'standard',
            'email' => $vendor->email,
//            'capabilities' => [
//                'card_payments' => ['requested' => true],
//                'transfers' => ['requested' => true],
//            ],
            'business_type' => 'individual',
            'business_profile' => [
                'mcc' => '5462', //bakeries https://stripe.com/docs/connect/setting-mcc
                'name' => $vendor->shop_name,
                'product_description' => $vendor->description,
                'support_email' => $vendor->shop_email,
                'support_phone' => $vendor->shop_mobile,
                'url' => config('app.url'),
            ],
            'company' => [
                'name' => $vendor->vendor_name,
                'phone' => $vendor->mobile,
                'address' => [
                    'country' => 'AU',
                    'line1' => $vendor->address,
//                        'line2' => $vendor['street_address'],
                    'city' => $vendor->suburb,
                    'state' => $vendor->state,
                    'postal_code' => $vendor->pc,
                ],
                'tax_id' => $vendor->abn
            ],
//            'individual' => [
//                'address' => $vendor->address,
//                'email' => $vendor->owner->email,
//                'first_name' => $vendor->contact_name,
//                'last_name' => $vendor->contact_lastname,
//                'phone' => $vendor->mobile
//            ],

//            'settings' => [
//                'branding' => [
//                    'logo' => $vendor->vendor_logo ? fopen(asset('storage/' . $vendor->vendor_logo), 'r') : null
//                ]
//            ]

        ];
        return $data;
    }
}
