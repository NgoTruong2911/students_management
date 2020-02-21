<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Carbon\Carbon;

$factory->define(User::class, function (Faker $faker) {
    $faculty = App\Models\Faculty::pluck('id')->toArray();
    return [
        'name' => $faker->name,
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'phone_number' => $faker->e164PhoneNumber,
        'age' => $faker->numberBetween(0,100),
        'gender' => $faker->numberBetween($min = 1, $max = 2),
        'avatar' => $faker->imageUrl($width = 640, $height = 480),
        'faculty_id' => $faker->randomElement($faculty),
        'password' => Hash::make('1234567'),
        'remember_token' => Str::random(10) // password
    ];
});
