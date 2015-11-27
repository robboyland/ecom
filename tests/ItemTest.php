<?php

use App\Category;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function can_add_an_item()
    {
        $categoryOne = factory(Category::class)->create();
        $categoryTwo = factory(Category::class)->create();

        $this->visit('items/create')
             ->type('name', 'name')
             ->select($categoryTwo->id, 'category_id')
             ->type('description', 'description')
             ->type(100, 'cost')
             ->press('Add New Item')
             ->seeInDatabase('items', ['name' => 'name',
                             'category_id' => $categoryTwo->id,
                             'description' => 'description',
                             'cost' => 100])
             ->seePageIs('items');
    }
}
