<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Debt;
use App\Models\DebtStatus;
use App\Models\DebtType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DebtController extends Controller
{
    public function index(Request $request)
    {
        [$dateMin, $dateMax] = Helper::getCurrentDate();
        if ($request->query('tanggal_dari') && $request->query('tanggal_ke') == '') {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
        } else if ($request->query('tanggal_dari') == '' && $request->query('tanggal_ke')) {
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        } else if ($request->query('tanggal_dari') && $request->query('tanggal_ke')) {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        }

        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $debts = DB::table('debts')
                ->join('debt_types', 'debts.debt_type_id', '=', 'debt_types.id')
                ->join('debt_statuses', 'debts.debt_status_id', '=', 'debt_statuses.id')
                ->select('debts.*', 'debt_types.name as type', 'debt_statuses.name as status')
                ->where("debts.created_at", ">=", $dateMin)
                ->where("debts.created_at", "<=", $dateMax)
                ->get();
        $menus = Helper::getMenus($request);
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

    public function create(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $menus = Helper::getMenus($request);
        $debtTypes = DebtType::all();
        $debtStatuses = DebtStatus::all();
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
            $formInput = [
                'debt_type_id' => $request->input('debt_type'),
                'debt_status_id' => $request->input('debt_status'),
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'on_behalf_of' => $request->input('on_behalf_of'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'created_at' => now(),
                'updated_at' => now()
            ];

            $debt = Debt::create($formInput);
            $debt->save();
    
            return redirect('/debts')->with('success', 'Tambah Hutang Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/debts')->with('error', 'Tambah Hutang Gagal!');
        }
    }

    public function edit(Request $request, $code)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $debtTypes = DebtType::all();
        $debtStatuses = DebtStatus::all();
        $debt = Debt::firstWhere('code', $code);
        $menus = Helper::getMenus($request);
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
        $debt = Debt::firstWhere('code', $code);
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
            $formInput = [
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
    
            Debt::where('code', $code)->update($formInput);
            return redirect('/debts')->with('success', 'Ubah hutang berhasil!');
        } catch(QueryException $ex) {
            return redirect('/debts')->with('error', 'Ubah hutang gagal!');
        }
    }

    public function deactivate(Request $request, $code)
    {
        $status = 1;
        Debt::where('code', $code)->update(['debt_status_id' => $status]);
        return redirect('/debts');
    }

    public function activate(Request $request, $code)
    {
        $status = 2;
        Debt::where('code', $code)->update(['debt_status_id' => $status]);
        return redirect('/debts');
    }

    public function destroy($code)
    {
        try {
            Debt::where('code', $code)->delete();
            return redirect('/debts')->with('success', 'Penghapusan hutang berhasil!');
        } catch(QueryException $ex) {
            return redirect('/debts')->with('error', 'Penghapusan hutang gagal!');
        }
    }
}
