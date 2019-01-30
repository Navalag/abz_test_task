<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'fio' => $faker->name,
        'position' => $faker->jobTitle,
        'employment_date' => date("Y-m-d H:i:s",rand(1262055681,time())),
        'salary' => random_int(1000, 5000),
        'boss_id' => random_int(0, 9),
    ];
});
