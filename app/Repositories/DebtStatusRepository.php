<?php

namespace App\Repositories;

use App\Models\DebtStatus;

class DebtStatusRepository
{
    static function getAll()
    {
        return DebtStatus::all();
    }
}