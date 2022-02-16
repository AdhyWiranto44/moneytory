<?php

namespace App\Repositories;

use App\Models\Debt;
use Illuminate\Support\Facades\DB;

class DebtRepository
{
    static function get($params)
    {
        return Debt::where($params)->get();
    }

    static function getWithTypeAndStatus($params)
    {
        return DB::table('debts')
            ->join('debt_types', 'debts.debt_type_id', '=', 'debt_types.id')
            ->join('debt_statuses', 'debts.debt_status_id', '=', 'debt_statuses.id')
            ->select('debts.*', 'debt_types.name as type', 'debt_statuses.name as status')
            ->where("debts.created_at", ">=", $params['from'])
            ->where("debts.created_at", "<=", $params['to'])
            ->get();
    }

    static function insert($data)
    {
        Debt::create($data)->save();
    }

    static function update($params, $update)
    {
        Debt::where($params)->update($update);
    }
    
    static function delete($params)
    {
        Debt::where($params)->delete();
    }
}