<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Clockin;
use Faker\Generator as Faker;

$factory->define(Clockin::class, function (Faker $faker) {

    return [
        'date' => $faker->word,
        'type' => $faker->word,
        'name' => $faker->word,
        'user_id' => $faker->randomDigitNotNull,
        'start_time' => $faker->date('Y-m-d H:i:s'),
        'end_time' => $faker->date('Y-m-d H:i:s'),
        'over_time' => $faker->word,
        'late_time' => $faker->word,
        'leave_early_time' => $faker->word,
        'total' => $faker->word,
        'verify' => $faker->word,
        'note' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
