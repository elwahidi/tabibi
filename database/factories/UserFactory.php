<?php

use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'last_name' => $faker->firstName(),
        'first_name' => $faker->lastName(),
        'birth' => $faker->date('Y-m-d'),
        'address' => $faker->address,
        'category_id' => $faker->numberBetween(1,1),
        'specialty_id' => $faker->numberBetween(1,1),
        'sex_id' => $faker->numberBetween(1,2),
        'city_id' => $faker->numberBetween(1,1),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
