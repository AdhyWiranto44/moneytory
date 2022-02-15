<?php

namespace App\Facades;

use App\Repositories\UserRepository;

class UserService
{
    static function getUserLogin(String $username = "")
    {
        return UserRepository::getOne($username);
    }
}