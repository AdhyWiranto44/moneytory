<?php

namespace App\Facades;

use App\Helper;
use App\Repositories\ExpenseRepository;

class ExpenseService
{
    static function getOne(String $code = "")
    {
        $params = [ 'code' => $code ];
        return ExpenseRepository::get($params)->first();
    }

    static function getByDate($from, $to)
    {
        $params = [
            ["created_at", ">=", $from], 
            ["created_at", "<=", $to]
        ];
        return ExpenseRepository::get($params);
    }

    static function getCostSumByDate($from, $to)
    {
        $params = [
            ["created_at", ">=", $from], 
            ["created_at", "<=", $to]
        ];
        return ExpenseRepository::get($params)->sum('cost');
    }

    static function insert()
    {
        $expense = [
            'name' => request()->input('name'),
            'code' => request()->input('code'),
            'description' => request()->input('description'),
            'cost' => request()->input('cost'),
            'created_at' => now(),
            'updated_at' => now()
        ];

        // Kalau ada gambar yang di-upload
        if (request()->image) {
            $expense['image'] = Helper::createImageName();
            Helper::uploadFile($expense['image']);
        }

        ExpenseRepository::insert($expense);
    }

    static function update($code, $expense)
    {
        $params = [ 'code' => $code ];
        $update = [
            'name' => request()->input('name') != null ? request()->input('name') : $expense->name,
            'code' => request()->input('code') != null ? request()->input('code') : $expense->code,
            'description' => request()->input('description') != null ? request()->input('description') : $expense->description,
            'cost' => request()->input('cost') != null ? request()->input('cost') : $expense->cost,
            'updated_at' => now()
        ];

        // Kalau ada gambar yang di-upload
        if (request()->image) {
            $update['image'] = Helper::createImageName();
            Helper::uploadFile($update['image']);
        }

        ExpenseRepository::update($params, $update);
    }

    static function delete($code)
    {
        $params = [ 'code' => $code ];
        ExpenseRepository::delete($params);
    }
}