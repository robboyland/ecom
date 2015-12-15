<?php

use App\Item;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Storage;
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

        $test_image = env('TEST_IMAGE_PATH');
        $mime_type_parts = explode("/", mime_content_type($test_image));
        $mime_type = $mime_type_parts[1];

        $this->actingAs($user)
             ->visit('items/create')
             ->type('name', 'name')
             ->select($categoryTwo->id, 'category_id')
             ->type('description', 'description')
             ->type(100, 'cost')
             ->attach(env('TEST_IMAGE_PATH'), 'image')
             ->press('Add New Item')
             ->seeInDatabase('items', ['name' => 'name',
                             'category_id' => $categoryTwo->id,
                             'description' => 'description',
                             'cost' => 100])
             ->seePageIs('items');

             $item = \DB::table('items')->where('name', 'name')->first();

             $exists = Storage::disk('s3')->has('items/' . $item->id . '.' . $mime_type);

             $this->assertEquals(true, $exists);

             Storage::disk('s3')->delete('items/' . $item->id . '.' . $mime_type);
    }

    /** @test */
    public function an_admin_can_update_an_items_details()
    {
        $user = factory(User::class)->create(['admin' => '1']);

        $item = factory(Item::class)->create();

        $category = factory(Category::class)->create();

        $this->actingAs($user)
             ->visit('items/' . $item->id . '/edit')
             ->type('name', 'name')
             ->select($category->id, 'category_id')
             ->type('description', 'description')
             ->type(1999, 'cost')
             ->press('Update Item')
             ->seeInDatabase('items', [
                             'name' => 'name',
                             'category_id' => $category->id,
                             'description' => 'description',
                             'cost' => 1999]
                             )
             ->seePageIs('items');
    }

    /** @test */
    public function an_admin_can_delete_an_item()
    {
        $user = factory(User::class)->create(['admin' => '1']);

        $item = factory(Item::class)->create();

        $this->actingAs($user)
             ->visit('items')
             ->press('delete-item-' . $item->id)
             ->notseeInDatabase('items', ['id' => $item->id])
             ->seePageIs('items');
    }
}
