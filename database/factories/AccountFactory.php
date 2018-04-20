<?php

use Faker\Generator as Faker;

$factory->define(App\Account::class, function (Faker $faker) {
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
        'token' => $faker->sha256
    ];
});
