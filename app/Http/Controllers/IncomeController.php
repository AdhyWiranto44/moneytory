<?php

namespace App\Http\Controllers;

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
    }

    public function index(Request $request)
    {
        [$dateMin, $dateMax] = $this->helper->getCurrentDate();
        if ($request->query('tanggal_dari') && $request->query('tanggal_ke') == '') {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
        } else if ($request->query('tanggal_dari') == '' && $request->query('tanggal_ke')) {
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        } else if ($request->query('tanggal_dari') && $request->query('tanggal_ke')) {
            $dateMin = $request->query('tanggal_dari') . ' 00:00:00';
            $dateMax = $request->query('tanggal_ke') . ' 23:59:59';
        }

        $code = $request->query('code');
        $user = $this->helper->getUserLogin($request);
        $company = $this->helper->getCompanyProfile();
        $incomes = DB::table('incomes')
                        ->join('income_statuses', 'incomes.income_status_id', '=', 'income_statuses.id')
                        ->select('incomes.*', 'income_statuses.name as status')
                        ->where("incomes.created_at", ">=", $dateMin)
                        ->where("incomes.created_at", "<=", $dateMax)
                        ->where("incomes.products", "LIKE", "%".$code."%")
                        ->get();
        $menus = $this->helper->getMenus($request);
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

    public function create(Request $request)
    {
        $user = $this->helper->getUserLogin($request);
        $company = $this->helper->getCompanyProfile();
        $menus = $this->helper->getMenus($request);
        $products = DB::table('products')
                ->join('units', 'products.unit_id', '=', 'units.id')
                ->select('products.*', 'units.name as unit')
                ->get();
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
                'code' => 'required|unique:incomes',
                'products' => 'required',
                'amounts' => 'required',
                'prices' => 'required',
                // 'total_price' => 'required|numeric',
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
                'unique' => 'Kode barang sudah ada!',
            ]
        );

        try {
            // untuk input base_prices data incomes
            $basePrices = [];

            $inputPrices = $request->input('prices');
            $inputProducts = $request->input('products');
            $inputAmounts = $request->input('amounts');
            $prices = explode(',', $inputPrices);
            $products = explode(',', $inputProducts);
            $amounts = explode(',', $inputAmounts);
            $total_price = 0;

            // Menghitung total biaya berdasarkan (harga modal + untung) dikali jumlah pesanan
            for ($i = 0; $i < count($prices); $i++) { 
                $total_price += ((int) $prices[$i] * (int) $amounts[$i]);
            }

            $formInput = [
                'income_status_id' => 2,
                'code' => $request->input('code'),
                'products' => $inputProducts,
                'amounts' => $inputAmounts,
                'prices' => $inputPrices,
                'total_price' => $total_price,
                'created_at' => now(),
                'updated_at' => now()
            ];

            // Mengurangi stok tiap produk yang dibeli
            for ($i = 0; $i < count($products); $i++) {
                $product = Product::firstWhere('code', $products[$i]);
                $stock = $product->stock;
                $basePrice = $product->base_price;

                // mengurangi stok barang jadi
                $product->update(['stock' => $stock - $amounts[$i]]);

                array_push($basePrices, $basePrice);
            }

            // tambahkan data harga modal pada form
            $formInput['base_prices'] = implode(",", $basePrices);

            $income = Income::create($formInput);
            $income->save();
    
            return redirect('/incomes')->with('success', 'Tambah Pemasukan Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/incomes')->with('error', 'Tambah Pemasukan Gagal!');
        }
    }

    public function edit(Request $request, $code)
    {
        $user = $this->helper->getUserLogin($request);
        $company = $this->helper->getCompanyProfile();
        $income = Income::firstWhere('code', $code);
        $menus = $this->helper->getMenus($request);
        $products = DB::table('products')
                ->join('units', 'products.unit_id', '=', 'units.id')
                ->select('products.*', 'units.name as unit')
                ->get();
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
        $income = Income::firstWhere('code', $code);
        $request->validate(
            [
                'code' => [
                    'required',
                    Rule::unique('incomes')->ignore($income->id)
                ],
                'products' => 'required',
                'amounts' => 'required',
                'prices' => 'required',
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
                'unique' => 'Kode barang sudah ada!',
            ]
        );

        try {
            $formInput = [
                'code' => $request->input('code') != null ? $request->input('code') : $income->code,
                'products' => $request->input('products') != null ? $request->input('products') : $income->products,
                'amounts' => $request->input('amounts') != null ? $request->input('amounts') : $income->amounts,
                'prices' => $request->input('prices') != null ? $request->input('prices') : $income->prices,
                'total_price' => array_sum(explode(',', $request->input('prices'))),
                'updated_at' => now()
            ];
    
            Income::where('code', $code)->update($formInput);
            return redirect('/incomes')->with('success', 'Ubah pemasukan berhasil!');
        } catch(QueryException $ex) {
            return redirect('/incomes')->with('error', 'Ubah pemasukan gagal!');
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

    public function destroy($code)
    {
        try {
            $income = Income::firstWhere('code', $code);
            $products = explode(',', $income->products);
            $amounts = explode(',', $income->amounts);

            // Mengurangi stok tiap produk yang dibeli
            for ($i = 0; $i < count($products); $i++) {
                $product = Product::firstWhere('code', $products[$i]);
                $stock = $product->stock;
                $product->update(['stock' => $stock + $amounts[$i]]);
            }

            $income->delete();
            return redirect('/incomes')->with('success', 'Penghapusan pemasukan berhasil!');
        } catch(QueryException $ex) {
            return redirect('/incomes')->with('error', 'Penghapusan pemasukan gagal!');
        }
    }
}
