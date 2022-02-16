<?php

namespace App\Repositories;

use App\Models\DebtStatus;

class DebtStatusRepository
{
    public function __construct()
    {
        $this->debtStatus = new DebtStatus();
    }

    public function getAll()
    {
        return $this->debtStatus->all();
    }
}