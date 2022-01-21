<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\RawIngredient;
use App\Models\Unit;
use Illuminate\Database\QueryException;
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

    public function create(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $menus = $this->getMenus($request);
        $units = Unit::all();
        $data = [
            'title' => 'Tambah Bahan Mentah',
            'menus' => $menus,
            'units' => $units,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('raw_ingredient_add', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'code' => 'required|unique:raw_ingredients',
                'stock' => 'required|numeric',
                'minimum_stock' => 'required|numeric',
                'unit' => 'required',
                'image' => 'image|max:1024'
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
                'unique' => 'Kode barang sudah ada!',
                'image.image' => 'File harus berupa gambar (jpg, jpeg, dan png)',
                'image.max' => 'Ukuran gambar maksimal yang diterima adalah sebesar :max MB'
            ]
        );

        try {
            $formInput = [
                'status_id' => 2,
                'unit_id' => $request->input('unit'),
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'stock' => $request->input('stock'),
                'minimum_stock' => $request->input('minimum_stock'),
                'created_at' => now(),
                'updated_at' => now()
            ];

            // Kalau ada gambar yang di-upload
            if ($request->image) {
                $imgName = strtotime('now') . '-' . preg_replace('/\s+/', '-', $request->image->getClientOriginalName());
                $formInput['image'] = $imgName;
                $request->image->storeAs('./public/img', $imgName);
            }

            $rawIngredient = RawIngredient::create($formInput);
            $rawIngredient->save();
    
            return redirect('/raw-ingredients')->with('success', 'Tambah Bahan Mentah Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/raw-ingredients')->with('error', 'Tambah Bahan Mentah Gagal!');
        }
    }

    public function deactivate(Request $request, $code)
    {
        $status = 1;
        RawIngredient::where('code', $code)->update(['status_id' => $status]);
        return redirect('/raw-ingredients');
    }

    public function activate(Request $request, $code)
    {
        $status = 2;
        RawIngredient::where('code', $code)->update(['status_id' => $status]);
        return redirect('/raw-ingredients');
    }

    private function getMenus(Request $request)
    {
        $menus = Helper::getMenus($request);
        return $menus;
    }
}
