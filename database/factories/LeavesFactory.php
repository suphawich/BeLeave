<?php

use Faker\Generator as Faker;

$factory->define(App\Leave::class, function (Faker $faker) {
    return [
      'subordinate_id' => $faker->unique()->randomNumber(),
      'substitute_id' => $faker->unique()->randomNumber(),
      'description' => $faker->text,
      'leave_type' => $faker->randomElement([
        'Vacation', 'Personal Errand', 'Sick'
      ]),
      'is_enabled' => $faker->boolean(90),
      'is_approved' => $faker->boolean(90)




        //
    ];
});
