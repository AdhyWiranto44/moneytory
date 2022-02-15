<?php

namespace App\Facades;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    static function insertDefaultUser()
    {
        $formInput = [
            'role_id' => 1,
            'status_id' => 2,
            'username' => 'admin',
            'password' => Hash::make('12345', ['rounds' => 10]),
            'name' => 'Administrator',
            'phone_number' => '088976685446',
            'email' => null,
            'address' => null,
            'image' => null,
            'created_at' => now(),
            'updated_at' => now()
        ];
        UserRepository::insert($formInput);
    }

    static function getUserLogin(String $username = "")
    {
        $params = [ 'username' => $username ];
        return UserRepository::get($params)->first();
    }
}