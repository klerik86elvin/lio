<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => 'Farida',
        'login' => 'farida',
        'password' => bcrypt('farida123'),
        'department_id' => 1
    ];
});
