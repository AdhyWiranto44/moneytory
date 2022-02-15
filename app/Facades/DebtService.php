<?php

namespace App\Facades;

use App\Repositories\DebtRepository;

class DebtService
{
    static function getByDate($from, $to)
    {
        $params = [
            ["debt_status_id", "=", 2], 
            ["created_at", ">=", $from], 
            ["created_at", "<=", $to]
        ];
        return DebtRepository::get($params)->sum('price');
    }
}