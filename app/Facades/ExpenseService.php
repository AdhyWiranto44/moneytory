<?php

namespace App\Facades;

use App\Repositories\ExpenseRepository;

class ExpenseService
{
    static function getByDate($from, $to)
    {
        $params = [
            ["created_at", ">=", $from], 
            ["created_at", "<=", $to]
        ];
        return ExpenseRepository::get($params)->sum('cost');
    }
}