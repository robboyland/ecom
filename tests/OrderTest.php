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
    public function a_user_can_view_orders_on_dashboard()
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
    public function a_user_cannot_view_another_users_orders_on_dashboard()
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

    /** @test */
    public function an_admin_can_view_all_orders()
    {
        $user = factory(User::class)->create(['admin' => 1]);

        $order = factory(Order::class)->create(['user_id' => $user->id]);
        $orderTwo = factory(Order::class)->create(['user_id' => 9]);

        $orderItem = factory(OrderItem::class)->create(['order_id' => $order->id]);
        $orderItemTwo = factory(OrderItem::class)->create(['order_id' => $orderTwo->id]);

        $this->actingAs($user)
             ->visit('/orders')
             ->see($order->charge_id)
             ->see($orderTwo->charge_id);
    }

    /** @test */
    public function an_admin_can_view_an_individual_order()
    {
        $user = factory(User::class)->create(['admin' => 1]);

        $order = factory(Order::class)->create(['user_id' => $user->id]);

        $orderItem = factory(OrderItem::class)->create(['order_id' => $order->id]);

        $this->actingAs($user)
             ->visit('orders/' . $order->id)
             ->see($order->id)
             ->see($orderItem->name)
             ->see($order->total / 100)
             ->see($orderItem->price / 100)
             ->see($user->name)
             ->see($user->name_number)
             ->see($user->street)
             ->see($user->city)
             ->see($user->county)
             ->see($user->postcode)
             ->seePageIs('orders/' . $order->id);
    }

    public function a_user_cannot_view_another_users_order()
    {
        $user = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $order = factory(Order::class)->create(['user_id' => $user->id]);

        $this->actingAs($userTwo)
             ->visit('orders/' . $order->id)
             ->seePageIs('dashboard');
    }

    /** @test */
    public function an_admin_can_view_a_users_order()
    {
        $user = factory(User::class)->create();
        $userTwo = factory(User::class)->create(['admin' => 1]);

        $order = factory(Order::class)->create(['user_id' => $user->id]);

        $this->actingAs($userTwo)
             ->visit('orders/' . $order->id)
             ->seePageIs('orders/' . $order->id);
    }
}
