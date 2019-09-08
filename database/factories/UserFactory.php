<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
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
        'nik' => $faker->unique()->ean8,
        'password' => '$2y$12$Rt7cwx0EO5UPu0BZ0UqobuBpjvvt1medOhL46Lx8GxuhOFgOYwozG',
        'role_id' => '2',
        'name' => $faker->name,
        'created_at' => date('Y-m-d H:i:s')
    ];
});
