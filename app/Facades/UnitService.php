<?php

namespace App\Facades;

use App\Repositories\UnitRepository;

class UnitService {
    public function __construct()
    {
        $this->unitRepository = new UnitRepository();
    }

    public function getAll()
    {
        return $this->unitRepository->getAll();
    }

    public function getOne(String $name = "")
    {
        $params = [ 'name' => $name ];
        return $this->unitRepository->get($params)->first();
    }

    public function insert()
    {
        $data = [ 'name' => request()->input('name') ];

        $this->unitRepository->insert($data);
    }

    public function update(String $name = "", $role)
    {
        $params = [ 'name' => $name ];
        $update = [
            'name' => request()->input('name') != null ? request()->input('name') : $role->name,
            'updated_at' => now()
        ];

        $this->unitRepository->update($params, $update);
    }

    public function delete($name)
    {
        $params = [ 'name' => $name ];
        $this->unitRepository->delete($params);
    }
}