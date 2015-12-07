<?php

use App\User;
use App\Category;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function an_admin_can_add_an_item()
    {
        $user = factory(User::class)->create(['admin' => '1']);

        $categoryOne = factory(Category::class)->create();
        $categoryTwo = factory(Category::class)->create();

        $this->actingAs($user)
             ->visit('items/create')
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
