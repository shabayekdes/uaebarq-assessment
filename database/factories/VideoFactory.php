<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'video_uri' => $faker->word(),
        'image_url' => $faker->word(),
        'keyword' => $faker->sentence(),
        'is_send_notification' => $faker->boolean(),
        'created_by' => 1,
    ];
});
