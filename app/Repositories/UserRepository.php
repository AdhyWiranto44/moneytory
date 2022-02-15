<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    static function getOne(String $username = "")
    {
        return User::firstWhere('username', $username);
    }
}