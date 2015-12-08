<?php

use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CartTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function can_add_item_to_cart()
    {
        $item = factory(Item::class)->create();

        $displayCost = $item->cost / 100;

        $this->visit('/')
             ->see($item->name)
             ->press('add-to-cart-' . $item->id)
             ->seePageIs('cart')
             ->see($item->name)
             ->see($displayCost);
    }

    /** @test */
    public function can_add_item_to_cart_from_individual_item_page()
    {
        $item = factory(Item::class)->create();

        $displayCost = $item->cost / 100;

        $this->visit('/'. $item->id)
             ->see($item->name)
             ->press('Add to cart')
             ->seePageIs('cart')
             ->see($item->name)
             ->see($displayCost);
    }

    /** @test */
    public function cart_shows_correct_total()
    {
        $this->withSession(['cart' => [
                                1 => [ 'name' => 'foo', 'qty' => 1, "price" => 101],
                                2 => [ 'name' => 'bar', 'qty' => 1, "price" => 220],
                                3 => [ 'name' => 'baz', 'qty' => 1, "price" => 303]
                                ]
                           ])
             ->visit('/cart')
             ->see(6.24);
    }

    /** @test */
    public function can_delete_item_from_cart()
    {
        $this->withSession(['cart' => [
                                1 => [ 'name' => 'foo', 'qty' => 1, "price" => 101],
                                2 => [ 'name' => 'bar', 'qty' => 1, "price" => 220],
                                3 => [ 'name' => 'baz', 'qty' => 1, "price" => 303]
                                ]
                           ])
             ->visit('/cart')
             ->see('baz')
             ->press('delete-item-' . 3)
             ->DontSee('baz')
             ->see('foo')
             ->see('bar')
             ->see(3.21);
    }
}
