<?php


namespace App\Services;


use App\Models\Vendor;

class StripeService
{
    private \Stripe\StripeClient $stripe;
    function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(config('services.stripe.api_key'));
    }
    public function createAccount(Vendor $vendor): string
    {
        if($vendor->charges_enabled_at){
            return false;
        }

        try {
             if($vendor->stripe_account_id) {
                 $this->stripe->accounts->delete($vendor->stripe_account_id);
             }
        } catch (\Exception $e) {

        }

        try {
                 $stripe_account = $this->stripe->accounts->create(
                    $this->data($vendor)
                );
                $vendor->stripe_account_id = $stripe_account->id;
                $vendor->save();
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());

        }

        return $this->refreshUrl($vendor);
    }

    public function refreshUrl(Vendor $vendor) : string
    {
        return $this->stripe->accountLinks->create(
            [
                'account' => $vendor->stripe_account_id,
                'refresh_url' => route('stripe.refreshUrl',$vendor->id),
                'return_url' => route('register-business.menu-products-setup'),
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
        $owner = explode(' ', $vendor->owner->name);

        $data = [
            'country' => 'AU',
            'type' => 'express',
            'email' => $vendor->email,
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
            'business_type' => 'individual',
            'business_profile' => [
                'mcc' => '5462', //bakeries https://stripe.com/docs/connect/setting-mcc
                'name' => $vendor->shop_name,
                'product_description' => $vendor->description,
                'support_email' => $vendor->shop_email,
                'support_phone' => $vendor->shop_mobile,
                'url' => config('app.url'),
            ],
//
            'individual' => [
                'address' => [
                    'city'=> $vendor->suburb,
                    'country'=>'AU',
                    'line1'=> $vendor->address,
                    'postal_code'=> $vendor->pc,
                    'state'=> $vendor->state
                ],
                'email' => $vendor->email,
                'first_name' => $owner[0],
                'last_name' => $owner[1] ?? '',
                'phone' => $vendor->owner->mobile
            ],

//            'settings' => [
//                'branding' => [
//                    'logo' => $vendor->vendor_logo ? fopen(asset('storage/' . $vendor->vendor_logo), 'r') : null
//                ]
//            ]

        ];
        return $data;
    }
}
