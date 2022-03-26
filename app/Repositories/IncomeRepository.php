<?php

namespace App\Repositories;

use App\Models\Income;
use Illuminate\Support\Facades\DB;

class IncomeRepository
{
    public function __construct()
    {
        $this->income = new Income();
    }

    public function get($params)
    {
        return $this->income->where($params)->get();
    }

    public function getLastRow()
    {
        return DB::table('incomes')->select('id')->orderByDesc('id')->limit(1)->first();
    }
}