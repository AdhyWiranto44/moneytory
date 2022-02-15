<?php

namespace App\Facades;

use App\Repositories\IncomeRepository;

class IncomeService
{
    static function getByDate($from, $to)
    {
        $params = [
            [ "income_status_id", "=", 2 ], 
            [ "created_at", ">=", $from ], 
            [ "created_at", "<=", $to ]
        ];
        return IncomeRepository::get($params)->sum('total_price');
    }
}