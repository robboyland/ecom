<?php

use App\Category;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function shows_list_of_categories()
    {
        $categoryOne = factory(Category::class)->create();
        $categoryTwo = factory(Category::class)->create();

        $this->visit('/categories')
             ->see($categoryOne->name)
             ->see($categoryTwo->name);
    }

    /** @test */
    public function can_add_a_category()
    {
        $this->visit('categories/create')
             ->type('name', 'name')
             ->press('Add New Category')
             ->seeInDatabase('categories', ['name' => 'name'])
             ->seePageIs('categories');
    }
}
