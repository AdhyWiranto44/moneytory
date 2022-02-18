<?php

namespace App\Facades;

use App\Repositories\RoleRepository;

class RoleService {
    public function __construct()
    {
        $this->roleRepository = new RoleRepository();
    }

    public function getAll()
    {
        return $this->roleRepository->getAll();
    }
}