<?php

namespace App\Facades;

use App\Helper;
use App\Repositories\RawIngredientRepository;

class RawIngredientService
{
    public function __construct()
    {
        $this->helper = new Helper();
        $this->rawIngredientRepository = new RawIngredientRepository();
    }

    public function getAll()
    {
        return $this->rawIngredientRepository->getAll()->get();
    }

    public function getAllByStatusId($statusId)
    {
        return $this->rawIngredientRepository->getAll()->where('raw_ingredients.status_id', $statusId)->get();
    }

    public function getOne($id)
    {
        $params = [ 'id' => $id ];
        return $this->rawIngredientRepository->get($params)->first();
    }

    public function getOneByCode($code)
    {
        $params = [ 'code' => $code ];
        return $this->rawIngredientRepository->get($params)->first();
    }

    public function getLastRow()
    {
        return $this->rawIngredientRepository->getLastRow();
    }

    public function insert()
    {
        // Membuat code
        $newCode = $this->helper->generateCode("RAW", $this->rawIngredientRepository->getLastRow());

        $data = [
            'status_id' => 2,
            'unit_id' => request()->input('unit'),
            'name' => request()->input('name'),
            'code' => $newCode,
            'stock' => request()->input('stock'),
            'minimum_stock' => request()->input('minimum_stock'),
            'created_at' => now(),
            'updated_at' => now()
        ];

        // Kalau ada gambar yang di-upload
        if (request()->image) {
            $data['image'] = $this->helper->createImageName();
            $this->helper->uploadFile($data['image']);
        }

        $this->rawIngredientRepository->insert($data);
    }

    public function update($code, $rawIngredient)
    {
        $params = [ 'code' => $code ];
        $update = [
            'unit_id' => request()->input('unit') != null ? request()->input('unit') : $rawIngredient->unit_id,
            'name' => request()->input('name') != null ? request()->input('name') : $rawIngredient->name,
            'code' => request()->input('code') != null ? request()->input('code') : $rawIngredient->code,
            'stock' => request()->input('stock') != null ? request()->input('stock') : $rawIngredient->stock,
            'minimum_stock' => request()->input('minimum_stock') != null ? request()->input('minimum_stock') : $rawIngredient->minimum_stock,
            'updated_at' => now()
        ];

        // Kalau ada gambar yang di-upload
        if (request()->image) {
            $update['image'] = $this->helper->createImageName();
            $this->helper->uploadFile($update['image']);
        }

        $this->rawIngredientRepository->update($params, $update);
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

    public function changeStatus($code, $status)
    {
        $params = [ 'code' => $code ];
        $update = [ 'status_id' => $status ];
        $this->rawIngredientRepository->update($params, $update);
    }

    public function delete($code)
    {
        $params = [ 'code' => $code ];
        $this->rawIngredientRepository->delete($params);
    }
}