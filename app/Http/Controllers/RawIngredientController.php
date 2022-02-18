<?php

namespace App\Http\Controllers;

use App\Facades\RawIngredientService;
use App\Facades\UnitService;
use App\Helper;
use App\Models\RawIngredient;
use App\Models\Unit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RawIngredientController extends Controller
{
    public function __construct()
    {
        $this->rawIngredientService = new RawIngredientService();
        $this->unitService = new UnitService();
        $this->helper = new Helper();
    }

    public function index()
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $rawIngredients = $this->rawIngredientService->getAll();
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

    public function create()
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $units = $this->unitService->getAll();
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
            $this->rawIngredientService->insert();    
            return redirect('/raw-ingredients')->with('success', 'Tambah Bahan Mentah Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/raw-ingredients')->with('error', 'Tambah Bahan Mentah Gagal!');
        }
    }

    public function edit($code)
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $units = $this->unitService->getAll();
        $rawIngredient = $this->rawIngredientService->getOneByCode($code);
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
        $rawIngredient = $this->rawIngredientService->getOneByCode($code);
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
            $this->rawIngredientService->update($code, $rawIngredient);
            return redirect('/raw-ingredients')->with('success', 'Ubah bahan mentah berhasil!');
        } catch(QueryException $ex) {
            return redirect('/raw-ingredients')->with('error', 'Ubah bahan mentah gagal!');
        }
    }

    public function deactivate($code)
    {
        $status = 1;
        $this->rawIngredientService->changeStatus($code, $status);
        return redirect('/raw-ingredients');
    }

    public function activate($code)
    {
        $status = 2;
        $this->rawIngredientService->changeStatus($code, $status);
        return redirect('/raw-ingredients');
    }

    public function destroy($code)
    {
        try {
            $this->rawIngredientService->delete($code);
            return redirect('/raw-ingredients')->with('success', 'Penghapusan bahan mentah berhasil!');
        } catch(QueryException $ex) {
            return redirect('/raw-ingredients')->with('error', 'Penghapusan bahan mentah gagal!');
        }
    }
}
