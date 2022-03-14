<?php

namespace App\Repositories;

use App\Models\Unit;

class UnitRepository {
    public function __construct()
    {
        $this->unit = new Unit();
    }

    public function getAll()
    {
        return $this->unit->all();
    }

    public function get($params)
    {
        return $this->unit->where($params)->get();
    }

    public function insert($data)
    {
        $this->unit->create($data)->save();
    }

    public function update($params, $update)
    {
        $this->unit->where($params)->update($update);
    }

    public function delete($params)
    {
        $this->unit->where($params)->delete();
    }
}