<?php

use App\Models\Tag;
use App\Models\Tool;
use Faker\Generator;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Tag::class, function (Generator $faker) {
    return [
        'name' => str_slug($faker->word),
    ];
});

$factory->define(Tool::class, function (Generator $faker) {
    return [
        'title' => $faker->company,
        'link' => $faker->url,
        'description' => $faker->text,
    ];
});
