<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OnProcessIngredientController extends Controller
{
    public function index(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $onProcessIngredients = DB::table('on_process_ingredients')
                        ->join('statuses', 'on_process_ingredients.status_id', '=', 'statuses.id')
                        ->join('raw_ingredients', 'on_process_ingredients.raw_ingredient_id', '=', 'raw_ingredients.id')
                        ->join('units', 'raw_ingredients.unit_id', '=', 'units.id')
                        ->select('on_process_ingredients.*', 'statuses.name as status', 'raw_ingredients.name as raw_ingredient', 'raw_ingredients.image as image', 'units.name as unit')
                        ->get();
        $menus = $this->getMenus($request);
        $data = [
            'title' => 'Bahan Dalam Proses',
            'menus' => $menus,
            'onProcessIngredients' => $onProcessIngredients,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('on_process_ingredients', $data);
    }

    private function getMenus(Request $request)
    {
        $menus = Helper::getMenus($request);
        return $menus;
    }
}
