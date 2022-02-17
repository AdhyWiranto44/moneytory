<?php

namespace App\Facades;

use App\Repositories\OnProcessIngredientRepository;

class OnProcessIngredientService
{
    public function __construct()
    {
        $this->onProcessIngredientRepository = new OnProcessIngredientRepository();
    }

    public function getAll()
    {
        return $this->onProcessIngredientRepository->getAll();
    }

    public function getOne($code)
    {
        $params = [ 'code' => $code ];
        return $this->onProcessIngredientRepository->get($params)->first();
    }

    public function insert()
    {
        $data = [
            'status_id' => 2,
            'raw_ingredient_id' => request()->input('raw_ingredient'),
            'code' => request()->input('code'),
            'purpose' => request()->input('purpose'),
            'amount' => (float) request()->input('amount'),
            'created_at' => now(),
            'updated_at' => now()
        ];

        $this->onProcessIngredientRepository->create($data);
    }

    public function update($code, $onProcessIngredient)
    {
        $params = [ 'code' => $code ];
        $update = [
            'raw_ingredient_id' => request()->input('raw_ingredient') != null ? request()->input('raw_ingredient') : $onProcessIngredient->raw_ingredient_id,
            'code' => request()->input('code') != null ? request()->input('code') : $onProcessIngredient->code,
            'purpose' => request()->input('purpose') != null ? request()->input('purpose') : $onProcessIngredient->purpose,
            'amount' => request()->input('amount') != null ? request()->input('amount') : $onProcessIngredient->amount,
            'updated_at' => now()
        ];

        $this->onProcessIngredientRepository->update($params, $update);
    }

    public function changeStatus($code, $status)
    {
        $params = [ 'code' => $code ];
        $update = [ 'status_id' => $status ];
        $this->onProcessIngredientRepository->update($params, $update);
    }

    public function delete($code)
    {
        $params = [ 'code' => $code ];
        $this->onProcessIngredientRepository->delete($params);
    }
}