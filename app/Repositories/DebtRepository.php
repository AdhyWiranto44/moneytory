<?php

namespace App\Repositories;

use App\Models\Debt;

class DebtRepository
{
    static function get($params)
    {
        return Debt::where($params)->get();
    }
}