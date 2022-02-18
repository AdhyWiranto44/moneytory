<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository {
    public function __construct()
    {
        $this->role = new Role();
    }

    public function getAll()
    {
        return $this->role->all();
    }
}