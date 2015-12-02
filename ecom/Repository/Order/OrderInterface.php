<?php

namespace Ecom\Repository\Order;

interface OrderInterface
{
    public function saveOrder($customer, $cart);
}