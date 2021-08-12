<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Skema;

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Skema::class, function (Faker $faker) {
    return [
        'skema_label' => $faker->unique()->word,
    ];
});
