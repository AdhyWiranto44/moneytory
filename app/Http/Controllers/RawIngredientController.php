<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\RawIngredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RawIngredientController extends Controller
{
    public function index(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $rawIngredients = DB::table('raw_ingredients')
                        ->join('statuses', 'raw_ingredients.status_id', '=', 'statuses.id')
                        ->join('units', 'raw_ingredients.unit_id', '=', 'units.id')
                        ->select('raw_ingredients.*', 'statuses.name as status', 'units.name as unit')
                        ->get();
        $menus = $this->getMenus($request);
        $data = [
            'title' => 'Bahan Mentah',
            'menus' => $menus,
            'rawIngredients' => $rawIngredients,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('raw_ingredients', $data);
    }

    private function getMenus(Request $request)
    {
        $menus = Helper::getMenus($request);
        return $menus;
    }
}
