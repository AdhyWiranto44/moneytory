<?php

namespace App\Http\Controllers;

use App\Facades\ProductService;
use App\Facades\UnitService;
use App\Helper;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->productService = new ProductService();
        $this->unitService = new UnitService();
        $this->helper = new Helper();
    }

    public function index()
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $products = $this->productService->getAll();
        $data = [
            'title' => 'Barang Jadi',
            'menus' => $menus,
            'products' => $products,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('products', $data);
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
        return view('product_add', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'unit' => 'required',
                'base_price' => 'required|numeric',
                'profit' => 'required|numeric',
                'stock' => 'required|numeric',
                'minimum_stock' => 'required|numeric',
                'image' => 'image|max:1024'
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
                'image.image' => 'File harus berupa gambar (jpg, jpeg, dan png)',
                'image.max' => 'Ukuran gambar maksimal yang diterima adalah sebesar :max MB'
            ]
        );

        try {
            $this->productService->insert();    
            return redirect('/products')->with('success', 'Tambah Barang Jadi Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/products')->with('error', 'Tambah Barang Jadi Gagal!');
        }
    }

    public function edit($code)
    {
        [ $user, $company, $menus ] = $this->helper->getCommonData();
        $units = $this->unitService->getAll();
        $product = $this->productService->getOne($code);
        $data = [
            'title' => 'Ubah',
            'product' => $product,
            'units' => $units,
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];

        return view('product_edit', $data);
    }

    public function update(Request $request, $code)
    {
        $product = $this->productService->getOne($code);
        $request->validate(
            [
                'name' => 'required',
                'base_price' => 'required|numeric',
                'profit' => 'required|numeric',
                'stock' => 'required|numeric',
                'minimum_stock' => 'required|numeric',
                'unit' => 'required',
                'image' => 'image|max:1024'
            ],
            [
                'required' => 'Kolom ini harus diisi!',
                'numeric' => 'Kolom ini harus berisi bilangan bulat atau bilangan pecahan',
                'image.image' => 'File harus berupa gambar (jpg, jpeg, dan png)',
                'image.max' => 'Ukuran gambar maksimal yang diterima adalah sebesar :max MB'
            ]
        );

        try {
            $this->productService->update($code, $product);
            return redirect('/products')->with('success', 'Ubah barang jadi berhasil!');
        } catch(QueryException $ex) {
            return redirect('/products')->with('error', 'Ubah barang jadi gagal!');
        }
    }

    public function deactivate($code)
    {
        $status = 1;
        $this->productService->changeStatus($code, $status);
        return redirect('/products');
    }

    public function activate($code)
    {
        $status = 2;
        $this->productService->changeStatus($code, $status);
        return redirect('/products');
    }

    public function destroy($code)
    {
        try {
            $this->productService->delete($code);
            return redirect('/products')->with('success', 'Penghapusan barang jadi berhasil!');
        } catch(QueryException $ex) {
            return redirect('/products')->with('error', 'Penghapusan barang jadi gagal!');
        }
    }
}
