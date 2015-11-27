<?php

use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StoreTest extends TestCase
{
    /** @test */
    public function shows_items_on_home_page()
    {
        $itemOne = factory(Item::class)->create();
        $itemTwo = factory(Item::class)->create();

        $this->visit('/')
             ->see($itemOne->name)
             ->see($itemTwo->name);
    }

    /** @test */
    public function shows_individual_item_page()
    {
        $item = factory(Item::class)->create();

        $this->visit('/' . $item->id)
             ->see($item->name)
             ->see($item->description)
             ->see($item->cost);
    }
}
