<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Illuminate\Support\Facades\App;

$factory->define(App\Task::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
        'status' => $faker->status,
        'description' => $faker->description,
        'hoursRequired' => $faker->hoursRequired,
        'hoursConsumed' => $faker->hoursConsumed
    ];
});
