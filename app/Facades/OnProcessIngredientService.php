<?php

namespace App\Facades;

use App\Helper;
use App\Repositories\OnProcessIngredientRepository;

class OnProcessIngredientService
{
    public function __construct()
    {
        $this->onProcessIngredientRepository = new OnProcessIngredientRepository();
        $this->helper = new Helper();
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

    public function getLastRow()
    {
        return $this->onProcessIngredientRepository->getLastRow();
    }

    public function insert()
    {
        // Membuat code
        $newCode = $this->helper->generateCode("ONP", $this->onProcessIngredientRepository->getLastRow());

        $data = [
            'status_id' => 2,
            'raw_ingredient_id' => request()->input('raw_ingredient'),
            'code' => $newCode,
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