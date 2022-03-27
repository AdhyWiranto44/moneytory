<?php

namespace App\Facades;

use App\Helper;
use App\Repositories\ExpenseRepository;

class ExpenseService
{
    public function __construct()
    {
        $this->expenseRepository = new ExpenseRepository();
        $this->helper = new Helper();
    }

    public function getOne(String $code = "")
    {
        $params = [ 'code' => $code ];
        return $this->expenseRepository->get($params)->first();
    }

    public function getByDate($from, $to)
    {
        $params = [
            ["created_at", ">=", $from], 
            ["created_at", "<=", $to]
        ];
        return $this->expenseRepository->get($params);
    }

    public function getCostSumByDate($from, $to)
    {
        $params = [
            ["created_at", ">=", $from], 
            ["created_at", "<=", $to]
        ];
        return $this->expenseRepository->get($params)->sum('cost');
    }

    public function getLastRow()
    {
        return $this->expenseRepository->getLastRow();
    }

    public function insert()
    {
        // Membuat code
        $newCode = $this->helper->generateCode("EXP", $this->expenseRepository->getLastRow());

        $expense = [
            'name' => request()->input('name'),
            'code' => $newCode,
            'description' => request()->input('description'),
            'cost' => request()->input('cost'),
            'created_at' => now(),
            'updated_at' => now()
        ];

        // Kalau ada gambar yang di-upload
        if (request()->image) {
            $expense['image'] = $this->helper->createImageName();
            $this->helper->uploadFile($expense['image']);
        }

        $this->expenseRepository->insert($expense);
    }

    public function update($code, $expense)
    {
        $params = [ 'code' => $code ];
        $update = [
            'name' => request()->input('name') != null ? request()->input('name') : $expense->name,
            'description' => request()->input('description') != null ? request()->input('description') : $expense->description,
            'cost' => request()->input('cost') != null ? request()->input('cost') : $expense->cost,
            'updated_at' => now()
        ];

        // Kalau ada gambar yang di-upload
        if (request()->image) {
            $update['image'] = $this->helper->createImageName();
            $this->helper->uploadFile($update['image']);
        }

        $this->expenseRepository->update($params, $update);
    }

    public function delete($code)
    {
        $params = [ 'code' => $code ];
        $this->expenseRepository->delete($params);
    }
}