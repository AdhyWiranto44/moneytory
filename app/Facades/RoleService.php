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

    public function getOne(String $name = "")
    {
        $params = [ 'name' => $name ];
        return $this->roleRepository->get($params)->first();
    }

    public function insert()
    {
        $data = [ 'name' => request()->input('name') ];

        $this->roleRepository->insert($data);
    }

    public function update(String $name = "", $role)
    {
        $params = [ 'name' => $name ];
        $update = [
            'name' => request()->input('name') != null ? request()->input('name') : $role->name,
            'updated_at' => now()
        ];

        $this->roleRepository->update($params, $update);
    }

    public function delete($name)
    {
        $params = [ 'name' => $name ];
        $this->roleRepository->delete($params);
    }
}