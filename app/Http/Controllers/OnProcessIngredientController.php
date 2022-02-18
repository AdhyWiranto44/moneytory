<?php

namespace App\Http\Controllers;

use App\Facades\OnProcessIngredientService;
use App\Facades\RawIngredientService;
use App\Helper;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OnProcessIngredientController extends Controller
{ 
    const ACTIVE = 2;

    public function __construct()
    {
        $this->onProcessIngredientService = new OnProcessIngredientService();
        $this->rawIngredientService = new RawIngredientService();
        $this->helper = new Helper();
    }

    public function index()
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $onProcessIngredients = $this->onProcessIngredientService->getAll();
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

    public function create()
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $rawIngredients = $this->rawIngredientService->getAllByStatusId(self::ACTIVE);
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

        try {
            $rawIngredientId = $request->input('raw_ingredient');
            $rawIngredient = $this->rawIngredientService->getOne($rawIngredientId);

            $isSuccess = $this->rawIngredientService->updateStock($rawIngredientId, $rawIngredient);
            
            if (!$isSuccess) {
                return back()->withInput()->with('error', 'Input jumlah melebihi stok!');
            }
        } catch(QueryException $ex) {
            return redirect('/on-process-ingredients')->with('error', 'Pengurangan stok bahan mentah gagal!');
        }

        try {
            $this->onProcessIngredientService->insert();
            return redirect('/on-process-ingredients')->with('success', 'Tambah Bahan Dalam Proses Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/on-process-ingredients')->with('error', 'Tambah Bahan Dalam Proses Gagal!');
        }
    }

    public function edit($code)
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $rawIngredients = $this->rawIngredientService->getAllByStatusId(self::ACTIVE);
        $onProcessIngredient = $this->onProcessIngredientService->getOne($code);
        $data = [
            'title' => 'Ubah',
            'onProcessIngredient' => $onProcessIngredient,
            'rawIngredients' => $rawIngredients,
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];

        return view('on_process_ingredient_edit', $data);
    }

    public function update(Request $request, $code)
    {
        $onProcessIngredient = $this->onProcessIngredientService->getOne($code);
        $request->validate(
            [
                'raw_ingredient' => 'required',
                'code' => [
                    'required',
                    Rule::unique('on_process_ingredients')->ignore($onProcessIngredient->id),
                ],
                'purpose' => 'required',
                'amount' => 'required|numeric',
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
                'unique' => 'Kode barang sudah ada!',
            ]
        );

        try {
            $rawIngredientId = $request->input('raw_ingredient');
            $rawIngredient = $this->rawIngredientService->getOne($rawIngredientId);

            // Restore previous raw ingredient stock
            $rawIngredient->stock += $onProcessIngredient->amount;

            $isSuccess = $this->rawIngredientService->updateStock($rawIngredientId, $rawIngredient);

            if (!$isSuccess) {
                return back()->withInput()->with('error', 'Input jumlah melebihi stok!');
            }
        } catch(QueryException $ex) {
            return redirect('/on-process-ingredients')->with('error', 'Pengurangan stok bahan mentah gagal!');
        }

        try {
            $this->onProcessIngredientService->update($code, $onProcessIngredient);
            return redirect('/on-process-ingredients')->with('success', 'Ubah bahan dalam proses berhasil!');
        } catch(QueryException $ex) {
            return redirect('/on-process-ingredients')->with('error', 'Ubah bahan dalam proses gagal!');
        }
    }

    public function destroy(Request $request, $code)
    {
        $onProcessIngredientService = $this->onProcessIngredientService->getOne($code);

        try {
            $rawIngredientId = $request->input('raw_ingredient');
            $amount = $onProcessIngredientService->amount;

            $this->rawIngredientService->restoreStock($rawIngredientId, $amount);
        } catch(QueryException $ex) {
            return redirect('/on-process-ingredients')->with('error', 'Pengurangan stok bahan mentah gagal!');
        }

        try {
            $this->onProcessIngredientService->delete($code);
            return redirect('/on-process-ingredients')->with('success', 'Penghapusan bahan dalam proses berhasil! Stock dikembalikan.');
        } catch(QueryException $ex) {
            return redirect('/on-process-ingredients')->with('error', 'Penghapusan bahan dalam proses gagal!');
        }
    }

    public function deactivate($code)
    {
        try {
            $status = 1;
            $this->onProcessIngredientService->changeStatus($code, $status);
            return redirect('/on-process-ingredients')->with('success', 'Bahan dalam proses selesai diproses');
        } catch(QueryException $ex) {
            return redirect('/on-process-ingredients')->with('error', 'Penggantian status gagal!');
        }
    }

    public function activate($code)
    {
        try {
            $status = 2;
            $this->onProcessIngredientService->changeStatus($code, $status);
            return redirect('/on-process-ingredients')->with('success', 'Bahan dalam proses sedang diproses');
        } catch(QueryException $ex) {
            return redirect('/on-process-ingredients')->with('error', 'Penggantian status gagal!');
        }
    }
}
