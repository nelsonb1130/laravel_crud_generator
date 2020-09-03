<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\contacts;
use Faker\Generator as Faker;

$factory->define(contacts::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'first_name' => $faker->word,
        'sur_name' => $faker->word,
        'description' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
