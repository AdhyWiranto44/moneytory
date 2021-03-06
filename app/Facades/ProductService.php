<?php

namespace App\Facades;

use App\Helper;
use App\Repositories\ProductRepository;

class ProductService {
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
        $this->helper = new Helper();
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function getAll2()
    {
        return $this->productRepository->getAll2();
    }

    public function getAllIfStockAvailable()
    {
        $products = array_filter($this->productRepository->getAll()->toArray(), function($item) {
            return $item->stock > 0;
        });
        return $products;
    }

    public function getOne($code)
    {
        $params = [ 'code' => $code ];
        return $this->productRepository->get($params)->first();
    }

    public function getLastRow()
    {
        return $this->productRepository->getLastRow();
    }

    public function insert()
    {
        // Membuat code
        $newCode = $this->helper->generateCode("PROD", $this->productRepository->getLastRow());

        $product = [
            'status_id' => 2,
            'unit_id' => request()->input('unit'),
            'name' => request()->input('name'),
            'code' => $newCode,
            'base_price' => request()->input('base_price'),
            'profit' => request()->input('profit'),
            'discount' => request()->input('discount'),
            'stock' => request()->input('stock'),
            'minimum_stock' => request()->input('minimum_stock'),
            'image' => $this->helper->createImageName(),
            'created_at' => now(),
            'updated_at' => now()
        ];

        $this->productRepository->insert($product);
        $this->helper->uploadFile($product['image']);
    }

    public function update($code, $product)
    {
        $params = [ 'code' => $code ];
        $update = [
            'unit_id' => request()->input('unit') != null ? request()->input('unit') : $product->unit_id,
            'name' => request()->input('name') != null ? request()->input('name') : $product->name,
            'stock' => request()->input('stock') != null ? request()->input('stock') : $product->stock,
            'minimum_stock' => request()->input('minimum_stock') != null ? request()->input('minimum_stock') : $product->minimum_stock,
            'base_price' => request()->input('base_price') != null ? request()->input('base_price') : $product->base_price,
            'profit' => request()->input('profit') != null ? request()->input('profit') : $product->profit,
            'discount' => request()->input('discount') != null ? request()->input('discount') : $product->discount,
            'image' => $this->helper->createImageName(),
            'updated_at' => now()
        ];

        $this->productRepository->update($params, $update);
        $this->helper->uploadFile($update['image']);
    }

    public function changeStatus($code, $status)
    {
        $params = [ 'code' => $code ];
        $update = [ 'status_id' => $status ];
        $this->productRepository->update($params, $update);
    }

    public function delete($code)
    {
        $params = [ 'code' => $code ];
        $this->productRepository->delete($params);
    }
}