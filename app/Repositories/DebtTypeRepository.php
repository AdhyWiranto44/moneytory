<?php

namespace App\Repositories;

use App\Models\DebtType;
use Illuminate\Support\Facades\DB;

class DebtTypeRepository
{
    static function getAll()
    {
        return DebtType::all();
    }
}