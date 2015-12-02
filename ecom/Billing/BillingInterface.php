<?php

namespace Ecom\Billing;

interface BillingInterface
{
    public function charge(array $data);
}