<?php

namespace App\Repositories;

use App\Models\Expense;

class ExpenseRepository
{
    static function get($params)
    {
        return Expense::where($params)->get();
    }
}