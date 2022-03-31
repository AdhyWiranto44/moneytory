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
            'image' => $this->helper->createImageName(),
            'created_at' => now(),
            'updated_at' => now()
        ];

        $this->expenseRepository->insert($expense);
        $this->helper->uploadFile($expense['image']);
    }

    public function update($code, $expense)
    {
        $params = [ 'code' => $code ];
        $update = [
            'name' => request()->input('name') != null ? request()->input('name') : $expense->name,
            'description' => request()->input('description') != null ? request()->input('description') : $expense->description,
            'cost' => request()->input('cost') != null ? request()->input('cost') : $expense->cost,
            'image' => $this->helper->createImageName(),
            'updated_at' => now()
        ];

        $this->expenseRepository->update($params, $update);
        $this->helper->uploadFile($update['image']);
    }

    public function delete($code)
    {
        $params = [ 'code' => $code ];
        $this->expenseRepository->delete($params);
    }
}