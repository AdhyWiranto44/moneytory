<?php

namespace App\Repositories;

use App\Models\OnProcessIngredient;
use Illuminate\Support\Facades\DB;

class OnProcessIngredientRepository
{
    public function __construct()
    {
        $this->onProcessIngredient = new OnProcessIngredient();
    }

    public function getAll()
    {
        return DB::table('on_process_ingredients')
        ->join('statuses', 'on_process_ingredients.status_id', '=', 'statuses.id')
        ->join('raw_ingredients', 'on_process_ingredients.raw_ingredient_id', '=', 'raw_ingredients.id')
        ->join('units', 'raw_ingredients.unit_id', '=', 'units.id')
        ->select('on_process_ingredients.*', 'statuses.name as status', 'raw_ingredients.name as raw_ingredient', 'raw_ingredients.image as image', 'units.name as unit')
        ->get();
    }

    public function get($params)
    {
        return $this->onProcessIngredient->where($params)->get();
    }

    public function create($data)
    {
        $this->onProcessIngredient->create($data)->save();
    }

    public function update($params, $update)
    {
        $this->onProcessIngredient->where($params)->update($update);
    }

    public function delete($params)
    {
        $this->onProcessIngredient->where($params)->delete();
    }
}