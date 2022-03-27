<?php

namespace App\Http\Controllers;

use App\Facades\IncomeService;
use App\Facades\ProductService;
use App\Helper;
use App\Models\Income;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class IncomeController extends Controller
{
    public function __construct()
    {
        $this->helper = new Helper();
        $this->incomeService = new IncomeService();
        $this->productService = new ProductService();
    }

    public function index(Request $request)
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        [$dateMin, $dateMax] = $this->helper->getCurrentDate();
        $code = $request->query('code');
        $incomes = $this->incomeService->getByDate($code, $dateMin, $dateMax);

        if ($request->query('tanggal_dari') && $request->query('tanggal_ke') == '') {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
        } else if ($request->query('tanggal_dari') == '' && $request->query('tanggal_ke')) {
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        } else if ($request->query('tanggal_dari') && $request->query('tanggal_ke')) {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        }

        $data = [
            'title' => 'Pemasukan',
            'menus' => $menus,
            'incomes' => $incomes,
            'productIncome' => null,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];

        if ($code != null) {
            $productIncome = [
                'code' => $code,
                'amount' => 0,
                'income' => 0
            ];
            foreach ($incomes as $income) {
                $products = explode(',', $income->products);
                $amounts = explode(',', $income->amounts);
                $prices = explode(',', $income->prices);

                for ($i = 0; $i < count($products); $i++) {
                    if ($code == $products[$i]) {
                        $productIncome['amount'] += $amounts[$i];
                        $productIncome['income'] += $prices[$i];
                    }
                }
            }
            $data['productIncome'] = $productIncome;
        }

        return view('incomes', $data);
    }

    public function create()
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $products = $this->productService->getAll2();
        $data = [
            'title' => 'Tambah',
            'menus' => $menus,
            'products' => $products,
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
                'products' => 'required',
                'amounts' => 'required',
                'prices' => 'required',
                'extra_charge' => 'numeric|nullable',
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
            ]
        );

        try {
            $result = $this->incomeService->insert();
            if ($result != null) return redirect('/incomes')->with('error', $result);
            return redirect('/incomes')->with('success', 'Tambah Pemasukan Berhasil!');
        } catch(QueryException $ex) {dd($ex);
            return redirect('/incomes')->with('error', 'Tambah Pemasukan Gagal!');
        }
    }

    public function edit($code)
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $income = $this->incomeService->getOne($code);
        $products = $this->productService->getAll2();
        $data = [
            'title' => 'Ubah',
            'income' => $income,
            'menus' => $menus,
            'products' => $products,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];

        return view('income_edit', $data);
    }

    public function update(Request $request, $code)
    {
        $income = $this->incomeService->getOne($code);
        $request->validate(
            [
                'products' => 'required',
                'amounts' => 'required',
                'prices' => 'required',
                'extra_charge' => 'numeric|nullable',
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
            ]
        );

        try {
            $result = $this->incomeService->update($code, $income);
            if ($result != null) return redirect('/incomes')->with('error', $result);
            return redirect('/incomes')->with('success', 'Ubah pemasukan berhasil!');
        } catch(QueryException $ex) {
            return redirect('/incomes')->with('error', 'Ubah pemasukan gagal!');
        }
    }

    public function deactivate($code)
    {
        $status = 1;
        $this->incomeService->changeStatus($code, $status);
        return redirect('/incomes');
    }

    public function activate($code)
    {
        $status = 2;
        $this->incomeService->changeStatus($code, $status);
        return redirect('/incomes');
    }

    public function destroy($code)
    {
        try {
            $this->incomeService->delete($code);
            return redirect('/incomes')->with('success', 'Penghapusan pemasukan berhasil!');
        } catch(QueryException $ex) {
            return redirect('/incomes')->with('error', 'Penghapusan pemasukan gagal!');
        }
    }
}
