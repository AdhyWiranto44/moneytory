<?php

namespace App\Repositories;

use App\Models\Expense;

class ExpenseRepository
{
    static function get($params)
    {
        return Expense::where($params)->get();
    }

    static function insert($data)
    {
        Expense::create($data)->save();
    }

    static function update($params, $update)
    {
        Expense::where($params)->update($update);
    }

    static function delete($params)
    {
        Expense::where($params)->delete();
    }
}