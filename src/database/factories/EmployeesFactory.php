<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'fio' => $faker->name,
        'position' => $faker->jobTitle,
        'employment_date' => now(),
        'salary' => 1500,
        'boss_id' => str_random(10),
    ];
});
