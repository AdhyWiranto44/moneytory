<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct()
    {
        $this->user = new User();
    }

    public function insert($data)
    {
        $this->user->create($data)->save();
    }
    
    public function get($params)
    {
        return $this->user->where($params)->get();
    }
}