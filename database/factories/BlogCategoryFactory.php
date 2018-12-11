<?php

use App\BlogCategory;
use Faker\Generator as Faker;

$factory->define(BlogCategory::class, function (Faker $faker) {
    return [
        'category_name'=>$faker->name,
        'category_slug'=>$faker->slug
    ];
});
