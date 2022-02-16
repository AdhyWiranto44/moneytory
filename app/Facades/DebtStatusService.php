<?php

namespace App\Facades;

use App\Repositories\DebtStatusRepository;

class DebtStatusService
{
    static function getAll()
    {
        return DebtStatusRepository::getAll();
    }
}