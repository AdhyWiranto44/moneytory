<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Income;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $incomes = DB::table('incomes')
                        ->join('income_statuses', 'incomes.income_status_id', '=', 'income_statuses.id')
                        ->select('incomes.*', 'income_statuses.name as status')
                        ->get();
        $menus = Helper::getMenus($request);
        $data = [
            'title' => 'Pemasukan',
            'menus' => $menus,
            'incomes' => $incomes,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('incomes', $data);
    }

    public function create(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $menus = Helper::getMenus($request);
        $data = [
            'title' => 'Tambah',
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('income_add', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'code' => 'required|unique:incomes',
                'products' => 'required',
                'amounts' => 'required',
                'prices' => 'required',
                'total_price' => 'required|numeric',
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
                'unique' => 'Kode barang sudah ada!',
            ]
        );

        try {
            $formInput = [
                'income_status_id' => 2,
                'code' => $request->input('code'),
                'products' => $request->input('products'),
                'amounts' => $request->input('amounts'),
                'prices' => $request->input('prices'),
                'total_price' => $request->input('total_price'),
                'created_at' => now(),
                'updated_at' => now()
            ];

            $income = Income::create($formInput);
            $income->save();
    
            return redirect('/incomes')->with('success', 'Tambah Pemasukan Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/incomes')->with('error', 'Tambah Pemasukan Gagal!');
        }
    }

    public function deactivate(Request $request, $code)
    {
        $status = 1;
        Income::where('code', $code)->update(['income_status_id' => $status]);
        return redirect('/incomes');
    }

    public function activate(Request $request, $code)
    {
        $status = 2;
        Income::where('code', $code)->update(['income_status_id' => $status]);
        return redirect('/incomes');
    }
}
