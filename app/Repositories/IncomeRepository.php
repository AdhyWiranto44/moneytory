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

    public function getByDate($params)
    {
        return DB::table('incomes')
            ->join('income_statuses', 'incomes.income_status_id', '=', 'income_statuses.id')
            ->select('incomes.*', 'income_statuses.name as status')
            ->where("incomes.created_at", ">=", $params["from"])
            ->where("incomes.created_at", "<=", $params["to"])
            ->where("incomes.products", "LIKE", "%".$params["code"]."%")
            ->get();
    }

    public function getLastRow()
    {
        return DB::table('incomes')->select('*')->orderByDesc('id')->limit(1)->first();
    }

    public function insert($data)
    {
        $this->income->create($data)->save();
    }

    public function update($params, $update)
    {
        $this->income->where($params)->update($update);
    }

    public function delete($params)
    {
        $this->income->where($params)->delete();
    }
}