<?php

use App\User;
use App\Category;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function an_admin_can_view_cms_list_of_categories()
    {
        $user = factory(User::class)->create(['admin' => 1]);

        $categoryOne = factory(Category::class)->create();
        $categoryTwo = factory(Category::class)->create();

        $this->actingAs($user)
             ->visit('/categories')
             ->see($categoryOne->name)
             ->see($categoryTwo->name);
    }

    /** @test */
    public function an_admin_can_add_a_category()
    {
        $user = factory(User::class)->create(['admin' => 1]);

        $this->actingAs($user)
             ->visit('categories/create')
             ->type('name', 'name')
             ->press('Add New Category')
             ->seeInDatabase('categories', ['name' => 'name'])
             ->seePageIs('categories');
    }

    /** @test */
    public function an_admin_can_edit_a_category_name()
    {
        $user = factory(User::class)->create(['admin' => 1]);

        $category = factory(Category::class)->create();

        $this->actingAs($user)
             ->visit('categories/' . $category->id . '/edit')
             ->type('fortyTwo', 'name')
             ->press('Update Category')
             ->seeInDatabase('categories', ['name' => 'fortyTwo'])
             ->seePageIs('categories');
    }
}
