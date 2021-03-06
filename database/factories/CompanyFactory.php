<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


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

$factory->define(Company::class, function (Faker $faker) {
    return [
        'role_id' => 1,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make(Str::random(10)),
        'logo' => 'pci-dss.png',
        'url' => 'https://www.'.Str::random(10).'com'
    ];
});
