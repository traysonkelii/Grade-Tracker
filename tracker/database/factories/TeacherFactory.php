<?php

use Faker\Generator as Faker;
use App\Department as Department;

$factory->define(App\Teacher::class, function (Faker $faker) {
    return [
        'id' => $faker->asciify('*******')->unique(),
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'department_id' => $faker->number()
    ];
});
