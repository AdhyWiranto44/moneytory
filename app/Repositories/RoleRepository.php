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

    public function get($params)
    {
        return $this->role->where($params)->get();
    }

    public function insert($data)
    {
        $this->role->create($data)->save();
    }

    public function update($params, $update)
    {
        $this->role->where($params)->update($update);
    }

    public function delete($params)
    {
        $this->role->where($params)->delete();
    }
}