<?php

namespace App\Facades;

use App\Repositories\DebtTypeRepository;

class DebtTypeService
{
    public function __construct()
    {
        $this->debtTypeRepository = new DebtTypeRepository();
    }

    public function getAll()
    {
        return $this->debtTypeRepository->getAll();
    }
}