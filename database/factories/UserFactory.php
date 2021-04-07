<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserModel;
use Faker\Generator as Faker;

$l=1;
$factory->define(UserModel::class, function (Faker $faker) use (&$l) {
    return [
                'username' => $faker->userName,
                'email' => 'admin@gmail.com',
                'password' => md5('1'), // password
                'fullname' => $faker->name,
                'thumb' => '/admin/images/user/img.jpg',
                'level' => 'admin',
                'status' => 'active',
                'created'=>now(),
                'created_at'=>now(),
                'created_by'=>'admin',
            ];


});
