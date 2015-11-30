<?php

use App\Item;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{

    public function run()
    {
        Item::truncate();

        factory(App\Item::class, 12)->create();
    }
}
