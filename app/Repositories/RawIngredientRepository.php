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
                ->join('units', 'raw_ingredients.unit_id', '=', 'units.id')
                ->select('raw_ingredients.*', 'units.name as unit')
                ->where('raw_ingredients.status_id', '=', '2')
                ->get();
    }

    public function get($params)
    {
        return $this->rawIngredient->where($params)->get();
    }

    public function update($params, $update)
    {
        $this->rawIngredient->where($params)->update($update);
    }
}