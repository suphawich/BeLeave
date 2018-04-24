<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'full_name' => $faker->name,
        // 'avatar' => $faker->image('C:/xampp/htdocs/BeLeave/public/images/profiles',640,480,'cats'),
        // 'avatar' => $faker->image('/Applications/MAMP/htdocs/BeLeave/public/images/profiles',640,480,'cats'),
        'avatar' => '',
        'address' => $faker->address,
        'access_level' => $faker->randomElement([
            'Guest', 'Subordinate', 'Supervisor', 'Administrator'
        ]),
        'tel' => $faker->phoneNumber,
        'company_name' => $faker->company,
        'is_enabled' => $faker->boolean(90),
        'token' => $faker->sha256,
        'remember_token' => null
    ];
});
