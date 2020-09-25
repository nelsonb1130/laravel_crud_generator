<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Admin\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {

    return [
        'type' => $faker->randomElement(]),
        'amount' => $faker->randomDigitNotNull,
        'description' => $faker->text,
        'created_date' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
