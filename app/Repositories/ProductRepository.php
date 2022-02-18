<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository {
    public function __construct()
    {
        $this->product = new Product();
    }

    public function getAll()
    {
        return DB::table('products')
            ->join('statuses', 'products.status_id', '=', 'statuses.id')
            ->join('units', 'products.unit_id', '=', 'units.id')
            ->select('products.*', 'statuses.name as status', 'units.name as unit')
            ->get();
    }

    public function get($params)
    {
        return $this->product->where($params)->get();
    }

    public function insert($data)
    {
        $this->product->create($data)->save();
    }

    public function update($params, $update)
    {
        $this->product->where($params)->update($update);
    }

    public function delete($params)
    {
        $this->product->where($params)->delete();
    }
}