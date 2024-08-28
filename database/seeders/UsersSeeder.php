<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Example of inserting a single user
        DB::table('users')->insert([
            [
                'username' => 'brzorza',
                'email' => 'wiktorbrzoza13@gmail.com',
                'phone_number' => '231123544',
                'password' => Hash::make('123123123'),
                'type' => UserTypeEnum::SELLER,
                'profile_picture' => 'images/profile_pictures/no-image.jpg',
            ],
            [
                'username' => 'Wiczag',
                'email' => 'wiktoriapajdo@gmail.com',
                'phone_number' => '231123544',
                'password' => Hash::make('123123123'),
                'type' => UserTypeEnum::USER,
                'profile_picture' => 'images/profile_pictures/no-image.jpg',
            ],
            [
                'username' => 'test_user',
                'email' => 'test@gmail.com',
                'phone_number' => '231123544',
                'password' => Hash::make('123123123'),
                'type' => UserTypeEnum::USER,
                'profile_picture' => 'images/profile_pictures/no-image.jpg',
            ],
            [
                'username' => 'next_bro',
                'email' => 'next_bro@gmail.com',
                'phone_number' => '231123544',
                'password' => Hash::make('123123123'),
                'type' => UserTypeEnum::USER,
                'profile_picture' => 'images/profile_pictures/no-image.jpg',
            ],
            [
                'username' => 'Krzysztof K',
                'email' => 'krzysztofk@gmail.com',
                'phone_number' => '231123544',
                'password' => Hash::make('123123123'),
                'type' => UserTypeEnum::USER,
                'profile_picture' => 'images/profile_pictures/no-image.jpg',
            ],
        ]);
    }
}
