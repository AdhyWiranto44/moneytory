<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Expense;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $expenses = Expense::all();
        $menus = Helper::getMenus($request);
        $data = [
            'title' => 'Pengeluaran',
            'menus' => $menus,
            'expenses' => $expenses,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];
        return view('expenses', $data);
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
        return view('expense_add', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'code' => 'required|unique:expenses',
                'description' => 'required',
                'cost' => 'required|numeric',
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
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'description' => $request->input('description'),
                'cost' => $request->input('cost'),
                'created_at' => now(),
                'updated_at' => now()
            ];

            // Kalau ada gambar yang di-upload
            if ($request->image) {
                $imgName = strtotime('now') . '-' . preg_replace('/\s+/', '-', $request->image->getClientOriginalName());
                $formInput['image'] = $imgName;
                $request->image->storeAs('./public/img', $imgName);
            }

            $expense = Expense::create($formInput);
            $expense->save();
    
            return redirect('/expenses')->with('success', 'Tambah Pengeluaran Berhasil!');
        } catch(QueryException $ex) {
            return redirect('/expenses')->with('error', 'Tambah Pengeluaran Gagal!');
        }
    }

    public function edit(Request $request, $code)
    {
        $user = Helper::getUserLogin($request);
        $company = Helper::getCompanyProfile();
        $expense = Expense::firstWhere('code', $code);
        $menus = Helper::getMenus($request);
        $data = [
            'title' => 'Ubah',
            'expense' => $expense,
            'menus' => $menus,
            'username' => $user->username,
            'userImage' => $user->image,
            'companyName' => $company->name,
            'companyLogo' => $company->image,
        ];

        return view('expense_edit', $data);
    }

    public function update(Request $request, $code)
    {
        $expense = Expense::firstWhere('code', $code);
        $request->validate(
            [
                'name' => 'required',
                'code' => [
                    'required',
                    Rule::unique('expenses')->ignore($expense->id),
                ],
                'description' => 'required',
                'cost' => 'required|numeric',
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
                'name' => $request->input('name') != null ? $request->input('name') : $expense->name,
                'code' => $request->input('code') != null ? $request->input('code') : $expense->code,
                'description' => $request->input('description') != null ? $request->input('description') : $expense->description,
                'cost' => $request->input('cost') != null ? $request->input('cost') : $expense->cost,
                'updated_at' => now()
            ];
    
            // Kalau ada gambar yang di-upload
            if ($request->image) {
                $imgName = strtotime('now') . '-' . preg_replace('/\s+/', '-', $request->image->getClientOriginalName());
                $formInput['image'] = $imgName;
                $request->image->storeAs('./public/img', $imgName);
            }
    
            Expense::where('code', $code)->update($formInput);
            return redirect('/expenses')->with('success', 'Ubah pengeluaran berhasil!');
        } catch(QueryException $ex) {
            return redirect('/expenses')->with('error', 'Ubah pengeluaran gagal!');
        }
    }
    
    public function destroy($code)
    {
        try {
            Expense::where('code', $code)->delete();
            return redirect('/expenses')->with('success', 'Penghapusan pengeluaran berhasil!');
        } catch(QueryException $ex) {
            return redirect('/expenses')->with('error', 'Penghapusan pengeluaran gagal!');
        }
    }
}
