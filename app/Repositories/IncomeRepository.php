<?php

namespace App\Repositories;

use App\Models\Income;

class IncomeRepository
{
    static function get($params)
    {
        return Income::where($params)->get();
    }
}