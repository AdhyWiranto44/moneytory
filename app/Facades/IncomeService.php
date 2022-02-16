<?php

namespace App\Facades;

use App\Repositories\IncomeRepository;

class IncomeService
{
    public function __construct()
    {
        $this->incomeRepository = new IncomeRepository();
    }

    public function getPriceSumByDate($from, $to)
    {
        $params = [
            [ "income_status_id", "=", 2 ], 
            [ "created_at", ">=", $from ], 
            [ "created_at", "<=", $to ]
        ];
        return $this->incomeRepository->get($params)->sum('total_price');
    }
}