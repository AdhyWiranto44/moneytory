<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\OnProcessIngredient;
use App\Models\RawIngredient;
use Illuminate\Database\QueryException;
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

    public function create(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $menus = $this->getMenus($request);
        $rawIngredients = DB::table('raw_ingredients')
                        ->join('units', 'raw_ingredients.unit_id', '=', 'units.id')
                        ->select('raw_ingredients.*', 'units.name as unit')
                        ->where('raw_ingredients.status_id', '=', '2')
                        ->get();
        $data = [
            'title' => 'Tambah',
            'menus' => $menus,
            'rawIngredients' => $rawIngredients,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('on_process_ingredient_add', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'raw_ingredient' => 'required',
                'code' => 'required|unique:on_process_ingredients',
                'purpose' => 'required',
                'amount' => 'required|numeric',
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
                'unique' => 'Kode barang sudah ada!',
            ]
        );

        $amount = (float) $request->input('amount');
        $rawIngredient = RawIngredient::firstWhere('id', $request->input('raw_ingredient'));
        if ($rawIngredient->stock - $amount < 0) {
            return redirect('/on-process-ingredients/add-new')->with('error', 'Input jumlah melebihi stok!');
        }

        try {
            $formInput = [
                'status_id' => 2,
                'raw_ingredient_id' => $request->input('raw_ingredient'),
                'code' => $request->input('code'),
                'purpose' => $request->input('purpose'),
                'amount' => $amount,
                'created_at' => now(),
                'updated_at' => now()
            ];

            $onProcessIngredient = OnProcessIngredient::create($formInput);
            $onProcessIngredient->save();

            $currentStock = $rawIngredient->stock;
            $rawIngredient->update(['stock' => $currentStock - $amount]);
            $rawIngredient->save();
    
            return redirect('/on-process-ingredients')->with('success', 'Tambah Bahan Dalam Proses Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/on-process-ingredients')->with('error', 'Tambah Bahan Dalam Proses Gagal!');
        }
    }

    private function getMenus(Request $request)
    {
        $menus = Helper::getMenus($request);
        return $menus;
    }
}
