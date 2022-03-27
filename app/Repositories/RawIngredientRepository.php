<?php

namespace App\Repositories;

use App\Models\RawIngredient;
use Illuminate\Support\Facades\DB;

class RawIngredientRepository
{
    public function __construct()
    {
        $this->rawIngredient = new RawIngredient();
    }

    public function getAll()
    {
        return DB::table('raw_ingredients')
            ->join('statuses', 'raw_ingredients.status_id', '=', 'statuses.id')
            ->join('units', 'raw_ingredients.unit_id', '=', 'units.id')
            ->select('raw_ingredients.*', 'statuses.name as status', 'units.name as unit');
    }

    public function get($params)
    {
        return $this->rawIngredient->where($params)->get();
    }

    public function getLastRow()
    {
        return DB::table('raw_ingredients')->select('id')->orderByDesc('id')->limit(1)->first();
    }

    public function insert($data)
    {
        $this->rawIngredient->create($data)->save();
    }

    public function update($params, $update)
    {
        $this->rawIngredient->where($params)->update($update);
    }

    public function delete($params)
    {
        $this->rawIngredient->where($params)->delete();
    }
}