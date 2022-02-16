<?php

namespace App\Repositories;

use App\Models\DebtType;

class DebtTypeRepository
{
    public function __construct()
    {
        $this->debtType = new DebtType();
    }

    public function getAll()
    {
        return $this->debtType->all();
    }
}