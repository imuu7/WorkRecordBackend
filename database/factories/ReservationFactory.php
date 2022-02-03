<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reservation;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'reserve_time' => $faker->date('Y-m-d H:i:s'),
        'reserve_items' => $faker->word,
        'phone' => $faker->word,
        'note' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
