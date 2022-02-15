<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    static function insert($data)
    {
        User::create($data)->save();
    }
    
    static function get($params)
    {
        return User::where($params)->get();
    }
}