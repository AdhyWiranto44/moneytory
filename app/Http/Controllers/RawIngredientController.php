<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\RawIngredient;
use App\Models\Unit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
            'title' => 'Tambah',
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

    public function edit(Request $request, $code)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $units = Unit::all();
        $rawIngredient = RawIngredient::firstWhere('code', $code);
        $menus = $this->getMenus($request);
        $data = [
            'title' => 'Ubah',
            'rawIngredient' => $rawIngredient,
            'units' => $units,
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];

        return view('raw_ingredient_edit', $data);
    }

    public function update(Request $request, $code)
    {
        $rawIngredient = RawIngredient::firstWhere('code', $code);
        $request->validate(
            [
                'name' => 'required',
                'code' => [
                    'required',
                    Rule::unique('raw_ingredients')->ignore($rawIngredient->id),
                ],
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
                'unit_id' => $request->input('unit') != null ? $request->input('unit') : $rawIngredient->unit_id,
                'name' => $request->input('name') != null ? $request->input('name') : $rawIngredient->name,
                'code' => $request->input('code') != null ? $request->input('code') : $rawIngredient->code,
                'stock' => $request->input('stock') != null ? $request->input('stock') : $rawIngredient->stock,
                'minimum_stock' => $request->input('minimum_stock') != null ? $request->input('minimum_stock') : $rawIngredient->minimum_stock,
                'updated_at' => now()
            ];
    
            // Kalau ada gambar yang di-upload
            if ($request->image) {
                $imgName = strtotime('now') . '-' . preg_replace('/\s+/', '-', $request->image->getClientOriginalName());
                $formInput['image'] = $imgName;
                $request->image->storeAs('./public/img', $imgName);
            }
    
            RawIngredient::where('code', $code)->update($formInput);
            return redirect('/raw-ingredients')->with('success', 'Ubah bahan mentah berhasil!');
        } catch(QueryException $ex) {
            return redirect('/raw-ingredients')->with('error', 'Ubah bahan mentah gagal!');
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

    public function destroy($code)
    {
        try {
            RawIngredient::where('code', $code)->delete();
            return redirect('/raw-ingredients')->with('success', 'Penghapusan bahan mentah berhasil!');
        } catch(QueryException $ex) {
            return redirect('/raw-ingredients')->with('error', 'Penghapusan bahan mentah gagal!');
        }
    }

    private function getMenus(Request $request)
    {
        $menus = Helper::getMenus($request);
        return $menus;
    }
}
