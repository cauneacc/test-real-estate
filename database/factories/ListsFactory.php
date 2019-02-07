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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Lists::class, function (Faker\Generator $faker) {
	$cityIds = App\Cities::all()->pluck('id')->toArray();
	$developerIds = App\Developers::all()->pluck('id')->toArray();

    return [
        'price' => rand(1,9999),
        'city_id' => $faker->randomElement($cityIds),
		'developer_id' => $faker->randomElement($developerIds),
        'name' => $faker->name,
		'is_on_sale' => (bool)rand(0,1),
    ];
});
