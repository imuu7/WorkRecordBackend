<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\LineConfig;
use Faker\Generator as Faker;

$factory->define(LineConfig::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'val' => $faker->word,
        'nickname' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
