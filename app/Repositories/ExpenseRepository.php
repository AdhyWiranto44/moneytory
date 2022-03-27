<?php

namespace App\Repositories;

use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class ExpenseRepository
{
    public function __construct()
    {
        $this->expense = new Expense();
    }

    public function get($params)
    {
        return $this->expense->where($params)->get();
    }

    public function getLastRow()
    {
        return DB::table('expenses')->select('id')->orderByDesc('id')->limit(1)->first();
    }

    public function insert($data)
    {
        $this->expense->create($data)->save();
    }

    public function update($params, $update)
    {
        $this->expense->where($params)->update($update);
    }

    public function delete($params)
    {
        $this->expense->where($params)->delete();
    }
}