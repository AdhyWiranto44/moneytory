<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $products = DB::table('products')
                ->join('statuses', 'products.status_id', '=', 'statuses.id')
                ->join('units', 'products.unit_id', '=', 'units.id')
                ->select('products.*', 'statuses.name as status', 'units.name as unit')
                ->get();
        $menus = Helper::getMenus($request);
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

    public function create(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $menus = Helper::getMenus($request);
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
        return view('product_add', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'code' => 'required|unique:products',
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
                'base_price' => $request->input('base_price'),
                'profit' => $request->input('profit'),
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

            $product = Product::create($formInput);
            $product->save();
    
            return redirect('/products')->with('success', 'Tambah Barang Jadi Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/products')->with('error', 'Tambah Barang Jadi Gagal!');
        }
    }

    public function edit(Request $request, $code)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $units = Unit::all();
        $product = Product::firstWhere('code', $code);
        $menus = Helper::getMenus($request);
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
        $product = Product::firstWhere('code', $code);
        $request->validate(
            [
                'name' => 'required',
                'code' => [
                    'required',
                    Rule::unique('products')->ignore($product->id),
                ],
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
                'unique' => 'Kode barang sudah ada!',
                'image.image' => 'File harus berupa gambar (jpg, jpeg, dan png)',
                'image.max' => 'Ukuran gambar maksimal yang diterima adalah sebesar :max MB'
            ]
        );

        try {
            $formInput = [
                'unit_id' => $request->input('unit') != null ? $request->input('unit') : $product->unit_id,
                'name' => $request->input('name') != null ? $request->input('name') : $product->name,
                'code' => $request->input('code') != null ? $request->input('code') : $product->code,
                'stock' => $request->input('stock') != null ? $request->input('stock') : $product->stock,
                'minimum_stock' => $request->input('minimum_stock') != null ? $request->input('minimum_stock') : $product->minimum_stock,
                'base_price' => $request->input('base_price') != null ? $request->input('base_price') : $product->base_price,
                'profit' => $request->input('profit') != null ? $request->input('profit') : $product->profit,
                'updated_at' => now()
            ];
    
            // Kalau ada gambar yang di-upload
            if ($request->image) {
                $imgName = strtotime('now') . '-' . preg_replace('/\s+/', '-', $request->image->getClientOriginalName());
                $formInput['image'] = $imgName;
                $request->image->storeAs('./public/img', $imgName);
            }
    
            Product::where('code', $code)->update($formInput);
            return redirect('/products')->with('success', 'Ubah barang jadi berhasil!');
        } catch(QueryException $ex) {
            return redirect('/products')->with('error', 'Ubah barang jadi gagal!');
        }
    }

    public function deactivate(Request $request, $code)
    {
        $status = 1;
        Product::where('code', $code)->update(['status_id' => $status]);
        return redirect('/products');
    }

    public function activate(Request $request, $code)
    {
        $status = 2;
        Product::where('code', $code)->update(['status_id' => $status]);
        return redirect('/products');
    }

    public function destroy($code)
    {
        try {
            Product::where('code', $code)->delete();
            return redirect('/products')->with('success', 'Penghapusan barang jadi berhasil!');
        } catch(QueryException $ex) {
            return redirect('/products')->with('error', 'Penghapusan barang jadi gagal!');
        }
    }
}
