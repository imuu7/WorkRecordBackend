<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Users;
use Faker\Generator as Faker;

$factory->define(Users::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'email' => $faker->word,
        'email_verified_at' => $faker->date('Y-m-d H:i:s'),
        'password' => $faker->word,
        'role' => $faker->word,
        'remember_token' => $faker->word,
        'active' => $faker->randomDigitNotNull,
        'stoken' => $faker->word,
        'nick' => $faker->word,
        'bank_name' => $faker->word,
        'bank_code' => $faker->word,
        'bank_number' => $faker->word,
        'bank_account' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
