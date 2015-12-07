<?php

use App\User;
use App\Order;
use App\OrderItem;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function user_can_view_orders_on_dashboard()
    {
        $user = factory(User::class)->create();

        $order = factory(Order::class)->create(['user_id' => $user->id]);
        $orderTotal = $order->total / 100;

        $orderTwo = factory(Order::class)->create(['user_id' => 9]);

        $orderItem = factory(OrderItem::class)->create(['order_id' => $order->id]);

        $this->actingAs($user)
             ->visit('/dashboard')
             ->see($order->charge_id)
             ->see($orderTotal)
             ->see($orderItem->name);
    }

    /** @test */
    public function user_cannot_view_anothers_users_orders_on_dashboard()
    {
        $user = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $order = factory(Order::class)->create(['user_id' => $user->id]);
        $orderTotal = $order->total / 100;

        $orderTwo = factory(Order::class)->create(['user_id' => 9]);

        $orderItem = factory(OrderItem::class)->create(['order_id' => $order->id]);

        $this->actingAs($userTwo)
             ->visit('/dashboard')
             ->dontsee($order->charge_id)
             ->dontsee($orderTotal)
             ->dontsee($orderItem->name)
             ->dontsee($orderItem->description);
    }
}
