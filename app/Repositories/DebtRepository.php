<?php

namespace App\Repositories;

use App\Models\Debt;
use Illuminate\Support\Facades\DB;

class DebtRepository
{
    public function __construct()
    {
        $this->debt = new Debt();
    }

    public function get($params)
    {
        return $this->debt->where($params)->get();
    }

    public function getWithTypeAndStatus($params)
    {
        return DB::table('debts')
            ->join('debt_types', 'debts.debt_type_id', '=', 'debt_types.id')
            ->join('debt_statuses', 'debts.debt_status_id', '=', 'debt_statuses.id')
            ->select('debts.*', 'debt_types.name as type', 'debt_statuses.name as status')
            ->where("debts.created_at", ">=", $params['from'])
            ->where("debts.created_at", "<=", $params['to'])
            ->get();
    }

    public function insert($data)
    {
        $this->debt->create($data)->save();
    }

    public function update($params, $update)
    {
        $this->debt->where($params)->update($update);
    }
    
    public function delete($params)
    {
        $this->debt->where($params)->delete();
    }
}