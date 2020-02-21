<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\User_subject;
use Faker\Generator as Faker;

$factory->define(User_subject::class, function (Faker $faker) {
    $subject = App\Models\Subject::pluck('id')->toArray();
    $user = App\Models\User::pluck('id')->toArray();
    return [
        'subject_id' => $faker->randomElement($subject),
        'user_id' => $faker->randomElement($user),
        'point' => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 10)
    ];
});
