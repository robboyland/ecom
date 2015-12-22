<?php

namespace Ecom\Service;

use App\Order;
use Ecom\Cart\Cart;
use Illuminate\Session\Store;
use Ecom\Billing\BillingInterface;
use Illuminate\Contracts\Mail\Mailer;
use Ecom\Repository\Order\OrderInterface;

class OrderProcessor
{
    public function __construct(OrderInterface $order,
                                Store $store,
                                BillingInterface $billing,
                                Cart $cart,
                                Mailer $mailer
                                )
    {
        $this->order    = $order;
        $this->session  = $store;
        $this->billing  = $billing;
        $this->cart     = $cart;
        $this->mailer   = $mailer;
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

            $this->mailer->queue('emails.orderconfirmation', ['user' => $user, 'order' => $order],
                       function($m) use ($user, $order) {
                            $m->from('orderconfirmation@app.com', 'Your order');

                            $m->to($user->email, $user->name)->subject('Order Confirmation ref: ' . $order->id);
            });
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
