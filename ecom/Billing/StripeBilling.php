<?php

namespace Ecom\Billing;

use Illuminate\Support\Facades\View;

class StripeBilling implements BillingInterface
{
    public function __construct()
    {
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));
    }

    public function charge(array $data)
    {
            return \Stripe\Charge::create([
                        'amount' => $data['amount'],
                        'currency' => 'gbp',
                        'description' => $data['email'],
                        'card' => $data['token']
                    ]);
    }
}
