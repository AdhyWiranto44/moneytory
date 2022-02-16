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

    static function insert()
    {
        $data = [
            'debt_type_id' => request()->input('debt_type'),
            'debt_status_id' => request()->input('debt_status'),
            'name' => request()->input('name'),
            'code' => request()->input('code'),
            'description' => request()->input('description'),
            'price' => request()->input('price'),
            'on_behalf_of' => request()->input('on_behalf_of'),
            'phone_number' => request()->input('phone_number'),
            'address' => request()->input('address'),
            'created_at' => now(),
            'updated_at' => now()
        ];

        DebtRepository::insert($data);
    }

    static function update($code, $debt)
    {
        $params = [ 'code' => $code ];
        $update = [
            'debt_type_id' => request()->input('debt_type') != null ? request()->input('debt_type') : $debt->debt_type_id,
            'debt_status_id' => request()->input('debt_status') != null ? request()->input('debt_status') : $debt->debt_status_id,
            'name' => request()->input('name') != null ? request()->input('name') : $debt->name,
            'code' => request()->input('code') != null ? request()->input('code') : $debt->code,
            'description' => request()->input('description') != null ? request()->input('description') : $debt->description,
            'price' => request()->input('price') != null ? request()->input('price') : $debt->price,
            'on_behalf_of' => request()->input('on_behalf_of') != null ? request()->input('on_behalf_of') : $debt->on_behalf_of,
            'phone_number' => request()->input('phone_number') != null ? request()->input('phone_number') : $debt->phone_number,
            'address' => request()->input('address') != null ? request()->input('address') : $debt->address,
            'updated_at' => now()
        ];

        DebtRepository::update($params, $update);
    }
    
    static function delete($code)
    {
        $params = [ 'code' => $code ];
        DebtRepository::delete($params);
    }
}