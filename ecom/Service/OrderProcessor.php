<?php

namespace Ecom\Service;

use Ecom\Repository\Order\OrderInterface;
use App\Order;
use Illuminate\Session\Store;
use Ecom\Billing\BillingInterface;
use Ecom\Cart\Cart;

class OrderProcessor
{
    public function __construct(OrderInterface $order,
                                Store $store,
                                BillingInterface $billing,
                                Cart $cart
                                )
    {
        $this->order    = $order;
        $this->session  = $store;
        $this->billing  = $billing;
        $this->cart     = $cart;
    }

    public function charge($user, $stripeToken)
    {
        $order = $this->saveOrder($user);

        $charge = $this->billing->charge([
            'token'  => $stripeToken,
            'email'  => $user->email,
            'amount' => $order->total
        ]);

        if ($charge->paid == true) {
            $this->paid($order->id, $charge->id);

            $this->cart->clear();
        }
    }

    protected function saveOrder($user)
    {
        return $this->order->saveOrder($user, $this->session->get('cart'));
    }

    protected function paid($orderId, $chargeId)
    {
        $completedOrder = Order::find($orderId);
        $completedOrder->paid = 'paid';
        $completedOrder->charge_id = $chargeId;
        $completedOrder->save();
    }

}
