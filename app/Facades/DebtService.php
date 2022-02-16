<?php

namespace App\Facades;

use App\Repositories\DebtRepository;

class DebtService
{
    public function __construct()
    {
        $this->debtRepository = new DebtRepository();
    }

    public function getOne(String $code = "")
    {
        $params = [ 'code' => $code ];
        return $this->debtRepository->get($params)->first();
    }

    public function getByDate($from, $to)
    {
        $params = [ 'from' => $from, 'to' => $to ];
        return $this->debtRepository->getWithTypeAndStatus($params);
    }

    public function getPriceSumByDate($from, $to)
    {
        $params = [
            ["debt_status_id", "=", 2], 
            ["created_at", ">=", $from], 
            ["created_at", "<=", $to]
        ];
        return $this->debtRepository->get($params)->sum('price');
    }

    public function insert()
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

        $this->debtRepository->insert($data);
    }

    public function update($code, $debt)
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

        $this->debtRepository->update($params, $update);
    }
    
    public function delete($code)
    {
        $params = [ 'code' => $code ];
        $this->debtRepository->delete($params);
    }
}