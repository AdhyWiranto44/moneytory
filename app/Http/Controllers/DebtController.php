<?php

namespace App\Http\Controllers;

use App\Facades\DebtService;
use App\Facades\DebtStatusService;
use App\Facades\DebtTypeService;
use App\Helper;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DebtController extends Controller
{
    public function index(Request $request)
    {
        [ $user, $company, $menus ] = Helper::getCommonData();
        [ $dateMin, $dateMax ] = Helper::getCurrentDate();
        $debts = DebtService::getByDate($dateMin, $dateMax);

        if ($request->query('tanggal_dari') && $request->query('tanggal_ke') == '') {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
        } else if ($request->query('tanggal_dari') == '' && $request->query('tanggal_ke')) {
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        } else if ($request->query('tanggal_dari') && $request->query('tanggal_ke')) {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        }

        $data = [
            'title' => 'Hutang',
            'menus' => $menus,
            'debts' => $debts,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('debts', $data);
    }

    public function create()
    {
        [ $user, $company, $menus ] = Helper::getCommonData();
        $debtTypes = DebtTypeService::getAll();
        $debtStatuses = DebtStatusService::getAll();
        $data = [
            'title' => 'Tambah',
            'menus' => $menus,
            'debtTypes' => $debtTypes,
            'debtStatuses' => $debtStatuses,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('debt_add', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'code' => 'required|unique:debts',
                'price' => 'required|numeric',
                'on_behalf_of' => 'required',
                'phone_number' => 'required',
                'address' => 'required',
                'debt_type' => 'required',
                'debt_status' => 'required',
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
                'unique' => 'Kode barang sudah ada!',
            ]
        );

        try {
            $data = [
                'debt_type_id' => request()->input('debt_type'),
                'debt_status_id' => request()->input('debt_status'),
                'name' => request()->input('name'),
                'code' => request()->input('code'),
                'description' => request()->input('description'),
                'price' => request()->input('price'),
                'on_behalf_of' => request()->input('on_behalf_of'),
                'phone_number' => request()->input('phone_number'),
                'address' => request()->input('address'),
                'created_at' => now(),
                'updated_at' => now()
            ];

            DebtService::insert($data);
            return redirect('/debts')->with('success', 'Tambah Hutang Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/debts')->with('error', 'Tambah Hutang Gagal!');
        }
    }

    public function edit($code)
    {
        [ $user, $company, $menus ] = Helper::getCommonData();
        $debtTypes = DebtTypeService::getAll();
        $debtStatuses = DebtStatusService::getAll();
        $debt = DebtService::getOne($code);
        $data = [
            'title' => 'Ubah',
            'debt' => $debt,
            'debtTypes' => $debtTypes,
            'debtStatuses' => $debtStatuses,
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];

        return view('debt_edit', $data);
    }

    public function update(Request $request, $code)
    {
        $debt = DebtService::getOne($code);
        $request->validate(
            [
                'name' => 'required',
                'code' => [
                    'required',
                    Rule::unique('debts')->ignore($debt->id),
                ],
                'price' => 'required|numeric',
                'on_behalf_of' => 'required',
                'phone_number' => 'required',
                'address' => 'required',
                'debt_type' => 'required',
                'debt_status' => 'required'
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
                'unique' => 'Kode barang sudah ada!'
            ]
        );

        try {
            $update = [
                'debt_type_id' => $request->input('debt_type') != null ? $request->input('debt_type') : $debt->debt_type_id,
                'debt_status_id' => $request->input('debt_status') != null ? $request->input('debt_status') : $debt->debt_status_id,
                'name' => $request->input('name') != null ? $request->input('name') : $debt->name,
                'code' => $request->input('code') != null ? $request->input('code') : $debt->code,
                'description' => $request->input('description') != null ? $request->input('description') : $debt->description,
                'price' => $request->input('price') != null ? $request->input('price') : $debt->price,
                'on_behalf_of' => $request->input('on_behalf_of') != null ? $request->input('on_behalf_of') : $debt->on_behalf_of,
                'phone_number' => $request->input('phone_number') != null ? $request->input('phone_number') : $debt->phone_number,
                'address' => $request->input('address') != null ? $request->input('address') : $debt->address,
                'updated_at' => now()
            ];
            DebtService::update($code, $update);
            return redirect('/debts')->with('success', 'Ubah hutang berhasil!');
        } catch(QueryException $ex) {
            return redirect('/debts')->with('error', 'Ubah hutang gagal!');
        }
    }

    public function deactivate($code)
    {
        try {
            $update = [ 'debt_status_id' => 1 ];
            DebtService::update($code, $update);
            return redirect('/debts')->with('success', 'Ubah status hutang berhasil!');
        } catch(QueryException $ex) {
            return redirect('/debts')->with('error', 'Ubah status hutang gagal!');
        }
    }

    public function activate($code)
    {
        try {
            $update = [ 'debt_status_id' => 2 ];
            DebtService::update($code, $update);
            return redirect('/debts')->with('success', 'Ubah status hutang berhasil!');
        } catch(QueryException $ex) {
            return redirect('/debts')->with('error', 'Ubah status hutang gagal!');
        }
    }

    public function destroy($code)
    {
        try {
            DebtService::delete($code);
            return redirect('/debts')->with('success', 'Penghapusan hutang berhasil!');
        } catch(QueryException $ex) {
            return redirect('/debts')->with('error', 'Penghapusan hutang gagal!');
        }
    }
}
