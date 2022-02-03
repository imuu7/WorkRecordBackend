<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\tel_msg_log;
use Faker\Generator as Faker;

$factory->define(tel_msg_log::class, function (Faker $faker) {

    return [
        'message_id' => $faker->word,
        'msg_from_id' => $faker->randomDigitNotNull,
        'msg_from_body' => $faker->text,
        'message_date' => $faker->date('Y-m-d H:i:s'),
        'chat_body' => $faker->text,
        'chat_text' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
