<?php

namespace Ecom\Repository\Order;

use App\Order;
use App\OrderItem;

class EloquentOrderRepository implements OrderInterface
{
    public function saveOrder($user, $cart)
    {
        $order = Order::create(['user_id' => $user->id]);

        $orderItems = [];

        foreach ($cart as $id => $item)
        {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $id;
            $orderItem->name = $item['name'];
            $orderItem->description = 'description';
            $orderItem->price = $item['price'];
            $orderItem->quantity = $item['qty'];

            $orderItems[] = $orderItem;
        }

        $order->orderItems()->saveMany($orderItems);

        $order->total = $this->orderTotal($order->id);
        $order->save();

        return $order;
    }

    public function orderTotal($orderId)
    {
        $items = OrderItem::where('order_id', '=', $orderId)->get();

        $total = 0;

        foreach ($items as $item)
        {
            $total += $item->quantity * $item->price;
        }

        return $total;
    }

}
