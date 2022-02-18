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
}