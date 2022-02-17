<?php

namespace App\Facades;

use App\Repositories\RawIngredientRepository;

class RawIngredientService
{
    public function __construct()
    {
        $this->rawIngredientRepository = new RawIngredientRepository();
    }

    public function getAll()
    {
        return $this->rawIngredientRepository->getAll();
    }

    public function getOne($id)
    {
        $params = [ 'id' => $id ];
        return $this->rawIngredientRepository->get($params)->first();
    }

    public function updateStock($id, $rawIngredient)
    {
        $params = [ 'id' => $id ];
        $amount = (float) request()->input('amount');
        $stockUpdate = $rawIngredient->stock - $amount;
        $update = ['stock' => $stockUpdate];

        if ($stockUpdate < 0) {
            return false;
        } else {
            $this->rawIngredientRepository->update($params, $update);
            return true;
        }
    }

    public function restoreStock($id, $amount)
    {
        $params = [ 'id' => $id ];
        $currentStock = $this->getOne($id)->stock;
        $update = [ 'stock' => $currentStock + $amount ];

        $this->rawIngredientRepository->update($params, $update);
    }
}