<?php

use Faker\Generator as Faker;

$factory->define(App\Student::class, function (Faker $faker) {
     return [
        'id' => $faker->asciify('*******')->unique(),
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName()
    ];
});
