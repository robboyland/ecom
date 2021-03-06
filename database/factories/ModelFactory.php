<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('password'),
        'admin' => 0,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Item::class, function (Faker\Generator $faker) {
    return [
        'category_id' => 1,
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'cost' => $faker->numberBetween($min = 1000, $max = 90000),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'total' => $faker->numberBetween($min = 1000, $max = 90000),
        'paid' => 'paid',
        'charge_id' => 'ch_' . $faker->shuffle('17DdfqJXm5fgVsifgbK9TprB'),
    ];
});

$factory->define(App\OrderItem::class, function (Faker\Generator $faker) {
    return [
        'product_id' => 2,
        'name' => $faker->sentence(3),
        'description' => $faker->sentence,
        'price' => $faker->numberBetween($min = 1000, $max = 90000),
        'quantity' => 1,
    ];
});
