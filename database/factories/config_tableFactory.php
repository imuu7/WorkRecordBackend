<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\config_table;
use Faker\Generator as Faker;

$factory->define(config_table::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'val' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
