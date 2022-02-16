<?php

namespace App\Facades;

use App\Repositories\DebtTypeRepository;

class DebtTypeService
{
    static function getAll()
    {
        return DebtTypeRepository::getAll();
    }
}