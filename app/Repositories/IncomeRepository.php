<?php

namespace App\Repositories;

use App\Models\Income;

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
}