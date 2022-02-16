<?php

namespace App\Facades;

use App\Repositories\DebtStatusRepository;

class DebtStatusService
{
    public function __construct()
    {
        $this->debtStatusRepository = new DebtStatusRepository();
    }

    public function getAll()
    {
        return $this->debtStatusRepository->getAll();
    }
}