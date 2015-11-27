<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function can_add_an_item()
    {
        $this->visit('items/create')
             ->type('name', 'name')
             ->type('description', 'description')
             ->type('cost', 'cost')
             ->press('Add New Item')
             ->seeInDatabase('items', ['name' => 'name',
                             'description' => 'description',
                             'cost' => 'cost'])
             ->seePageIs('items');
    }
}
