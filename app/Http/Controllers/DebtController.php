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
    public function __construct()
    {
        $this->debtService = new DebtService();
        $this->debtStatusService = new DebtStatusService();
        $this->debtTypeService = new DebtTypeService();
        $this->helper = new Helper();
    }

    public function index(Request $request)
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        [ $dateMin, $dateMax ] = $this->helper->getCurrentDate();

        if ($request->query('tanggal_dari') && $request->query('tanggal_ke') == '') {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
        } else if ($request->query('tanggal_dari') == '' && $request->query('tanggal_ke')) {
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        } else if ($request->query('tanggal_dari') && $request->query('tanggal_ke')) {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        }

        $debts = $this->debtService->getByDate($dateMin, $dateMax);
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
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $debtTypes = $this->debtTypeService->getAll();
        $debtStatuses = $this->debtStatusService->getAll();
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
            ]
        );

        try {
            $this->debtService->insert();
            return redirect('/debts')->with('success', 'Tambah Hutang Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/debts')->with('error', 'Tambah Hutang Gagal!');
        }
    }

    public function edit($code)
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $debtTypes = $this->debtTypeService->getAll();
        $debtStatuses = $this->debtStatusService->getAll();
        $debt = $this->debtService->getOne($code);
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
        $debt = $this->debtService->getOne($code);
        $request->validate(
            [
                'name' => 'required',
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
            ]
        );

        try {
            $this->debtService->update($code, $debt);
            return redirect('/debts')->with('success', 'Ubah hutang berhasil!');
        } catch(QueryException $ex) {
            return redirect('/debts')->with('error', 'Ubah hutang gagal!');
        }
    }

    public function deactivate($code)
    {
        try {
            $status = 1;
            $this->debtService->changeStatus($code, $status);
            return redirect('/debts')->with('success', 'Ubah status hutang berhasil!');
        } catch(QueryException $ex) {
            return redirect('/debts')->with('error', 'Ubah status hutang gagal!');
        }
    }

    public function activate($code)
    {
        try {
            $status = 2;
            $this->debtService->changeStatus($code, $status);
            return redirect('/debts')->with('success', 'Ubah status hutang berhasil!');
        } catch(QueryException $ex) {
            return redirect('/debts')->with('error', 'Ubah status hutang gagal!');
        }
    }

    public function destroy($code)
    {
        try {
            $this->debtService->delete($code);
            return redirect('/debts')->with('success', 'Penghapusan hutang berhasil!');
        } catch(QueryException $ex) {
            return redirect('/debts')->with('error', 'Penghapusan hutang gagal!');
        }
    }
}
