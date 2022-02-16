<?php

namespace App\Facades;

use App\Repositories\DebtRepository;

class DebtService
{
    static function getOne(String $code = "")
    {
        $params = [ 'code' => $code ];
        return DebtRepository::get($params)->first();
    }

    static function getByDate($from, $to)
    {
        $params = [ 'from' => $from, 'to' => $to ];
        return DebtRepository::getWithTypeAndStatus($params);
    }

    static function getPriceSumByDate($from, $to)
    {
        $params = [
            ["debt_status_id", "=", 2], 
            ["created_at", ">=", $from], 
            ["created_at", "<=", $to]
        ];
        return DebtRepository::get($params)->sum('price');
    }

    static function insert($data)
    {
        DebtRepository::insert($data);
    }

    static function update($code, $update)
    {
        $params = [ 'code' => $code ];
        DebtRepository::update($params, $update);
    }
    
    static function delete($code)
    {
        $params = [ 'code' => $code ];
        DebtRepository::delete($params);
    }
}