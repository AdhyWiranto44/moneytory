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
}